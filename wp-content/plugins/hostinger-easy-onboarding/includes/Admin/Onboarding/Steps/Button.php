<?php

namespace Hostinger\EasyOnboarding\Admin\Onboarding\Steps;

defined( 'ABSPATH' ) || exit;

class Button {
    /**
     * @var string
     */
    private string $title;

    /**
     * @var bool
     */
    private bool $is_skippable;

    /**
     * @var string
     */
    private string $url = '';

    private string $modal_name = '';

    private bool $is_astra_needed = false;

    /**
     * @param string $title
     * @param bool $is_skippable
     * @param string $url
     */
    public function __construct( string $title = '', bool $is_skippable = false, string $url = '' ) {
        $this->title = $title;
        $this->is_skippable = $is_skippable;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function get_title(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return void
     */
    public function set_title( string $title ): void
    {
        $this->title = $title;
    }

    /**
     * @return bool
     */
    public function get_is_skippable(): bool
    {
        return $this->is_skippable;
    }

    /**
     * @param bool $is_skippable
     *
     * @return void
     */
    public function set_is_skippable( bool $is_skippable ): void
    {
        $this->is_skippable = $is_skippable;
    }

    /**
     * @return string
     */
    public function get_url(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return void
     */
    public function set_url(string $url): void
    {
        $this->url = $url;
    }

    public function get_modal_name(): string {
        return $this->modal_name;
    }

    public function set_modal_name( string $modal_name ): void {
        $this->modal_name = $modal_name;
    }

    public function get_is_astra_needed(): bool {
        return $this->is_astra_needed;
    }

    public function set_is_astra_needed( bool $is_astra_needed ): void {
        $this->is_astra_needed = $is_astra_needed;
    }

    /**
     * @return array
     */
    public function to_array(): array
    {
        return array(
            'title'     => $this->get_title(),
            'is_skippable' => $this->get_is_skippable(),
            'is_astra_needed' => $this->get_is_astra_needed(),
            'url' => $this->get_url(),
            'modal_name' => $this->get_modal_name(),
        );
    }
}
