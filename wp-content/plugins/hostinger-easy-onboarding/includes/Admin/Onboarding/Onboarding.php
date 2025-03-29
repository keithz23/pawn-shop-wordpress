<?php

namespace Hostinger\EasyOnboarding\Admin\Onboarding;

use Hostinger\EasyOnboarding\Admin\Actions;
use Hostinger\EasyOnboarding\Admin\Onboarding\Steps\Button;
use Hostinger\EasyOnboarding\Admin\Onboarding\Steps\Step;
use Hostinger\EasyOnboarding\Admin\Onboarding\Steps\StepCategory;
use Hostinger\EasyOnboarding\AmplitudeEvents\Actions as AmplitudeActions;
use Hostinger\EasyOnboarding\AmplitudeEvents\Amplitude;
use Hostinger\EasyOnboarding\Helper;

defined( 'ABSPATH' ) || exit;

class Onboarding {
    private const HOSTINGER_ADD_DOMAIN_URL  = 'https://hpanel.hostinger.com/add-domain/';
    private const HOSTINGER_WEBSITES_URL    = 'https://hpanel.hostinger.com/websites';
    public const HOSTINGER_EASY_ONBOARDING_STEPS_OPTION_NAME    = 'hostinger_easy_onboarding_steps';
    public const HOSTINGER_EASY_ONBOARDING_WEBSITE_STEP_CATEGORY_ID   = 'website_setup';
    public const HOSTINGER_EASY_ONBOARDING_STORE_STEP_CATEGORY_ID   = 'online_store_setup';
    /**
     * @var Helper
     */
    private Helper $helper;

    /**
     * @var array
     */
    private array $step_categories = array();

    /**
     * @return void
     */
    public function init(): void {
        $this->helper = new Helper();

        $this->load_step_categories();
    }

    /**
     * @return void
     */
    private function load_step_categories(): void {
        include_once ABSPATH . 'wp-admin/includes/plugin.php';

        $website_step_category = new StepCategory(
            self::HOSTINGER_EASY_ONBOARDING_WEBSITE_STEP_CATEGORY_ID,
            __( 'Website setup', 'hostinger-easy-onboarding' )
        );

        $first_step = $this->get_first_step_data();

        if ( ! empty( $first_step->get_title() ) ) {
            $website_step_category->add_step( $first_step );
        }

        if ( is_plugin_active( 'hostinger-affiliate-plugin/hostinger-affiliate-plugin.php' ) ) {
            $website_step_category->add_step( $this->get_amazon_affiliate_step() );
        }

        if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            $website_step_category->add_step( $this->get_started_with_store() );
        }

        // Connect domain.
        $website_step_category->add_step( $this->get_add_domain_step() );

        $website_step_category->add_step( $this->get_google_kit_step() );

        // Add category.
        $this->step_categories[] = $website_step_category;

        if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            $store_step_category = new StepCategory(
                self::HOSTINGER_EASY_ONBOARDING_STORE_STEP_CATEGORY_ID,
                __('Online store setup', 'hostinger-easy-onboarding')
            );

            // Setup online store.
            $store_step_category->add_step( $this->get_setup_online_store() );

            // Add product.
            $store_step_category->add_step( $this->get_add_product_step() );

            // Add payment method.
            $store_step_category->add_step( $this->get_payment_method_step() );

            // Add shipping method.
            $store_step_category->add_step( $this->get_shipping_method_step() );

            $this->step_categories[] = $store_step_category;
        }
    }

    /**
     * @return array
     */
    public function get_step_categories(): array {
        return array_map(
            function ( $item ) {
                return $item->to_array();
            },
            $this->step_categories
        );
    }

    /**
     * @param string $step_category_id
     * @param string $step_id
     *
     * @return bool
     */
    public function complete_step( string $step_category_id, string $step_id ): bool {
        if ( !$this->validate_step( $step_category_id, $step_id ) ) {
            return false;
        }

        $onboarding_steps = $this->get_saved_steps();

        if(empty($onboarding_steps[$step_category_id])) {
            $onboarding_steps[$step_category_id] = array();
        }

        $onboarding_steps[$step_category_id][$step_id] = true;

        $this->maybe_send_store_events( $onboarding_steps );

        return update_option( self::HOSTINGER_EASY_ONBOARDING_STEPS_OPTION_NAME, $onboarding_steps, false );
    }

    /**
     * @param string $step_category_id
     * @param string $step_id
     *
     * @return bool
     */
    public function validate_step( string $step_category_id, string $step_id ): bool {
        $step_categories = $this->get_step_categories();

        if(empty($step_categories)) {
            return false;
        }

        // Try to match step category id.
        $found = false;
        foreach($step_categories as $step_category) {
            if($step_category['id'] == $step_category_id) {
                if(!empty($step_category['steps'])) {
                    foreach($step_category['steps'] as $step) {
                        if($step['id'] == $step_id) {
                            $found = true;
                            break;
                        }
                    }
                }
                break;
            }
        }

        if(empty($found)) {
            return false;
        }

        return true;
    }

    /**
     * @param string $step_category_id
     * @param string $step_id
     *
     * @return bool
     */
    public function is_completed( string $step_category_id, string $step_id ) : bool {
        $onboarding_steps = $this->get_saved_steps();

        if(empty($onboarding_steps[$step_category_id][$step_id])) {
            return false;
        }

        return (bool)$onboarding_steps[$step_category_id][$step_id];
    }

    /**
     * @return array
     */
    private function get_saved_steps(): array {
        return get_option( self::HOSTINGER_EASY_ONBOARDING_STEPS_OPTION_NAME, array() );
    }

    private function get_add_domain_step(): Step
    {
        $step = new Step( Actions::DOMAIN_IS_CONNECTED );

        $step->set_image_url( HOSTINGER_EASY_ONBOARDING_ASSETS_URL . '/images/steps/connect_domain.svg' );

        $step->set_title( __( 'Add a domain', 'hostinger-easy-onboarding' ) );

        $button = new Button( __( 'Add domain', 'hostinger-easy-onboarding' ) );

        if ( $this->helper->is_free_subdomain() || $this->helper->is_preview_domain() ) {
            if( $this->is_completed( self::HOSTINGER_EASY_ONBOARDING_WEBSITE_STEP_CATEGORY_ID, Actions::DOMAIN_IS_CONNECTED ) ) {
                $step->set_title( __( 'Connect on hPanel', 'hostinger-easy-onboarding' ) );
            }

            $step->set_description(
                __(
                    'Visit hPanel and connect a real domain. If you already did this, please wait up to 24h until the domain fully connects',
                    'hostinger-easy-onboarding'
                )
            );

            $site_url   = preg_replace( '#^https?://#', '', get_site_url() );
            $hpanel_url = self::HOSTINGER_WEBSITES_URL . '/' . $site_url;

            $button->set_title( __( 'Connect on hPanel', 'hostinger-easy-onboarding' ) );
            $button->set_url( $hpanel_url );

        } else {
            if( $this->is_completed( self::HOSTINGER_EASY_ONBOARDING_WEBSITE_STEP_CATEGORY_ID, Actions::DOMAIN_IS_CONNECTED ) ) {
                $step->set_title( __( 'Connected a domain', 'hostinger-easy-onboarding' ) );
            }

            $step->set_description(
                __(
                    'Every website needs a domain that makes it easy to access and remember. Get yours in just a few clicks.',
                    'hostinger-easy-onboarding'
                )
            );

            $site_url   = preg_replace( '#^https?://#', '', get_site_url() );
            $hpanel_url = self::HOSTINGER_ADD_DOMAIN_URL . $site_url . '/select';

            $query_parameters = array(
                'websiteType' => 'wordpress',
                'redirectUrl' => self::HOSTINGER_WEBSITES_URL,
            );

            $button->set_url( $hpanel_url . '?' . http_build_query( $query_parameters ) );
        }

        if( !$this->is_completed( self::HOSTINGER_EASY_ONBOARDING_WEBSITE_STEP_CATEGORY_ID, Actions::DOMAIN_IS_CONNECTED ) ) {
            $step->set_primary_button( $button );
        }

        return $step;
    }

    private function get_amazon_affiliate_step(): Step
    {
        $step = new Step(Actions::AMAZON_AFFILIATE);

        $step->set_image_url( HOSTINGER_EASY_ONBOARDING_ASSETS_URL . '/images/steps/amazon_affiliate.svg' );

        $step->set_title( __( 'Connect your Amazon account to the site', 'hostinger-easy-onboarding' ) );

        if( $this->is_completed( self::HOSTINGER_EASY_ONBOARDING_WEBSITE_STEP_CATEGORY_ID, Actions::AMAZON_AFFILIATE ) ) {
            $step->set_title( __( 'Connected your Amazon account', 'hostinger-easy-onboarding' ) );
        }

        $step->set_description( __( 'Link your Amazon Associates account to your website, start promoting products, and earn rewards. No API key required.', 'hostinger-easy-onboarding' ) );

        $button = new Button( __( 'Connect Amazon to site', 'hostinger-easy-onboarding' ) );

        $button->set_url( admin_url( 'admin.php?page=hostinger-amazon-affiliate' ) );

        if( !$this->is_completed( self::HOSTINGER_EASY_ONBOARDING_WEBSITE_STEP_CATEGORY_ID, Actions::AMAZON_AFFILIATE ) ) {
            $step->set_primary_button( $button );
        }

        return $step;
    }

    private function get_started_with_store(): Step
    {
        $step = new Step( Actions::STORE_TASKS );

        $step->set_image_url( HOSTINGER_EASY_ONBOARDING_ASSETS_URL . '/images/steps/store_tasks.svg' );

        $step->set_title( __( 'Set up your online store', 'hostinger-easy-onboarding' ) );

        $step->set_description( __( 'Get ready to sell online. Add your first product, then set up shipping and payments.', 'hostinger-easy-onboarding' ) );

        $primary_button = new Button( __( 'Get started', 'hostinger-easy-onboarding' ) );

        $primary_button->set_url( admin_url( 'admin.php?page=hostinger-get-onboarding' ) );

        if( $this->is_completed( self::HOSTINGER_EASY_ONBOARDING_WEBSITE_STEP_CATEGORY_ID, Actions::STORE_TASKS ) ) {
            $primary_button->set_title( __( 'View list', 'hostinger-easy-onboarding' ) );
        }

        if( !$this->is_completed( self::HOSTINGER_EASY_ONBOARDING_WEBSITE_STEP_CATEGORY_ID, Actions::STORE_TASKS ) ) {
            $step->set_primary_button( $primary_button );
        }

        return $step;
    }

    private function get_setup_online_store(): Step
    {
        $step = new Step( Actions::SETUP_STORE );

        $step->set_image_url( HOSTINGER_EASY_ONBOARDING_ASSETS_URL . '/images/steps/store_tasks.svg' );

        $step->set_title( __( 'Add store details', 'hostinger-easy-onboarding' ) );

        $step->set_description( __( 'We\'ll use this information to help you set up your store faster.', 'hostinger-easy-onboarding' ) );

        $primary_button = new Button( __( 'Get started', 'hostinger-easy-onboarding' ) );

        if( $this->is_completed( self::HOSTINGER_EASY_ONBOARDING_STORE_STEP_CATEGORY_ID, Actions::SETUP_STORE ) ) {
            $primary_button->set_url( admin_url( 'admin.php?page=wc-settings' ) );
        } else {
            $primary_button->set_modal_name( 'SetupOnlineStoreModal' );
        }

        if( !$this->is_completed( self::HOSTINGER_EASY_ONBOARDING_STORE_STEP_CATEGORY_ID, Actions::SETUP_STORE ) ) {
            $step->set_primary_button( $primary_button );
        }

        return $step;
    }

    private function get_add_product_step(): Step
    {
        $step = new Step( Actions::ADD_PRODUCT );

        $step->set_image_url( HOSTINGER_EASY_ONBOARDING_ASSETS_URL . '/images/steps/add_product.svg' );

        $step->set_title( __( 'Add your first product or service', 'hostinger-easy-onboarding' ) );

        $step->set_description( __( 'Sell products, services and digital downloads. Set up and customize each item to fit your business needs.', 'hostinger-easy-onboarding' ) );

        $primary_button = new Button( __( 'Add product', 'hostinger-easy-onboarding' ) );

        $primary_button->set_url( admin_url( 'post-new.php?post_type=product' ) );

        $secondary_button = new Button( __( 'Not now', 'hostinger-easy-onboarding' ) );

        $secondary_button->set_is_skippable( true );

        if( !$this->is_completed( self::HOSTINGER_EASY_ONBOARDING_STORE_STEP_CATEGORY_ID, Actions::ADD_PRODUCT ) ) {
            $step->set_primary_button( $primary_button );
            $step->set_secondary_button( $secondary_button );
        }

        return $step;
    }

    private function get_payment_method_step(): Step
    {
        $step = new Step( Actions::ADD_PAYMENT );

        $step->set_image_url( HOSTINGER_EASY_ONBOARDING_ASSETS_URL . '/images/steps/add_payment_method.svg' );

        $step->set_title( __( 'Set up payments', 'hostinger-easy-onboarding' ) );

        $step->set_description( __( 'Get ready to sell online. Add your first product, then set up payments and shipping.', 'hostinger-easy-onboarding' ) );

        $primary_button = new Button( __( 'Set up payment method', 'hostinger-easy-onboarding' ) );

        $primary_button->set_modal_name( 'SetupPaymentMethodModal' );

        $primary_button->set_url( admin_url( 'admin.php?page=hostinger-get-onboarding&subPage=hostinger-store-add-payment-method' ) );

        if( !$this->is_completed( self::HOSTINGER_EASY_ONBOARDING_STORE_STEP_CATEGORY_ID, Actions::ADD_PAYMENT ) ) {
            $step->set_primary_button( $primary_button );
        }

        return $step;
    }

    private function get_shipping_method_step(): Step
    {
        $step = new Step( Actions::ADD_SHIPPING );

        $step->set_image_url( HOSTINGER_EASY_ONBOARDING_ASSETS_URL . '/images/steps/add_shipping_method.svg' );

        $step->set_title( __( 'Manage shipping', 'hostinger-easy-onboarding' ) );

        $step->set_description( __( 'Choose the ways you\'d like to ship orders to customers. You can always add others later.', 'hostinger-easy-onboarding' ) );

        $primary_button = new Button( __( 'Set up shipping method', 'hostinger-easy-onboarding' ) );

        $primary_button->set_modal_name( 'SetupShippingMethodModal' );

        $primary_button->set_url( admin_url( 'admin.php?page=hostinger-get-onboarding&subPage=hostinger-store-add-shipping-method' ) );

        $secondary_button = new Button( __( 'Not needed', 'hostinger-easy-onboarding' ) );

        $secondary_button->set_is_skippable( true );

        if( !$this->is_completed( self::HOSTINGER_EASY_ONBOARDING_STORE_STEP_CATEGORY_ID, Actions::ADD_SHIPPING ) ) {
            $step->set_primary_button( $primary_button );
            $step->set_secondary_button( $secondary_button );
        }

        return $step;
    }

    private function get_google_kit_step(): Step
    {
        $step = new Step( Actions::GOOGLE_KIT );

        $step->set_image_url( HOSTINGER_EASY_ONBOARDING_ASSETS_URL . '/images/steps/google_kit.svg' );

        $step->set_title( __( 'Get found on Google', 'hostinger-easy-onboarding' ) );

        $step->set_description( __( 'Make sure that your website shows up when visitors are looking for your business on Google.', 'hostinger-easy-onboarding' ) );

        $primary_button = new Button( __( 'Set up Google Site Kit', 'hostinger-easy-onboarding' ) );

        $primary_button->set_url( admin_url( 'admin.php?page=googlesitekit-splash' ) );

        if( $this->is_completed( self::HOSTINGER_EASY_ONBOARDING_WEBSITE_STEP_CATEGORY_ID, Actions::GOOGLE_KIT ) ) {
            $primary_button->set_title( __( 'Manage', 'hostinger-easy-onboarding' ) );
        } else {
            $primary_button->set_modal_name( 'SkipGoogleSiteKitModal' );
        }

        $secondary_button = new Button( __( 'Not needed', 'hostinger-easy-onboarding' ) );

        $secondary_button->set_is_skippable( true );

        if( ! $this->is_completed( self::HOSTINGER_EASY_ONBOARDING_WEBSITE_STEP_CATEGORY_ID, Actions::DOMAIN_IS_CONNECTED ) ) {
            $step->set_error_message( __( 'Connect your domain first', 'hostinger-easy-onboarding' ) );
            $primary_button->set_title( '' );
            $secondary_button->set_title( '' );

            $step->set_secondary_button( $secondary_button );
        }

        if( !$this->is_completed( self::HOSTINGER_EASY_ONBOARDING_WEBSITE_STEP_CATEGORY_ID, Actions::GOOGLE_KIT ) ) {
            $step->set_primary_button( $primary_button );
        }

        return $step;
    }

    public function maybe_send_store_events( array $steps ) : void {
        if ( $this->is_store_ready( $steps ) ) {
            $this->send_event( AmplitudeActions::WOO_READY_TO_SELL, true );
        }

        if ( $this->is_store_completed( $steps ) ) {
            $this->send_event( AmplitudeActions::WOO_SETUP_COMPLETED, true );
        }
    }

    private function is_store_ready( array $steps ): bool {
        $store_steps = $steps[Onboarding::HOSTINGER_EASY_ONBOARDING_STORE_STEP_CATEGORY_ID] ?? array();
        return !empty( $store_steps[Actions::ADD_PAYMENT] ) && !empty( $store_steps[Actions::ADD_PRODUCT] );
    }

    private function is_store_completed( $steps ): bool {
        $all_woo_steps = Actions::get_category_action_lists()[ Onboarding::HOSTINGER_EASY_ONBOARDING_STORE_STEP_CATEGORY_ID ];
        $completed_woo_steps = !empty($steps[Onboarding::HOSTINGER_EASY_ONBOARDING_STORE_STEP_CATEGORY_ID]) ? $steps[Onboarding::HOSTINGER_EASY_ONBOARDING_STORE_STEP_CATEGORY_ID] : array();

        foreach ( $all_woo_steps as $step_key ) {
            if ( empty( $completed_woo_steps[ $step_key ] ) ) {
                return false;
            }
        }

        return true;
    }

    private function send_event( string $action, bool $once = false ): bool {
        if ( $once ) {
            $option_name = 'hostinger_amplitude_' . $action;

            $event_sent = get_option( $option_name, false );

            if ( $event_sent ) {
                return false;
            }
        }

        $amplitude = new Amplitude();

        $params = array( 'action' => $action );

        $event = $amplitude->send_event( $params );

        if( $once ) {
            update_option( $option_name, true );
        }

        return !empty( $event );
    }

    public function get_first_step_data(): Step
    {
        include_once ABSPATH . 'wp-admin/includes/plugin.php';

        $step = new Step( Actions::AI_STEP );

        $builder_type = get_option( 'hostinger_builder_type' );

        if ( $builder_type === 'ai' ) {
            $hostinger_ai_version = get_option( 'hostinger_ai_version', false );

            $step->set_image_url( HOSTINGER_EASY_ONBOARDING_ASSETS_URL . '/images/steps/ai_step.svg' );

            if ( empty( $hostinger_ai_version ) ) {
                $step->set_title( __( 'Create a site with AI', 'hostinger-easy-onboarding' ) );
                $step->set_description( __( 'Build a professional, custom-designed site in moments. Just a few clicks and AI handles the rest.', 'hostinger-easy-onboarding' ) );

                $step->set_title( __( 'Connected a domain', 'hostinger-easy-onboarding' ) );
                $primary_button = new Button();
                $primary_button->set_title( __( 'Create site with AI', 'hostinger-easy-onboarding' ) );
                $primary_button->set_url( admin_url( 'admin.php?page=hostinger-ai-website-creation&redirect=hostinger-easy-onboarding' ) );

                $secondary_button = new Button();
                $secondary_button->set_title( __( 'Not now', 'hostinger-easy-onboarding' ) );
            } else {
                $step->set_title( __( 'Want to create a new AI site?', 'hostinger-easy-onboarding' ) );
                $step->set_description( __( 'Your new site will replace the current one. Use the same description or change it.', 'hostinger-easy-onboarding' ) );

                $primary_button = new Button();
                $primary_button->set_title( __( 'Keep current site', 'hostinger-easy-onboarding' ) );
                $primary_button->set_is_skippable( true );

                $secondary_button = new Button();
                $secondary_button->set_title( __( 'Create new site', 'hostinger-easy-onboarding' ) );
                $secondary_button->set_url( admin_url( 'admin.php?page=hostinger-ai-website-creation&redirect=hostinger-easy-onboarding' ) );
            }

            if( !$this->is_completed( self::HOSTINGER_EASY_ONBOARDING_WEBSITE_STEP_CATEGORY_ID, Actions::AI_STEP ) ) {
                $step->set_primary_button( $primary_button );
                $step->set_secondary_button( $secondary_button );
            }

            return $step;
        }

        if ( $builder_type === 'prebuilt' ) {
            $step->set_image_url( HOSTINGER_EASY_ONBOARDING_ASSETS_URL . '/images/steps/prebuilt.svg' );

            $step->set_title( __( 'Want to create a new site on a different template?', 'hostinger-easy-onboarding' ) );
            $step->set_description( __( 'Your new site will replace the current one. Choose from 140+ professional templates.', 'hostinger-easy-onboarding' ) );

            if( !$this->is_completed( self::HOSTINGER_EASY_ONBOARDING_WEBSITE_STEP_CATEGORY_ID, Actions::AI_STEP ) ) {
                $primary_button = new Button();
                $primary_button->set_title( __( 'Keep current site', 'hostinger-easy-onboarding' ) );
                $primary_button->set_is_skippable( true );
                $step->set_primary_button( $primary_button );

                $secondary_button = new Button();
                $secondary_button->set_title( __( 'Choose another template', 'hostinger-easy-onboarding' ) );
                $secondary_button->set_is_astra_needed( true );
                $secondary_button->set_url( admin_url( 'themes.php?page=starter-templates&ci=1' ) );
                $step->set_secondary_button( $secondary_button );
            }
        }

        $whitelist_plans = array(
            'cloud_economy',
            'cloud_enterprise',
            'cloud_professional',
            'hostinger_business',
        );

        $hosting_plan = get_option( 'hostinger_hosting_plan', false );

        if ( $builder_type === 'theme' && !empty( $hosting_plan ) ) {
            $primary_button = new Button();
            $secondary_button = new Button();

            if ( in_array( $hosting_plan, $whitelist_plans ) ) {
                $step->set_image_url( HOSTINGER_EASY_ONBOARDING_ASSETS_URL . '/images/steps/ai_step.svg' );
                $step->set_title( __( 'Want to create a new site?', 'hostinger-easy-onboarding' ) );
                $step->set_description( __( 'Your new site will replace the current one. Choose from 140+ professional templates or use AI.', 'hostinger-easy-onboarding' ) );
                $primary_button->set_title( __( 'Keep current site', 'hostinger-easy-onboarding' ) );
                $primary_button->set_is_skippable( true );
                $secondary_button->set_title( __( 'Create new site', 'hostinger-easy-onboarding' ) );
                $secondary_button->set_modal_name( 'CreateWebsiteWithAiBuilderModal' );
            } else {
                $step->set_image_url( HOSTINGER_EASY_ONBOARDING_ASSETS_URL . '/images/steps/prebuilt.svg' );
                $step->set_title( __( 'Want to create a new site on a pre-built template?', 'hostinger-easy-onboarding' ) );
                $step->set_description( __( 'Your new site will replace the current one. Choose from 140+ professional templates.', 'hostinger-easy-onboarding' ) );
                $primary_button->set_title( __( 'Keep current site', 'hostinger-easy-onboarding' ) );
                $primary_button->set_is_skippable( true );
                $secondary_button->set_title( __( 'Choose a template', 'hostinger-easy-onboarding' ) );
                $secondary_button->set_is_astra_needed( true );
                $secondary_button->set_url( admin_url( 'themes.php?page=starter-templates&ci=1' ) );
            }

            if( !$this->is_completed( self::HOSTINGER_EASY_ONBOARDING_WEBSITE_STEP_CATEGORY_ID, Actions::AI_STEP ) ) {
                $step->set_primary_button( $primary_button );

                $step->set_secondary_button( $secondary_button );
            }
        }

        if ( $builder_type === 'blank' && !empty( $hosting_plan ) ) {
            $primary_button = new Button();
            $secondary_button = new Button();

            if ( in_array( $hosting_plan, $whitelist_plans ) ) {
                $step->set_image_url( HOSTINGER_EASY_ONBOARDING_ASSETS_URL . '/images/steps/ai_step.svg' );
                $step->set_title( __( 'Start creating your site', 'hostinger-easy-onboarding' ) );
                $step->set_description( __( 'Build a professional, custom-designed site in moments. Choose from 140+ templates or use AI.', 'hostinger-easy-onboarding' ) );
                $primary_button->set_title( __( 'Create site', 'hostinger-easy-onboarding' ) );
                $primary_button->set_modal_name( 'CreateWebsiteWithAiBuilderModal' );
                $secondary_button->set_title( __( 'Not now', 'hostinger-easy-onboarding' ) );
                $secondary_button->set_is_skippable( true );
            } else {
                $step->set_image_url( HOSTINGER_EASY_ONBOARDING_ASSETS_URL . '/images/steps/prebuilt.svg' );
                $step->set_title( __( 'Start creating your site', 'hostinger-easy-onboarding' ) );
                $step->set_description( __( 'Build a custom-designed site in minutes with professional templates. You’ll be ready to go live in a few clicks.', 'hostinger-easy-onboarding' ) );
                $primary_button->set_title( __( 'Choose template', 'hostinger-easy-onboarding' ) );
                $primary_button->set_is_astra_needed( true );
                $primary_button->set_url( admin_url( 'themes.php?page=starter-templates&ci=1' ) );
                $secondary_button->set_title( __( 'Not now', 'hostinger-easy-onboarding' ) );
                $secondary_button->set_is_skippable( true );
            }

            if( !$this->is_completed( self::HOSTINGER_EASY_ONBOARDING_WEBSITE_STEP_CATEGORY_ID, Actions::AI_STEP ) ) {
                $step->set_primary_button( $primary_button );

                $step->set_secondary_button( $secondary_button );
            }
        }

        return $step;
    }

    public static function is_first_step_active(): bool {
        $builder_type = get_option( 'hostinger_builder_type' );

        $builder_type_whitelist = array(
            'ai',
            'theme',
            'blank',
        );

        if ( ! in_array( $builder_type, $builder_type_whitelist, true ) ) {
            return false;
        }

        $hosting_plan = get_option( 'hostinger_hosting_plan', false );

        if ( empty( $hosting_plan ) ) {
            return false;
        }

        return true;
    }
}
