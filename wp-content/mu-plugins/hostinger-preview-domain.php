<?php
/**
 * Plugin Name:       Hostinger Preview Domain
 * Plugin URI:        https://www.hostinger.com
 * Description:       Enable access to the website through a temporary domain while the main domain is not yet configured.
 * Version:           1.2.2
 * Author:            Hostinger
 * Author URI:        https://www.hostinger.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       hostinger-preview-domain
 * Domain Path:       /languages
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * MU Plugin:         Yes
 */

if ( ! class_exists( 'Hostinger_Temporary_Domain_Handler' ) ) {
    class Hostinger_Temporary_Domain_Handler {
        private $site_domain;
        private $current_domain;

        public function __construct() {
            $this->initialize_domains();
            $this->setup_hooks();
        }

        /**
         * Filter and rewrite the URL if necessary.
         *
         * @param string      $url     The original URL.
         * @param mixed       $path    Optional. Path relative to the URL.
         * @param string|null $scheme  Optional. Scheme to give the URL context.
         * @param int|null    $blog_id Optional. Blog ID.
         *
         * @return string The filtered URL.
         */
        public function filter_url( $url, $path = '', $scheme = null, $blog_id = null ) {
            if ( ! $this->should_rewrite_url() || ! filter_var( $url, FILTER_VALIDATE_URL ) ) {
                return $url;
            }

            $filtered_url = str_replace( [ 'http://' . $this->site_domain, 'https://' . $this->site_domain ], 'https://' . $this->current_domain, $url );

            return filter_var( $filtered_url, FILTER_SANITIZE_URL ) ?: '';
        }

        /**
         * Filter and rewrite the content if necessary.
         *
         * @param string $content The original content.
         *
         * @return string The filtered content.
         */
        public function filter_content( $content ) {
            if ( ! $this->should_rewrite_url() ) {
                return $content;
            }

            $patterns = [
                // HTML attributes and content URLs
                '/(href|src|action)\s*=\s*[\'"]https?:\/\/' . preg_quote( $this->site_domain, '/' ) . '[^\s\'"<>]*/i',
                // CSS imports and urls
                '/(@import\s+["\']|url\(["\']?)https?:\/\/' . preg_quote( $this->site_domain, '/' ) . '[^\s\'"<>)]*/i',
            ];

            foreach ( $patterns as $pattern ) {
                $content = preg_replace_callback( $pattern, function ( $matches ) {
                    $url = substr( $matches[0], strpos( $matches[0], 'http' ) );

                    return str_replace( $url, $this->filter_url( $url ), $matches[0] );
                }, $content );
            }

            return $content ?: '';
        }

        /**
         * Handle CORS headers.
         *
         * @return void
         */
        public function handle_cors() {
            if ( ! $this->should_rewrite_url() ) {
                return;
            }

            $allowed_origin = 'https://' . filter_var( $this->current_domain, FILTER_SANITIZE_URL );

            if ( isset( $_SERVER['HTTP_ORIGIN'] ) && $_SERVER['HTTP_ORIGIN'] === $allowed_origin ) {
                header( 'Access-Control-Allow-Origin: ' . $allowed_origin );
                header( 'Access-Control-Allow-Methods: GET, POST, OPTIONS' );
                header( 'Access-Control-Allow-Credentials: true' );
                header( 'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept' );
                header( 'Access-Control-Max-Age: 86400' );

                if ( $_SERVER['REQUEST_METHOD'] === 'OPTIONS' ) {
                    header( 'HTTP/1.1 204 No Content' );
                    exit();
                }
            }
        }

        /**
         * Start output buffering if URL rewriting is needed.
         *
         * @return void
         */
        public function start_output_buffer() {
            if ( $this->should_rewrite_url() ) {
                ob_start( [ $this, 'filter_content' ] );
            }
        }

        /**
         * Initialize site and current domains.
         *
         * @return void
         */
        private function initialize_domains() {
            $this->site_domain = $this->sanitize_domain( parse_url( get_site_url(), PHP_URL_HOST ) ?: '' );
            $this->current_domain = $this->sanitize_domain( isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '' );
        }

        /**
         * Setup hooks for URL and content filtering.
         *
         * @return void
         */
        private function setup_hooks() {
            if ( $this->should_skip_hooks() ) {
                return;
            }

            // Basic URL filters
            add_filter( 'home_url', [ $this, 'filter_url' ], 10, 4 );
            add_filter( 'site_url', [ $this, 'filter_url' ], 10, 4 );
            add_filter( 'wp_redirect', [ $this, 'filter_url' ], 10 );

            // Content filters
            $content_filters = [ 'the_content', 'widget_text', 'wp_nav_menu_items' ];
            foreach ( $content_filters as $filter ) {
                add_filter( $filter, [ $this, 'filter_content' ], 999 );
            }

            // Media handling
            add_filter( 'wp_get_attachment_url', [ $this, 'filter_url' ] );

            // Admin filters
            if ( is_admin() ) {
                $this->setup_admin_filters();
            }

            // Output buffering and CORS
            add_action( 'init', [ $this, 'start_output_buffer' ], 0 );
            add_action( 'init', [ $this, 'handle_cors' ], 0 );
        }

        /**
         * Setup filters for admin URLs.
         *
         * @return void
         */
        private function setup_admin_filters() {
            $admin_filters = [
                'admin_url',
                'plugins_url',
                'theme_file_uri',
                'includes_url',
                'content_url',
                'style_loader_src',
                'script_loader_src',
                'preview_post_link',
            ];

            foreach ( $admin_filters as $filter ) {
                add_filter( $filter, [ $this, 'filter_url' ], 10, 3 );
            }
        }

        /**
         * Sanitize a domain name.
         *
         * @param string $domain The domain name to sanitize.
         *
         * @return string The sanitized domain name.
         */
        private function sanitize_domain( $domain ) {
            return preg_replace( '/[^a-z0-9\-\.]/', '', strtolower( trim( $domain ) ) );
        }

        /**
         * Check if we should skip applying hooks for this request.
         *
         * @return bool True if hooks should be skipped
         */
        private function should_skip_hooks() {
            if ( php_sapi_name() === 'cli' ) {
                if ( $this->is_litespeed_command() ) {
                    return true;
                }
            }

            return false;
        }

        /**
         * Simple check if current command contains LiteSpeed references
         *
         * @return bool True if litespeed command detected
         */
        private function is_litespeed_command() {
            global $argv;

            if ( ! empty( $argv ) ) {
                $command = implode( ' ', $argv );
                if ( stripos( $command, 'litespeed' ) !== false || stripos( $command, 'lscache' ) !== false ) {
                    return true;
                }
            }

            return false;
        }

        /**
         * Determine if the URL should be rewritten.
         *
         * @return bool True if the URL should be rewritten, false otherwise.
         */
        private function should_rewrite_url() {
            return $this->current_domain !== $this->site_domain;
        }
    }

    new Hostinger_Temporary_Domain_Handler();
}
