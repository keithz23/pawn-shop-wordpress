<?php
namespace Hostinger\EasyOnboarding\Rest;

use Hostinger\EasyOnboarding\Admin\Onboarding\WelcomeCards;

/**
 * Avoid possibility to get file accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Class for handling Settings Rest API
 */
class WelcomeRoutes {
    /**
     * Return welcome status
     *
     * @param WP_REST_Request $request WordPress rest request.
     *
     * @return \WP_REST_Response
     */
    public function get_welcome_status( \WP_REST_Request $request ): \WP_REST_Response {
        $parameters = $request->get_params();

        $locale = !empty($parameters['locale']) ? sanitize_text_field($parameters['locale']) : '';
        $available_languages = get_available_languages();

        if (!empty($locale) && in_array($locale, $available_languages)) {
            switch_to_locale($locale);
        }

        $welcome_card = new WelcomeCards();
        $welcome_cards = $welcome_card->get_welcome_cards();

        $data = array(
            'data' => array(
                'welcome_cards'  => $welcome_cards,
                'welcome_choice_done' => get_option( 'hostinger_onboarding_choice_done', false )
            )
        );

        $response = new \WP_REST_Response( $data );

        $response->set_headers( array( 'Cache-Control' => 'no-cache' ) );

        $response->set_status( \WP_Http::OK );

        return $response;
    }

    /**
     * @param \WP_REST_Request $request
     *
     * @return \WP_Error|\WP_REST_Response
     */
    public function update_welcome_status( \WP_REST_Request $request )
    {
        $parameters = $request->get_params();

        if( empty( $parameters['choice'] ) ) {
            return new \WP_Error(
                'data_invalid',
                __( 'Choice parameter missing or empty', 'hostinger-easy-onboarding' ),
                array(
                    'status' => \WP_Http::BAD_REQUEST
                )
            );
        }

        $choice = sanitize_text_field( $parameters['choice'] );

        update_option( 'hostinger_onboarding_choice_done', $choice );

        if ( has_action( 'litespeed_purge_all' ) ) {
            do_action( 'litespeed_purge_all' );
        }

        $response = new \WP_REST_Response( array( 'data' => array() ) );

        $response->set_headers(array('Cache-Control' => 'no-cache'));

        $response->set_status( \WP_Http::OK );

        return $response;
    }

    /**
     * @param \WP_REST_Request $request
     *
     * @return \WP_Error|\WP_REST_Response
     */
    public function update_addons_banner_status( \WP_REST_Request $request ) {
        $parameters = $request->get_params();

        // Validate if 'choice' parameter exists and is boolean
        if ( ! isset( $parameters['choice'] ) || ! is_bool( $parameters['choice'] ) ) {
            return new \WP_Error( 'data_invalid', __( 'Choice parameter missing or invalid', 'hostinger-easy-onboarding' ), array( 'status' => \WP_Http::BAD_REQUEST ) );
        }

        $choice = (bool) $parameters['choice'] ? 0 : 1;

        set_transient( 'hostinger_hide_addons_banner', $choice, YEAR_IN_SECONDS );

        // Prepare response
        $response = new \WP_REST_Response( array( 'data' => array() ) );
        $response->set_headers( array( 'Cache-Control' => 'no-cache' ) );
        $response->set_status( \WP_Http::OK );

        return $response;
    }
}