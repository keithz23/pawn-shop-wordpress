jQuery(document).ready(function($){	
	
	var adminBarHeight = 0;
	if ( $("#wpadminbar").length != 0 ){
		var adminBarHeight = $('#wpadminbar').height();
	}
	var mysticky_welcomebar_height = adminBarHeight + jQuery( '.mysticky-welcomebar-fixed' ).outerHeight();
	if( jQuery( '.mysticky-welcomebar-fixed' ).data('position') == 'top' ) {
		jQuery( '.mysticky-welcomebar-entry-effect-slide-in.mysticky-welcomebar-fixed' ).css( 'top', '-' + mysticky_welcomebar_height + 'px' );
	} else {
		jQuery( '.mysticky-welcomebar-entry-effect-slide-in.mysticky-welcomebar-fixed' ).css( 'bottom', '-' + mysticky_welcomebar_height + 'px' );
	}
	var divi_topbar_height = $( '.et_fixed_nav #top-header' ).outerHeight();
	var divi_total_height = mysticky_welcomebar_height + divi_topbar_height;
	var welcombar_aftersubmission = $( '.mysticky-welcomebar-fixed' ).data('aftersubmission');
	if( welcombar_aftersubmission == 'dont_show_welcomebar' ){
		var welcomebar_storage = localStorage.getItem("welcomebar_close");
	} else if( welcombar_aftersubmission == 'show_welcomebar_next_visit' ) {
		var welcomebar_storage = sessionStorage.getItem("welcomebar_close");
	} else {
		sessionStorage.removeItem('welcomebar_close');
		localStorage.removeItem('welcomebar_close');
		var welcomebar_storage = null;
	}
	if ( welcomebar_storage === null ){

		var after_trigger = jQuery( '.mysticky-welcomebar-fixed' ).data('after-triger');
		
		jQuery( 'body' ).addClass( 'mysticky-welcomebar-apper' );

		if ( after_trigger == 'after_a_few_seconds' ) {
			
			if ( $( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-display-desktop' ) ) {
				if ( $( window ).width() > 767 ) {
					var trigger_sec = jQuery( '.mysticky-welcomebar-fixed' ).data('triger-sec') * 1000;
					var welcombar_position = $( '.mysticky-welcomebar-fixed' ).data('position');
					var welcombar_height = $( '.mysticky-welcomebar-fixed' ).outerHeight();
					
					setTimeout(function(){
						jQuery( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-animation' );
						$( '.mysticky-welcomebar-fixed' ).addClass( 'entry-effect' );
						if ( welcombar_position == 'top' ) {								
							
							jQuery( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-animation' );
							jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', (adminBarHeight + 0) + 'px' );
							jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
							$( 'html' ).css( 'margin-bottom', '' );
							jQuery( '#mysticky_divi_style' ).remove();
							jQuery( '.et_fixed_nav #top-header' ).css( 'top', welcombar_height + 'px' );
							jQuery( 'head' ).append( '<style id="mysticky_divi_style" type="text/css">.et_fixed_nav #main-header {top: ' + welcombar_height + 'px !important}.et_fixed_nav #top-header + #main-header{top: ' + divi_total_height + 'px !important}</style>' );
							//$( 'html' ).attr( 'style', 'margin-top: ' + mysticky_welcomebar_height + 'px !important' );
							$("html").animate({ "margin-top": mysticky_welcomebar_height + "px" }, 1000, function() {	
								$("html").css("cssText", "margin-top:" + mysticky_welcomebar_height + "px!important;");
							});
							$( '#mysticky-nav' ).css( 'top', mysticky_welcomebar_height + 'px' );
						} else {
							jQuery( '.mysticky-welcomebar-fixed' ).css( 'bottom', '0' );
							jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
							$( 'html' ).css( 'margin-top', '' );
							jQuery( '#mysticky_divi_style' ).remove();
							jQuery( '.et_fixed_nav #top-header' ).css( 'top', '' );
							$( 'html' ).attr( 'style', 'margin-bottom: ' + mysticky_welcomebar_height + 'px !important' );
						}
					}, trigger_sec );
				}
			}
		}
		if ( $( window ).width() < 767 ) {
			if ( after_trigger == 'after_a_few_seconds' ) {
				if ( $( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-display-mobile' ) ) {
					var trigger_sec = jQuery( '.mysticky-welcomebar-fixed' ).data('triger-sec') * 1000;
					var welcombar_position = $( '.mysticky-welcomebar-fixed' ).data('position');
					var welcombar_height = $( '.mysticky-welcomebar-fixed' ).outerHeight();
					setTimeout(function(){
						jQuery( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-animation' );
						$( '.mysticky-welcomebar-fixed' ).addClass( 'entry-effect' );
						jQuery( '#mysticky_divi_style' ).remove();
						jQuery( '.et_fixed_nav #top-header' ).css( 'top', '' );							
						if ( welcombar_position == 'top' ) {
							jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', ( adminBarHeight + 0) + 'px' );
							jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
							$( 'html' ).css( 'margin-bottom', '' );
							//$( 'html' ).attr( 'style', 'margin-top: ' + mysticky_welcomebar_height + 'px !important' );
							$("html").animate({ "margin-top": mysticky_welcomebar_height + "px" }, 1000, function() {	
								$("html").css("cssText", "margin-top:" + mysticky_welcomebar_height + "px!important;");
							});
							$( '#mysticky-nav' ).css( 'top', mysticky_welcomebar_height + 'px' );
						} else {
							jQuery( '.mysticky-welcomebar-fixed' ).css( 'bottom', '0' );
							jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
							$( 'html' ).css( 'margin-top', '' );
							$( 'html' ).attr( 'style', 'margin-bottom: ' + mysticky_welcomebar_height + 'px !important' );
						}
					}, trigger_sec );
				}
			}
		}
		mystickyelements_present();
	}
	$( window ).resize( function(){		
	
		var mysticky_welcomebar_height = jQuery( '.mysticky-welcomebar-fixed' ).outerHeight();
		if( welcombar_aftersubmission == 'dont_show_welcomebar' ){
			var welcomebar_storage = localStorage.getItem("welcomebar_close");
		} else if( welcombar_aftersubmission == 'show_welcomebar_next_visit' ) {
			var welcomebar_storage = sessionStorage.getItem("welcomebar_close");
		} else {
			sessionStorage.removeItem('welcomebar_close');
			localStorage.removeItem('welcomebar_close');
			var welcomebar_storage = null;
		}
		if ( welcomebar_storage === null ){
			var after_trigger = jQuery( '.mysticky-welcomebar-fixed' ).data('after-triger');
			if ( ! $( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-notapper' ) ) {
				jQuery( 'body' ).addClass( 'mysticky-welcomebar-apper' );
			} else {
				jQuery( 'body' ).removeClass( 'mysticky-welcomebar-apper' );
			}
			if ( after_trigger == 'after_a_few_seconds' ) {
				var trigger_sec = jQuery( '.mysticky-welcomebar-fixed' ).data('triger-sec') * 1000;
				var welcombar_position = $( '.mysticky-welcomebar-fixed' ).data('position');
				var welcombar_height = $( '.mysticky-welcomebar-fixed' ).outerHeight();
				if ( $( window ).width() < 767 ) {
					if ( $( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-display-mobile' ) ) {
						setTimeout(function(){
							jQuery( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-animation' );
							$( '.mysticky-welcomebar-fixed' ).addClass( 'entry-effect' );
							jQuery( '#mysticky_divi_style' ).remove();
							jQuery( '.et_fixed_nav #top-header' ).css( 'top', '' );
							if ( welcombar_position == 'top' ) {
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', ( adminBarHeight +  0) + 'px' );
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
								$( 'html' ).css( 'margin-bottom', '' );
								//$( 'html' ).attr( 'style', 'margin-top: ' + mysticky_welcomebar_height + 'px !important' );
								$("html").animate({ "margin-top": mysticky_welcomebar_height + "px" }, 1000, function() {	
									$("html").css("cssText", "margin-top:" + mysticky_welcomebar_height + "px!important;");
								});
								$( '.mysticky-welcomebar-apper #mysticky-nav' ).css( 'top', mysticky_welcomebar_height + 'px' );
							} else {
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'bottom', '0' );
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
								$( 'html' ).css( 'margin-top', '' );
								$( 'html' ).attr( 'style', 'margin-bottom: ' + mysticky_welcomebar_height + 'px !important' );
							}
						}, trigger_sec );
					}
				} else {
					if ( $( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-display-desktop' ) ) {
						setTimeout(function(){
							jQuery( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-animation' );
							$( '.mysticky-welcomebar-fixed' ).addClass( 'entry-effect' );
							if ( welcombar_position == 'top' ) {
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', ( adminBarHeight + 0) + 'px' );
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
								$( 'html' ).css( 'margin-bottom', '' );
								jQuery( '#mysticky_divi_style' ).remove();
								jQuery( '.mysticky-welcomebar-apper.et_fixed_nav #top-header' ).css( 'top', welcombar_height + 'px' );
								jQuery( 'head' ).append( '<style id="mysticky_divi_style" type="text/css">.mysticky-welcomebar-apper.et_fixed_nav #main-header {top: ' + welcombar_height + 'px !important}.mysticky-welcomebar-apper.et_fixed_nav #top-header + #main-header{top: ' + divi_total_height + 'px !important}</style>' );
								//$( 'html' ).attr( 'style', 'margin-top: ' + mysticky_welcomebar_height + 'px !important' );
								$("html").animate({ "margin-top": mysticky_welcomebar_height + "px" }, 1000, function() {	
									$("html").css("cssText", "margin-top:" + mysticky_welcomebar_height + "px!important;");
								});
								$( '.mysticky-welcomebar-apper #mysticky-nav' ).css( 'top', mysticky_welcomebar_height + 'px' );
							} else {
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'bottom', '0' );
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
								$( 'html' ).css( 'margin-top', '' );
								jQuery( '#mysticky_divi_style' ).remove();
								jQuery( '.et_fixed_nav #top-header' ).css( 'top', '' );
								$( 'html' ).attr( 'style', 'margin-bottom: ' + mysticky_welcomebar_height + 'px !important' );
							}
						}, trigger_sec );
					}
				}
			}
			mystickyelements_present();
		}
	} );

	jQuery(window).on( 'scroll', function(){			
		if( welcombar_aftersubmission == 'dont_show_welcomebar' ){
			var welcomebar_storage = localStorage.getItem("welcomebar_close");
		} else if( welcombar_aftersubmission == 'show_welcomebar_next_visit' ) {
			var welcomebar_storage = sessionStorage.getItem("welcomebar_close");
		} else {
			sessionStorage.removeItem('welcomebar_close');
			localStorage.removeItem('welcomebar_close');
			var welcomebar_storage = null;
		}
		if ( welcomebar_storage === null ){
			var welcombar_height = $( '.mysticky-welcomebar-fixed' ).outerHeight();
			var welcombar_position = $( '.mysticky-welcomebar-fixed' ).data('position');
			if ( welcombar_position == 'top' ) {
				$( '#mysticky-nav' ).css( 'top', mysticky_welcomebar_height + 'px' );
			}
			if ( after_trigger === 'after_scroll' ) {
				var scroll = 100 * $(window).scrollTop() / ($(document).height() - $(window).height());
				var after_scroll_val = jQuery( '.mysticky-welcomebar-fixed' ).data('triger-sec');
				var welcombar_position = $( '.mysticky-welcomebar-fixed' ).data('position');
				var welcombar_height = $( '.mysticky-welcomebar-fixed' ).outerHeight();
				if( scroll > after_scroll_val ) {
					if ( $( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-display-desktop' ) ) {
						if ( $( window ).width() > 767 ) {
							jQuery( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-animation' );
							$( '.mysticky-welcomebar-fixed' ).addClass( 'entry-effect' );
							if ( welcombar_position == 'top' ) {
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', (adminBarHeight+ 0 ) + 'px' );
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
								$( 'html' ).css( 'margin-bottom', '' );
								//$( 'html' ).attr( 'style', 'margin-top: ' + mysticky_welcomebar_height + 'px !important' );
								$("html").animate({ "margin-top": mysticky_welcomebar_height + "px" }, 1000, function() {	
									$("html").css("cssText", "margin-top:" + mysticky_welcomebar_height + "px!important;");
								});
								$( '#mysticky-nav' ).css( 'top', mysticky_welcomebar_height + 'px' );
							} else {
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'bottom', '0' );
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
								$( 'html' ).css( 'margin-top', '' );
								$( 'html' ).attr( 'style', 'margin-bottom: ' + mysticky_welcomebar_height + 'px !important' );
							}
						}
					}
					if ( $( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-display-mobile' ) ) {
						if ( $( window ).width() < 767 ) {
							jQuery( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-animation' );
							$( '.mysticky-welcomebar-fixed' ).addClass( 'entry-effect' );
							if ( welcombar_position == 'top' ) {
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', ( adminBarHeight +0 ) + 'px' );
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
								$( 'html' ).css( 'margin-bottom', '' );
								//$( 'html' ).attr( 'style', 'margin-top: ' + mysticky_welcomebar_height + 'px !important' );
								$("html").animate({ "margin-top": mysticky_welcomebar_height + "px" }, 1000, function() {	
									$("html").css("cssText", "margin-top:" + mysticky_welcomebar_height + "px!important;");
								});
								$( '#mysticky-nav' ).css( 'top', mysticky_welcomebar_height + 'px' );
							} else {
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'bottom', '0' );
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
								$( 'html' ).css( 'margin-top', '' );
								$( 'html' ).attr( 'style', 'margin-bottom: ' + mysticky_welcomebar_height + 'px !important' );
							}
						}
					}
				}
			}
			mystickyelements_present();
		}

	});
	
	jQuery( '.mysticky-welcomebar-close, .mysticky-welcomebar-btn a' ).on( 'click', function(e){
		if ($(this).attr('href') == '') {
			e.preventDefault();
		}
		/* Submit contact lead form */
		var flag				= true;
		var trigger_sec 		= 100;
		var welcomebar_widget 	= 0;	
		if( jQuery(".mysticky-welcomebar-lead-content").length > 0 && !$(this).hasClass("mysticky-welcomebar-close")){

			if( jQuery('#contact-lead-name-'+welcomebar_widget).val() != '' && ( jQuery('#contact-lead-phone-'+welcomebar_widget).val() != '' || jQuery('#contact-lead-email-'+welcomebar_widget).val() != '' )){

				if( jQuery('#contact-lead-email-'+welcomebar_widget).css("display") != 'none' &&  IsEmail(jQuery('#contact-lead-email-'+welcomebar_widget).val()) != true ){
					
					if( $(".input-error").length ){
						$(".input-error").remove();
					}

					$( '<div class="input-error"><span>Please, enter valid email</span></div>' ).insertAfter( jQuery('#contact-lead-email-' + welcomebar_widget) );
					flag = false;
				}	


				if( jQuery('#contact-lead-phone-'+welcomebar_widget).css("display") != 'none' &&  validatePhone(jQuery('#contact-lead-phone-'+welcomebar_widget).val()) != true  ){
					if( $(".input-error").length ){
						$(".input-error").remove();
					}
					$( '<div class="input-error"><span>Please, enter valid phone</span></div>' ).insertAfter( jQuery('#contact-lead-phone-'+welcomebar_widget) );
					flag=false;
				}	
				
				if (flag == true) {
					var data = [];
					data["contact_name"] = jQuery('#contact-lead-name-'+welcomebar_widget).val();
					data["contact_email"] = jQuery('#contact-lead-email-'+welcomebar_widget).val();
					data["contact_phone"] = jQuery('#contact-lead-phone-'+welcomebar_widget).val();
					data["contact_page_link"] = jQuery('#contact-lead-pagelink-'+welcomebar_widget).val();
					
					
					var sucess_message = $( '.mysticky-welcomebar-fixed' ).data('show-success-message');
					if ( sucess_message == 1) {
						$(".mysticky-welcomebar-fixed .mysticky-welcomebar-lead-content").hide();
						$(".mysticky-welcomebar-fixed .mysticky-welcomebar-content p").hide();
						$(".mysticky-welcomebar-fixed .mysticky-welcomebar-btn.contact-lead-button").hide();
						$(".mysticky-welcomebar-fixed .mysticky-welcomebar-thankyou-content").show();
						$(".mysticky-welcomebar-fixed .mysticky-welcomebar-thankyou-content p").show();
					}
					var trigger_sec = 2000;
					jQuery.ajax({
						url: welcomebar_frontjs.ajaxurl,
						type:'post',
						data: 'contact_name='+data["contact_name"]+'&contact_email='+data["contact_email"]+'&contact_phone='+data["contact_phone"]+'&action=stickymenu_contact_lead_form&widget_id=' + welcomebar_widget  + '&page_link='+ data["contact_page_link"]+'&save_form_lead=1&wpnonce=' + welcomebar_frontjs.ajax_nonce,
						success: function( data ){					
							$(".mysticky-welcomebar-widget-"+welcomebar_widget+" .mysticky-welcomebar-fixed-wrap").css("margin-bottom","0");							
							jQuery('#contact-lead-name-'+welcomebar_widget).val('');
							jQuery('#contact-lead-email-'+welcomebar_widget).val('');
							jQuery('#contact-lead-phone-'+welcomebar_widget).val('');
							
						},
					});
				}else{
					$(".mysticky-welcomebar-widget-"+welcomebar_widget+" .mysticky-welcomebar-fixed-wrap").css("margin-bottom","10px");
					return false;
				}

				
			}else{
				localStorage.removeItem('welcomebar_close_' + welcomebar_widget);
				sessionStorage.removeItem('welcomebar_close_' + welcomebar_widget);
				
				if($(".input-error").length){
					$(".input-error").remove();
				}

				if( jQuery('#contact-lead-name-'+welcomebar_widget).css("display") != 'none' && jQuery('#contact-lead-name-'+welcomebar_widget).val() == '' && jQuery('#contact-lead-email-'+welcomebar_widget).css("display") != 'none' &&  jQuery('#contact-lead-email-'+welcomebar_widget).val() == '' ){

					$( '<div class="input-error"><span>Please enter your name and email</span></div>' ).insertAfter( jQuery('#contact-lead-name-'+welcomebar_widget) );
					flag=false;

				}else if( jQuery('#contact-lead-name-'+welcomebar_widget).css("display") != 'none' && jQuery('#contact-lead-name-'+welcomebar_widget).val() == '' && jQuery('#contact-lead-phone-'+welcomebar_widget).css("display") != 'none' && jQuery('#contact-lead-phone-'+welcomebar_widget).val() == '' ){

					$( '<div class="input-error"><span>Please enter your name and phone</span></div>' ).insertAfter( jQuery('#contact-lead-name-'+welcomebar_widget) );
					flag=false;

				}else if( jQuery('#contact-lead-name-'+welcomebar_widget).css("display") != 'none' && jQuery('#contact-lead-name-'+welcomebar_widget).val() == '' ){

					$( '<div class="input-error"><span>Please enter your name</span></div>' ).insertAfter( jQuery('#contact-lead-name-'+welcomebar_widget) );
					flag=false;

				}else if( jQuery('#contact-lead-email-'+welcomebar_widget).css("display") != 'none' &&  jQuery('#contact-lead-email-'+welcomebar_widget).val() == '' ){

					$( '<div class="input-error"><span>Please, enter your email</span></div>' ).insertAfter( jQuery('#contact-lead-email-'+welcomebar_widget) );
					flag=false;

				}else if( jQuery('#contact-lead-phone-'+welcomebar_widget).css("display") != 'none' && jQuery('#contact-lead-phone-'+welcomebar_widget).val() == '' ){

					$( '<div class="input-error"><span>Please, enter your phone</span></div>' ).insertAfter( jQuery('#contact-lead-phone-'+welcomebar_widget) );
					flag=false;

				}

				if(flag==false){
					
					$(".mysticky-welcomebar-widget-"+welcomebar_widget+" .mysticky-welcomebar-fixed-wrap").css("margin-bottom","10px");
				} else{
					$(".mysticky-welcomebar-widget-"+welcomebar_widget+" .mysticky-welcomebar-fixed-wrap").css("margin-bottom","0");
				}
				return false;
			}
		}else{
			if( $(this).hasClass("mysticky-welcomebar-close") ){
				localStorage.setItem('is_close_trigger_' + welcomebar_widget, 'yes');
			}
		}
		
		setTimeout(function(){
			if( welcombar_aftersubmission != 'show_welcomebar_every_page' ){
				if( welcombar_aftersubmission == 'dont_show_welcomebar' ){
					sessionStorage.removeItem('welcomebar_close');
					localStorage.setItem('welcomebar_close', 'close');
				} else if( welcombar_aftersubmission == 'show_welcomebar_next_visit' ) {
					localStorage.removeItem('welcomebar_close');
					sessionStorage.setItem('welcomebar_close', 'close');
				}
			}
			var welcombar_position = $( '.mysticky-welcomebar-fixed' ).data('position');
			var welcombar_height = $( '.mysticky-welcomebar-fixed' ).outerHeight();
			jQuery( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-notapper' );
			jQuery( 'body' ).removeClass( 'mysticky-welcomebar-apper' );
			jQuery( '.mysticky-welcomebar-fixed' ).slideUp( 'slow' );
			if ( welcombar_position == 'top' ) {
				jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', '-' + mysticky_welcomebar_height + 'px' );
			} else {
				jQuery( '.mysticky-welcomebar-fixed' ).css( 'bottom', '-' + mysticky_welcomebar_height + 'px' );
			}
			jQuery( '#mysticky_divi_style' ).remove();
			jQuery( '.et_fixed_nav #top-header' ).css( 'top', '' );
			jQuery( 'html' ).css( 'margin-top', '' );
			jQuery( 'html' ).css( 'margin-bottom', '' );
			$( '#mysticky-nav' ).css( 'top', '0px' );
			/*if mystickyelements show*/
			var mystickyelements_show = $( '.mystickyelements-fixed' ).length;
			if( mystickyelements_show && $( window ).width() <= 1024 && $( '.mystickyelements-fixed' ).hasClass( 'mystickyelements-position-mobile-top' ) && welcombar_position == 'top' ) {
				var mystickyelements_height = $( '.mystickyelements-fixed' ).height();
				$( '.mystickyelements-fixed' ).css( 'top', '' );
				//$( 'html' ).attr( 'style', 'margin-top: ' + mystickyelements_height + 'px !important' );
				$("html").animate({ "margin-top": mystickyelements_height + "px" }, 1000, function() {	
					$("html").css("cssText", "margin-top:" + mystickyelements_height + "px!important;");
				});
			}
			
		}, trigger_sec );
		jQuery('#contact-lead-name-'+welcomebar_widget).val('');
		jQuery('#contact-lead-email-'+welcomebar_widget).val('');
		jQuery('#contact-lead-phone-'+welcomebar_widget).val('');
	} );
	
	// JS snippet to allow close button to work with keyboard.
	$('.mysticky-welcomebar-close').on('keydown', function(e) {
		if(e.keyCode == '13'){
			$(this).trigger('click');
		}
	});
});
function mystickyelements_present() {
	var after_trigger 		  = jQuery( '.mysticky-welcomebar-fixed' ).data('after-triger');
	var mystickyelements_show = jQuery( '.mystickyelements-fixed' ).length;		
	var welcombar_position 			  = jQuery( '.mysticky-welcomebar-fixed' ).data('position');
	var adminBarHeight = 0;
	if ( jQuery("#wpadminbar").length != 0 ){
		var adminBarHeight = jQuery('#wpadminbar').height();
	}
	
	if ( jQuery( window ).width() <= 600 && jQuery(window).scrollTop() != 0 && welcombar_position == 'top') {
		jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', '0px' );
		var welcombar_height = jQuery( '.mysticky-welcomebar-fixed' ).outerHeight();
		
		if (jQuery( '.mysticky-welcomebar-fixed' ).css('display') === 'none') {
			welcombar_height= 0;
		}			
		jQuery( '#mysticky-nav' ).css( 'top', welcombar_height + 'px' );
		
	} else if ( welcombar_position == 'top' ) {
		var mysticky_welcomebar_height = adminBarHeight + jQuery( '.mysticky-welcomebar-fixed' ).outerHeight();
		if (jQuery( '.mysticky-welcomebar-fixed' ).css('display') === 'none') {
			mysticky_welcomebar_height= adminBarHeight + 0;
		}	
		jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', ( adminBarHeight + 0) + 'px' );			
		jQuery( '#mysticky-nav' ).css( 'top', mysticky_welcomebar_height + 'px' );
	}
	if( mystickyelements_show ) {
		
		var welcombar_height 			  = jQuery( '.mysticky-welcomebar-fixed' ).outerHeight();
		var mystickyelements_height 	  = jQuery( '.mystickyelements-fixed' ).height();
		var mystickyelements_total_height = welcombar_height + mystickyelements_height;
		if ( jQuery( window ).width() <= 1024 && jQuery( '.mystickyelements-fixed' ).hasClass( 'mystickyelements-position-mobile-top' ) ) {
			if ( after_trigger == 'after_a_few_seconds' ) {
				if ( jQuery( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-display-mobile' ) ) {
					var trigger_sec = jQuery( '.mysticky-welcomebar-fixed' ).data('triger-sec') * 1000;
					setTimeout(function(){
						if ( welcombar_position == 'top' ) {
							jQuery( '.mystickyelements-fixed' ).css( 'top', welcombar_height );
							//jQuery( 'html' ).attr( 'style', 'margin-top: ' + mystickyelements_total_height + 'px !important' );
							$("html").animate({ "margin-top": mystickyelements_total_height + "px" }, 1000, function() {	
								$("html").css("cssText", "margin-top:" + mystickyelements_total_height + "px!important;");
							});
						} else {
							jQuery( '.mystickyelements-fixed' ).css( 'top', '' );
							jQuery( 'html' ).attr( 'style', 'margin-bottom: ' + welcombar_height + 'px !important' );
						}
					}, trigger_sec );
				}
			} else if ( after_trigger === 'after_scroll' ) {
				var scroll = 100 * $(window).scrollTop() / ($(document).height() - $(window).height());
				var after_scroll_val = $( '.mysticky-welcomebar-fixed' ).data('triger-sec');
				if( scroll > after_scroll_val ) {
					if ( jQuery( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-display-mobile' ) ) {
						if ( welcombar_position == 'top' ) {
							jQuery( '.mystickyelements-fixed' ).css( 'top', welcombar_height );
							//jQuery( 'html' ).attr( 'style', 'margin-top: ' + mystickyelements_total_height + 'px !important' );
							$("html").animate({ "margin-top": mystickyelements_total_height + "px" }, 1000, function() {	
								$("html").css("cssText", "margin-top:" + mystickyelements_total_height + "px!important;");
							});
						} else {
							jQuery( '.mystickyelements-fixed' ).css( 'top', '' );
							jQuery( 'html' ).attr( 'style', 'margin-bottom: ' + welcombar_height + 'px !important' );
						}
					}
				}
			}
		}
	}
}
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

function IsEmail(email) {
	var regex =
/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!regex.test(email)) {
		return false;
	}
	else {
		return true;
	}
}

function validatePhone(txtPhone) {
	var a = txtPhone;
	var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
	if (filter.test(a)) {
		return true;
	}
	else {
		return false;
	}
}