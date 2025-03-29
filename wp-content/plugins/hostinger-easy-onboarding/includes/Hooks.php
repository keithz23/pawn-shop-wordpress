<?php

namespace Hostinger\EasyOnboarding;

use Hostinger\EasyOnboarding\Admin\Actions as Admin_Actions;
use Hostinger\EasyOnboarding\Admin\Onboarding\Onboarding;
use Hostinger\EasyOnboarding\AmplitudeEvents\Amplitude;
use Hostinger\EasyOnboarding\AmplitudeEvents\Actions as AmplitudeActions;
use WP_Admin_Bar;

defined('ABSPATH') || exit;

class Hooks
{
    public const HOMEPAGE_DISPLAY = 'page';

    private Onboarding $onboarding;
    private bool $event_incremented = false;

    public function __construct() {
        $this->onboarding = new Onboarding();

        add_action( 'init', [ $this, 'check_url_and_flush_rules' ] );
        add_action( 'template_redirect', [ $this, 'admin_preview_website' ] );

        add_filter( 'hostinger_once_per_day_events', [ $this, 'limit_triggered_amplitude_events' ] );

        add_action( 'activate_plugin', [ $this, 'prevent_flexible_shipping_redirect' ] );
        add_action( 'activated_plugin', [ $this, 'maybe_mark_payments_step_completed' ] );
        add_action( 'update_option_WPLANG', [ $this, 'changed_site_language' ], 10, 3 );
        add_action( 'password_reset', [ $this, 'admin_password_reset_action' ], 10, 2 );
        add_action( 'profile_update', [ $this, 'admin_password_reset_action_on_edit' ], 10, 2 );
        //Edit site events
        add_action( 'save_post', [ $this, 'save_post_content' ], 10, 3 );
        add_action( 'updated_option', [ $this, 'save_settings' ], 10, 1 );
        add_action( 'customize_save_after', [ $this, 'save_customizer_settings' ] );
        add_action( 'admin_bar_menu', [ $this, 'customize_admin_bar_logo' ], 100 );
        add_action( 'admin_bar_menu', [ $this, 'custom_admin_bar_edit_home_page_link' ], 9999 );

        add_action( 'plugins_loaded', [ $this, 'disable_prebuild_website_redirect' ] );
    }

    public function disable_prebuild_website_redirect(): void {
        add_filter( 'srfm_enable_redirect_activation', fn( $do_redirect ) => false, 10 );
    }

    public function admin_password_reset_action( \WP_User $user, string $new_pass ): void {
        $amplitudeEvents = new Amplitude();

        if ( ! in_array( 'administrator', (array)$user->roles ) ) {
            return;
        }

        $amplitudeEvents->send_event( [ 'action' => AmplitudeActions::WP_PASSWORD_RESET ] );
    }

    public function admin_password_reset_action_on_edit( int $user_id, \WP_User $old_user_data ): void {
        $amplitudeEvents = new Amplitude();
        $user            = get_userdata( $user_id );

        if ( user_can( $user, 'administrator' ) && isset( $_POST['pass1'] ) && ! empty( $_POST['pass1'] ) ) {
            $amplitudeEvents->send_event( [ 'action' => AmplitudeActions::WP_PASSWORD_RESET ] );
        }
    }

    public function changed_site_language( mixed $old_value, mixed $new_value, string $option_name ): void {
        $amplitudeEvents = new Amplitude();
        $current_lang    = get_locale();
        $new_value       = $new_value ?: 'en_US';

        $params = [
            'action'       => AmplitudeActions::WP_CHANGED_LANG,
            'old_language' => $current_lang,
            'new_language' => $new_value,
        ];

        $amplitudeEvents->send_event( $params );
    }

    public function save_post_content(int $post_ID, \WP_Post $post, bool $update): void
    {
        $amplitudeEvents = new Amplitude();

        if (Helper::should_skip_event() || $this->event_incremented) {
            return;
        }

        if ($post->post_status === 'auto-draft') {
            return;
        }

        if ($amplitudeEvents->canSendEditAmplitudeEvent()) {
            $amplitudeEvents->sendEditAmplitudeEvent();
            $this->event_incremented = true;
        }
    }

    public function save_settings(string $option_name): void
    {
        $amplitudeEvents     = new Amplitude();
        $skip_options        = in_array($option_name, [
            'hostinger_amplitude_event_data',
            'hostinger_amplitude_edit_count',
        ]);
        $option_page_not_set = ! isset($_POST['option_page']);

        if (Helper::should_skip_event() || $skip_options || $this->event_incremented || $option_page_not_set) {
            return;
        }

        if ($amplitudeEvents->canSendEditAmplitudeEvent()) {
            $amplitudeEvents->sendEditAmplitudeEvent();
            $this->event_incremented = true;
        }
    }

    public function save_customizer_settings(): void
    {
        $amplitudeEvents = new Amplitude();

        if (Helper::should_skip_event() || $this->event_incremented) {
            return;
        }

        if ($amplitudeEvents->canSendEditAmplitudeEvent()) {
            $amplitudeEvents->sendEditAmplitudeEvent();
            $this->event_incremented = true;
        }
    }

    public function check_url_and_flush_rules()
    {
        if (defined('DOING_AJAX') && \DOING_AJAX) {
            return false;
        }

        $current_url    = home_url(add_query_arg(null, null));
        $url_components = wp_parse_url($current_url);

        if (isset($url_components['query'])) {
            parse_str($url_components['query'], $params);

            if (isset($params['app_name'])) {
                $app_name = sanitize_text_field($params['app_name']);

                if ($app_name === 'Omnisend App') {
                    if (function_exists('flush_rewrite_rules')) {
                        flush_rewrite_rules();
                    }

                    if (has_action('litespeed_purge_all')) {
                        do_action('litespeed_purge_all');
                    }
                }
            }
        }
    }

    public function admin_preview_website()
    {
        if ( ! current_user_can('manage_options')) {
            return false;
        }

        $amplitude = new Amplitude();

        $appearance      = get_option('hostinger_appearance', 'none');
        $subscription_id = get_option('hostinger_subscription_id', 0);

        $params = [
            'action'          => 'wordpress.preview_site',
            'appearance'      => $appearance,
            'subscription_id' => $subscription_id,
        ];

        $amplitude->send_event($params);
    }

    public function limit_triggered_amplitude_events($events): array
    {
        $new_events = [
            AmplitudeActions::WP_PREVIEW_SITE,
            AmplitudeActions::WP_EASY_ONBOARDING_ENTER,
            AmplitudeActions::WP_CONNECT_DOMAIN_SHOWN,
            AmplitudeActions::WP_CONNECT_DOMAIN_ENTER,
            AmplitudeActions::WP_EASY_ONBOARDING_COMPLETED,
            AmplitudeActions::WP_BLACK_FRIDAY_BANNER_OFFER_SHOWN,
            AmplitudeActions::WP_CHANGED_LANG,
            AmplitudeActions::WP_PASSWORD_RESET,
            AmplitudeActions::WP_ADDONS_BANNER_SHOWN,
        ];

        return array_merge($events, $new_events);
    }

    // Mark payments step completed if Amazon Pay payment gateway plugin is activated because this payment gateway is enabled after activation right away.
    public function maybe_mark_payments_step_completed(string $plugin): void
    {
        if ( ! is_plugin_active('woocommerce/woocommerce.php')) {
            return;
        }

        if ($plugin
            !== 'woocommerce-gateway-amazon-payments-advanced/woocommerce-gateway-amazon-payments-advanced.php') {
            return;
        }

        $this->onboarding->init();

        if ($this->onboarding->is_completed(
            Onboarding::HOSTINGER_EASY_ONBOARDING_STORE_STEP_CATEGORY_ID,
            Admin_Actions::ADD_PAYMENT
        )) {
            return;
        }

        $this->onboarding->complete_step(
            Onboarding::HOSTINGER_EASY_ONBOARDING_STORE_STEP_CATEGORY_ID,
            Admin_Actions::ADD_PAYMENT
        );
    }

    public function prevent_flexible_shipping_redirect(string $plugin): void
    {
        // Disable Flexible shipping activation redirect by setting value to true.
        if ($plugin == 'flexible-shipping/flexible-shipping.php') {
            $flexible_shipping_redirect = get_option('flexible-shipping-activation-redirected', false);

            if (empty($flexible_shipping_redirect)) {
                update_option('flexible-shipping-activation-redirected', 1);
            }
        }
    }

    public function customize_admin_bar_logo(WP_Admin_Bar $wp_admin_bar): void
    {
        $wp_admin_bar->add_node([
            'id'   => 'wp-logo',
            'href' => admin_url(),
        ]);
    }

    public function custom_admin_bar_edit_home_page_link(WP_Admin_Bar $wp_admin_bar): void
    {
        if (wp_is_block_theme()) {
            return;
        }

        $front_page_id = get_option('page_on_front');
        $show_on_front = get_option('show_on_front');

        if ($show_on_front !== self::HOMEPAGE_DISPLAY || !$front_page_id) {
            return;
        }

        $query_args = [
            'post'   => $front_page_id,
            'action' => 'edit',
        ];

        $edit_url = add_query_arg($query_args, admin_url('post.php'));

        $wp_admin_bar->add_node([
            'id'    => 'edit_home_page',
            'title' => __('Edit Home Page', 'hostinger-easy-onboarding'),
            'href'  => $edit_url,
        ]);
    }
}
