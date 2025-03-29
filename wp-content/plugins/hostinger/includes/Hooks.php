<?php

namespace Hostinger;

use Hostinger\DefaultOptions;
use Hostinger\Admin\Options\PluginOptions;
use Hostinger\Admin\PluginSettings;
use Hostinger\WpHelper\Utils;

defined( 'ABSPATH' ) || exit;

class Hooks {
    public function __construct() {
        // XMLRpc / Force SSL
        add_filter( 'xmlrpc_enabled', array( $this, 'check_xmlrpc_enabled' ) );
        add_filter( 'wp_is_application_passwords_available', array( $this, 'check_authentication_password_enabled' ) );
        add_filter( 'wp_headers', array( $this, 'check_pingback' ) );
        add_filter( 'plugins_loaded', array( $this, 'plugins_loaded' ) );

        add_action( 'update_option_woocommerce_coming_soon', array( $this, 'litespeed_flush_cache' ) );
        add_action( 'update_option_woocommerce_store_pages_only', array( $this, 'litespeed_flush_cache' ) );
        add_action( 'upgrader_process_complete', array( $this, 'disable_auth_passwords_on_update' ), 10, 2 );
    }

    public function disable_auth_passwords_on_update( \WP_Upgrader $upgrader_object, array $options ): void {
        if ( $options['action'] !== 'update' || $options['type'] !== 'plugin' || empty( $options['plugins'] ) ) {
            return;
        }

        if ( ! in_array( 'hostinger/hostinger.php', $options['plugins'], true ) ) {
            return;
        }

        $settings = get_option( HOSTINGER_PLUGIN_SETTINGS_OPTION, [] );

        if ( ! empty( $settings['disable_authentication_password'] ) ) {
            return;
        }

        $default_options  = new DefaultOptions();
        $updated_settings = $default_options->check_authentication_password( $settings );

        $plugin_options = new PluginOptions( $updated_settings );
        update_option( HOSTINGER_PLUGIN_SETTINGS_OPTION, $plugin_options->to_array(), false );
    }

	/**
	 * @return void
	 */
	public function plugins_loaded() {
		$utils           = new Utils();
		$plugin_settings = new PluginSettings();
		$settings        = $plugin_settings->get_plugin_settings();

		if ( defined( 'WP_CLI' ) && \WP_CLI ) {
			return;
		}

		// Xmlrpc.
		if ( $settings->get_disable_xml_rpc() && $utils->isThisPage( 'xmlrpc.php' ) ) {
			exit( 'Disabled' );
		}

		// SSL redirect.
		if ( $settings->get_force_https() && ! is_ssl() ) {
			if ( isset( $_SERVER['HTTP_HOST'] ) && isset( $_SERVER['REQUEST_URI'] ) ) {
				$host = sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) );

				if ( $settings->get_force_www() && strpos( $host, 'www.' ) === false ) {
					$host = 'www.' . $host;
				}

				wp_safe_redirect( 'https://' . $host . sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ), 301 );
				exit;
			}
		}

		// Force www.
		if ( $settings->get_force_www() ) {
			if ( isset( $_SERVER['HTTP_HOST'] ) && isset( $_SERVER['REQUEST_URI'] ) ) {
				$host = sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) );

				if ( strpos( $host, 'www.' ) === false ) {
					wp_safe_redirect( 'https://www.' . $host . sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ), 301 );
					exit;
				}
			}
		}
	}

	/**
	 * @param  mixed $headers
	 *
	 * @return mixed
	 */
	public function check_pingback( $headers ) {
		$plugin_settings = new PluginSettings();
		$settings        = $plugin_settings->get_plugin_settings();

		if ( $settings->get_disable_xml_rpc() ) {
			unset( $headers['X-Pingback'] );
		}

		return $headers;
	}

	/**
	 * @return bool
	 */
	public function check_xmlrpc_enabled(): bool {
		$plugin_settings = new PluginSettings();
		$settings        = $plugin_settings->get_plugin_settings();

		if ( $settings->get_disable_xml_rpc() ) {
			return false;
		}

		return true;
	}

    /**
     * @return bool
     */
    public function check_authentication_password_enabled(): bool {
        $plugin_settings = new PluginSettings();
        $settings        = $plugin_settings->get_plugin_settings();

        if ( $settings->get_disable_authentication_password() ) {
            return false;
        }

        return true;
    }

    public function litespeed_flush_cache(): void {
        if ( has_action( 'litespeed_purge_all' ) ) {
            do_action( 'litespeed_purge_all' );
        }
    }
}
