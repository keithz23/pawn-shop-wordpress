<?php
/**
 * MSB Customize bar
 *
 * @author  : Premio <contact@premio.io>
 * @license : GPL2
 * */

if (defined('ABSPATH') === false) {
    exit;
}

?>

<div id="mystickybar-tab-customize-bar" class="mystickybar-tab-content active">
	<h2 class="section-title"><strong><?php esc_html_e('Step 1', 'myStickymenu'); ?>:</strong> <?php esc_html_e('Customize your bar', 'myStickymenu'); ?></h2>
	<div class="mystickybar-content-section">
		<div class="mysticky-welcomebar-header-title">	
			<label for="mysticky-welcomebar-contact-form-enabled">
				<?php esc_html_e('Bar visibility', 'myStickymenu'); ?>
				<span class="mysticky-custom-fields-tooltip">
					<a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;">When the toggle is on, the notification will appear on your website</p>
				</span>
			</label>
			<label for="mysticky-welcomebar-contact-form-enabled" class="mysticky-welcomebar-switch mysticky-custom-fields-tooltip">
				<input type="checkbox" id="mysticky-welcomebar-contact-form-enabled" name="mysticky_option_welcomebar[mysticky_welcomebar_enable]" value="1" <?php checked( @$welcomebar['mysticky_welcomebar_enable'], '1' );?> />
				<span class="slider"></span>
				<p style="width: 100px;text-align: center; padding:5px;">
					<span class="mystickybar-visible" <?php if(!isset($welcomebar['mysticky_welcomebar_enable']) || (isset($welcomebar['mysticky_welcomebar_enable']) && $welcomebar['mysticky_welcomebar_enable'] != 1 ) ):?>style="display:none;"<?php endif;?>>
						<?php esc_html_e('Bar is visible', 'myStickymenu'); ?></span>
					<span class="mystickybar-hidden" <?php if(isset($welcomebar['mysticky_welcomebar_enable']) && $welcomebar['mysticky_welcomebar_enable'] == 1 ):?>style="display:none;"<?php endif;?>>	<?php esc_html_e('Bar is hidden', 'myStickymenu'); ?>
					</span>
				</p>
			</label>
		</div>
		
		<div class="mysticky-welcomebar-setting-wrap">
			<div class="mysticky-welcomebar-subheader-title">
				<h4><?php esc_html_e('Bar Settings', 'myStickymenu'); ?></h4>
			</div>
			<div class="mysticky-welcomebar-setting-block">
				<div class="mysticky-welcomebar-setting-content mysticky-welcomebar-setting-position">
					<label><?php esc_html_e('Position', 'myStickymenu'); ?><span class="mysticky-custom-fields-tooltip">
								<a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;">Choose if you want to show the bar on top or at the bottom of your site</p></span></label>
					<div class="mysticky-welcomebar-setting-content-right setting-content-relative">
						<label>
							<input name="mysticky_option_welcomebar[mysticky_welcomebar_position]" value= "top" type="radio" <?php checked( @$welcomebar['mysticky_welcomebar_position'], 'top' );?> />
							<?php esc_html_e("Top", 'mystickymenu'); ?>
						</label>
						<label>
							<input name="mysticky_option_welcomebar[mysticky_welcomebar_position]" value="bottom" type="radio" disabled />
							<?php esc_html_e("Bottom", 'mystickymenu'); ?>
						</label>
						<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php esc_html_e( 'Upgrade Now', 'mystickymenu' );?></a></span>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content height-setting" <?php if(isset($welcomebar['mysticky_welcomebar_enable_lead']) && $welcomebar['mysticky_welcomebar_enable_lead'] == 1):?> style="display:none;"<?php endif;?>>
					<label><?php esc_html_e('Height', 'myStickymenu'); ?>
						<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;">Choose the size of your bar in pixels</p></span>
					</label>
					<div class="mysticky-welcomebar-setting-content-right setting-content-relative">
						<div class="px-wrap">
							<input type="number" class="" min="0" step="1" id="mysticky_welcomebar_height" name="mysticky_option_welcomebar[mysticky_welcomebar_height]" value="60" disabled />
							<span class="input-px">PX</span>
						</div>
						<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php esc_html_e( 'Upgrade Now', 'mystickymenu' );?></a></span>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content">
					<label><?php esc_html_e('Bar Color', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-colorpicker">
						<input type="text" id="mysticky_welcomebar_bgcolor" name="mysticky_option_welcomebar[mysticky_welcomebar_bgcolor]" class="my-color-field" data-alpha="true" value="<?php echo esc_attr($welcomebar['mysticky_welcomebar_bgcolor']);?>" />
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content">
					<label>
						<?php _e('Bar background image', 'myStickymenu'); ?>
						<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;"><?php esc_html_e('Choose a custom image as the background for your welcome bar', 'myStickymenu');?><br><img src="<?php echo MYSTICKYMENU_URL ?>/images/bar-background-image.png" style="width:100%;"/></p></span>
					</label>
					<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-colorpicker setting-content-relative">
						<a href="<?php echo esc_url($upgarde_url); ?>" class="welcomebar-background-image" id="welcomebar-background-image"><?php esc_html_e('Upload Background', 'myStickymenu');?></a>
						<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php _e( 'Upgrade Now', 'mystickymenu' );?></a></span>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content">
					<label><?php esc_html_e('Bar Text Color', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-colorpicker">
						<input type="text" id="mysticky_welcomebar_bgtxtcolor" name="mysticky_option_welcomebar[mysticky_welcomebar_bgtxtcolor]" class="my-color-field" data-alpha="true" value="<?php echo esc_attr($welcomebar['mysticky_welcomebar_bgtxtcolor']);?>" />
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content">
					<label><?php esc_html_e('Font', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right">
						<select name="mysticky_option_welcomebar[mysticky_welcomebar_font]" class="form-fonts">
							<option value=""><?php esc_html_e( 'Select font family', 'myStickymenu' );?></option>
							<?php $group= ''; foreach( myStickymenu_fonts() as $key=>$value):
										if ($value != $group){
											echo '<optgroup label="' . esc_attr($value) . '">';
											$group = $value;
										}
									?>
								<option value="<?php echo esc_attr($key);?>" <?php selected( @$welcomebar['mysticky_welcomebar_font'], $key ); ?>><?php echo esc_html($key);?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content">
					<label><?php esc_html_e('Font Size', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right">
						<div class="px-wrap">
							<input type="number" class="" min="0" step="1" id="mysticky_welcomebar_fontsize" name="mysticky_option_welcomebar[mysticky_welcomebar_fontsize]" value="<?php echo (isset($welcomebar['mysticky_welcomebar_fontsize'])) ? esc_attr($welcomebar['mysticky_welcomebar_fontsize']) : '';?>" />
							<span class="input-px">PX</span>
						</div>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content mysticky-collect-lead">
					<label><?php esc_html_e('Bar Text', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right welcomebar-text">
						<label>
							<input id="welcomebar_static_text" name="mysticky_option_welcomebar[mysticky_welcomebar_text_type]" value= "static_text" type="radio" <?php checked( @$welcomebar['mysticky_welcomebar_text_type'], 'static_text' );?> />
							<span><?php esc_html_e("Static Text", 'mystickymenu'); ?></span>
						</label>
						<label>
							<input id="welcomebar_sliding_text" class="welcomebar_sliding_text"  name="mysticky_option_welcomebar[mysticky_welcomebar_text_type]" value="sliding_text" type="radio" <?php checked( @$welcomebar['mysticky_welcomebar_text_type'], 'sliding_text' );?> />
							<span>
								<?php esc_html_e("Sliding Texts", 'mystickymenu'); ?>
								<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;"><?php esc_html_e('Enhance Your Sticky Menu with Sliding Text. Display multiple lines of content that can scroll automatically in your desired direction.', 'mystickymenu');?><br><img src="<?php echo esc_url(MYSTICKYMENU_URL) ?>/images/sliding-text.gif" style="width:100%;"/></p></span>
							</span>
						</label>
					</div>
				</div>
				<div id="mysticky_welcomebar_static_text_setting" class="mysticky-welcomebar-setting-content" style="display:<?php echo (isset($welcomebar['mysticky_welcomebar_text_type']) && $welcomebar['mysticky_welcomebar_text_type'] == 'static_text') ? 'flex' : 'none'; ?>">
					<label></label>
					<div class="mysticky-welcomebar-setting-content-right">
					<?php 
						$settings = array(
							'media_buttons' => false,
							'textarea_name' => 'mysticky_option_welcomebar[mysticky_welcomebar_bar_text]',
							'tinymce'       => array(
												'toolbar1'      => 'bold,italic,underline,separator,alignleft,aligncenter,alignright,separator,link,unlink',
												'init_instance_callback' => 'function(editor){
																			editor.on("keypress ExecCommand", function(){
																				
																				var content = tinymce.activeEditor.getContent();
																				var mysticky_bar_text_val = content.replace(/(?:\r\n|\r|\n)/g, "<br />");
																				mysticky_bar_text_val = mysticky_bar_text_val.replace(/(?:onchange|onclick|onmouseover|onmouseout|onkeydown|onload\onerror|alert)/g, "");
																				jQuery( ".mysticky-welcomebar-content .mysticky-welcomebar-static_text" ).html( mysticky_bar_text_val );
																				
																				jQuery( ".mysticky-welcomebar-fixed p" ).css( "font-size", jQuery("#mysticky_welcomebar_fontsize").val() + "px" );
																				jQuery( ".mysticky-welcomebar-fixed p" ).css("color", jQuery("#mysticky_welcomebar_bgtxtcolor").val()  );

																			});
																		}'
											),
							'quicktags' => false,
						);
						wp_editor( stripslashes($welcomebar['mysticky_welcomebar_bar_text']), 'mysticky_bar_text', $settings ); 
						// add more buttons to the html editor
						function underline_tag_add_quicktags() {
							if ( wp_script_is('quicktags') ){ ?>
							<script type="text/javascript">
								QTags.addButton( 'underline_tag', 'U', '<u>', '</u>', 'underline', 'underline', 20, '' );
							</script>
						<?php
							}
						}
						add_action( 'admin_print_footer_scripts', 'underline_tag_add_quicktags' );    
						?>						
					</div>
				</div>
				<div id="mysticky_welcomebar_sliding_text_setting" class="mysticky-welcomebar-setting-content" style="display:<?php echo (isset($welcomebar['mysticky_welcomebar_text_type']) && $welcomebar['mysticky_welcomebar_text_type'] == 'sliding_text') ? 'flex' : 'none'; ?>">
					<label></label>
					<div class="mysticky-welcomebar-setting-content-right">
						<div class="welcomebar-slider-text-option">								
							<div class="welcomebar-slider-text">
								<input type="text" value="Add any sliding texts here" />
								<span class="add-more-slider-text"><span class="dashicons dashicons-insert"></span><?php esc_html_e('Add', 'mystickymenu');?></span>
							</div>
							<span class="upgrade-mystickymenu myStickymenu-upgrade">
								<a href="<?php echo esc_url($upgarde_url); ?>" target="_blank">
									<i class="fas fa-lock"></i><?php esc_html_e('UPGRADE NOW', 'mystickymenu'); ?>
								</a>
							</span>
						</div>
					</div>
				</div>
				<div id="mysticky_welcomebar_sliding_text_transition_style" class="mysticky-welcomebar-setting-content" style="display:<?php echo (isset($welcomebar['mysticky_welcomebar_text_type']) && $welcomebar['mysticky_welcomebar_text_type'] == 'sliding_text') ? 'flex' : 'none'; ?>">
					<label><?php esc_html_e('Transition styles', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right">
						<div class="welcomebar-slider-text-option">								
							<select>
								<option value="slideInRight" <?php selected( $welcomebar['mysticky_welcomebar_slider_transition'],'slideInRight')?>><?php esc_html_e('Right transition', 'myStickymenu');?></option>
								<option value="slideInLeft" <?php selected( $welcomebar['mysticky_welcomebar_slider_transition'],'slideInLeft')?>><?php esc_html_e('Left transition', 'myStickymenu');?></option>
								<option value="slideInUp" <?php selected( $welcomebar['mysticky_welcomebar_slider_transition'],'slideInUp')?>><?php esc_html_e('Up transition', 'myStickymenu');?></option>
								<option value="slideInDown" <?php selected( $welcomebar['mysticky_welcomebar_slider_transition'],'slideInDown')?>><?php esc_html_e('Down transition', 'myStickymenu');?></option>
							</select>
							<span class="upgrade-mystickymenu myStickymenu-upgrade">
								<a href="<?php echo esc_url($upgarde_url); ?>" target="_blank">
									<i class="fas fa-lock"></i><?php esc_html_e('UPGRADE NOW', 'mystickymenu'); ?>
								</a>
							</span>
						</div>
					</div>
				</div>
				<div id="mysticky_welcomebar_sliding_text_transition_speed" class="mysticky-welcomebar-setting-content" style="display:<?php echo (isset($welcomebar['mysticky_welcomebar_text_type']) && $welcomebar['mysticky_welcomebar_text_type'] == 'sliding_text') ? 'flex' : 'none'; ?>">
					<label><?php esc_html_e('Transition speed', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right">
						<div class="welcomebar-slider-text-option">								
							<select>
								<option value="6000" data-speed="6000"><?php esc_html_e('Slow', 'myStickymenu');?></option>
								<option value="4500" data-speed="4500"><?php esc_html_e('Medium', 'myStickymenu');?></option>
								<option value="3000" data-speed="3000"><?php esc_html_e('Fast', 'myStickymenu');?></option>
							</select>
							<span class="upgrade-mystickymenu myStickymenu-upgrade">
								<a href="<?php echo esc_url($upgarde_url); ?>" target="_blank">
									<i class="fas fa-lock"></i><?php esc_html_e('UPGRADE NOW', 'mystickymenu'); ?>
								</a>
							</span>
						</div>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content">
					<label><?php esc_html_e('Show an X Button', 'myStickymenu'); ?>
						<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;"><?php esc_html_e('Choose if you want to show an X button to close the bar or not or desktop and mobile devices', 'mystickymenu');?></p></span>	
					</label>
					<div class="mysticky-welcomebar-setting-content-right">
						<label>
							<input name="mysticky_option_welcomebar[mysticky_welcomebar_x_desktop]" value= "desktop" type="checkbox" <?php checked( @$welcomebar['mysticky_welcomebar_x_desktop'], 'desktop' );?> />
							<?php esc_html_e( 'Desktop', 'mystickymenu' );?>
						</label>
						<label>
							<input name="mysticky_option_welcomebar[mysticky_welcomebar_x_mobile]" value= "mobile" type="checkbox" <?php checked( @$welcomebar['mysticky_welcomebar_x_mobile'], 'mobile' );?> />
							<?php esc_html_e( 'Mobile', 'mystickymenu' );?>
						</label>
						<div class="x-color-wrap"><label>X Color</label>
						<div class="mysticky-welcomebar-colorpicker color-x-input">
							<input type="text" id="mysticky_welcomebar_xcolor" name="mysticky_option_welcomebar[mysticky_welcomebar_x_color]" class="my-color-field" data-alpha="true" value="<?php echo isset($welcomebar['mysticky_welcomebar_x_color']) ? esc_attr($welcomebar['mysticky_welcomebar_x_color']) : ''; ?>"></div></div>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content">						
					<label><?php esc_html_e('Countdown', 'myStickymenu'); ?> <span class="dashicons dashicons-clock" style="margin-left:5px;color:#a8aeaf;"></span> 
					<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;"><?php esc_html_e("Add a countdown timer element to your Bar to increase conversion rate, announce flash sales, and more","mystickymenu");?><br><img src="<?php echo esc_url(MYSTICKYMENU_URL) ?>/images/countdown.gif" style="width:100%;"/></p></span>
					</label>
					<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-close-automatically-sec">
						<label for="mysticky-welcomebar-countdown-enabled" class="mysticky-welcomebar-switch">
							<input type="checkbox" id="mysticky-welcomebar-countdown-enabled" name="mysticky_option_welcomebar[mysticky_welcomebar_enable_countdown]" value="1" data-url="<?php echo esc_url($upgarde_url); ?>" />
							<span class="slider"></span>
							
						</label>
						<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php esc_html_e( 'Upgrade Now', 'mystickymenu' );?></a></span>
					</div>
				</div>
				<!-- Collect lead Section  -->
				<div class="mysticky-welcomebar-setting-content">
					<label style="position:relative;"><?php esc_html_e('Collect leads', 'myStickymenu'); ?>&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16" style="fill: #a8aeaf;position: absolute;top: 3px"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"></path></svg> 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;"><?php echo sprintf(esc_html__(" Collect the visitor's details such as Name, email address or phone number from the bar. Collected visitor details can be viewed on the %1\$s page","mystickymenu"), '<a href="' . esc_url(admin_url("admin.php?page=my-sticky-menu-leads")). '" target="_blank">' . esc_html__( 'Contact Form Leads', 'mystickymenu') .'</a>');?></p></span>
					</label>
					<div class="mysticky-welcomebar-setting-content-right">
						<label for="mysticky-welcomebar-collectlead-enabled" class="mysticky-welcomebar-switch collect-lead-switch">
							<input type="checkbox" id="mysticky-welcomebar-collectlead-enabled" name="mysticky_option_welcomebar[mysticky_welcomebar_enable_lead]" data-button-text= "<?php echo esc_attr($welcomebar["mysticky_welcomebar_btn_text"]); ?>" value="1" <?php checked( @$welcomebar['mysticky_welcomebar_enable_lead'], '1' );?>/>
							<span class="slider"></span>
						</label>
					</div>
				</div>
				<div class="mysticky-welcomebar-collect-lead mysticky-collect-lead" <?php if( isset($welcomebar['mysticky_welcomebar_enable_lead']) && $welcomebar['mysticky_welcomebar_enable_lead'] != 1 ):?> style="display:none;" <?php endif;?>>
					<div class="mysticky-welcomebar-setting-content">
						<label><?php esc_html_e('Select inputs', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right lead_inputs">
							<label>
								<input id="mysticky_lead_input_email" name="mysticky_option_welcomebar[mysticky_welcomebar_lead_input]" value= "email_address" type="radio" <?php checked( @$welcomebar['mysticky_welcomebar_lead_input'], 'email_address' );?> />
								<span><?php esc_html_e("Name & email address", 'mystickymenu'); ?></span>
							</label>
							<label>
								<input id="mysticky_lead_input_phone" class="mysticky_lead_input_phone"  name="mysticky_option_welcomebar[mysticky_welcomebar_lead_input]" value="phone" type="radio" <?php checked( @$welcomebar['mysticky_welcomebar_lead_input'], 'phone' );?> />
								<span><?php esc_html_e("Name & phone number", 'mystickymenu'); ?></span>
							</label>				
						</div>
					</div>

					<div class="mysticky-welcomebar-setting-content">
						<label><?php esc_html_e('Placeholder for Name', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right">
							<input type="text" class="mysticky_welcome_lead_name_placeholder" autocomplete="off"  value="<?php echo isset($welcomebar['lead_name_placeholder']) ? esc_attr($welcomebar['lead_name_placeholder']) : ''; ?>" name="mysticky_option_welcomebar[lead_name_placeholder]" id="lead-name-placeholder" />	
						</div>
					</div>

					<div class="mysticky-welcomebar-setting-content" id="lead-email-content" style="display:<?php echo (isset($welcomebar['mysticky_welcomebar_lead_input']) && $welcomebar['mysticky_welcomebar_lead_input'] == 'email_address') ? 'flex' : 'none'; ?>">
						<label><?php esc_html_e('Placeholder for Email', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right">
							<input type="text" class="mysticky_welcome_lead_email_placeholder" autocomplete="off"  value="<?php echo isset($welcomebar['lead_email_placeholder']) ? esc_attr($welcomebar['lead_email_placeholder']) : ''; ?>" name="mysticky_option_welcomebar[lead_email_placeholder]" id="lead-email-placeholder" />	
						</div>
					</div>

					<div class="mysticky-welcomebar-setting-content" id="lead-phone-content" style="display:<?php echo (isset($welcomebar['mysticky_welcomebar_lead_input']) && $welcomebar['mysticky_welcomebar_lead_input'] == 'phone') ? 'flex' : 'none'; ?>">
						<label><?php esc_html_e('Placeholder for Phone', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right">
							<input type="text" class="mysticky_welcome_lead_phone_placeholder" autocomplete="off"  value="<?php echo isset($welcomebar['lead_phone_placeholder']) ? esc_attr($welcomebar['lead_phone_placeholder']) : ''; ?>" name="mysticky_option_welcomebar[lead_phone_placeholder]" id="lead-phone-placeholder" />	
						</div>
					</div>
					
					<div class="mysticky-welcomebar-setting-content">
						<label for="mysticky_welcomebar_show_success_message">
							<?php esc_html_e( 'Show success message', 'mystickymenu');?>
						</label>
						<div class="mysticky-welcomebar-setting-content-right" style="margin-top: 8px;">
							<label for="mysticky_welcomebar_show_success_message" class="mysticky-welcomebar-switch">
								<input name="mysticky_option_welcomebar[mysticky_welcomebar_show_success_message]" id="mysticky_welcomebar_show_success_message" value= "1" type="checkbox" <?php checked( @$welcomebar['mysticky_welcomebar_show_success_message'], '1' );?> />
								<span class="slider"></span>
							</label>
						</div>
					</div>
					<div id="mysticky-welcomebar-thankyou-wrap" class="mysticky-welcomebar-setting-content flex-top" <?php if ( !isset($welcomebar['mysticky_welcomebar_show_success_message']) ) : ?> style="display:none;" <?php endif;?>>
						<label><?php esc_html_e('Thank You Text', 'myStickymenu'); ?></label>
						
						<?php $mysticky_welcomebar_thankyou_screen_text = (isset($welcomebar['mysticky_welcomebar_thankyou_screen_text'])) ? stripslashes($welcomebar['mysticky_welcomebar_thankyou_screen_text']) : 'Thank you for submitting the form' ; ?>
						<div class="mysticky-welcomebar-setting-content-right">
							<?php 
							$settings = array(
								'media_buttons' => false, 
								'textarea_name' => 'mysticky_option_welcomebar[mysticky_welcomebar_thankyou_screen_text]',
								'tinymce' => false,
								'quicktags' => array(
									'buttons' => 'strong,em,link'
								)
							);
							wp_editor( stripslashes($mysticky_welcomebar_thankyou_screen_text), 'mysticky_thankyou_screen_text', $settings ); 
							?>				
						</div>
					</div>

					<div class="mysticky-welcomebar-setting-content">
						<label  style="width:351px;">
							<input name="mysticky_option_welcomebar[mysticky_welcomebar_send_email_lead]" id="send_lead_email_enable" data-url="<?php echo esc_url($upgarde_url); ?>" value= "1" type="checkbox" /><?php esc_html_e( 'Send leads to email', 'mystickymenu');?>
							<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php esc_html_e( 'Upgrade Now', 'mystickymenu' );?></a></span>
						</label>	
					</div>	
				</div>	
				<!-- Coupon Section Start  -->
				<div class="mysticky-welcomebar-setting-content">
					<label class="bagicon"><?php esc_html_e('Show Coupons', 'myStickymenu'); ?> &nbsp;<img src="<?php echo esc_url(MYSTICKYMENU_URL); ?>/images/shopyicon.svg" />
					<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;"><?php esc_html_e("Add a coupon to your bar. Users can click on the coupon, copy it and use it on your website","mystickymenu");?><br><img src="<?php echo esc_url(esc_url(MYSTICKYMENU_URL)) ?>/images/show-coupon-ss.png" style="width:100%;"/></p></span>
					</label>
					<div class="mysticky-welcomebar-setting-content-right" style="margin-top: 8px;">
						<label for="mysticky-welcomebar-showcoupon-enabled" class="mysticky-welcomebar-switch showcoupon-switch">
							<input type="checkbox" id="mysticky-welcomebar-showcoupon-enabled" name="mysticky_option_welcomebar[mysticky_welcomebar_enable_coupon]" data-url="<?php echo esc_url($upgarde_url); ?>"  value="1"/>
							<span class="slider"></span>
						</label>
						<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php esc_html_e( 'Upgrade Now', 'mystickymenu' );?></a></span>
					</div>
				</div>
			</div><!-- mysticky-welcomebar-setting-block -->
			
			<div class="mysticky-welcomebar-subheader-title">
				<h4><?php esc_html_e('Button Settings', 'myStickymenu'); ?></h4>
			</div>
			
			<div class="mysticky-welcomebar-setting-block">
				<div class="mysticky-welcomebar-setting-content">
					<label><?php esc_html_e('Show a Button On', 'myStickymenu'); ?>
						<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;">Choose whether you want to display a button on your bar or not on desktop and mobile devices</p></span>	
					</label>
					<div class="mysticky-welcomebar-setting-content-right">
						<label>
							<input name="mysticky_option_welcomebar[mysticky_welcomebar_btn_desktop]" value= "desktop" type="checkbox" <?php checked( @$welcomebar['mysticky_welcomebar_btn_desktop'], 'desktop' );?> />
							<?php esc_html_e( 'Desktop', 'mystickymenu' );?>
						</label>
						<label>
							<input name="mysticky_option_welcomebar[mysticky_welcomebar_btn_mobile]" value= "mobile" type="checkbox"<?php checked( @$welcomebar['mysticky_welcomebar_btn_mobile'], 'mobile' );?> />
							<?php esc_html_e( 'Mobile', 'mystickymenu' );?>
						</label>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content">
					<label for="mysticky-welcomebar-postion-relative-text"><?php esc_html_e('Set the button\'s position relative to the text', 'myStickymenu'); ?>
						<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;">Customize the position of the button and the text to match your design preference.</p></span>
					</label>
					<div class="mysticky-welcomebar-setting-content-right">
						<label for="mysticky-welcomebar-postion-relative-text" class="mysticky-welcomebar-switch">
							<input type="checkbox" id="mysticky-welcomebar-postion-relative-text" name="mysticky_option_welcomebar[mysticky_welcomebar_button_postion_relative_text]" value="1" <?php checked( @$welcomebar['mysticky_welcomebar_button_postion_relative_text'], '1' );?> />
							<span class="slider"></span>
						</label>
					</div>
				</div>
				
				<div id="mysticky-welcomebar-button-text-postion" class="mysticky-welcomebar-setting-content" <?php if( isset($welcomebar['mysticky_welcomebar_button_postion_relative_text']) && $welcomebar['mysticky_welcomebar_button_postion_relative_text'] != 1 ):?> style="display:none;" <?php endif;?>>
					<label for="mysticky-welcomebar-button-text-postion"><?php esc_html_e('Position', 'myStickymenu'); ?>
						<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;">Position the button and text to the right, left, or center of the bar.</p></span>
					</label>
					<div class="mysticky-welcomebar-setting-content-right setting-content-relative">
						<label>
							<input name="mysticky_option_welcomebar[mysticky_welcomebar_button_text_postion]" value= "left" type="radio" <?php checked( @$welcomebar['mysticky_welcomebar_button_text_postion'], 'left' );?> />
							<?php esc_html_e("Left", 'mystickymenu'); ?>
						</label>
						<label>
							<input name="mysticky_option_welcomebar[mysticky_welcomebar_button_text_postion]" value= "center" type="radio" <?php checked( @$welcomebar['mysticky_welcomebar_button_text_postion'], 'center' );?> />
							<?php esc_html_e("Center", 'mystickymenu'); ?>
						</label>
						<label>
							<input name="mysticky_option_welcomebar[mysticky_welcomebar_button_text_postion]" value="right" type="radio" <?php checked( @$welcomebar['mysticky_welcomebar_button_text_postion'], 'right' );?> />
							<?php esc_html_e("Right", 'mystickymenu'); ?>
						</label>						
					</div>					
				</div>
				<div class="mysticky-welcomebar-setting-content">
					<label><?php esc_html_e('Button Color', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-colorpicker mysticky_welcomebar_btn_color">
						<input type="text" id="mysticky_welcomebar_btncolor" name="mysticky_option_welcomebar[mysticky_welcomebar_btncolor]" class="my-color-field" data-alpha="true" value="<?php echo esc_attr($welcomebar['mysticky_welcomebar_btncolor']);?>" />
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content">
					<label><?php esc_html_e('Button Text Color', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-colorpicker mysticky_welcomebar_btn_color">
						<input type="text" id="mysticky_welcomebar_btntxtcolor" name="mysticky_option_welcomebar[mysticky_welcomebar_btntxtcolor]" class="my-color-field" data-alpha="true" value="<?php echo esc_attr($welcomebar['mysticky_welcomebar_btntxtcolor']);?>" />
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content">
					<label><?php esc_html_e('Button Text', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right welcomebar-text-button">
						<input type="text" id="mysticky_welcomebar_btn_text" class="mystickyinput mysticky_welcomebar_disable" name="mysticky_option_welcomebar[mysticky_welcomebar_btn_text]" value="<?php echo stripslashes($welcomebar['mysticky_welcomebar_btn_text']);?>" />
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content">
					<label><?php esc_html_e('Hover Effects', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right welcomebar-hover-effect">
						<select name="mysticky_option_welcomebar[mysticky_welcomebar_hover_effect]" class="mysticky-welcomebar-hover-effect mysticky_welcomebar_disable">
							<option value="none" <?php selected( @$welcomebar['mysticky_welcomebar_hover_effect'], 'none' ); ?>><?php esc_html_e( 'None', 'myStickymenu' );?></option>
							<option value="fill_effect_button" <?php selected( @$welcomebar['mysticky_welcomebar_hover_effect'], 'fill_effect_button' ); ?>><?php esc_html_e( 'Fill on effects on hover', 'myStickymenu' );?></option>
							<option value="border_effect_button" <?php selected( @$welcomebar['mysticky_welcomebar_hover_effect'], 'border_effect_button' ); ?>><?php esc_html_e( 'Border effects on hover', 'myStickymenu' );?></option>
						</select>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content welcomebar-hover-fill-effect"  <?php if ( $welcomebar['mysticky_welcomebar_hover_effect'] != 'fill_effect_button' ) : ?> style="display:none;" <?php endif;?>>
					<label><?php esc_html_e('Button Hover Fill effects ', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right">
						<select name="mysticky_option_welcomebar[mysticky_welcomebar_hover_fill_effect]" class="mysticky-welcomebar-hover-effect mysticky_welcomebar_disable">
							<option value="fill1" <?php selected( @$welcomebar['mysticky_welcomebar_hover_fill_effect'], 'fill1' ); ?>><?php esc_html_e( 'Fill Style 1', 'myStickymenu' );?></option>
							<option value="fill2" <?php selected( @$welcomebar['mysticky_welcomebar_hover_fill_effect'], 'fill2' ); ?>><?php esc_html_e( 'Fill Style 2', 'myStickymenu' );?></option>
							<option value="fill3" <?php selected( @$welcomebar['mysticky_welcomebar_hover_fill_effect'], 'fill3' ); ?>><?php esc_html_e( 'Fill Style 3', 'myStickymenu' );?></option>
							<option value="fill4" <?php selected( @$welcomebar['mysticky_welcomebar_hover_fill_effect'], 'fill4' ); ?>><?php esc_html_e( 'Fill Style 4', 'myStickymenu' );?></option>
							<option value="fill5" <?php selected( @$welcomebar['mysticky_welcomebar_hover_fill_effect'], 'fill5' ); ?>><?php esc_html_e( 'Fill Style 5', 'myStickymenu' );?></option>
						</select>
					</div>
				</div>	
				<div class="mysticky-welcomebar-setting-content welcomebar-hover-border-effect"  <?php if ( $welcomebar['mysticky_welcomebar_hover_effect'] != 'border_effect_button' ) : ?> style="display:none;" <?php endif;?>>
					<label><?php esc_html_e('Button Hover Border effects ', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right">
						<select name="mysticky_option_welcomebar[mysticky_welcomebar_hover_border_effect]" class="mysticky-welcomebar-hover-effect mysticky_welcomebar_disable">
							<option value="border1" <?php selected( @$welcomebar['mysticky_welcomebar_hover_border_effect'], 'border1' ); ?>><?php esc_html_e( 'Border Style 1', 'myStickymenu' );?></option>
							<option value="border2" <?php selected( @$welcomebar['mysticky_welcomebar_hover_border_effect'], 'border2' ); ?>><?php esc_html_e( 'Border Style 2', 'myStickymenu' );?></option>
							<option value="border3" <?php selected( @$welcomebar['mysticky_welcomebar_hover_border_effect'], 'border3' ); ?>><?php esc_html_e( 'Border Style 3', 'myStickymenu' );?></option>
							<option value="border4" <?php selected( @$welcomebar['mysticky_welcomebar_hover_border_effect'], 'border4' ); ?>><?php esc_html_e( 'Border Style 4', 'myStickymenu' );?></option>
						</select>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content mysticky-welcomebar-hover-txt-color" <?php if ( $welcomebar['mysticky_welcomebar_hover_effect'] == 'none' ) : ?> style="display:none;" <?php endif;?>>
					<label><?php esc_html_e('Button Hover Text Color', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-colorpicker mysticky_welcomebar_btn_color">
						<input type="text" id="mysticky_welcomebar_btnhovertxtcolor" name="mysticky_option_welcomebar[mysticky_welcomebar_btnhovertxtcolor]" class="my-color-field" data-alpha="true" value="<?php echo esc_attr($welcomebar['mysticky_welcomebar_btnhovertxtcolor']);?>" />
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content mysticky-welcomebar-hover-color" <?php if ( $welcomebar['mysticky_welcomebar_hover_effect'] == 'none' ) : ?> style="display:none;" <?php endif;?>>
					<label><?php esc_html_e('Button Hover Color', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-colorpicker mysticky_welcomebar_btn_color">
						<input type="text" id="mysticky_welcomebar_btnhovercolor" name="mysticky_option_welcomebar[mysticky_welcomebar_btnhovercolor]" class="my-color-field" data-alpha="true" value="<?php echo esc_attr($welcomebar['mysticky_welcomebar_btnhovercolor']);?>" />
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content mysticky-welcomebar-hover-border-color" <?php if ( $welcomebar['mysticky_welcomebar_hover_effect'] != 'border_effect_button' ) : ?> style="display:none;" <?php endif;?>>
					<label><?php esc_html_e('Button Hover Border Color', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-colorpicker mysticky_welcomebar_btn_color">
						<input type="text" id="mysticky_welcomebar_btnhoverbordercolor" name="mysticky_option_welcomebar[mysticky_welcomebar_btnhoverbordercolor]" class="my-color-field" data-alpha="true" value="<?php echo esc_attr($welcomebar['mysticky_welcomebar_btnhoverbordercolor']);?>" />
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content">
					<label><?php esc_html_e('Attention Effect', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right">
						<div class="mysticky-welcomebar-setting-attention">
							<select name="mysticky_option_welcomebar[mysticky_welcomebar_attentionselect]" class="mysticky-welcomebar-attention mysticky_welcomebar_disable">
								<option value="default" <?php selected( @$welcomebar['mysticky_welcomebar_attentionselect'], '	' ); ?>><?php esc_html_e( 'None', 'myStickymenu' );?></option>
								<option value="flash" <?php selected( @$welcomebar['mysticky_welcomebar_attentionselect'], 'flash' ); ?>><?php esc_html_e( 'Flash', 'myStickymenu' );?></option>
								<option value="shake" <?php selected( @$welcomebar['mysticky_welcomebar_attentionselect'], 'shake' ); ?>><?php esc_html_e( 'Shake', 'myStickymenu' );?></option>
								<option value="swing" <?php selected( @$welcomebar['mysticky_welcomebar_attentionselect'], 'swing' ); ?>><?php esc_html_e( 'Swing', 'myStickymenu' );?></option>
								<option value="tada" <?php selected( @$welcomebar['mysticky_welcomebar_attentionselect'], 'tada' ); ?>><?php esc_html_e( 'Tada', 'myStickymenu' );?></option>
								<option value="heartbeat" <?php selected( @$welcomebar['mysticky_welcomebar_attentionselect'], 'heartbeat' ); ?>><?php esc_html_e( 'Heartbeat', 'myStickymenu' );?></option>
								<option value="wobble" <?php selected( @$welcomebar['mysticky_welcomebar_attentionselect'], 'wobble' ); ?>><?php esc_html_e( 'Wobble', 'myStickymenu' );?></option>
							</select>
						</div>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content">
					<label><?php esc_html_e('Action On Button Click', 'myStickymenu'); ?>
						<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;">Select what you'd like to happen when a visitor clicks on the button <br/>Redirect the visitor to another URL - your visitor will be redirected to another URL after they click on the button (for example, a specific product or latest collection) <br/>Close the Bar - after they user clicks on the button, the Bar will be closed <br/>Launch a Poptin pop-up - when the user clicks on the button, a Poptin pop-up will be launched. You need to first create a free Poptin account (link on "free Poptin account" to <a href='https://www.poptin.com/?utm_source=msm' target="_blank">https://www.poptin.com/?utm_source=msm</a>) and set up your pop-ups <br/>Show a thank-you screen - show a thank you screen after the user clicks on a button with different text from your Bar text</p></span>		
					</label>
					<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-setting-redirect-wrap">
						<div class="mysticky-welcomebar-setting-action">
							<select name="mysticky_option_welcomebar[mysticky_welcomebar_actionselect]" class="mysticky-welcomebar-action mysticky_welcomebar_disable">
								<option value="redirect_to_url" <?php selected( @$welcomebar['mysticky_welcomebar_actionselect'], 'redirect_to_url' ); ?>><?php esc_html_e( 'Redirect the visitor to another URL', 'myStickymenu' );?></option>
								<option value="close_bar" <?php selected( @$welcomebar['mysticky_welcomebar_actionselect'], 'close_bar' ); ?>><?php esc_html_e( 'Close the Bar', 'myStickymenu' );?></option>
								<option value="poptin_popup" <?php selected( @$welcomebar['mysticky_welcomebar_actionselect'], 'poptin_popup' ); ?> ><?php esc_html_e( 'Launch a Poptin pop-up', 'myStickymenu' );?></option>
								<option value="thankyou_screen" data-href="<?php echo esc_url($upgarde_url); ?>"><?php esc_html_e( 'Show a thank-you screen (Pro Feature)', 'myStickymenu' );?></option>
							</select>
						</div>
						
					</div>
				</div>
				
				<div class="mysticky-welcomebar-poptin-popup" <?php if ( $welcomebar['mysticky_welcomebar_actionselect'] != 'poptin_popup' ) : ?> style="display:none;" <?php endif;?>>						
					<div class="mysticky-welcomebar-setting-content">
						<p class="mysticky-welcomebar-poptin-content" >Sign up at <a href="https://www.poptin.com/?utm_source=msm" target="_blank">Poptin</a> for free and launch pop-ups on <a href="https://help.poptin.com/article/show/72942-how-to-show-a-poptin-when-the-visitor-clicks-on-a-button-link-on-your-site" target="_blank">click</a>							
						</p>							
					</div>
					<div class="mysticky-welcomebar-setting-content">
						<label><?php esc_html_e('Poptin pop-up direct link', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right">
							<input type="text" id="mysticky_welcomebar_poptin_popup_link" class="mystickyinput mysticky_welcomebar_disable" name="mysticky_option_welcomebar[mysticky_welcomebar_poptin_popup_link]" value="<?php echo (isset($welcomebar['mysticky_welcomebar_poptin_popup_link'])) ? esc_attr($welcomebar['mysticky_welcomebar_poptin_popup_link']) : '';?>" placeholder="<?php echo esc_url("https://app.popt.in/APIRequest/click/some_id_here"); ?>"  />
							<input type="hidden" id="welcome_save_anyway"  value='' />
						</div>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content mysticky-welcomebar-redirect-container" <?php if ( $welcomebar['mysticky_welcomebar_actionselect'] != 'redirect_to_url' ) : ?> style="display:none;" <?php endif;?>>
					<label><?php esc_html_e('Redirection link', 'myStickymenu'); ?></label>
					<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-setting-action mysticky-welcomebar-redirect" <?php if ( $welcomebar['mysticky_welcomebar_actionselect'] == 'close_bar' ) : ?> style="display:none;" <?php endif;?> >
						<input type="text" id="mysticky_welcomebar_redirect" class="mystickyinput mysticky_welcomebar_disable" name="mysticky_option_welcomebar[mysticky_welcomebar_redirect]" value="<?php echo ( isset($welcomebar['mysticky_welcomebar_redirect'])) ? esc_url($welcomebar['mysticky_welcomebar_redirect']) : esc_url($welcomebar['mysticky_welcomebar_redirect']);?>" placeholder="<?php echo esc_url("https://www.yourdomain.com"); ?>"  />
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content mysticky-welcomebar-redirect-container" <?php if ( $welcomebar['mysticky_welcomebar_actionselect'] != 'redirect_to_url' ) : ?> style="display:none;" <?php endif;?>>
					<label><?php esc_html_e( 'Open in a new tab', 'mystickymenu' );?></label>
					<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-setting-newtab mysticky-welcomebar-redirect"  >
						<label class="mysticky-welcomebar-switch">
							<input name="mysticky_option_welcomebar[mysticky_welcomebar_redirect_newtab]" value= "1" type="checkbox" disabled />
							<span class="slider"></span>
						</label>
						<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php esc_html_e( 'Upgrade Now', 'mystickymenu' );?></a></span>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content mysticky-welcomebar-redirect-container" <?php if ( $welcomebar['mysticky_welcomebar_actionselect'] != 'redirect_to_url' ) : ?> style="display:none;" <?php endif;?>>
					<label><?php esc_html_e('rel Attribute', 'myStickymenu'); ?>
						<span class="mysticky-custom-fields-tooltip">
							<a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a>
							<p><?php esc_html_e("Add a \"rel\" attribute to the button link. You can use it to add a rel=\"nofollow\", \"sponsored\", or any other \"rel\" attribute option","mystickymenu");?></p>
						</span>
					</label>
					<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-setting-newtab mysticky-welcomebar-redirect"  >
						<input type="text" id="mysticky_welcomebar_redirect_rel" class="mystickyinput mysticky_welcomebar_disable unactive_rel_input" name="mysticky_option_welcomebar[mysticky_welcomebar_redirect_rel]" value="" placeholder="" disabled />
						<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php esc_html_e( 'Upgrade Now', 'mystickymenu' );?></a></span>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content">
					<label><?php esc_html_e('Bar Appearance After Button Click', 'myStickymenu'); ?>
						<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;"><?php esc_html_e("Choose bar display settings after a visitor click on the button. The \"Don't show the Bar again for the user\" option is the preferable option if you don't want to annoy your visitors by showing the bar over and over","mystickymenu");?></p></span>
					</label>
					<div class="mysticky-welcomebar-setting-content-right">
						<div class="mysticky-welcomebar-setting-action">
							<select name="mysticky_option_welcomebar[mysticky_welcomebar_aftersubmission]" class="mysticky-welcomebar-aftersubmission mysticky_welcomebar_disable">
								<option value="dont_show_welcomebar" <?php selected( @$welcomebar['mysticky_welcomebar_aftersubmission'], 'dont_show_welcomebar' ); ?>><?php esc_html_e( "Don't show the Bar again for the user", 'myStickymenu' );?></option>
								<option value="show_welcomebar_next_visit" <?php selected( @$welcomebar['mysticky_welcomebar_aftersubmission'], 'show_welcomebar_next_visit' ); ?>><?php esc_html_e( 'Show the Bar again when the user visits the website next time', 'myStickymenu' );?></option>
								<option value="show_welcomebar_every_page" <?php selected( @$welcomebar['mysticky_welcomebar_aftersubmission'], 'show_welcomebar_every_page' ); ?> ><?php esc_html_e( 'Show the Bar when the user refreshes/goes to another page', 'myStickymenu' );?></option>
							</select>
						</div>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-content">
					<label><?php esc_html_e('Close Bar Automatically After Click', 'myStickymenu'); ?>
						<span class="mysticky-custom-fields-tooltip"><a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a><p style="z-index: 99999;"><?php esc_html_e("Choose if you'd like the bar to be closed automatically after button submission",'mystickymenu');?></p></span>
					</label>
					<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-close-automatically-sec">
						<label for="mysticky-welcomebar-close-automatically-enabled" class="mysticky-welcomebar-switch">
							<input type="checkbox" id="mysticky-welcomebar-close-automatically-enabled" name="mysticky_option_welcomebar[mysticky_welcomebar_enable_automatical]" value="1" data-url="<?php echo esc_url($upgarde_url); ?>"/>
							<span class="slider"></span>
						</label>
						<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php esc_html_e( 'Upgrade Now', 'mystickymenu' );?></a></span>
						<div class="mysticky-welcomebar-setting-action" style="display:none;">
							<div class="px-wrap">
								<span><?php esc_html_e('Close bar after ', 'myStickymenu'); ?></span>
								<input type="number" class="" min="0" step="1" id="mysticky_welcomebar_triggersec_automatically" name="mysticky_option_welcomebar[mysticky_welcomebar_triggersec_automatically]" value="0">
								<span class="input-px"><?php esc_html_e('Sec', 'myStickymenu'); ?></span>
							</div>
						</div>
					</div>
				</div>
				
			</div><!-- mysticky-welcomebar-setting-block -->
			
		</div><!-- mysticky-welcomebar-setting-wrap -->
	
	</div><!--mystickybar-content-section -->
</div>