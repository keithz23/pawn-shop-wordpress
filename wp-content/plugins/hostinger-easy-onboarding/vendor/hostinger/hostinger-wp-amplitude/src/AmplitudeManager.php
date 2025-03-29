<?php

namespace Hostinger\Amplitude;

use Hostinger\WpHelper\Config;
use Hostinger\WpHelper\Requests\Client;
use Hostinger\WpHelper\Utils as Helper;

class AmplitudeManager
{
    public const AMPLITUDE_ENDPOINT = '/v3/wordpress/plugin/trigger-event';
    private const CACHE_ONE_DAY = 86400;
    private const LOGIN_DATA = 'hostinger_login_data';

    private Config $configHandler;
    private Client $client;
    private Helper $helper;

    public function __construct(
        Helper $helper,
        Config $configHandler,
        Client $client
    ) {
        $this->helper        = $helper;
        $this->configHandler = $configHandler;
        $this->client        = $client;
    }

    public function sendRequest( string $endpoint, array $params, array $headers = [] ): array {
        try {
            if ( ! $this->isTransientSystemWorking() ) {
                return [ 'status' => 'error', 'message' => 'Database error: Transient not set correctly' ];
            }

            if ( ! $this->shouldSendAmplitudeEvent( $params ) ) {
                return [];
            }

            $params  = $this->addImpersonationData( $params );
            $params  = $this->addDomainAndDirectory( $params );

            $headers = $this->extractCorrelationIdHeader( $headers );

            $response = $this->client->post( $endpoint, [ 'params' => $params ], $headers );

            return $response;
        } catch ( \Exception $exception ) {
            $this->helper->errorLog( 'Error sending request: ' . $exception->getMessage() );

            return [ 'status' => 'error', 'message' => $exception->getMessage() ];
        }
    }

    public function addDomainAndDirectory( array $params ) : array {
        if ( $siteUrl = get_site_url() ) {
            $params['siteurl'] = $siteUrl;

            $websiteDir          = $this->getSubdirectoryName( $siteUrl );
            $params['directory'] = $websiteDir;
        }

        return $params;
    }

    public function getSubdirectoryName( string $siteUrl ) : string {
        $sitePath = parse_url( $siteUrl, PHP_URL_PATH ) ?? '';

        return trim( $sitePath, '/' ) ? : '';
    }

    public function addImpersonationData( array $params ) : array {
        $login_data = get_transient( self::LOGIN_DATA );

        if ( $login_data === false ) {
            return $params;
        }

        if ( ! empty( $login_data['acting_client_id'] ) ) {
            $params['is_impersonated']        = true;
            $params['impersonated_client_id'] = sanitize_text_field( $login_data['acting_client_id'] );
        }

        if ( ! empty( $login_data['client_id'] ) ) {
            $params['client_id'] = sanitize_text_field( $login_data['client_id'] );
        }

        return $params;
    }

    // Events which firing once per day
    public static function getSingleAmplitudeEvents() : array {
        return apply_filters( 'hostinger_once_per_day_events', [] );
    }

    public function shouldSendAmplitudeEvent( array $params ): bool {
        $oneTimePerDay = self::getSingleAmplitudeEvents();

        if ( empty( $params['action'] ) ) {
            return false;
        }

        $eventAction  = sanitize_text_field( $params['action'] );
        $transientKey = 'amplitude_event_' . $eventAction;

        if ( in_array( $eventAction, $oneTimePerDay, true ) ) {
            $hasBeenSentToday = get_transient( $transientKey );

            if ( $hasBeenSentToday ) {
                return false;
            }

            set_transient( $transientKey, time(), self::CACHE_ONE_DAY );
        }

        return true;
    }

    public function isTransientSystemWorking() : bool {
        set_transient( 'check_transients', 'value', 60 );

        $testValue = get_transient( 'check_transients' );

        return $testValue !== false;
    }

    public function extractCorrelationIdHeader( array $headers = [] ): array {
        if ( empty( $headers ) ) {
            return [];
        }

        foreach ( $headers as $key => $value ) {
            if ( strtolower( $key ) === 'x-correlation-id' || strtolower( $key ) === 'x_correlation_id' ) {
                $idValue = is_array( $value ) && ! empty( $value ) ? $value[0] : $value;

                return [ 'X-Correlation-ID' => $idValue ];
            }
        }

        return [];
    }
}
