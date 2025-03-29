<?php

namespace Hostinger;

use Hostinger\Admin\Options\PluginOptions;
use Hostinger\Helper;

defined( 'ABSPATH' ) || exit;

class DefaultOptions {
	/**
	 * @return void
	 */
    public function add_options(): void {
        $this->configure_security_settings();

        foreach ( $this->options() as $key => $option ) {
            update_option( $key, $option );
        }
    }

    public function configure_security_settings(): void {
        $hostinger_plugin_settings = get_option( HOSTINGER_PLUGIN_SETTINGS_OPTION, [] );

        // Check and set bypass code
        if ( empty( $hostinger_plugin_settings['bypass_code'] ) ) {
            $hostinger_plugin_settings['bypass_code'] = Helper::generate_bypass_code( 16 );
        }

        $hostinger_plugin_settings = $this->check_authentication_password( $hostinger_plugin_settings );

        $plugin_options = new PluginOptions( $hostinger_plugin_settings );
        update_option( HOSTINGER_PLUGIN_SETTINGS_OPTION, $plugin_options->to_array(), false );
    }

    public function check_authentication_password( array $settings ): array {
        global $wpdb;

        $existing_passwords = (int)$wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$wpdb->usermeta} WHERE meta_key = %s", '_application_passwords' ) );

        if ( $existing_passwords === 0 ) {
            $settings['disable_authentication_password'] = true;
        }

        return $settings;
    }

	/**
	 * @return string[]
	 */
	private function options(): array {
		$options = array(
            'optin_monster_api_activation_redirect_disabled' => 'true',
            'wpforms_activation_redirect'                    => 'true',
            'aioseo_activation_redirect'                     => 'false',
		);

		if ( Helper::is_plugin_active( 'astra-sites' ) ) {
			$options = array_merge( $options, $this->get_astra_options() );
		}

		return $options;
	}

	/**
	 * @return string[]
	 */
	private function get_astra_options(): array {
		return array(
			'astra_sites_settings' => 'gutenberg',
		);
	}
}
