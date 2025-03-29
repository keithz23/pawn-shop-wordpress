<?php
/**
 * MSB Display rules
 *
 * @author  : Premio <contact@premio.io>
 * @license : GPL2
 * */

if (defined('ABSPATH') === false) {
    exit;
}

?>

<div id="mystickybar-tab-display-rules" class="mystickybar-tab-content">
	<h2 class="section-title"><strong><?php esc_html_e('Step 2', 'myStickymenu'); ?>:</strong> <?php esc_html_e('Display rules', 'myStickymenu'); ?></h2>
	<div class="mystickybar-content-section">
		<div class="mysticky-welcomebar-setting-wrap">
			<div class="mysticky-welcomebar-subheader-title">
				<h4><?php esc_html_e('Triggers', 'myStickymenu'); ?></h4>
			</div>
			<div class="mysticky-welcomebar-setting-block">
				<div class="mysticky-welcomebar-setting-content">
					<label><?php esc_html_e('Entry effect', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right">
						<?php $welcomebar['mysticky_welcomebar_entry_effect'] = (isset($welcomebar['mysticky_welcomebar_entry_effect']) && $welcomebar['mysticky_welcomebar_entry_effect']!= '') ? esc_attr($welcomebar['mysticky_welcomebar_entry_effect']) : 'slide-in'; ?>
						<select id="myStickymenu-entry-effect" name="mysticky_option_welcomebar[mysticky_welcomebar_entry_effect]" >
							<option value="none" <?php selected( @$welcomebar['mysticky_welcomebar_entry_effect'], 'none' ); ?>><?php esc_html_e( 'No effect', 'myStickymenu' );?></option>
							<option value="slide-in" <?php selected( @$welcomebar['mysticky_welcomebar_entry_effect'], 'slide-in' ); ?>><?php esc_html_e( 'Slide in', 'myStickymenu' );?></option>
							<option value="fade" <?php selected( @$welcomebar['mysticky_welcomebar_entry_effect'], 'fade' ); ?>><?php esc_html_e( 'Fade', 'myStickymenu' );?></option>
						</select>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content">
					<label><?php esc_html_e('Devices', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right">
						<div class="flex-1">
							<label>
								<input name="mysticky_option_welcomebar[mysticky_welcomebar_device_desktop]" value= "desktop" type="checkbox" checked disabled />
								<?php esc_html_e( 'Desktop', 'mystickymenu' );?>
							</label>
							<label>
								<input name="mysticky_option_welcomebar[mysticky_welcomebar_device_mobile]" value= "mobile" type="checkbox" checked disabled />
								<?php esc_html_e( 'Mobile', 'mystickymenu' );?>
							</label>
						</div>
						<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php esc_html_e( 'Upgrade Now', 'mystickymenu' );?></a></span>
					</div>
				</div>

				<div class="mysticky-welcomebar-setting-content align-top">
					<label><?php esc_html_e('Trigger', 'myStickymenu'); ?>
						<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;">Choose when you'd like the bar to appear on your site</p></span>
					</label>
					<div class="mysticky-welcomebar-setting-content-right trigger-wrap gap-x-px flex-inline">
						<div class="mysticky-welcomebar-setting-action flex-1">
							<select class="mysticky-welcomebar-trigger">
								<option value="after_a_few_seconds" <?php selected( @$welcomebar['mysticky_welcomebar_trigger'], 'after_a_few_seconds' ); ?>><?php esc_html_e( 'After a few seconds', 'myStickymenu' );?></option>
								<option value="after_scroll" <?php selected( @$welcomebar['mysticky_welcomebar_trigger'], 'after_scroll' ); ?>><?php esc_html_e( 'After Scroll', 'myStickymenu' );?></option>
							</select>
						</div>
						<div class="mysticky-welcomebar-setting-action mysticky-welcomebar-triggersec">
							<div class="px-wrap">
								<input type="number" class="" min="0" step="1" id="mysticky_welcomebar_triggersec" name="mysticky_option_welcomebar[mysticky_welcomebar_triggersec]" value="0" disabled />
								<span class="input-px"><?php echo ( isset($welcomebar['mysticky_welcomebar_trigger']) && $welcomebar['mysticky_welcomebar_trigger'] == 'after_scroll' ) ? '%' : 'Sec'; ?></span>
							</div>
						</div>
						<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php esc_html_e( 'Upgrade Now', 'mystickymenu' );?></a></span>
					</div>
				</div>
			</div>

			<div class="mysticky-welcomebar-subheader-title">
				<h4><?php esc_html_e('Targeting', 'myStickymenu'); ?></h4>
			</div>
			<div class="mysticky-welcomebar-setting-block">
				<div class="mysticky-welcomebar-setting-content align-top">
					<label><?php _e('Date Scheduling', 'myStickymenu'); ?>
						<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;"><?php esc_html_e('Set the date and time for when you want the widget to start showing and the time you would like it to stop showing. You can add up to 12 combinations of "on and off" triggers. This feature may be useful when you have an upcoming limited-time offer.',"mystickymenu");?></p></span>
					</label>
					<div class="mysticky-welcomebar-setting-content-right">
						<div class="mysticky-welcomebar-date-schedule-options" id="mysticky-welcomebar-date-schedule-options" style="display:none;" >
							<div class="welcomebar-date-schedule-time-zone">
								<label><?php esc_html_e( 'Timezone', 'mystickymenu');?></label>
								<select class=" gmt-data welcomebar-gmt-timezone gmt-timezone" name="mysticky_option_welcomebar[date_schedule_timezone]" >
									<option selected="selected" value="">Select a city or country</option>
								</select>
							</div>
							<div class="welcomebar-date-schedule-box-html" >
								<div class="welcomebar-date-schedule-box setting-content-relative">
									<div class="date-time-box">
										<div class="date-select-option">
											<label>
												<?php esc_html_e( 'Start date ', 'mystickymenu');?>
												<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;"><?php esc_html_e('Schedule a date from which the widget will be displayed (the starting date is included)',"mystickymenu");?></p></span>
											</label>
											<input autocomplete="off" type="text" class="welcomebar-datepicker" id="date_schedule___count___start_date">
										</div>
										<div class="time-select-option">
											<label><?php esc_html_e( 'Start time ', 'mystickymenu');?></label>
											<input autocomplete="off" type="text" class="welcomebar-timepicker" id="date_schedule___count___start_time">
										</div>
									</div>
									<div class="date-time-box">
										<div class="date-select-option">
											<label>
												<?php esc_html_e( 'End date ', 'mystickymenu');?>
												<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;"><?php esc_html_e('Schedule a date from which the widget will stop being displayed (the end date is included)',"mystickymenu");?></p></span>
											</label>
											<input autocomplete="off" type="text" class="welcomebar-datepicker" id="date_schedule___count___end_date">
										</div>
										<div class="time-select-option">
											<label><?php esc_html_e( 'End time ', 'mystickymenu');?></label>
											<input autocomplete="off" type="text"  id="date_schedule___count___end_time">
										</div>
										<div class="mysticky-welcomebar-url-buttons">
											<a class="mysticky-welcomebar-remove-date-schedule" href="javascript:void(0);">x</a>
										</div>
									</div>

									<span class="upgrade-mystickymenu myStickymenu-upgrade">
										<a href="<?php echo esc_url($upgarde_url); ?>" target="_blank">
											<i class="fas fa-lock"></i><?php _e('UPGRADE NOW', 'mystickymenu'); ?>
										</a>
									</span>
								</div>
							</div>
						</div>
						<span style="width: 100%;display: block;">
							<a href="javascript:void(0);" class="create-rule" id="add-date-schedule-option"><?php esc_html_e( "Add Rule", "mystickymenu" );?></a>
						</span>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content show-on-apper flex-column gap-x-px">
					<label><?php esc_html_e('Page targeting', 'myStickymenu'); ?>
						<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;">
							<?php esc_html_e(" Add page targeting to ensure the bar only appears or doesn't appear for the selected pages only","mystickymenu");?></p></span>
					</label>
					<div class="mysticky-welcomebar-setting-content-right absolute">
						<a href="javascript:void(0);" class="create-rule" id="create-rule"><?php esc_html_e( "Add Rule", "mystickyelements" );?></a>
					</div>
					<?php
					$url_options = array(
							'page_contains'   => esc_html__('Link that contain', "mystickymenu"),
							'page_has_url'    => esc_html__('A specific link', "mystickymenu"),
							'page_start_with' => esc_html__('Links starting with', "mystickymenu"),
							'page_end_with'   => esc_html__('Links ending with', "mystickymenu"),
							'wp_pages'        => esc_html__('WordPress Pages', "mystickymenu"),
							'wp_posts'        => esc_html__('WordPress Posts', "mystickymenu"),
							'wp_categories'   => esc_html__('WordPress Categories', "mystickymenu"),
							'wp_tags'         => esc_html__('WordPress Tags',  "mystickymenu")
						);
						if ( class_exists( 'WooCommerce' ) ) {
							$url_options['wc_products'] = esc_html__('WooCommerce products', "mystickymenu");
							$url_options['wc_products_on_sale'] = esc_html__('WooCommerce products on sale', "mystickymenu");
						}
					?>
					<div class="mysticky-welcomebar-page-options-html" style="display: none">
						<div class="mysticky-welcomebar-page-option mx-w-100">
							<div class="url-content">
								<div class="mysticky-welcomebar-url-select">
									<select name="" id="url_shown_on___count___option">
										<option value="show_on"><?php esc_html_e("Show on", "mysticky" );?></option>
										<option value="not_show_on"><?php esc_html_e("Don't show on", "mysticky" );?></option>
									</select>
								</div>
								<div class="mysticky-welcomebar-url-option">
									<select class="mysticky-welcomebar-url-options" name="" id="url_rules___count___option">
										<option selected="selected" value=""><?php esc_html_e("Select Rule", "mysticky" );?></option>
										<?php foreach($url_options as $key=>$value) {
											echo '<option value="'. esc_attr($key).'">'. esc_html($value).'</option>';
										} ?>
									</select>
								</div>
								<div class="mysticky-welcomebar-url-box">
									<span class='mysticky-welcomebar-url'><?php echo esc_url(site_url("/")); ?></span>
								</div>
								<div class="mysticky-welcomebar-url-values">
									<input type="text" value="" name="mysticky_option_welcomebar[page_settings][__count__][value]" id="url_rules___count___value" disabled />
								</div>
								<div class="clear"></div>
							</div>
							<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php esc_html_e( 'Upgrade Now', 'mystickymenu' );?></a></span>
						</div>
					</div>
					<div class="mysticky-welcomebar-page-options mysticky-welcomebar-setting-content-right mx-w-100" id="mysticky-welcomebar-page-options" style="display:none"></div>
				</div>
				<div class="mysticky-welcomebar-setting-content show-on-apper">
					<label><?php _e('User targeting', 'myStickymenu'); ?>
						<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;"><?php esc_html_e("Add a rule if you want to show the welcome bar for logged in or logged out users of your WordPress website selectively","mystickymenu");?></p></span>
					</label>
					<div class="mysticky-welcomebar-setting-content-right">
						<div class=" mystickymenu-country-inputs">
							<select>
								<option value="" ><?php esc_html_e( 'Show for all users', 'mystickymenu' );?></option>
								<option value="logged-in" <?php selected($welcomebar['user_target'], 'logged-in')?>><?php esc_html_e( 'Show just for logged-in users', 'mystickymenu' );?></option>
								<option value="logged-out" <?php selected($welcomebar['user_target'], 'logged-out')?>><?php esc_html_e( 'Show just for logged-out users', 'mystickymenu' );?></option>
							</select>
							<span class="upgrade-mystickymenu myStickymenu-upgrade">
								<a href="<?php echo esc_url($upgarde_url); ?>" target="_blank">
									<i class="fas fa-lock"></i><?php _e('UPGRADE NOW', 'mystickymenu'); ?>
								</a>
							</span>
						</div>

					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content">
					<label><?php esc_html_e('Country targeting', 'myStickymenu'); ?>
						<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;">
							<?php esc_html_e("Add country targeting to ensure the bar only appears for the selected countries only","mystickymenu");?></p></span>
					</label>
					<div class="mysticky-welcomebar-setting-content-right">
						<div class=" mystickymenu-country-inputs">

							<button type="button" class="mystickymenu-country-button"><?php esc_html_e("All countries", 'mystickymenu'); ?></button>
							<div class="mystickymenu-country-list-box">

								<select name="general-settings[countries_list][]" placeholder="Select Country" class="myStickyelements-country-list">
									<option value=""><?php esc_html_e("All countries", 'mystickymenu'); ?></option>
								</select>
							</div>
							<span class="upgrade-mystickymenu myStickymenu-upgrade">
								<a href="<?php echo esc_url($upgarde_url); ?>" target="_blank">
									<i class="fas fa-lock"></i><?php esc_html_e('UPGRADE NOW', 'mystickymenu'); ?>
								</a>
							</span>
						</div>
					</div>
				</div>

			</div>

		</div><!-- mysticky-welcomebar-setting-wrap -->

	</div><!-- mystickybar-content-section -->

</div>