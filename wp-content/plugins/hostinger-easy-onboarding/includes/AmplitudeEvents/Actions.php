<?php

namespace Hostinger\EasyOnboarding\AmplitudeEvents;

defined( 'ABSPATH' ) || exit;

class Actions {
	public const ONBOARDING_ITEM_COMPLETED    = 'wordpress.easy_onboarding.item_completed';
	public const WOO_ITEM_COMPLETED    = 'wordpress.woocommerce.item_completed';
	public const WOO_READY_TO_SELL    = 'wordpress.woocommerce.store.ready_to_sell';
	public const WOO_SETUP_COMPLETED    = 'wordpress.woocommerce.store_setup.completed';
	public const WP_EDIT    = 'wordpress.edit_saved';
	public const WP_CHANGED_LANG    = 'wordpress.language_changed';
	public const WP_PASSWORD_RESET    = 'wordpress.password_reset';
	public const WP_PREVIEW_SITE    = 'wordpress.preview_site';
	public const WP_EASY_ONBOARDING_ENTER    = 'wordpress.easy_onboarding.enter';
	public const WP_CONNECT_DOMAIN_SHOWN    = 'wordpress.connect_domain.shown';
    public const WP_CONNECT_DOMAIN_ENTER    = 'wordpress.connect_domain.enter';
    public const WP_EASY_ONBOARDING_COMPLETED    = 'wordpress.easy_onboarding.completed';
    public const WP_BLACK_FRIDAY_BANNER_OFFER_SHOWN    = 'black_friday.banner.offer_shown';
    public const WP_ADDONS_BANNER_SHOWN = 'wordpress.addons_banner.shown';
}
