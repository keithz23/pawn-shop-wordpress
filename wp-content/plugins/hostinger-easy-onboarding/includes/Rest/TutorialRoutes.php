<?php
namespace Hostinger\EasyOnboarding\Rest;

/**
 * Avoid possibility to get file accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

class TutorialRoutes {
    public function get_tutorials( \WP_REST_Request $request ): \WP_REST_Response {
        $parameters = $request->get_params();

        $locale = sanitize_text_field( $parameters['locale'] );

        $user_locale = !empty( $locale ) ? substr( $locale, 0, 2) : 'en';

        $tutorials = array(
            'en' => array(
                array(
                    'id'       => 'F_53_baJe6Q',
                    'title'    => 'How to Make a Website (2024): Simple, Quick, & Easy Tutorial',
                    'duration' => '17:47',
                ),
                array(
                    'id'       => 'nEksiCZBlJ0',
                    'title'    => 'How to Customize Your WordPress Website with Gutenberg For Beginners',
                    'duration' => '14:43',
                ),
                array(
                    'id'       => 'SU_DOsu9Llk',
                    'title'    => 'How to EASILY Manage Google Tools with Google Site Kit - Beginners Guide 2024',
                    'duration' => '12:28',
                ),
                array(
                    'id'       => 'YK-XO7iLyGQ',
                    'title'    => 'How to Import Images Into WordPress Website',
                    'duration' => '1:44',
                ),
                array(
                    'id'       => 'WHXtmEppbn8',
                    'title'    => 'How to Edit the Footer in WordPress',
                    'duration' => '6:17',
                ),
            ),
            'pt' => array(
                array(
                    'id'       => 'Ck15HW4koWE',
                    'title'    => 'Como Alterar a sua Logo no WordPress (Rápido e Prático)',
                    'duration' => '4:28',
                ),
                array(
                    'id'       => 'OJH713cx-u4',
                    'title'    => 'Como Personalizar um Tema do WordPress',
                    'duration' => '13:42',
                ),
                array(
                    'id'       => 'X_04utuq750',
                    'title'    => 'Como Editar o Menu dos Temas do WordPress',
                    'duration' => '4:53',
                ),
                array(
                    'id'       => 'cMKPatPvSKk',
                    'title'    => 'Como Criar Categorias no WordPress',
                    'duration' => '6:04',
                ),
            ),
            'es' => array(
                array(
                    'id'       => 'FKp0dvhEN8o',
                    'title'    => 'Cómo Personalizar WordPress (2023)',
                    'duration' => '9:02',
                ),
                array(
                    'id'       => '1tvYSsRSgNc',
                    'title'    => 'Cómo Crear una Galería de Fotos en WordPress | Fácil y Gratis',
                    'duration' => '5:48',
                ),
                array(
                    'id'       => 'A-yuq3g1KVs',
                    'title'    => 'Como Instalar Plugins y Temas en WordPress',
                    'duration' => '4:54',
                ),
                array(
                    'id'       => '_8Z0C6Os1CQ',
                    'title'    => 'Cómo Crear un Menú en WordPress (en Menos de 5 minutos)',
                    'duration' => '4:52',
                ),
            ),
            'fr' => array(
                array(
                    'id'       => 'zpW8jliv45E',
                    'title'    => 'Hostinger WordPress : Le Guide Complet pour utiliser WordPress sur Hostinger',
                    'duration' => '8:11',
                ),
                array(
                    'id'       => 'X7ZA9pteqqQ',
                    'title'    => 'TUTO WORDPRESS (Débutant) : Créer un site WordPress pour les Nuls',
                    'duration' => '12:56',
                ),
                array(
                    'id'       => 'JIHy3Y6ek_s',
                    'title'    => 'Tuto WordPress Débutant (Hostinger hPanel) - Créer un Site par IA',
                    'duration' => '7:21',
                ),
                array(
                    'id'       => 'Te3fM7VuQKg',
                    'title'    => 'Installer un Thème WordPress (2023) | Rapide et Facile',
                    'duration' => '2:58',
                ),
                array(
                    'id'       => '2rPq1CiogDk',
                    'title'    => 'Google Analytics sur WordPress FACILEMENT avec Google Site Kit : Guide Complet (2023)',
                    'duration' => '7:19',
                ),
            ),
            'hi' => array(
                array(
                    'id'       => '4wGytQfbmm4',
                    'title'    => 'How to Build a Website FAST Using AI in Just 10 Minutes',
                    'duration' => '8:32',
                ),
                array(
                    'id'       => 'AT73ExGMuVc',
                    'title'    => 'How to Edit Footer in WordPress in Hindi | Hostinger India',
                    'duration' => '3:48',
                ),
                array(
                    'id'       => 'OIGsBGIaZqM',
                    'title'    => 'How to Create a Menu in WordPress in Hindi | Hostinger India',
                    'duration' => '2:38',
                ),
                array(
                    'id'       => 'WFBoHv0xJ60',
                    'title'    => 'How to Install WordPress Themes | Hostinger India',
                    'duration' => '2:52',
                ),
            ),
        );

        if ( empty( $tutorials[$user_locale] ) ) {
            $user_locale = 'en';
        }

        $data = array(
            'data' => array(
                'tutorials'  => $tutorials[$user_locale],
            )
        );

        $response = new \WP_REST_Response( $data );

        $response->set_headers( array( 'Cache-Control' => 'no-cache' ) );

        $response->set_status( \WP_Http::OK );

        return $response;
    }

}
