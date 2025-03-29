<?php
/**
 * MSB BarPreview
 *
 * @author  : Premio <contact@premio.io>
 * @license : GPL2
 * */

if (defined('ABSPATH') === false) {
    exit;
}
$button_postion_relative_text = (isset($welcomebar['mysticky_welcomebar_button_postion_relative_text']) ) ? esc_attr($welcomebar['mysticky_welcomebar_button_postion_relative_text']) : '';
$button_text_postion = (isset($welcomebar['mysticky_welcomebar_button_text_postion']) ) ? esc_attr($welcomebar['mysticky_welcomebar_button_text_postion']) : 'center';
$button_text_postion_clss = '';
if ( $button_postion_relative_text == 1 ) {
	$button_text_postion_clss = 'mysticky-welcomebar-position-' . $button_text_postion;
}
?>
<div class="mysticky-welcomebar-preview-wrap">
	<div class="mysticky-welcomebar-setting-right mysticky-welcomebar-preview">
		<div class="mysticky-welcomebar-backword-page">
			<a href="<?php echo esc_url(admin_url("admin.php?page=my-stickymenu-welcomebar"));?>"><span class="dashicons dashicons-arrow-left-alt2 back-dashboard" style="color: unset;font-size: 17px;"></span> Back to Dashboard</a>
		</div>
		<div class="mysticky-welcomebar-header-title">
			<h3><?php esc_html_e('Preview', 'mystickyelements'); ?></h3>
		</div>
		<div class="mysticky-welcomebar-preview-screen">
			<?php if(isset($welcomebar['mysticky_welcomebar_font']) && $welcomebar['mysticky_welcomebar_font'] != '' ):?>
			<link href="https://fonts.googleapis.com/css?family=<?php echo esc_attr($welcomebar['mysticky_welcomebar_font']) ?>:400,600,700|Lato:400,500,600,700" rel="stylesheet" type="text/css" class="sfba-google-font">
			<?php endif; ?>
			<div class="mysticky-welcomebar-fixed mysticky-welcomebar-display-desktop <?php echo esc_attr($display_main_class); ?>" >
				<div class="mysticky-welcomebar-fixed-wrap <?php echo esc_attr($button_text_postion_clss);?>">
					<?php 
						$content_width = (isset($welcomebar['mysticky_welcomebar_enable_lead']) && $welcomebar['mysticky_welcomebar_enable_lead'] === '1') ? '90%'  : '75%';
					?>	
					<div class="mysticky-welcomebar-content" style="width:<?php  echo esc_attr($content_width); ?>">								
						<div class="mysticky-welcomebar-static_text" style="display:<?php echo (isset($welcomebar['mysticky_welcomebar_text_type']) && $welcomebar['mysticky_welcomebar_text_type'] == 'static_text') ? 'block' : 'none'; ?>">
						<?php echo isset($welcomebar['mysticky_welcomebar_bar_text'])? stripslashes($welcomebar['mysticky_welcomebar_bar_text']) :"Get 30% off your first purchase";?>								
						</div>
					</div>

					<div class="mysticky-welcomebar-lead-content" <?php if((isset($welcomebar['mysticky_welcomebar_enable_lead']) && $welcomebar['mysticky_welcomebar_enable_lead'] != 1)) :?> style="display:none;" <?php endif; ?>>

						<input type="text" class="preview-lead-name" placeholder="<?php echo esc_attr($welcomebar['lead_name_placeholder']);?>"/>
						<input type="text" class="preview-lead-email" placeholder="<?php echo esc_attr($welcomebar['lead_email_placeholder']);?>" style="display:<?php echo (isset($welcomebar['mysticky_welcomebar_lead_input']) && $welcomebar['mysticky_welcomebar_lead_input'] == 'email_address') ? 'flex' : 'none';?>"/>
						<input type="text" class="preview-lead-phone" placeholder="<?php echo esc_attr($welcomebar['lead_phone_placeholder']);?>" style="display:<?php echo (isset($welcomebar['mysticky_welcomebar_lead_input']) && $welcomebar['mysticky_welcomebar_lead_input'] == 'phone') ? 'flex' : 'none';?>"/>

					</div>

					<div class="mysticky-welcomebar-btn  mysticky-welcomebar-hover-effect-<?php  if ($welcomebar['mysticky_welcomebar_hover_effect'] == 'fill_effect_button'){echo esc_attr($welcomebar['mysticky_welcomebar_hover_fill_effect']); }elseif($welcomebar['mysticky_welcomebar_hover_effect'] == 'border_effect_button'){echo esc_attr($welcomebar['mysticky_welcomebar_hover_border_effect']);}else{echo "none";}?>">
						<?php 
							$mysticky_welcomebar_btn_text =  isset($welcomebar['mysticky_welcomebar_btn_text']) ? stripslashes($welcomebar['mysticky_welcomebar_btn_text']) : "Got it!";
						?>
								
						<a href="javascript:void(0)"><?php echo stripslashes($mysticky_welcomebar_btn_text);?></a>
					</div>
					<?php 
						$x_color = (isset($welcomebar['mysticky_welcomebar_x_color'])) ? esc_attr($welcomebar['mysticky_welcomebar_x_color']) : '#000000';
					?>
					<span class="mysticky-welcomebar-close" style="color:<?php echo esc_attr($x_color);?>" tabindex="0" role="button" aria-label="close">X</span>
				</div>
			</div>
		</div>
		<div class="timer-message" <?php if(isset($welcomebar['mysticky_welcomebar_enable_lead']) && $welcomebar['mysticky_welcomebar_enable_lead'] != 1):?> style="display:none;"<?php endif;?>>
			<p><span class="dashicons dashicons-info"></span> The elements will be displayed in 1-line on your actual website. <a class="save_change" href="javascript:void(0);">Save changes</a> and <a href="<?php echo esc_url(site_url());?>" target="_blank" class="visit_site_link"><span class="dashicons dashicons-migrate" style="color: #2271b1 !important;"></span> visit your website</a> to check how it’d look like</p>
		</div>
		<div class="mysticky-welcomebar-full-screen">
			<button type="button" class="welcomebar-full-screen-btn">
				<?php esc_html_e( 'Show Fullscreen Preview', 'mystickymenu' );?>
				<span class="dashicons dashicons-fullscreen-alt"></span>
			</button>
			
			<button type="button" class="welcomebar-minimise-screen-btn" style="display:none;">
				<?php esc_html_e( 'Minimise Preview', 'mystickymenu' );?>
				<span class="dashicons dashicons-fullscreen-exit-alt"></span>
			</button>
		</div>
	</div>
	<script>
	jQuery(".mysticky-welcomebar-fixed").on(
		"animationend MSAnimationEnd webkitAnimationEnd oAnimationEnd",
		function() {
			jQuery(this).removeClass("animation-start");
		}
	);
	jQuery(document).ready(function() { 
		var container = jQuery(".mysticky-welcomebar-fixed");
        var refreshId = setInterval(function() {
            container.addClass("animation-start");
        }, 3500);
    });
	</script>
	<style id="button-hover-color">
		<?php if ( $welcomebar['mysticky_welcomebar_hover_effect'] != 'none' ) {?>  
		.mysticky-welcomebar-fixed .mysticky-welcomebar-btn a:hover {
			/*opacity: 0.7;*/
			<?php if ( $welcomebar['mysticky_welcomebar_hover_effect'] != 'none' ) : ?> color: <?php echo esc_attr($welcomebar['mysticky_welcomebar_btnhovertxtcolor']); ?>; <?php endif;?>
			<?php if ( $welcomebar['mysticky_welcomebar_hover_effect'] == 'border_effect_button' ) : ?> background: <?php echo esc_attr($welcomebar['mysticky_welcomebar_btnhovercolor']); ?>; <?php endif;?>
			
			-moz-box-shadow: 1px 2px 4px rgba(0, 0, 0,0.5);
			-webkit-box-shadow: 1px 2px 4px rgba(0, 0, 0, 0.5);
			box-shadow: 1px 2px 4px rgba(0, 0, 0, 0.5);
		}
		<?php } ?>
		<?php if ( $welcomebar['mysticky_welcomebar_hover_effect'] == 'border_effect_button' ) : ?>  
		.mysticky-welcomebar-btn:before,
		.mysticky-welcomebar-btn:after {
			background: <?php echo esc_attr($welcomebar['mysticky_welcomebar_btnhoverbordercolor']); ?>;
			z-index: 0;
		}
		.mysticky-welcomebar-btn a:before,
		.mysticky-welcomebar-btn a:after {
			background: <?php echo esc_attr($welcomebar['mysticky_welcomebar_btnhoverbordercolor']); ?>;
			z-index: 0;
		}
		<?php endif;?>
		<?php if ( $welcomebar['mysticky_welcomebar_hover_effect'] == 'fill_effect_button' ) : ?>  
		.mysticky-welcomebar-btn a:after {
			background: <?php echo esc_attr($welcomebar['mysticky_welcomebar_btnhovercolor']); ?>;
			z-index: -1;
			border-radius: 4px;
		}
		.mysticky-welcomebar-btn a:before,
		.mysticky-welcomebar-btn a:after {
			background: <?php echo esc_attr($welcomebar['mysticky_welcomebar_btnhovercolor']); ?>;
			z-index: -1;
		}
		<?php endif;?>
	</style>
	<style>
		.morphext > .morphext__animated {
		  display: inline-block;
		}
		.mysticky-welcomebar-fixed {
			background-color: <?php echo esc_attr($welcomebar['mysticky_welcomebar_bgcolor']); ?>;
			font-family: <?php echo esc_attr($welcomebar['mysticky_welcomebar_font']); ?>;
			position: absolute;
			left: 0;
			right: 0;
			opacity: 0;
			z-index: 9;
			-webkit-transition: all 1s ease 0s;
			-moz-transition: all 1s ease 0s;
			transition: all 1s ease 0s;
		}
		.mysticky-welcomebar-fixed-wrap {
			width: 98%;
			min-height: 60px;
			padding: 10px 29px 10px 20px;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.mysticky-welcomebar-preview-mobile-screen .mysticky-welcomebar-fixed{
			padding: 0 25px;
		}
		.mysticky-welcomebar-position-top {
			top:0;
		}
		.mysticky-welcomebar-position-bottom {
			bottom:0;
		}
		.mysticky-welcomebar-position-top.mysticky-welcomebar-entry-effect-slide-in {
			top: -80px;
		}
		.mysticky-welcomebar-position-bottom.mysticky-welcomebar-entry-effect-slide-in {
			bottom: -80px;
		}
		.mysticky-welcomebar-display-desktop.mysticky-welcomebar-position-top.mysticky-welcomebar-entry-effect-slide-in.entry-effect {
			top:0;
			opacity: 1;
		}
		.mysticky-welcomebar-display-desktop.mysticky-welcomebar-position-bottom.mysticky-welcomebar-entry-effect-slide-in.entry-effect {
			bottom:0;
			opacity: 1;
		}
		.mysticky-welcomebar-entry-effect-fade {
			opacity: 0;
		}
		.mysticky-welcomebar-display-desktop.mysticky-welcomebar-entry-effect-fade.entry-effect {
			opacity: 1;
		}
		.mysticky-welcomebar-entry-effect-none {
			display: none;
		}
		.mysticky-welcomebar-display-desktop.mysticky-welcomebar-entry-effect-none.entry-effect {
			display: block;
			opacity: 1;
		}	.mysticky-welcomebar-position-top.mysticky-welcomebar-entry-effect-slide-in.entry-effect.mysticky-welcomebar-fixed {
			top: 0;			
		}
		.mysticky-welcomebar-position-bottom.mysticky-welcomebar-entry-effect-slide-in.entry-effect.mysticky-welcomebar-fixed {
			bottom: 0;
		}		
		.mysticky-welcomebar-fixed .mysticky-welcomebar-content p a,
		.mysticky-welcomebar-fixed .mysticky-welcomebar-content p {
			color: <?php echo esc_attr($welcomebar['mysticky_welcomebar_bgtxtcolor']); ?>;
			font-size: <?php echo esc_attr($welcomebar['mysticky_welcomebar_fontsize']); ?>px;
			font-family: inherit;
			margin: 0;
			padding: 0;
			line-height: 1.2;
			font-weight: 400;
		}		
		.mysticky-welcomebar-fixed.mysticky-site-front.mysticky-welcomebar-btn-desktop .mysticky-welcomebar-btn {
			display: block;
			margin-left:5px;
		}
		.mysticky-welcomebar-fixed .mysticky-welcomebar-btn a {
			background-color: <?php echo esc_attr($welcomebar['mysticky_welcomebar_btncolor']); ?>;
			font-family: inherit;
			color: <?php echo esc_attr($welcomebar['mysticky_welcomebar_btntxtcolor']); ?>;
			border-radius: 4px;
			text-decoration: none;
			display: inline-block;
			vertical-align: top;
			line-height: 1.2;
			font-size: <?php echo esc_attr($welcomebar['mysticky_welcomebar_fontsize']) ?>px;
			font-weight: 400;
			padding: 5px 15px;
			white-space: nowrap;
			text-align: center;
		}
	

		@media only screen and (max-width: 1024px) {
			.mysticky-welcomebar-fixed {
				padding: 0 10px 0 10px;
			}
		}
		
		/* Animated Buttons */
		.mysticky-welcomebar-btn a {
			-webkit-animation-duration: 1s;
			animation-duration: 1s;
		}
		@-webkit-keyframes flash {
			from,
			50%,
			to {
				opacity: 1;
			}

			25%,
			75% {
				opacity: 0;
			}
		}
		@keyframes flash {
			from,
			50%,
			to {
				opacity: 1;
			}

			25%,
			75% {
				opacity: 0;
			}
		}
		.mysticky-welcomebar-attention-flash.animation-start .mysticky-welcomebar-btn a {
			-webkit-animation-name: flash;
			animation-name: flash;
		}
		
		@keyframes shake {
			from,
			to {
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}

			10%,
			30%,
			50%,
			70%,
			90% {
				-webkit-transform: translate3d(-10px, 0, 0);
				transform: translate3d(-10px, 0, 0);
			}

			20%,
			40%,
			60%,
			80% {
				-webkit-transform: translate3d(10px, 0, 0);
				transform: translate3d(10px, 0, 0);
			}
		}

		.mysticky-welcomebar-attention-shake.animation-start .mysticky-welcomebar-btn a {
			-webkit-animation-name: shake;
			animation-name: shake;
		}
		
		@-webkit-keyframes swing {
			20% {
				-webkit-transform: rotate3d(0, 0, 1, 15deg);
				transform: rotate3d(0, 0, 1, 15deg);
			}

			40% {
				-webkit-transform: rotate3d(0, 0, 1, -10deg);
				transform: rotate3d(0, 0, 1, -10deg);
			}

			60% {
				-webkit-transform: rotate3d(0, 0, 1, 5deg);
				transform: rotate3d(0, 0, 1, 5deg);
			}

			80% {
				-webkit-transform: rotate3d(0, 0, 1, -5deg);
				transform: rotate3d(0, 0, 1, -5deg);
			}
	
			to {
				-webkit-transform: rotate3d(0, 0, 1, 0deg);
				transform: rotate3d(0, 0, 1, 0deg);
			}
		}

		@keyframes swing {
			20% {
				-webkit-transform: rotate3d(0, 0, 1, 15deg);
				transform: rotate3d(0, 0, 1, 15deg);
			}

			40% {
				-webkit-transform: rotate3d(0, 0, 1, -10deg);
				transform: rotate3d(0, 0, 1, -10deg);
			}

			60% {
				-webkit-transform: rotate3d(0, 0, 1, 5deg);
				transform: rotate3d(0, 0, 1, 5deg);
			}

			80% {
				-webkit-transform: rotate3d(0, 0, 1, -5deg);
				transform: rotate3d(0, 0, 1, -5deg);
			}

			to {
				-webkit-transform: rotate3d(0, 0, 1, 0deg);
				transform: rotate3d(0, 0, 1, 0deg);
			}
		}

		.mysticky-welcomebar-attention-swing.animation-start .mysticky-welcomebar-btn a {
			-webkit-transform-origin: top center;
			transform-origin: top center;
			-webkit-animation-name: swing;
			animation-name: swing;
		}
		
		@-webkit-keyframes tada {
			from {
				-webkit-transform: scale3d(1, 1, 1);
				transform: scale3d(1, 1, 1);
			}

			10%,
			20% {
				-webkit-transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
				transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
			}

			30%,
			50%,
			70%,
			90% {
				-webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
				transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
			}

			40%,
			60%,
			80% {
				-webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
				transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
			}

			to {
				-webkit-transform: scale3d(1, 1, 1);
				transform: scale3d(1, 1, 1);
			}
		}

		@keyframes tada {
			from {
				-webkit-transform: scale3d(1, 1, 1);
				transform: scale3d(1, 1, 1);
			}

			10%,
			20% {
				-webkit-transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
				transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
			}

			30%,
			50%,
			70%,
			90% {
				-webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
				transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
			}

			40%,
			60%,
			80% {
				-webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
				transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
			}

			to {
				-webkit-transform: scale3d(1, 1, 1);
				transform: scale3d(1, 1, 1);
			}
		}

		.mysticky-welcomebar-attention-tada.animation-start .mysticky-welcomebar-btn a {
			-webkit-animation-name: tada;
			animation-name: tada;
		}
		
		@-webkit-keyframes heartBeat {
			0% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}

			14% {
				-webkit-transform: scale(1.3);
				transform: scale(1.3);
			}

			28% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}

			42% {
				-webkit-transform: scale(1.3);
				transform: scale(1.3);
			}

			70% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}
		}

		@keyframes heartBeat {
			0% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}

			14% {
				-webkit-transform: scale(1.3);
				transform: scale(1.3);
			}

			28% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}

			42% {
				-webkit-transform: scale(1.3);
				transform: scale(1.3);
			}

			70% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}
		}

		.mysticky-welcomebar-attention-heartbeat.animation-start .mysticky-welcomebar-btn a {
		  -webkit-animation-name: heartBeat;
		  animation-name: heartBeat;
		  -webkit-animation-duration: 1.3s;
		  animation-duration: 1.3s;
		  -webkit-animation-timing-function: ease-in-out;
		  animation-timing-function: ease-in-out;
		}
		
		@-webkit-keyframes wobble {
			from {
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}

			15% {
				-webkit-transform: translate3d(-25%, 0, 0) rotate3d(0, 0, 1, -5deg);
				transform: translate3d(-25%, 0, 0) rotate3d(0, 0, 1, -5deg);
			}

			30% {
				-webkit-transform: translate3d(20%, 0, 0) rotate3d(0, 0, 1, 3deg);
				transform: translate3d(20%, 0, 0) rotate3d(0, 0, 1, 3deg);
			}

			45% {
				-webkit-transform: translate3d(-15%, 0, 0) rotate3d(0, 0, 1, -3deg);
				transform: translate3d(-15%, 0, 0) rotate3d(0, 0, 1, -3deg);
			}

			60% {
				-webkit-transform: translate3d(10%, 0, 0) rotate3d(0, 0, 1, 2deg);
				transform: translate3d(10%, 0, 0) rotate3d(0, 0, 1, 2deg);
			}

			75% {
				-webkit-transform: translate3d(-5%, 0, 0) rotate3d(0, 0, 1, -1deg);
				transform: translate3d(-5%, 0, 0) rotate3d(0, 0, 1, -1deg);
			}

			to {
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}
		}

		@keyframes wobble {
			from {
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}

			15% {
				-webkit-transform: translate3d(-25%, 0, 0) rotate3d(0, 0, 1, -5deg);
				transform: translate3d(-25%, 0, 0) rotate3d(0, 0, 1, -5deg);
			}

			30% {
				-webkit-transform: translate3d(20%, 0, 0) rotate3d(0, 0, 1, 3deg);
				transform: translate3d(20%, 0, 0) rotate3d(0, 0, 1, 3deg);
			}

			45% {
				-webkit-transform: translate3d(-15%, 0, 0) rotate3d(0, 0, 1, -3deg);
				transform: translate3d(-15%, 0, 0) rotate3d(0, 0, 1, -3deg);
			}

			60% {
				-webkit-transform: translate3d(10%, 0, 0) rotate3d(0, 0, 1, 2deg);
				transform: translate3d(10%, 0, 0) rotate3d(0, 0, 1, 2deg);
			}

			75% {
				-webkit-transform: translate3d(-5%, 0, 0) rotate3d(0, 0, 1, -1deg);
				transform: translate3d(-5%, 0, 0) rotate3d(0, 0, 1, -1deg);
			}

			to {
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}
		}
		
		.mysticky-welcomebar-attention-wobble.animation-start .mysticky-welcomebar-btn a {
			-webkit-animation-name: wobble;
			animation-name: wobble;
		}
	</style>
</div>