(function( $ ) {
	"use strict";

	jQuery(document).ready(function($){
		var handle = $( "#custom-handle" );
		$( "#slider" ).slider({
		  create: function() {
			handle.text( $( this ).slider( "value" ) );
			handle.text( $('#myfixed_opacity').val() );
			handle.css('left', $('#myfixed_opacity').val() + '%')
		  },
		  slide: function( event, ui ) {
			$('#myfixed_opacity').val(ui.value);
			handle.text( ui.value );
		  }
		});
		jQuery(
		  '<div class="pt_number"><div class="pt_numberbutton pt_numberup">+</div><div class="pt_numberbutton pt_numberdown">-</div></div>'
		).insertAfter("input.mysticky-number1");

		jQuery(".mystickynumber1").each(function() {

			var spinner = jQuery(this),
			input = spinner.find('input[type="number"]'),
			btnUp = spinner.find(".pt_numberup"),
			btnDown = spinner.find(".pt_numberdown"),
			min = input.attr("min"),
			max = input.attr("max"),
			valOfAmout = input.val(),
			newVal = 0;

			btnUp.on("click", function() {

				var oldValue = parseFloat(input.val());

				if (oldValue >= max) {
				  var newVal = oldValue;
				} else {
				  var newVal = oldValue + 1;
				}
				spinner.find("input").val(newVal);
				spinner.find("input").trigger("change");
			});
			btnDown.on("click", function() {
				var oldValue = parseFloat(input.val());
				if (oldValue <= min) {
				var newVal = oldValue;
				} else {
				var newVal = oldValue - 1;
				}
				spinner.find("input").val(newVal);
				spinner.find("input").trigger("change");
			});
		});


		$(".confirm").on( 'click', function() {
			return window.confirm("Reset to default settings?");
		});

		var flag = 0;
		$( "#mystickymenu-select option" ).each(function( i ) {

			if ($('select#mystickymenu-select option:selected').val() !== '' ) {
				flag = 1;
			}
			if( $('select#mystickymenu-select option:selected').val() == $(this).val() ){
				$('#mysticky_class_selector').show();
			}else {
				$('#mysticky_class_selector').hide();
			}
		});
		if ( flag === 0 ) {
			$('#mysticky_class_selector').show();
			$("select#mystickymenu-select option[value=custom]").attr('selected', 'selected');
		}

		$("#mystickymenu-select").on( 'change', function() {
			if ($(this).val() == 'custom' ) {
				$('#mysticky_class_selector').show();
			}else {
				$('#mysticky_class_selector').hide();
			}

		});
		/*02-08-2019 welcom bar js*/
		
		var bar_action_previous;
		$( '.mysticky-welcomebar-action' ).on('focus', function () {
			// Store the current value on focus and on change
			bar_action_previous = this.value;
		}).change(function() {
			var mysticky_welcomebar_action = $( this ).val();
			
			if ( mysticky_welcomebar_action == 'redirect_to_url' ) {
				$( '.mysticky-welcomebar-redirect' ).show();
				$( '.mysticky-welcomebar-redirect-container' ).show();
			} else {
				$( '.mysticky-welcomebar-redirect' ).hide();
				$( '.mysticky-welcomebar-redirect-container' ).hide();
			}
			if ( mysticky_welcomebar_action == 'poptin_popup' ) {
				$( '.mysticky-welcomebar-poptin-popup' ).show();
			} else {
				$( '.mysticky-welcomebar-poptin-popup' ).hide();
			}
			if ( $('.mysticky-welcomebar-action option:selected').attr('data-href') !== '' && mysticky_welcomebar_action == 'thankyou_screen' ) {
				window.open( $( '.mysticky-welcomebar-action option:selected' ).attr('data-href') , '_blank');
				$('.mysticky-welcomebar-action').val( bar_action_previous ).change();
				console.log(bar_action_previous);
			}
			bar_action_previous = this.value;
			
		});
		
		var page_option_content = "";
	    page_option_content = $( '.mysticky-welcomebar-page-options-html' ).html();
	    $( '.mysticky-welcomebar-page-options-html' ).remove();

	    $( '#create-rule' ).on( 'click', function(){
	        var append_html = page_option_content.replace(/__count__/g, '1', page_option_content);
	        $( '.mysticky-welcomebar-page-options' ).append( append_html );
			$( '.mysticky-welcomebar-page-options' ).show();
			$( this ).parent().remove();
	    });
		$( document ).on( 'click', '#add-date-schedule-option' ,function(){
			$( '#mysticky-welcomebar-date-schedule-options').show();
		});	    
		
		/*Mysticky page target*/
		var mysticky_total_page_option = 0;
		var mysticky_page_option_content = "";
		mysticky_total_page_option = $( '.mysticky-page-option' ).length;
	    mysticky_page_option_content = $( '.mysticky-page-options-html' ).html();
	    $( '.mysticky-page-options-html' ).remove();

	    $( '#mysticky_create-rule' ).on( 'click', function(){

	        var append_html = mysticky_page_option_content.replace(/__count__/g, mysticky_total_page_option, mysticky_page_option_content);
	        mysticky_total_page_option++;
	        $( '.mysticky-page-options' ).append( append_html );
	        $( '.mysticky-page-options .mysticky-page-option' ).removeClass( 'last' );
	        $( '.mysticky-page-options .mysticky-page-option:last' ).addClass( 'last' );

			if( $( '.mysticky-page-option .myStickymenu-upgrade' ).length > 0 ) {
				$( this ).remove();
			}
	    });
	    $( document ).on( 'click', '.mysticky-remove-rule', function() {
	       $( this ).closest( '.mysticky-page-option' ).remove();
	        $( '.mysticky-page-options .mysticky-page-option' ).removeClass( 'last' );
	        $( '.mysticky-page-options .mysticky-page-option:last' ).addClass( 'last' );
	    });
		$( document ).on( 'change', '.mysticky-url-options', function() {
			var current_val = jQuery( this ).val();
			var mysticky_welcomebar_siteURL = jQuery( '#mysticky_welcomebar_site_url' ).val();
			var mysticky_welcomebar_newURL  = mysticky_welcomebar_siteURL;
			if( current_val == 'page_has_url' ) {
				mysticky_welcomebar_newURL = mysticky_welcomebar_siteURL;
			} else if( current_val == 'page_contains' ) {
				mysticky_welcomebar_newURL = mysticky_welcomebar_siteURL + '%s%';
			} else if( current_val == 'page_start_with' ) {
				mysticky_welcomebar_newURL = mysticky_welcomebar_siteURL + 's%';
			} else if( current_val == 'page_end_with' ) {
				mysticky_welcomebar_newURL = mysticky_welcomebar_siteURL + '%s';
			}
			$( this ).closest( '.url-content' ).find( '.mysticky-welcomebar-url' ).text( mysticky_welcomebar_newURL );
		});
		/* welcome bar live preview */

		/* Apply Wp Color Picker */
		var myOptions = {
			clear: function (event) {
				var color_id 	= $(event.target).parents('.wp-picker-input-wrap').find('.wp-color-picker').attr('id');
				var color_code  = 'unset';
				if ( color_id === 'mysticky_welcomebar_bgcolor'){
					$('.mysticky-welcomebar-fixed').css('background-color', color_code );
				}
				if ( color_id === 'mysticky_welcomebar_bgtxtcolor'){
					$('.mysticky-welcomebar-fixed .mysticky-welcomebar-content p').css('color', color_code );
				}
				if ( color_id === 'mysticky_welcomebar_btncolor'){
					$('.mysticky-welcomebar-btn a').css('background-color', color_code );
				}
				if ( color_id === 'mysticky_welcomebar_btntxtcolor'){
					$('.mysticky-welcomebar-btn a').css('color', color_code );
				}
				if( color_id === 'mysticky_welcomebar_xcolor' ){
					$(".mysticky-welcomebar-close").css('color',color_code);
				}
				if (color_id === 'mysticky_welcomebar_btnhovertxtcolor') {
					if(selectedValue !="none"){
						$('.mysticky-welcomebar-preview-screen').find('style[data-text-color]').remove();
						$('.mysticky-welcomebar-preview-screen').append('<style  data-text-color>.mysticky-welcomebar-btn a:hover  {color:' + color_code + ' !important}  </style>');
					}
				}
				if ( color_id === 'mysticky_welcomebar_btnhovercolor'){
					var selectElement = document.querySelector('select[name="mysticky_option_welcomebar[mysticky_welcomebar_hover_effect]"]');
					var selectedValue = selectElement.value;
					if(selectedValue =="fill_effect_button"){
						$('.mysticky-welcomebar-preview-screen').find('style[data-background-color]').remove();
						$('.mysticky-welcomebar-preview-screen').append('<style  data-background-color>.mysticky-welcomebar-btn a:after  {background:' + color_code + ' !important}  </style>');
					}
					if(selectedValue =="border_effect_button"){
						$('.mysticky-welcomebar-preview-screen').find('style[data-background-color]').remove();
						$('.mysticky-welcomebar-preview-screen').append('<style  data-background-color>.mysticky-welcomebar-fixed .mysticky-welcomebar-btn a:hover {background:' + color_code + ' !important}  </style>');
					}
				}
				if ( color_id === 'mysticky_welcomebar_btnhoverbordercolor'){
					$('.mysticky-welcomebar-preview-screen').find('style[data-border-color]').remove();
					$('.mysticky-welcomebar-preview-screen').append('<style  data-border-color>.mysticky-welcomebar-btn:before, .mysticky-welcomebar-btn:after {background-color:' + color_code + ' !important} .mysticky-welcomebar-btn a:before, .mysticky-welcomebar-btn a:after {background-color:' + color_code + ' !important} </style>');
				}
			},
			change: function(event, ui){
				var color_id = $(this).attr('id');
				var slug = $(this).data('slug');

				var color_code = ui.color.toString();
				if ( color_id === 'mysticky_welcomebar_bgcolor'){
					$('.mysticky-welcomebar-fixed').css('background-color', color_code );
				}
				if ( color_id === 'mysticky_welcomebar_bgtxtcolor'){
					$('.mysticky-welcomebar-fixed .mysticky-welcomebar-content p').css('color', color_code );
				}
				if ( color_id === 'mysticky_welcomebar_btncolor'){
					$('.mysticky-welcomebar-btn a').css('background-color', color_code );
				}
				if ( color_id === 'mysticky_welcomebar_btntxtcolor'){
					$('.mysticky-welcomebar-btn a').css('color', color_code );
				}
				if( color_id === 'mysticky_welcomebar_xcolor' ){
					$(".mysticky-welcomebar-close").css('color',color_code);
				}
				if (color_id === 'mysticky_welcomebar_btnhovertxtcolor') {
					if(selectedValue !="none"){
						$('.mysticky-welcomebar-preview-screen').find('style[data-text-color]').remove();
						$('.mysticky-welcomebar-preview-screen').append('<style  data-text-color>.mysticky-welcomebar-btn a:hover  {color:' + color_code + ' !important}  </style>');
					}
				}
				if ( color_id === 'mysticky_welcomebar_btnhovercolor'){
					var selectElement = document.querySelector('select[name="mysticky_option_welcomebar[mysticky_welcomebar_hover_effect]"]');
					var selectedValue = selectElement.value;
					if(selectedValue =="fill_effect_button"){
						$('.mysticky-welcomebar-preview-screen').find('style[data-background-color]').remove();
						$('.mysticky-welcomebar-preview-screen').append('<style  data-background-color>.mysticky-welcomebar-btn a:after  {background:' + color_code + ' !important}  </style>');
					}
					if(selectedValue =="border_effect_button"){
						$('.mysticky-welcomebar-preview-screen').find('style[data-background-color]').remove();
						$('.mysticky-welcomebar-preview-screen').append('<style  data-background-color>.mysticky-welcomebar-fixed .mysticky-welcomebar-btn a:hover {background:' + color_code + ' !important}  </style>');
					}
				}
				if ( color_id === 'mysticky_welcomebar_btnhoverbordercolor'){
					$('.mysticky-welcomebar-preview-screen').find('style[data-border-color]').remove();
					$('.mysticky-welcomebar-preview-screen').append('<style  data-border-color>.mysticky-welcomebar-btn:before, .mysticky-welcomebar-btn:after {background-color:' + color_code + ' !important} .mysticky-welcomebar-btn a:before, .mysticky-welcomebar-btn a:after {background-color:' + color_code + ' !important} </style>');
				}
			}
	    };
		$('.mysticky-welcomebar-setting-wrap .my-color-field,.sticky-header-content .my-color-field').wpColorPicker(myOptions);

		$( 'input[name="mysticky_option_welcomebar[mysticky_welcomebar_x_desktop]"]' ).on( 'change', function(){
			if( $( this ).prop( "checked" ) == true ) {
				$( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-showx-desktop' );
			} else {
				$( '.mysticky-welcomebar-fixed' ).removeClass( 'mysticky-welcomebar-showx-desktop' );
			}
		} );
		$( 'input[name="mysticky_option_welcomebar[mysticky_welcomebar_x_mobile]"]' ).on( 'change', function(){
			if( $( this ).prop( "checked" ) == true ) {
				$( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-showx-mobile' );
			} else {
				$( '.mysticky-welcomebar-fixed' ).removeClass( 'mysticky-welcomebar-showx-mobile' );
			}
		} );

		$( 'input[name="mysticky_option_welcomebar[mysticky_welcomebar_btn_desktop]"]' ).on( 'change', function(){
			if( $( this ).prop( "checked" ) == true ) {
				$( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-btn-desktop' );
			} else {
				$( '.mysticky-welcomebar-fixed' ).removeClass( 'mysticky-welcomebar-btn-desktop' );
			}

			if( $( this ).prop( "checked" ) == false && $( 'input[name="mysticky_option_welcomebar[mysticky_welcomebar_btn_mobile]"]' ).prop( "checked" ) == false ) {
				$( ".mysticky_welcomebar_disable, .mysticky_welcomebar_btn_color button.wp-color-result" ).css({
					'pointer-events': 'none',
					'opacity': '0.5'
				});
			} else {
				$( ".mysticky_welcomebar_disable, .mysticky_welcomebar_btn_color button.wp-color-result" ).css({
					'pointer-events': '',
					'opacity': ''
				});
			}
		} );

		$( 'input[name="mysticky_option_welcomebar[mysticky_welcomebar_btn_mobile]"]' ).on( 'change', function(){
			if( $( this ).prop( "checked" ) == true ) {
				$( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-btn-mobile' );
			} else {
				$( '.mysticky-welcomebar-fixed' ).removeClass( 'mysticky-welcomebar-btn-mobile' );
			}

			if( $( this ).prop( "checked" ) == false && $( 'input[name="mysticky_option_welcomebar[mysticky_welcomebar_btn_desktop]"]' ).prop( "checked" ) == false ) {
				$( ".mysticky_welcomebar_disable, .mysticky_welcomebar_btn_color button.wp-color-result" ).css({
					'pointer-events': 'none',
					'opacity': '0.5'
				});
			} else {
				$( ".mysticky_welcomebar_disable, .mysticky_welcomebar_btn_color button.wp-color-result" ).css({
					'pointer-events': '',
					'opacity': ''
				});
			}
		} );
		if( $( 'input[name="mysticky_option_welcomebar[mysticky_welcomebar_btn_desktop]"]' ).prop( "checked" ) == false && $( 'input[name="mysticky_option_welcomebar[mysticky_welcomebar_btn_mobile]"]' ).prop( "checked" ) == false ) {
			$( ".mysticky_welcomebar_disable, .mysticky_welcomebar_btn_color button.wp-color-result" ).css({
				'pointer-events': 'none',
				'opacity': '0.5'
			});
		} else {
			$( ".mysticky_welcomebar_disable, .mysticky_welcomebar_btn_color button.wp-color-result" ).css({
				'pointer-events': '',
				'opacity': ''
			});
		}

		$( 'select[name="mysticky_option_welcomebar[mysticky_welcomebar_font]"]' ).on( 'change', function(){
			var myfixed_font_val = $( this ).val();
			if( myfixed_font_val == 'System Stack'){
				myfixed_font_val = '-apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"';
			}
			$( 'head' ).append( '<link href="https://fonts.googleapis.com/css?family='+ myfixed_font_val +':400,600,700" rel="stylesheet" type="text/css" class="sfba-google-font">' );
			$( '.mysticky-welcomebar-fixed' ).css( 'font-family', myfixed_font_val );
		} );

		$( 'input[name="mysticky_option_welcomebar[mysticky_welcomebar_fontsize]"]' ).on( 'keyup click', function(){
			var mysticky_welcomebar_fontsize_val = $( this ).val();
			$( '.mysticky-welcomebar-fixed p' ).css( 'font-size', mysticky_welcomebar_fontsize_val + 'px' );
			$( '.mysticky-welcomebar-btn a' ).css( 'font-size', mysticky_welcomebar_fontsize_val + 'px' );
		} );

		$( '#wp-mysticky_bar_text-wrap .wp-editor-tabs button' ).on( 'click', function(){
			if ( $("#wp-mysticky_bar_text-wrap").hasClass("tmce-active") ){

			}
		} );

		$( document ).on( 'click', '#qt_mysticky_bar_text_toolbar .ed_button', function(){
			$( 'textarea[name="mysticky_option_welcomebar[mysticky_welcomebar_bar_text]"]' ).trigger( 'change keyup click' );
		} );
		
		/* Static Text */
		var mysticky_bar_text_val = $( 'textarea[name="mysticky_option_welcomebar[mysticky_welcomebar_bar_text]"]' ).val().replace(/(?:\r\n|\r|\n)/g, '<br />');
		mysticky_bar_text_val = mysticky_bar_text_val.replace(/(?:onchange|onclick|onmouseover|onmouseout|onkeydown|onload\onerror|alert)/g, '');
		$( '.mysticky-welcomebar-content p.mysticky-welcomebar-static_text' ).html( mysticky_bar_text_val );
		$( 'textarea[name="mysticky_option_welcomebar[mysticky_welcomebar_bar_text]"]' ).on( 'change keyup click', function(){
			
			var mysticky_bar_text_val = $( this ).val().replace(/(?:\r\n|\r|\n)/g, '<br />');
			mysticky_bar_text_val = mysticky_bar_text_val.replace(/(?:onchange|onclick|onmouseover|onmouseout|onkeydown|onload\onerror|alert)/g, '');
			$( '.mysticky-welcomebar-content p.mysticky-welcomebar-static_text' ).html( mysticky_bar_text_val );
			$('.mysticky-welcomebar-fixed .mysticky-welcomebar-content p.mysticky-welcomebar-static_text').css('color', $('#mysticky_welcomebar_bgtxtcolor').val() );
			$( '.mysticky-welcomebar-fixed p.mysticky-welcomebar-static_text' ).css( 'font-size', $('#mysticky_welcomebar_fontsize').val() + 'px' );
			
		} );
		/* Sliding Text */
		$( document ).on( 'change keyup click', 'input[name="mysticky_option_welcomebar[mysticky_welcomebar_slider_text][]"]' , function(){
			var sliding_text = '';
			$('input[name="mysticky_option_welcomebar[mysticky_welcomebar_slider_text][]"]').each(function(index) {				
				sliding_text += '"' + $(this).val() + '",';
			});
			var slider_transition = $( 'select[name="mysticky_option_welcomebar[mysticky_welcomebar_slider_transition]"]' ).val();            
			$('.mysticky-welcomebar-animation-transition').html('<span class="mysticky-welcomebar-animation-text" data-morphext-options=\'{"animation": "'+ slider_transition +'", "phrases": [' + sliding_text.slice(0, -1) + '], "speed":"3500"}\'></span>')
			jQuery(".mysticky-welcomebar-animation-transition .mysticky-welcomebar-animation-text").morphext();
		});
		
		$( document ).on( 'change', 'select[name="mysticky_option_welcomebar[mysticky_welcomebar_slider_transition]"]' , function(){		
			var sliding_text = '';
			$('input[name="mysticky_option_welcomebar[mysticky_welcomebar_slider_text][]"]').each(function(index) {				
				sliding_text += '"' + $(this).val() + '",';
			});
			var slider_transition = $( 'select[name="mysticky_option_welcomebar[mysticky_welcomebar_slider_transition]"]' ).val();
			$('.mysticky-welcomebar-animation-transition').html('<span class="mysticky-welcomebar-animation-text" data-morphext-options=\'{"animation": "'+ slider_transition +'", "phrases": [' + sliding_text.slice(0, -1) + '], "speed":"3500"}\'></span>')
			jQuery(".mysticky-welcomebar-animation-transition .mysticky-welcomebar-animation-text").morphext();
		});
		
		$( 'input[name="mysticky_option_welcomebar[mysticky_welcomebar_btn_text]"]' ).on( 'keyup', function(){
			var mysticky_btn_text_val = $( this ).val();
			$( '.mysticky-welcomebar-btn a' ).text( mysticky_btn_text_val );
		} );

		/* DATE: 11-12-2019 start */
		$( 'select[name="mysticky_option_welcomebar[mysticky_welcomebar_attentionselect]"]' ).on( 'change', function(){
			$(".mysticky-welcomebar-fixed").removeClass (function (index, className) {
				return (className.match (/(^|\s)mysticky-welcomebar-attention-\S+/g) || []).join(' ');
			});
			$( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-attention-' + $(this).val() );

		} );
		/* DATE: 11-12-2019 End */
		/* DATE: 15-02-2024  */
		$( 'select[name="mysticky_option_welcomebar[mysticky_welcomebar_hover_fill_effect]"]' ).on( 'change', function(){
			$(".mysticky-welcomebar-btn").removeClass (function (index, className) {
				return (className.match (/(^|\s)mysticky-welcomebar-hover-effect-\S+/g) || []).join(' ');
			});
			$( '.mysticky-welcomebar-btn' ).addClass( 'mysticky-welcomebar-hover-effect-' + $(this).val() );

		} );
		$( 'select[name="mysticky_option_welcomebar[mysticky_welcomebar_hover_border_effect]"]' ).on( 'change', function(){
			$(".mysticky-welcomebar-btn").removeClass (function (index, className) {
				return (className.match (/(^|\s)mysticky-welcomebar-hover-effect-\S+/g) || []).join(' ');
			});
			$( '.mysticky-welcomebar-btn' ).addClass( 'mysticky-welcomebar-hover-effect-' + $(this).val() );

		} );
		$( 'select[name="mysticky_option_welcomebar[mysticky_welcomebar_hover_effect]"]' ).on( 'change', function(){
			var hovervalue = $(this).val();
			if (hovervalue == "fill_effect_button") {
				$(".welcomebar-hover-fill-effect").css("display", "flex");
				$(".welcomebar-hover-border-effect").css("display", "none");
			}
			if (hovervalue == "border_effect_button") {
				$(".welcomebar-hover-fill-effect").css("display", "none");
				$(".welcomebar-hover-border-effect").css("display", "flex");
			}
			if (hovervalue == "none") {
				$(".welcomebar-hover-fill-effect").css("display", "none");
				$(".welcomebar-hover-border-effect").css("display", "none");
			}
			
		});
		$( 'select[name="mysticky_option_welcomebar[mysticky_welcomebar_hover_effect]"]' ).on( 'change', function(){
			var hovervalue = $(this).val();
			if (hovervalue == "fill_effect_button") {
				$(".mysticky-welcomebar-hover-txt-color").css("display", "flex");
				$(".mysticky-welcomebar-hover-color").css("display", "flex");
				$(".mysticky-welcomebar-hover-border-color").css("display", "none");
			}
			if (hovervalue == "border_effect_button") {
				$(".mysticky-welcomebar-hover-txt-color").css("display", "flex");
				$(".mysticky-welcomebar-hover-color").css("display", "flex");
				$(".mysticky-welcomebar-hover-border-color").css("display", "flex");
			}
			if (hovervalue == "none") {
				$(".mysticky-welcomebar-hover-txt-color").css("display", "none");
				$(".mysticky-welcomebar-hover-color").css("display", "none");
				$(".mysticky-welcomebar-hover-border-color").css("display", "none");
			}
			
		});
		$( 'select[name="mysticky_option_welcomebar[mysticky_welcomebar_hover_effect]"]' ).on( 'change', function(){
			var hovereffectvalue = $(this).val();
			var filleffect = $( 'select[name="mysticky_option_welcomebar[mysticky_welcomebar_hover_fill_effect]"]' ).val();
			var bordereffect = $( 'select[name="mysticky_option_welcomebar[mysticky_welcomebar_hover_border_effect]"]' ).val();
			if(hovereffectvalue == "fill_effect_button"){
				$(".mysticky-welcomebar-btn").removeClass (function (index, className) {
					return (className.match (/(^|\s)mysticky-welcomebar-hover-effect-\S+/g) || []).join(' ');
				});
				$( '.mysticky-welcomebar-btn' ).addClass( 'mysticky-welcomebar-hover-effect-' + filleffect );
			}
			if(hovereffectvalue == "border_effect_button"){
				$(".mysticky-welcomebar-btn").removeClass (function (index, className) {
					return (className.match (/(^|\s)mysticky-welcomebar-hover-effect-\S+/g) || []).join(' ');
				});
				$( '.mysticky-welcomebar-btn' ).addClass( 'mysticky-welcomebar-hover-effect-' + bordereffect );
			}
		});
		$( 'select[name="mysticky_option_welcomebar[mysticky_welcomebar_hover_effect]"]' ).on( 'change', function(){
			var hovereffectvalue = $(this).val();
			var filleffect = $( 'select[name="mysticky_option_welcomebar[mysticky_welcomebar_hover_fill_effect]"]' ).val();
			var bordereffect = $( 'select[name="mysticky_option_welcomebar[mysticky_welcomebar_hover_border_effect]"]' ).val();
			if(hovereffectvalue == "fill_effect_button"){
				$(".mysticky-welcomebar-btn").removeClass (function (index, className) {
					return (className.match (/(^|\s)mysticky-welcomebar-hover-effect-\S+/g) || []).join(' ');
				});
				$( '.mysticky-welcomebar-btn' ).addClass( 'mysticky-welcomebar-hover-effect-' + filleffect );

				var btnhovertxtcolor = $( '#mysticky_welcomebar_btnhovertxtcolor' ).val();
				var btnhovercolor = $( '#mysticky_welcomebar_btnhovercolor' ).val();
				$('.mysticky-welcomebar-preview-screen').find('style[data-hover-color]').remove();
				$('.mysticky-welcomebar-preview-screen').append('<style  data-hover-color>.mysticky-welcomebar-fixed .mysticky-welcomebar-btn a:hover {color:' + btnhovertxtcolor + ';}.mysticky-welcomebar-btn a:after{background:' + btnhovercolor + '!important;z-index: -1 !important}.mysticky-welcomebar-btn a:before,.mysticky-welcomebar-btn a:after{background:' + btnhovercolor + '!important;z-index: -1 !important;}</style>');
				$('#button-hover-color').remove();
			}
			if(hovereffectvalue == "border_effect_button"){
				$(".mysticky-welcomebar-btn").removeClass (function (index, className) {
					return (className.match (/(^|\s)mysticky-welcomebar-hover-effect-\S+/g) || []).join(' ');
				});
				$( '.mysticky-welcomebar-btn' ).addClass( 'mysticky-welcomebar-hover-effect-' + bordereffect );

				var btnhovertxtcolor = $( '#mysticky_welcomebar_btnhovertxtcolor' ).val();
				var btnhovercolor = $( '#mysticky_welcomebar_btnhovercolor' ).val();
				var btnhoverbordercolor = $( '#mysticky_welcomebar_btnhoverbordercolor' ).val();
				$('.mysticky-welcomebar-preview-screen').find('style[data-hover-color]').remove();
				$('.mysticky-welcomebar-preview-screen').find('style[data-hover-color]').remove();
				$('.mysticky-welcomebar-preview-screen').append('<style  data-hover-color>.mysticky-welcomebar-fixed .mysticky-welcomebar-btn a:hover {color:' + btnhovertxtcolor + ';background:' + btnhovercolor + '!important;}.mysticky-welcomebar-btn:before,.mysticky-welcomebar-btn:after {background:' + btnhoverbordercolor + '!important;z-index: 1 !important}.mysticky-welcomebar-btn a:before,.mysticky-welcomebar-btn a:after {background:' + btnhoverbordercolor + '!important;z-index: 1 !important;}</style>');
				$('#button-hover-color').remove();
			}
			if(hovereffectvalue == "none"){
				$('.mysticky-welcomebar-preview-screen').find('style[data-hover-color]').remove();
				$('.mysticky-welcomebar-preview-screen').find('style[data-background-color]').remove();
				$('.mysticky-welcomebar-preview-screen').find('style[data-border-color]').remove();
				$('#button-hover-color').remove();
			}
		});
		/* DATE: 15-02-2024 End */
		$("#myStickymenu-entry-effect").on( 'change', function() {
			$(".mysticky-welcomebar-preview-screen .mysticky-welcomebar-fixed").removeClass('entry-effect');
			$(".mysticky-welcomebar-fixed").removeClass (function (index, className) {
				return (className.match (/(^|\s)mysticky-welcomebar-entry-effect-\S+/g) || []).join(' ');
			});
			$( '.mysticky-welcomebar-preview-screen .mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-entry-effect-' + $(this).val() );
			setTimeout( function(){
				$(".mysticky-welcomebar-preview-screen .mysticky-welcomebar-fixed").addClass('entry-effect');
			}, 1000 );

		});
		$( '.mysticky-welcomebar-fixed' ).addClass( 'entry-effect' );

		jQuery(".mysticky-welcomebar-animation-transition .mysticky-welcomebar-animation-text").morphext();

	});
	$( window ).on('load', function(){
	    $( '.mysticky-welcomebar-url-options' ).each( function(){
	        $( this ).trigger( 'change' );
	    });
	});

	jQuery(document).on("click",".mystickymenu-delete-widget",function(e){
		e.preventDefault();

		var widget_id = jQuery(this).data("widget-id");
		jQuery("#widget-delete-dialog-"+widget_id).show();
		jQuery("#mystickymenu-delete-popup-overlay-"+widget_id).show();
	});

	/* Mystickymenu: Dashbaord table delete button click action */

	jQuery(document).on("click",".btn-delete",function(e){
		e.preventDefault();
		var delWidId = jQuery(this).data("id");
		jQuery.ajax({
			url: ajaxurl,
			type:'post',
			data: 'action=stickymenu_widget_delete&widget_id=' + delWidId + '&widget_delete=1&wpnonce=' + mystickymenu.ajax_nonce,
			success: function( data ){
				$( '#stickymenu-widget-' + delWidId ).remove();
				setTimeout('location.reload()', 500);
			},
		});
	});


	jQuery(document).on("click",".btn-delete-cancel",function(e){
		e.preventDefault();
		var id = jQuery(this).data("id");
		jQuery("#widget-delete-dialog-"+id).hide();
		jQuery("#mystickymenu-delete-popup-overlay-"+id).hide();
	});

	/* Mystickymenu: Dashbaord table welcombar widget status change action */

	jQuery(document).on("click",".mystickymenu-widget-enabled",function(){
		var widget_id = $(this).data('id');
		if(jQuery(this).prop("checked") != true){
			jQuery('#widget-status-dialog-' + widget_id).show();
			jQuery('#mystickymenu-status-popup-overlay-' + widget_id).show();
		}else{
			var widget_status = 1;
			set_widget_status( widget_id, widget_status );
		}
	});

	jQuery(document).on("click",".btn-turnoff-status",function(e){
		e.preventDefault();
		var widget_id = $(this).data('id');

		if ( typeof widget_id !== "undefined") {
			var widget_status = 0;
			set_widget_status( widget_id, widget_status );
		}

	});


	jQuery(document).on("click",".btn-nevermind-status",function(e){
		e.preventDefault();
		var widget_id = $(this).data('id');
		if ( typeof widget_id !== "undefined") {
			var widget_status = 1;
			set_widget_status( widget_id, widget_status );
			jQuery("#mystickymenu-widget-enabled-"+widget_id).prop('checked', true)
		}

	});

	jQuery(document).on("click",".mystickymenupopup-overlay",function(e){
		e.preventDefault();

		if(jQuery(this).data("fromoverlay") == 'welcombar_delete'){
			jQuery(this).hide();
			var delId = jQuery(this).data('id');
			jQuery('#widget-delete-dialog-'+delId).hide();
		}
	});

	jQuery(document).on("click",".mystickymenupopup-widget-status-overlay",function(e){
		e.preventDefault();
		var widget_id = $(this).data('id');
		var widget_status = 1;
		set_widget_status( widget_id, widget_status );
		jQuery("#mystickymenu-widget-enabled-"+widget_id).prop('checked', true);

	});

	function set_widget_status( widget_id, widget_status ) {
		jQuery.ajax({
			url: ajaxurl,
			type:'post',
			data: 'action=mystickymenu_widget_status&widget_id='+widget_id+'&widget_status=' + widget_status +'&wpnonce=' + mystickymenu.ajax_nonce,
			success: function( data ){
				$('#widget-status-dialog-' + widget_id).hide();
				$('#mystickymenu-status-popup-overlay-' + widget_id).hide();
			},
		});
	}

	jQuery(document).on("click","#close-first-popup, .btn-close-dashboard",function(e){
		e.preventDefault();
		jQuery('.first-widget-popup').hide();
		jQuery('.mystickymenupopup-overlay').hide();
	});

	jQuery(document).on("click","#first_widget_overlay",function(){
		jQuery('.first-widget-popup').hide();
		jQuery(this).hide();
	});



	jQuery(document).on("click","#btn-config-disable",function(e){
		e.preventDefault();
		jQuery("#stickymenu_status_popupbox").show();
		jQuery("#stickymenuconfig-overlay-popup").show();
	});

	jQuery(document).on("click","#stickymenuconfig-overlay-popup",function(){
		jQuery("#stickymenu_status_popupbox").hide();
		jQuery(this).hide();
	});

	jQuery(document).on("click","#stickymenu_status_turnoff",function(e){
		e.preventDefault();
		var stickymenu_status = 0;
		set_stickymenu_status( stickymenu_status );
	});

	jQuery(document).on("click","#stickymenu_status_nevermind",function(e){
		e.preventDefault();
		jQuery("#stickymenu_status_popupbox").hide();
		jQuery("#stickymenuconfig-overlay-popup").hide();
	});

	function set_stickymenu_status( stickymenu_status ){
		jQuery.ajax({
			url: ajaxurl,
			type:'post',
			data: 'action=stickymenu_status_update&stickymenu_status=' + stickymenu_status +'&wpnonce=' + mystickymenu.ajax_nonce,
			success: function( data ){
				location.reload();
			},
		});
	}

	jQuery(document).on("click",".close-button",function(){
		if(jQuery(this).data("from") == 'welcome-bar-status'){
			var id = jQuery(this).data("id");
			jQuery("#widget-status-dialog-"+id).hide();
			jQuery("#mystickymenu-status-popup-overlay-"+id).hide();
			var widget_status = 1;
			set_widget_status( id, widget_status );
			jQuery("#mystickymenu-widget-enabled-"+id).prop('checked', true)

		}else if( jQuery(this).data("from") == "stickymenu-status"){
			jQuery("#stickymenu_status_popupbox").hide();
			jQuery("#stickymenuconfig-overlay-popup").hide();

		}else if( jQuery(this).data("from") == "stickymenu-confirm" ){
			jQuery("#mysticky-sticky-save-confirm").hide();
			jQuery("#stickymenu-option-overlay-popup").hide();
		}else if( jQuery(this).data("from") == "welcombar-confirm" ){
			jQuery("#welcomebar-save-confirm").hide();
			jQuery("#welcombar-sbmtvalidation-overlay-popup").hide();
		}else{
			var id = jQuery(this).data("id");
			jQuery("#widget-delete-dialog-"+id).hide();
			jQuery("#mystickymenu-delete-popup-overlay-"+id).hide();
		}
	});


	jQuery(document).on("click","#stickymenu-option-overlay-popup",function(){
		$("#mysticky-sticky-save-confirm").hide();
		$(this).hide();
	});


	jQuery(document).on("click","#welcombar-sbmtvalidation-overlay-popup",function(){
		$("#welcomebar-save-confirm").hide();
		$(this).hide();
	});


	jQuery(document).on("change","#mysticky-welcomebar-countdown-enabled",function(){
		var url = jQuery(this).data("url");
		jQuery(this).prop('checked',false);
		window.open(url, '_blank');
	});

	jQuery(document).on("click",".btn-save-stickymenu" , function(event){
		if ( $( '#mysticky-stickymenu-form-enabled' ).prop( 'checked' ) == false && $('#save_stickymenu').val() == "" ) {
			event.preventDefault();
			$("#mysticky-sticky-save-confirm").show();
			$("#stickymenu-option-overlay-popup").show();

			$('#stickymenu_status_ok').attr('data-clickfrom', 'save');
			$('#stickymenu_status_dolater').attr('data-clickfrom', 'save');
		}
	});

	jQuery(document).on("click",".save_view_dashboard" , function(event){
		if ( $( '#mysticky-stickymenu-form-enabled' ).prop( 'checked' ) == false && $('#save_stickymenu').val() == "" ) {
			event.preventDefault();
			$("#mysticky-sticky-save-confirm").show();
			$("#stickymenu-option-overlay-popup").show();

			$('#stickymenu_status_ok').attr('data-clickfrom', 'dashboard');
			$('#stickymenu_status_dolater').attr('data-clickfrom', 'dashboard');
		}
	});

	jQuery(document).on("click","#stickymenu_status_ok",function(){
		var clickFrom = $(this).data("clickfrom");
		$('#save_stickymenu').val("1");
		$( '#mysticky-stickymenu-form-enabled' ).prop( 'checked' , true )
		$("#mysticky-sticky-save-confirm").hide();
		$("#stickymenu-option-overlay-popup").hide();
		if(clickFrom == 'dashboard'){
			$('.save_view_dashboard').trigger("click");
		}else{
			$('.btn-save-stickymenu').trigger("click");
		}
	});

	jQuery(document).on("click","#stickymenu_status_dolater",function(){
		var clickFrom = $(this).data("clickfrom");
		$('#save_stickymenu').val("1");
		if(clickFrom == 'dashboard'){
			$('.save_view_dashboard').trigger("click");
		}else{
			$('.btn-save-stickymenu').trigger("click");
		}
	});

	jQuery(document).on( 'click','.welcombar_save', function(e){

		if ( $( 'input[name="mysticky_option_welcomebar[mysticky_welcomebar_enable]"]' ).prop( 'checked' ) == false && $( 'input#save_welcome_bar' ).val() == '' ) {
			e.preventDefault();
			$("#welcomebar-save-confirm").show();
			$("#welcombar-sbmtvalidation-overlay-popup").show();
			$("#welcombar_sbmtbtn_off").attr("data-clickfrom",'save_button');
			$("#welcomebar_yes_sbmtbtn").attr("data-clickfrom",'save_button');
		}
	});


	jQuery(document).on( 'click','.save_view_dashboard', function(e){

		if ( $( 'input[name="mysticky_option_welcomebar[mysticky_welcomebar_enable]"]' ).prop( 'checked' ) == false && $( 'input#save_welcome_bar' ).val() == '' ) {
			e.preventDefault();
			$("#welcomebar-save-confirm").show();
			$("#welcombar-sbmtvalidation-overlay-popup").show();
			$("#welcombar_sbmtbtn_off").attr("data-clickfrom",'save_dashboard_button');
			$("#welcomebar_yes_sbmtbtn").attr("data-clickfrom",'save_dashboard_button');
		}
	});
	$( document ).on( 'change', '#mysticky-welcomebar-contact-form-enabled', function(){
		$("span.mystickybar-visible, span.mystickybar-hidden").hide();
		if( $(this).prop('checked') == true ) {
			$("span.mystickybar-visible").show();
		} else {
			$("span.mystickybar-hidden").show();
		}
	})

	jQuery(document).on("click","#welcomebar_yes_sbmtbtn",function(){

		var clickFrom = $(this).data("clickfrom");

		$("#welcomebar-save-confirm").hide();
		$("#welcombar-sbmtvalidation-overlay-popup").hide();
		$( 'input#welcome_save_anyway' ).val('1');
		$( 'input#save_welcome_bar' ).val('1');
		$( 'input[name="mysticky_option_welcomebar[mysticky_welcomebar_enable]"]' ).prop( 'checked',true );
		if(clickFrom == 'save_dashboard_button'){
			$( '.mystickybar-tabs-buttons button.save_view_dashboard' ).trigger('click');
		}else{
			$( '.mystickybar-tabs-buttons button.welcombar_save' ).trigger('click');
		}
	});

	jQuery(document).on("click","#welcombar_sbmtbtn_off",function(){
		var clickFrom = $(this).data("clickfrom");

		$("#welcomebar-save-confirm").hide();
		$("#welcombar-sbmtvalidation-overlay-popup").hide();
		$( 'input#welcome_save_anyway' ).val('1');
		$( 'input#save_welcome_bar' ).val('1');

		if(clickFrom == 'save_dashboard_button'){
			$( '.mystickybar-tabs-buttons button.save_view_dashboard' ).trigger('click');
		}else{
			$( '.mystickybar-tabs-buttons button.welcombar_save' ).trigger('click');
		}
	});

	jQuery(document).on("click","#mysticky-welcomebar-showcoupon-enabled",function(){
		var url = jQuery(this).data("url");
		jQuery(this).prop('checked',false);
		window.open(url, '_blank');
	});
	
	if( $("#mysticky-welcomebar-collectlead-enabled").prop("checked") == true ){
		$( '.mysticky-welcomebar-preview-screen .mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-collectlead-active' );
	}
	jQuery(document).on("change","#mysticky-welcomebar-collectlead-enabled",function(){

		var button_text = $(this).data("button-text");

		if( $(this).prop("checked") == true ){

			$(".timer-message").show();
			$(".mysticky-welcomebar-collect-lead").show();
			$(".welcomebar_height_content").hide();
			$( '.mysticky-welcomebar-preview-screen .mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-collectlead-active' );
			$(".mysticky-welcomebar-preview-screen .mysticky-welcomebar-fixed .mysticky-welcomebar-content").css("width","90%");
			$(".mysticky-welcomebar-lead-content").show();
			$(".mysticky-welcomebar-btn a").text("Send me");
			$("#mysticky_welcomebar_btn_text").val("Send me");
			$(".mysticky-welcomebar-btn").addClass("collect-lead");
			$(".height-setting").hide();
		}else{

			button_text = ( button_text == 'Send me' ) ? 'Got it!' : button_text;
			$(".timer-message").hide();
			$(".welcomebar_height_content").show();
			$(".mysticky-welcomebar-collect-lead").hide();
			$( '.mysticky-welcomebar-preview-screen .mysticky-welcomebar-fixed' ).removeClass( 'mysticky-welcomebar-collectlead-active' );
			$(".mysticky-welcomebar-preview-screen .mysticky-welcomebar-fixed .mysticky-welcomebar-content").css("width","75%");
			$(".mysticky-welcomebar-lead-content").hide();
			$(".mysticky-welcomebar-btn a").text(button_text);
			$("#mysticky_welcomebar_btn_text").val(button_text);
			$(".height-setting").show();
			$(".mysticky-welcomebar-btn").removeClass("collect-lead");
		}
	});

	jQuery(document).on("click","#send_lead_email_enable",function(){
		var url = jQuery(this).data("url");
		jQuery(this).prop('checked',false);
		window.open(url, '_blank');
	});


	jQuery(document).on("keyup","#lead-name-placeholder,#lead-email-placeholder,#lead-phone-placeholder",function(e){
		if( $(this).attr("id") == "lead-name-placeholder" ){
			$(".preview-lead-name").attr("placeholder",$(this).val());
		}else if( $(this).attr("id") == "lead-email-placeholder" ){
			$(".preview-lead-email").attr("placeholder",$(this).val());
		}else{
			$(".preview-lead-phone").attr("placeholder",$(this).val());
		}
	});
	/* Welcomebar Text*/
	jQuery(document).on("change","input[name='mysticky_option_welcomebar[mysticky_welcomebar_text_type]']",function(){
		if( $(this).val() == 'static_text' ){
			$("#mysticky_welcomebar_static_text_setting").show();
			$("#mysticky_welcomebar_sliding_text_setting").hide();
			$("#mysticky_welcomebar_sliding_text_transition_style,#mysticky_welcomebar_sliding_text_transition_speed").hide();
		}else{
			$("#mysticky_welcomebar_static_text_setting").hide();
			$("#mysticky_welcomebar_sliding_text_setting").show();
			$("#mysticky_welcomebar_sliding_text_transition_style,#mysticky_welcomebar_sliding_text_transition_speed").show();
		}

	});

	jQuery(document).on("change","input[name='mysticky_option_welcomebar[mysticky_welcomebar_lead_input]']",function(){
		if( $(this).val() == 'email_address' ){
			$("#lead-email-content").show();
			$("#lead-phone-content").hide();
			$(".preview-lead-email").show();
			$(".preview-lead-phone").hide();
		}else{
			$("#lead-email-content").hide();
			$("#lead-phone-content").show();
			$(".preview-lead-email").hide();
			$(".preview-lead-phone").show();
		}

	});

	/* Mystickymenu : Single delete contact lead data - Contact lead page */

	jQuery(document).on("click",".mystickymenu-delete-entry",function(event){

		var deleterowid = $( this ).attr( "data-delete" );
		var confirm_delete = window.confirm("Are you sure you want to delete Record with ID# "+deleterowid);
		if (confirm_delete == true) {
			jQuery.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {"action": "mystickymenu_delete_contact_lead","ID": deleterowid, delete_nonce: jQuery("#delete_nonce").val(),"wpnonce": mystickymenu.ajax_nonce},
				success: function(data){
					location.href = window.location.href;
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert("Status: " + textStatus); alert("Error: " + errorThrown);
				}
			});
		}

	});

	/* Mystickymenu : Bulk delete all contact lead data - Contact lead page */

	jQuery(document).on("click","#mystickymenu_delete_all_leads", function(){
		var confirm_delete = window.confirm("Are you sure you want to delete all Record from the database?");
		if (confirm_delete == true) {
			jQuery.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {"action": "mystickymenu_delete_contact_lead", 'all_leads': 1 , delete_nonce: jQuery("#delete_nonce").val(),"wpnonce": mystickymenu.ajax_nonce},
				success: function(data){
					location.href = window.location.href;
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert("Status: " + textStatus); alert("Error: " + errorThrown);
				}
			});
		}
		return false;
	});

	/* Mystickymenu : Bulk do action trigger in contact lead table */

	jQuery(document).on('click','#doaction',function(e){
		e.preventDefault();
		var bulks = [];
		jQuery( '.cb-select-blk' ).each( function(){
			if (this.checked) {
				bulks.push( jQuery(this).val() );
			}
		} );

		jQuery.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {"action": "my_sticky_menu_bulks","bulks": bulks,"wpnonce": mystickymenu.ajax_nonce},
			success: function(data){
				location.href = window.location.href;
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert("Status: " + textStatus); alert("Error: " + errorThrown);
			}
		});
	} );

	jQuery(document).on( 'change','#mysticky-welcomebar-close-automatically-enabled', function(){
		$(this).prop("checked",false);
		var url = $(this).data("url");
		window.open(url, '_blank');
	});

	jQuery(document).on("click",".save_change",function(){
		$( '.mystickybar-tabs-buttons button.welcombar_save' ).trigger('click');
	});

	jQuery(document).on( 'change','#mysticky_welcomebar_show_success_message', function(){
		if( $( this ).prop( "checked" ) == true ) {
			$('#mysticky-welcomebar-thankyou-wrap').show();
		} else {
			$('#mysticky-welcomebar-thankyou-wrap').hide();
		}
	});
	
	//rating popup 	
	$(document).on("keyup", "#upgrade-review-comment", function(){
		var commentLength = 1000 - parseInt($.trim($(this).val()).length);
		if(commentLength < 0) {
			var userComment = $.trim($(this).val());
			userComment = userComment.slice(0, 1000);
			$(".upgrade-review-textarea label span").text(0);
			$(this).val(userComment);
		} else {
			$(".upgrade-review-textarea label span").text(commentLength);
		}
	});

	$(document).on("change", "#upgrade-review-comment", function(){
		var commentLength = 1000 - parseInt($.trim($(this).val()).length);
		if(commentLength < 0) {
			var userComment = $.trim($(this).val());
			userComment = userComment.slice(0, 1000);
			$(".upgrade-review-textarea label span").text(0);
			$(this).val(userComment);
		} else {
			$(".upgrade-review-textarea label span").text(commentLength);
		}
	});
	
	$(document).on("click", ".welcomebar-full-screen-btn", function(){
		$( this ).hide();
		$( '.welcomebar-minimise-screen-btn' ).show();
		$( '.mysticky-welcomebar-preview' ).addClass( 'mysticky-welcomebar-full-screen-preview' );
		$( '.mysticky-welcomebar-preview-wrap' ).addClass( 'mysticky-welcomebar-full-screen-preview-body' );
	});
	
	$(document).on("click", ".welcomebar-minimise-screen-btn", function(){
		$( this ).hide();
		$( '.welcomebar-full-screen-btn' ).show();
		$( '.mysticky-welcomebar-preview' ).removeClass( 'mysticky-welcomebar-full-screen-preview' );
		$( '.mysticky-welcomebar-preview-wrap' ).removeClass( 'mysticky-welcomebar-full-screen-preview-body' );
	});
	
	$(document).on("click", ".mysticky-welcomebar-full-screen-preview-body", function(event){				
		if( $(event.target).hasClass( 'mysticky-welcomebar-full-screen-preview-body') == true || $(event.target).hasClass( 'mysticky-welcomebar-header-title') == true){
			$( '.welcomebar-minimise-screen-btn' ).trigger( 'click' );			
		}
	});
	
	$(document).ready(
        function () {		
		if( $("#mystickymenu-rating").length != 0 ) {
			$("#rating-modal-popup").show();
			$("#mystickymenu-rating").starRating({
				initialRating   : 0,
				useFullStars    : true,
				strokeColor     : '#FDB10C',
				ratedColor      : '#FDB10C',
				activeColor     : '#FDB10C',
				strokeWidth     : 0,
				minRating       : 1,
				starSize        : 32,
				useGradient     : 0,
				onHover: function(currentRate) {
					$(".upgrade-user-rating span").text(currentRate+"/5");
					$(".upgrade-user-rating" ).css('visibility', 'visible');
				},
				onLeave:  function(currentRate) {
					$(".upgrade-user-rating" ).css('visibility', 'hidden');
				},				
				callback( currentRate ) {
					console.log(currentRate);
					if( currentRate !== 5 ) {
						$(".rating-modal-steps").removeClass("active");
						$(".rating-modal-steps#step-2").addClass("active");
						$("#mystickymenu-rated-rating").html("");
						for(let i=0 ; i< parseInt(currentRate); i++) {
							var ratingStar = '<div class="jq-star"><svg shape-rendering="geometricPrecision" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="305px" height="305px" viewBox="60 -62 309 309" style="enable-background:new 64 -59 305 305; stroke-width:0px;" xml:space="preserve"> <polygon data-side="center" className="svg-empty-28" points="281.1,129.8 364,55.7 255.5,46.8 214,-59 172.5,46.8 64,55.4 146.8,129.7 121.1,241 212.9,181.1 213.9,181 306.5,241 " style="fill: transparent; stroke: #ffa83e;"></polygon> <polygon data-side="left" className="svg-empty-28" points="281.1,129.8 364,55.7 255.5,46.8 214,-59 172.5,46.8 64,55.4 146.8,129.7 121.1,241 213.9,181.1 213.9,181 306.5,241 " style="stroke-opacity: 0;"></polygon> <polygon data-side="right" className="svg-empty-28" points="364,55.7 255.5,46.8 214,-59 213.9,181 306.5,241 281.1,129.8 " style="stroke-opacity: 0;"></polygon> </svg></div>';
							$("#mystickymenu-rated-rating").append(ratingStar);
						}
					} else {
						window.open("https://wordpress.org/support/plugin/mystickymenu/reviews/#new-post", '_blank');
						set_mystickymenu_review_reminder(-1);
					}
				}
			})
		}	

		$(document).on("click", ".close-popup-button a.hide-upgrade-modal", function(){
			if($(".rating-modal-steps#step-3").hasClass("active")) {
				set_mystickymenu_review_reminder(14);
			} else {
				$(".rating-modal-steps").removeClass("active");
				$(".rating-modal-steps#step-3").addClass("active");
			}
		});

		$(document).on("click", "#upgrade-review-button", function(){            
			$("#rating-modal-popup").hide();
			var review_reminder = ($('.upgrade-review-reminder').length >= 1) ? $('.upgrade-review-reminder').val(): "-1";		
			jQuery.ajax({
				type:'post',
				url: mystickymenu.ajaxurl,
				data: {
					action: "mystickymenu_review_box_message",
					rating: $("#mystickymenu-rated-rating .jq-star").length,
					nonce: mystickymenu.ajax_nonce,
					message: $.trim($("#upgrade-review-comment").val())
				},
				success: function() {				
					set_mystickymenu_review_reminder(review_reminder);
				}
			});
		});
		
		
		function set_mystickymenu_review_reminder(noOfDays) {		
			$.ajax({
				type: "post",
				url: mystickymenu.ajaxurl,
				data: {
					action: "mystickymenu_review_box",
					days: noOfDays,
					nonce: mystickymenu.ajax_nonce
				},
			   
				success: function() {
					
				}
			});
			$("#rating-modal-popup").remove();
		}
		
		$(document).on("click", ".mystickymenu-popup-form", function( e ){
			if ( $(e.target).attr('id') == 'rating-modal-popup' ) {
				let step_id = $( '#rating-modal-popup .rating-modal-steps.active' ).attr( 'id') ;
				
				if ( step_id == 'step-1' ) {
					$(".rating-modal-steps").removeClass("active");
					$(".rating-modal-steps#step-3").addClass("active");
				}
				
				if ( step_id == 'step-3' ) {
					$('#upgrade-review-reminder option[value="14"]').attr("selected", "selected");
					$( "#upgrade-review-button" ).trigger( 'click');
				}
			}
			
		});
		$(".welcomebar-full-screen-btn").click(function(){
			var windowHeight = $(window).height()* 0.73;
			$('.mysticky-welcomebar-preview-screen').css('height', windowHeight + 'px');
		});
		$(".welcomebar-minimise-screen-btn").click(function(){
			$('.mysticky-welcomebar-preview-screen').removeAttr("style");
		});
		
		/*
		 * Bar Tab
		 */
		$( document ).on( 'click', '.mystickybar-tabs .mystickybar-tab', function(){
			let tab 	= $(this).data( 'tab' );
			let tabid 	= $(this).data( 'tab-id' );
			
			$( '.mystickybar-tabs .mystickybar-tab').removeClass( 'mystickybar-tab-active' );
			$( this).addClass( 'mystickybar-tab-active mystickybar-tab-completed');
			$( '.mystickybar-tab-content').removeClass('mystickybar-active active');
			$( '#' + tabid).addClass('mystickybar-active active');
			$( '#mystickybar-widget-body-tab .mystickybar-preview-section').show();
			if( tab == 'first') {
				$( '.mystickybar-back-button').addClass( 'disabled' );
				$( '.mystickybar-next-button').removeClass( 'disabled' );
				
				$('#mystickybar-display-rules').removeClass( 'mystickybar-tab-completed' );
				$('#mystickybar-poptin-popups').removeClass( 'mystickybar-tab-completed' );
			} else if( tab == 'middle' ) {
				$( '.mystickybar-back-button').removeClass( 'disabled' );
				$( '.mystickybar-next-button').removeClass( 'disabled' );				
				$('#mystickybar-poptin-popups').removeClass( 'mystickybar-tab-completed' );
			} else {
				$( '.mystickybar-back-button').removeClass( 'disabled' );
				$( '.mystickybar-next-button').addClass( 'disabled' );
				$('#mystickybar-display-rules').addClass( 'mystickybar-tab-completed' );
				$( '#mystickybar-widget-body-tab .mystickybar-preview-section').hide();				
			}
		});
		
		/*
		 * Next Button
		 */
		$( document ).on( 'click', '.mystickybar-tabs-buttons .mystickybar-next-button', function(){
			let tab_index 	= $('.mystickybar-tab.mystickybar-tab-active').data( 'tab-index' ) + 1;			
			let tab_id 		= $('.mystickybar-tab[data-tab-index="'+ tab_index+'"]').attr( 'id' );
			$( '#' +tab_id ).trigger( 'click' );
		});
		
		/*
		 * Back Button
		 */
		$( document ).on( 'click', '.mystickybar-tabs-buttons .mystickybar-back-button', function(){
			let tab_index 	= $('.mystickybar-tab.mystickybar-tab-active').data( 'tab-index' ) - 1;			
			let tab_id 		= $('.mystickybar-tab[data-tab-index="'+ tab_index+'"]').attr( 'id' );
			$( '#' +tab_id ).trigger( 'click' );
		});
		
		$( document ).on( 'click', '.mysticky-welcomebar-preview-wrap.mysticky-welcomebar-full-screen-preview-body .mysticky-welcomebar-close', function(){
			$( '.welcomebar-minimise-screen-btn' ).trigger( 'click' );
		});
		
		$( document).on("change", "#mysticky-welcomebar-postion-relative-text", function(){
			let button_text_postion = $('input[name="mysticky_option_welcomebar[mysticky_welcomebar_button_text_postion]"]:checked').val();
			if( $(this).prop("checked") == true ){
				$("#mysticky-welcomebar-button-text-postion").show();				
				$('.mysticky-welcomebar-preview-screen .mysticky-welcomebar-fixed-wrap').addClass( 'mysticky-welcomebar-position-' + button_text_postion );
			}else{
				$("#mysticky-welcomebar-button-text-postion").hide();
				$('.mysticky-welcomebar-preview-screen .mysticky-welcomebar-fixed-wrap').removeClass( 'mysticky-welcomebar-position-' + button_text_postion );
			}
		});
		
		$( document).on("change", 'input[name="mysticky_option_welcomebar[mysticky_welcomebar_button_text_postion]"]', function(){
			let button_text_postion = $( this ).val();
			
			$('.mysticky-welcomebar-preview-screen .mysticky-welcomebar-fixed-wrap').removeClass( 'mysticky-welcomebar-position-center mysticky-welcomebar-position-left mysticky-welcomebar-position-right '  );
			
			$('.mysticky-welcomebar-preview-screen .mysticky-welcomebar-fixed-wrap').addClass( 'mysticky-welcomebar-position-' + button_text_postion );
		});
		
	});
	
})(jQuery);
