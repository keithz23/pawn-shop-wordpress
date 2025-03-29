<?php
/**
 * MSB Bar Settings
 *
 * @author  : Premio <contact@premio.io>
 * @license : GPL2
 * */

if (defined('ABSPATH') === false) {
    exit;
}
$upgarde_url 	= admin_url("admin.php?page=my-stickymenu-upgrade");
$nonce 			= wp_create_nonce('mysticky_option_welcomebar_update');
$nonce_reset 	= wp_create_nonce('mysticky_option_welcomebar_reset');

$welcomebar = get_option( 'mysticky_option_welcomebar' );

if ( $welcomebar == '' || empty($welcomebar)) {
	$welcomebar = mysticky_welcomebar_pro_widget_default_fields();
}
$welcomebar["mysticky_welcomebar_x_color"] = (isset($welcomebar["mysticky_welcomebar_x_color"]) ) ? esc_attr($welcomebar["mysticky_welcomebar_x_color"]) : '#000000';

$welcomebar['mysticky_welcomebar_bgcolor'] = ( isset($welcomebar['mysticky_welcomebar_bgcolor']) ) ? esc_attr($welcomebar['mysticky_welcomebar_bgcolor']) : '#03ed96';

$welcomebar['mysticky_welcomebar_bgtxtcolor'] = ( isset($welcomebar['mysticky_welcomebar_bgtxtcolor']) ) ? esc_attr($welcomebar['mysticky_welcomebar_bgtxtcolor']) : '#000000';

$welcomebar['mysticky_welcomebar_bar_text'] = (isset($welcomebar['mysticky_welcomebar_bar_text']) ) ? $welcomebar['mysticky_welcomebar_bar_text'] : 'Get 30% off your first purchase';

$welcomebar['mysticky_welcomebar_btntxtcolor'] = (isset($welcomebar['mysticky_welcomebar_btntxtcolor'])) ? esc_attr($welcomebar['mysticky_welcomebar_btntxtcolor']) : '#ffffff';

$welcomebar['mysticky_welcomebar_btnhovertxtcolor'] = ( isset($welcomebar['mysticky_welcomebar_btnhovertxtcolor']) ) ? esc_attr($welcomebar['mysticky_welcomebar_btnhovertxtcolor']) : '#000000';
$welcomebar['mysticky_welcomebar_btnhoverbordercolor'] = (isset($welcomebar['mysticky_welcomebar_btnhoverbordercolor'])) ? esc_attr($welcomebar['mysticky_welcomebar_btnhoverbordercolor']) : '#000000';
$welcomebar['mysticky_welcomebar_btnhovercolor'] = (isset($welcomebar['mysticky_welcomebar_btnhovercolor'])) ? esc_attr($welcomebar['mysticky_welcomebar_btnhovercolor']) : '#ffffff';

$welcomebar['mysticky_welcomebar_btncolor'] = (isset($welcomebar['mysticky_welcomebar_btncolor']) && $welcomebar['mysticky_welcomebar_btncolor'] != '' ) ? esc_attr($welcomebar['mysticky_welcomebar_btncolor']) : '';
$welcomebar['mysticky_welcomebar_attentionselect'] = isset($welcomebar['mysticky_welcomebar_attentionselect']) ? esc_attr($welcomebar['mysticky_welcomebar_attentionselect']) : '';

$welcomebar['mysticky_welcomebar_enable'] = isset($welcomebar['mysticky_welcomebar_enable']) ? esc_attr($welcomebar['mysticky_welcomebar_enable']) : '';

$welcomebar['mysticky_welcomebar_show_success_message'] = isset($welcomebar['mysticky_welcomebar_show_success_message']) ? esc_attr($welcomebar['mysticky_welcomebar_show_success_message']) : '';
$mysticky_welcomebar_showx_desktop = $mysticky_welcomebar_showx_mobile = '';
$mysticky_welcomebar_btn_desktop = $mysticky_welcomebar_btn_mobile = '';
$mysticky_welcomebar_display_desktop = $mysticky_welcomebar_display_mobile = '';
if( isset($welcomebar['mysticky_welcomebar_x_desktop']) ) {
	$mysticky_welcomebar_showx_desktop = ' mysticky-welcomebar-showx-desktop';
}
if( isset($welcomebar['mysticky_welcomebar_x_mobile']) ) {
	$mysticky_welcomebar_showx_mobile = ' mysticky-welcomebar-showx-mobile';
}
if( isset($welcomebar['mysticky_welcomebar_btn_desktop']) ) {
	$mysticky_welcomebar_btn_desktop = ' mysticky-welcomebar-btn-desktop';
}
if( isset($welcomebar['mysticky_welcomebar_btn_mobile']) ) {
	$mysticky_welcomebar_btn_mobile = ' mysticky-welcomebar-btn-mobile';
}

if( !isset($welcomebar['mysticky_welcomebar_redirect_rel']) ) {
	$welcomebar['mysticky_welcomebar_redirect_rel'] = '';
}
$display = ' mysticky-welcomebar-attention-'. ( isset($welcomebar['mysticky_welcomebar_attentionselect']) ? esc_attr($welcomebar['mysticky_welcomebar_attentionselect']) : '' );
$display_entry_effect = (isset($welcomebar['mysticky_welcomebar_entry_effect'])) ? ' mysticky-welcomebar-entry-effect-'.esc_attr($welcomebar['mysticky_welcomebar_entry_effect']) : ' mysticky-welcomebar-entry-effect-slide-in';
$welcomebar['mysticky_welcomebar_position'] = isset($welcomebar['mysticky_welcomebar_position']) ? esc_attr($welcomebar['mysticky_welcomebar_position']) : 'top';
$display_main_class = "mysticky-welcomebar-position-" . $welcomebar['mysticky_welcomebar_position'] . $mysticky_welcomebar_showx_desktop . $mysticky_welcomebar_showx_mobile . $mysticky_welcomebar_btn_desktop . $mysticky_welcomebar_btn_mobile . $display . $display_entry_effect;

$welcomebar['mysticky_welcomebar_text_type'] = (isset($welcomebar['mysticky_welcomebar_text_type']) && $welcomebar['mysticky_welcomebar_text_type'] != '' ) ? esc_attr($welcomebar['mysticky_welcomebar_text_type']) : "static_text";
$welcomebar['mysticky_welcomebar_slider_text'] = (isset($welcomebar['mysticky_welcomebar_slider_text']) && $welcomebar['mysticky_welcomebar_slider_text'] != '' ) ? $welcomebar['mysticky_welcomebar_slider_text'] : [];

$welcomebar['mysticky_welcomebar_slider_transition'] = (isset($welcomebar['mysticky_welcomebar_slider_transition']) && $welcomebar['mysticky_welcomebar_slider_transition'] != '' ) ? esc_attr($welcomebar['mysticky_welcomebar_slider_transition']) : "right";

$welcomebar['mysticky_welcomebar_lead_input'] = (isset($welcomebar['mysticky_welcomebar_lead_input']) && $welcomebar['mysticky_welcomebar_lead_input'] != '' ) ? esc_attr($welcomebar['mysticky_welcomebar_lead_input']) : "email_address";


$welcomebar['lead_name_placeholder'] = (isset($welcomebar['lead_name_placeholder']) && $welcomebar['lead_name_placeholder'] != '' ) ? stripslashes($welcomebar['lead_name_placeholder']) : "Name";

$welcomebar['lead_email_placeholder'] = (isset($welcomebar['lead_email_placeholder']) &&$welcomebar['lead_email_placeholder'] != '' ) ? stripslashes($welcomebar['lead_email_placeholder']) : "Email";

$welcomebar['lead_phone_placeholder'] = (isset($welcomebar['lead_phone_placeholder']) &&$welcomebar['lead_phone_placeholder'] != '' ) ? stripslashes($welcomebar['lead_phone_placeholder']) : "Phone";

$welcomebar['mysticky_welcomebar_enable_lead'] = (isset($welcomebar['mysticky_welcomebar_enable_lead']) && $welcomebar['mysticky_welcomebar_enable_lead'] != '' ) ? esc_attr($welcomebar['mysticky_welcomebar_enable_lead']) : 0;

$welcomebar['mysticky_welcomebar_hover_effect'] = (isset($welcomebar['mysticky_welcomebar_hover_effect']) && $welcomebar['mysticky_welcomebar_hover_effect'] != '' ) ? esc_attr($welcomebar['mysticky_welcomebar_hover_effect']) : '';	
$welcomebar['mysticky_welcomebar_hover_fill_effect'] = (isset($welcomebar['mysticky_welcomebar_hover_fill_effect']) && $welcomebar['mysticky_welcomebar_hover_fill_effect'] != '' ) ? esc_attr($welcomebar['mysticky_welcomebar_hover_fill_effect']) : '';
$welcomebar['mysticky_welcomebar_hover_fill_effect'] = (isset($welcomebar['mysticky_welcomebar_hover_fill_effect']) && $welcomebar['mysticky_welcomebar_hover_fill_effect'] != '' ) ? esc_attr($welcomebar['mysticky_welcomebar_hover_fill_effect']) : '';
$welcomebar['mysticky_welcomebar_hover_border_effect'] = (isset($welcomebar['mysticky_welcomebar_hover_border_effect']) && $welcomebar['mysticky_welcomebar_hover_border_effect'] != '' ) ? esc_attr($welcomebar['mysticky_welcomebar_hover_border_effect']) : '';
$welcomebar['user_target'] = (isset($welcomebar['user_target']) && $welcomebar['user_target'] != '' ) ? esc_attr($welcomebar['user_target']) : '';

$welcomebar['mysticky_welcomebar_button_postion_relative_text'] = (isset($welcomebar['mysticky_welcomebar_button_postion_relative_text']) ) ? esc_attr($welcomebar['mysticky_welcomebar_button_postion_relative_text']) : '';
$welcomebar['mysticky_welcomebar_button_text_postion'] = (isset($welcomebar['mysticky_welcomebar_button_text_postion']) ) ? esc_attr($welcomebar['mysticky_welcomebar_button_text_postion']) : 'center';


$countries = array(array("short_name" => "AF", "country_name" => "Afghanistan"), array("short_name" => "AL", "country_name" => "Albania"), array("short_name" => "DZ", "country_name" => "Algeria"), array("short_name" => "AD", "country_name" => "Andorra"), array("short_name" => "AO", "country_name" => "Angola"), array("short_name" => "AI", "country_name" => "Anguilla"), array("short_name" => "AG", "country_name" => "Antigua and Barbuda"), array("short_name" => "AR", "country_name" => "Argentina"), array("short_name" => "AM", "country_name" => "Armenia"), array("short_name" => "AW", "country_name" => "Aruba"), array("short_name" => "AU", "country_name" => "Australia"), array("short_name" => "AT", "country_name" => "Austria"), array("short_name" => "AZ", "country_name" => "Azerbaijan"), array("short_name" => "BS", "country_name" => "Bahamas"), array("short_name" => "BH", "country_name" => "Bahrain"), array("short_name" => "BD", "country_name" => "Bangladesh"), array("short_name" => "BB", "country_name" => "Barbados"), array("short_name" => "BY", "country_name" => "Belarus"), array("short_name" => "BE", "country_name" => "Belgium"), array("short_name" => "BZ", "country_name" => "Belize"), array("short_name" => "BJ", "country_name" => "Benin"), array("short_name" => "BM", "country_name" => "Bermuda"), array("short_name" => "BT", "country_name" => "Bhutan"), array("short_name" => "BO", "country_name" => "Bolivia"), array("short_name" => "BA", "country_name" => "Bosnia and Herzegowina"), array("short_name" => "BW", "country_name" => "Botswana"), array("short_name" => "BV", "country_name" => "Bouvet Island"), array("short_name" => "BR", "country_name" => "Brazil"), array("short_name" => "IO", "country_name" => "British Indian Ocean Territory"), array("short_name" => "BN", "country_name" => "Brunei Darussalam"), array("short_name" => "BG", "country_name" => "Bulgaria"), array("short_name" => "BF", "country_name" => "Burkina Faso"), array("short_name" => "BI", "country_name" => "Burundi"), array("short_name" => "KH", "country_name" => "Cambodia"), array("short_name" => "CM", "country_name" => "Cameroon (Republic of Cameroon)"), array("short_name" => "CA", "country_name" => "Canada"), array("short_name" => "CV", "country_name" => "Cape Verde"), array("short_name" => "KY", "country_name" => "Cayman Islands"), array("short_name" => "CF", "country_name" => "Central African Republic"), array("short_name" => "TD", "country_name" => "Chad"), array("short_name" => "CL", "country_name" => "Chile"), array("short_name" => "CN", "country_name" => "China"), array("short_name" => "CX", "country_name" => "Christmas Island"), array("short_name" => "CC", "country_name" => "Cocos (Keeling) Islands"), array("short_name" => "CO", "country_name" => "Colombia"), array("short_name" => "KM", "country_name" => "Comoros"), array("short_name" => "CG", "country_name" => "Congo"), array("short_name" => "CK", "country_name" => "Cook Islands"), array("short_name" => "CR", "country_name" => "Costa Rica"), array("short_name" => "CI", "country_name" => "Cote D\Ivoire"), array("short_name" => "HR", "country_name" => "Croatia"), array("short_name" => "CU", "country_name" => "Cuba"), array("short_name" => "CY", "country_name" => "Cyprus"), array("short_name" => "CZ", "country_name" => "Czech Republic"), array("short_name" => "DK", "country_name" => "Denmark"), array("short_name" => "DJ", "country_name" => "Djibouti"), array("short_name" => "DM", "country_name" => "Dominica"), array("short_name" => "DO", "country_name" => "Dominican Republic"), array("short_name" => "EC", "country_name" => "Ecuador"), array("short_name" => "EG", "country_name" => "Egypt"), array("short_name" => "SV", "country_name" => "El Salvador"), array("short_name" => "GQ", "country_name" => "Equatorial Guinea"), array("short_name" => "ER", "country_name" => "Eritrea"), array("short_name" => "EE", "country_name" => "Estonia"), array("short_name" => "ET", "country_name" => "Ethiopia"), array("short_name" => "FK", "country_name" => "Falkland Islands (Malvinas)"), array("short_name" => "FO", "country_name" => "Faroe Islands"), array("short_name" => "FJ", "country_name" => "Fiji"), array("short_name" => "FI", "country_name" => "Finland"), array("short_name" => "FR", "country_name" => "France"), array("short_name" => "Me", "country_name" => "Montenegro"), array("short_name" => "GF", "country_name" => "French Guiana"), array("short_name" => "PF", "country_name" => "French Polynesia"), array("short_name" => "TF", "country_name" => "French Southern Territories"), array("short_name" => "GA", "country_name" => "Gabon"), array("short_name" => "GM", "country_name" => "Gambia"), array("short_name" => "GE", "country_name" => "Georgia"), array("short_name" => "DE", "country_name" => "Germany"), array("short_name" => "GH", "country_name" => "Ghana"), array("short_name" => "GI", "country_name" => "Gibraltar"), array("short_name" => "GR", "country_name" => "Greece"), array("short_name" => "GL", "country_name" => "Greenland"), array("short_name" => "GD", "country_name" => "Grenada"), array("short_name" => "GP", "country_name" => "Guadeloupe"), array("short_name" => "GT", "country_name" => "Guatemala"), array("short_name" => "GN", "country_name" => "Guinea"), array("short_name" => "GW", "country_name" => "Guinea bissau"), array("short_name" => "GY", "country_name" => "Guyana"), array("short_name" => "HT", "country_name" => "Haiti"), array("short_name" => "HM", "country_name" => "Heard Island And Mcdonald Islands"), array("short_name" => "HN", "country_name" => "Honduras"), array("short_name" => "HK", "country_name" => "Hong Kong"), array("short_name" => "HU", "country_name" => "Hungary"), array("short_name" => "IS", "country_name" => "Iceland"), array("short_name" => "IN", "country_name" => "India"), array("short_name" => "ID", "country_name" => "Indonesia"), array("short_name" => "IR", "country_name" => "Iran, Islamic Republic Of"), array("short_name" => "IQ", "country_name" => "Iraq"), array("short_name" => "IE", "country_name" => "Ireland"), array("short_name" => "IL", "country_name" => "Israel"), array("short_name" => "IT", "country_name" => "Italy"), array("short_name" => "JM", "country_name" => "Jamaica"), array("short_name" => "JP", "country_name" => "Japan"), array("short_name" => "JO", "country_name" => "Jordan"), array("short_name" => "KZ", "country_name" => "Kazakhstan"), array("short_name" => "KE", "country_name" => "Kenya"), array("short_name" => "KI", "country_name" => "Kiribati"), array("short_name" => "KP", "country_name" => "Korea, Democratic People's Republic Of"), array("short_name" => "KR", "country_name" => "South Korea"), array("short_name" => "KW", "country_name" => "Kuwait"), array("short_name" => "KG", "country_name" => "Kyrgyzstan"), array("short_name" => "LA", "country_name" => "Lao People\s Democratic Republic"), array("short_name" => "LV", "country_name" => "Latvia"), array("short_name" => "LB", "country_name" => "Lebanon"), array("short_name" => "LS", "country_name" => "Lesotho"), array("short_name" => "LR", "country_name" => "Liberia"), array("short_name" => "LY", "country_name" => "Libyan Arab Jamahiriya"), array("short_name" => "LI", "country_name" => "Liechtenstein"), array("short_name" => "LT", "country_name" => "Lithuania"), array("short_name" => "LU", "country_name" => "Luxembourg"), array("short_name" => "MO", "country_name" => "Macao"), array("short_name" => "MK", "country_name" => "Macedonia"), array("short_name" => "MG", "country_name" => "Madagascar"), array("short_name" => "MW", "country_name" => "Malawi"), array("short_name" => "MY", "country_name" => "Malaysia"), array("short_name" => "MV", "country_name" => "Maldives"), array("short_name" => "ML", "country_name" => "Mali"), array("short_name" => "MT", "country_name" => "Malta"), array("short_name" => "MQ", "country_name" => "Martinique"), array("short_name" => "MR", "country_name" => "Mauritania"), array("short_name" => "MU", "country_name" => "Mauritius"), array("short_name" => "YT", "country_name" => "Mayotte"), array("short_name" => "MD", "country_name" => "Moldova"), array("short_name" => "MC", "country_name" => "Monaco"), array("short_name" => "MN", "country_name" => "Mongolia"), array("short_name" => "MS", "country_name" => "Montserrat"), array("short_name" => "MA", "country_name" => "Morocco"), array("short_name" => "MZ", "country_name" => "Mozambique"), array("short_name" => "MM", "country_name" => "Myanmar"), array("short_name" => "NA", "country_name" => "Namibia"), array("short_name" => "NR", "country_name" => "Nauru"), array("short_name" => "NP", "country_name" => "Nepal"), array("short_name" => "NL", "country_name" => "Netherlands"), array("short_name" => "AN", "country_name" => "Netherlands Antilles"), array("short_name" => "NC", "country_name" => "New Caledonia"), array("short_name" => "NZ", "country_name" => "New Zealand"), array("short_name" => "NI", "country_name" => "Nicaragua"), array("short_name" => "NE", "country_name" => "Niger"), array("short_name" => "NG", "country_name" => "Nigeria"), array("short_name" => "NU", "country_name" => "Niue"), array("short_name" => "NF", "country_name" => "Norfolk Island"), array("short_name" => "NO", "country_name" => "Norway"), array("short_name" => "OM", "country_name" => "Oman"), array("short_name" => "PK", "country_name" => "Pakistan"), array("short_name" => "PA", "country_name" => "Panama"), array("short_name" => "PG", "country_name" => "Papua New Guinea"), array("short_name" => "PY", "country_name" => "Paraguay"), array("short_name" => "PE", "country_name" => "Peru"), array("short_name" => "PH", "country_name" => "Philippines"), array("short_name" => "PN", "country_name" => "Pitcairn"), array("short_name" => "PL", "country_name" => "Poland"), array("short_name" => "PT", "country_name" => "Portugal"), array("short_name" => "QA", "country_name" => "Qatar"), array("short_name" => "RE", "country_name" => "Reunion"), array("short_name" => "RO","country_name" => "Romania"), array("short_name" => "RU", "country_name" => "Russia"), array("short_name" => "RW", "country_name" => "Rwanda"), array("short_name" => "KN", "country_name" => "Saint Kitts and Nevis"), array("short_name" => "LC", "country_name" => "Saint Lucia"), array("short_name" => "VC", "country_name" => "St. Vincent"), array("short_name" => "WS", "country_name" => "Samoa"), array("short_name" => "SM", "country_name" => "San Marino"), array("short_name" => "ST", "country_name" => "Sao Tome and Principe"), array("short_name" => "SA", "country_name" => "Saudi Arabia"), array("short_name" => "SN", "country_name" => "Senegal"), array("short_name" => "SC", "country_name" => "Seychelles"), array("short_name" => "SL", "country_name" => "Sierra Leone"), array("short_name" => "SG", "country_name" => "Singapore"), array("short_name" => "SK", "country_name" => "Slovakia"), array("short_name" => "SI", "country_name" => "Slovenia"), array("short_name" => "SB", "country_name" => "Solomon Islands"), array("short_name" => "SO", "country_name" => "Somalia"), array("short_name" => "ZA", "country_name" => "South Africa"), array("short_name" => "GS", "country_name" => "South Georgia & South Sandwich Islands"), array("short_name" => "ES", "country_name" => "Spain"), array("short_name" => "LK", "country_name" => "Sri Lanka"), array("short_name" => "SH", "country_name" => "Saint Helena"), array("short_name" => "PM", "country_name" => "Saint Pierre And Miquelon"), array("short_name" => "SD", "country_name" => "Sudan"), array("short_name" => "SR", "country_name" => "Suriname"), array("short_name" => "SJ", "country_name" => "Svalbard And Jan Mayen"), array("short_name" => "SZ", "country_name" => "Swaziland"), array("short_name" => "SE", "country_name" => "Sweden"), array("short_name" => "CH", "country_name" => "Switzerland"), array("short_name" => "SY", "country_name" => "Syria"), array("short_name" => "TW", "country_name" => "Taiwan"), array("short_name" => "TJ", "country_name" => "Tajikistan"), array("short_name" => "TZ", "country_name" => "Tanzania, United Republic Of"), array("short_name" => "TH", "country_name" => "Thailand"), array("short_name" => "TG", "country_name" => "Togo"), array("short_name" => "TK", "country_name" => "Tokelau"), array("short_name" => "TO", "country_name" => "Tonga"), array("short_name" => "TT", "country_name" => "Trinidad and Tobago"), array("short_name" => "TN", "country_name" => "Tunisia"), array("short_name" => "TR", "country_name" => "Turkey"), array("short_name" => "TM", "country_name" => "Turkmenistan"), array("short_name" => "TC", "country_name" => "Turks and Caicos Islands"), array("short_name" => "TV", "country_name" => "Tuvalu"), array("short_name" => "UG", "country_name" => "Uganda"), array("short_name" => "UA", "country_name" => "Ukraine"), array("short_name" => "AE", "country_name" => "United Arab Emirates"), array("short_name" => "GB", "country_name" => "United Kingdom"), array("short_name" => "US", "country_name" => "United States"), array("short_name" => "UM", "country_name" => "United States Minor Outlying Islands"), array("short_name" => "UY", "country_name" => "Uruguay"), array("short_name" => "UZ", "country_name" => "Uzbekistan"), array("short_name" => "VU", "country_name" => "Vanuatu"), array("short_name" => "VA", "country_name" => "Holy See (Vatican City State)"), array("short_name" => "VE", "country_name" => "Venezuela"), array("short_name" => "VN", "country_name" => "Vietnam"), array("short_name" => "VG", "country_name" => "Virgin Islands (British)"), array("short_name" => "WF", "country_name" => "Wallis and Futuna Islands"), array("short_name" => "EH", "country_name" => "Western Sahara"), array("short_name" => "YE", "country_name" => "Yemen"), array("short_name" => "ZM", "country_name" => "Zambia"), array("short_name" => "ZW", "country_name" => "Zimbabwe"), array("short_name" => "AX", "country_name" => "Aland Islands"), array("short_name" => "CD", "country_name" => "Congo, The Democratic Republic Of The"), array("short_name" => "CW", "country_name" => "Curaçao"), array("short_name" => "GG", "country_name" => "Guernsey"), array("short_name" => "IM", "country_name" => "Isle Of Man"), array("short_name" => "JE", "country_name" => "Jersey"), array("short_name" => "KV", "country_name" => "Kosovo"), array("short_name" => "PS", "country_name" => "Palestinian Territory"), array("short_name" => "BL", "country_name" => "Saint Barthélemy"), array("short_name" => "MF", "country_name" => "Saint Martin"), array("short_name" => "RS", "country_name" => "Serbia"), array("short_name" => "SX", "country_name" => "Sint Maarten"), array("short_name" => "TL", "country_name" => "Timor Leste"), array("short_name" => "MX", "country_name" => "Mexico"));
$selected_countries = (isset($welcomebar['countries_list'])) ? $welcomebar['countries_list'] : '' ;
$selected_countries = ( $selected_countries === false || empty($selected_countries) || !is_array($selected_countries) ) ? array() : $selected_countries;
$count = count($selected_countries);
$countries_message =  "All countries";
if($count == 1) {
	$countries_message = "1 country selected";
} else if($count > 1){
	$countries_message = $count." countries selected";
}

?>

<div id="loader" class="center" style="display:none;"><svg  version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve" style="width:150px;height:150px;"><path fill="#fff" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50"><animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite"></animateTransform></path></svg></div>

<div id="mystickybar-container" class="mystickybar-container">	
	<form class="mysticky-welcomebar-form" id="mysticky_welcomebar_form" method="post" action="<?php echo admin_url('admin.php?page=my-stickymenu-welcomebar&save=1&widget=0');?>">
		<div class="mystickybar-header mystickybar-logo z-50 flex gap-3 items-center justify-between bg-white p-1.5 fixed top-0 left-0 w-full" id="mystickybar-header-tab-label">
			<a href="<?php echo esc_url( admin_url( 'admin.php?page=my-stickymenu-welcomebar' ) ) ?>">
				<img class="max-w-[100px]" src="<?php echo esc_url(MYSTICKYMENU_URL.'images/logo-color.svg'); ?>" alt="mystickymenu" class="logo">				
			</a>
			<div class="header-items flex-1">
				<ul class="mystickybar-tabs flex items-start justify-between">
					<li class="mystickybar-tab-li m-0">
						<a class="mystickybar-tab mystickybar-tab-completed mystickybar-tab-active" id="mystickybar-customize-bar" data-tab-id="mystickybar-tab-customize-bar" data-tab="first" data-tab-index="1">
							<span class="mystickybar-tabs-heading"></span>
							<span class="mystickybar-tabs-subheading"><?php esc_html_e("1. Customize Bar", "mystickymenu") ?></span>                               
						</a>
					</li>
					<li class="mystickybar-tab-li m-0">
						<a class="mystickybar-tab" id="mystickybar-display-rules" data-tab-id="mystickybar-tab-display-rules" data-tab="middle" data-tab-index="2">
							<span class="mystickybar-tabs-heading"></span>
							<span class="mystickybar-tabs-subheading"><?php esc_html_e("2. Display rules", "mystickymenu") ?></span>                               
						</a>
					</li>
					
					<li class="mystickybar-tab-li m-0">
						<a class="mystickybar-tab" id="mystickybar-poptin-popups" data-tab-id="mystickybar-tab-poptin-popups" data-tab="last" data-tab-index="3">
							<span class="mystickybar-tabs-heading"></span>
							<span class="mystickybar-tabs-subheading"><?php esc_html_e("3. Poptin Popups", "mystickymenu") ?></span>                               
						</a>
					</li>
				</ul>
			</div>
			<div class="mystickybar-tabs-buttons relative space-x-2">
				<button type="button" class="btn btn-primary-outline flex mystickybar-back-button disabled" id="mystickybar-back-button">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
						<path d="M15.8333 10H4.16668" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M10 15.8333L4.16668 9.99996L10 4.16663" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<span><?php esc_html_e("Back", "mystickymenu") ?></span>
				</button>
				
				<button type="button" class="btn btn-primary-outline flex mystickybar-next-button" id="mystickybar-next-button">
					<span><?php esc_html_e("Next", "mystickymenu") ?></span>
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
						<path d="M4.16677 10H15.8334" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M10.0001 4.16663L15.8334 9.99996L10.0001 15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</button>
				<span class="save-button-container">
					<button type="submit" class="btn btn-primary button button-primary save_view_dashboard save-button whitespace-nowrap" id="submit" name="submit">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
							<path d="M15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V4.16667C2.5 3.72464 2.67559 3.30072 2.98816 2.98816C3.30072 2.67559 3.72464 2.5 4.16667 2.5H13.3333L17.5 6.66667V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5Z" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M14.1666 17.5V10.8334H5.83331V17.5" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M5.83331 2.5V6.66667H12.5" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>						
						<span class="mobile-text"><?php esc_html_e("Save & View Dashboard", "mystickymenu") ?></span>
					</button>					
				<span>
			</div>
		</div>
		
		<section class="mystickybar-widget-tabs-content" id="mystickybar-widget-body-tab" >
			<div class="mystickybar-column">
				<?php 
					include_once( 'customize-bar.php');
					include_once( 'display-rules.php');
					include_once( 'poptin-popup.php');
				?>
			</div>
			<div class="mystickybar-preview-section">
				<?php include_once( 'bar-preview.php');?>
			</div>
		</section>
		
		<input type="hidden" name="nonce" value="<?php echo esc_attr($nonce); ?>">
		<input type="hidden" name="active_tab_element" value="1">
		<input type="hidden" name="widget_no" value="0">
		<input type="hidden" id="save_welcome_bar" name="save_welcome_bar" >
	</form>
</div>

<div class="mystickymenu-action-popup new-center" id="welcomebar-save-confirm" style="display:none;">
	<div class="mystickymenu-action-popup-header">
		<h3><?php esc_html_e("Bar is currently off","mystickymenu"); ?></h3>
		<span class="dashicons dashicons-no-alt close-button" data-from = "welcombar-confirm"></span>
	</div>
	<div class="mystickymenu-action-popup-body">
		<p><?php esc_html_e("Your Bar is currently turned off, would you like to save and show it on your site?","mystickymenu"); ?></p>
	</div>
	<div class="mystickymenu-action-popup-footer">
		<button type="button" class="btn-enable btn-nevermind-status" id="welcombar_sbmtbtn_off" ><?php esc_html_e("Just save and keep it off","mystickymenu"); ?></button>
		<button type="button" class="btn-disable-cancel btn-turnoff-status button-save-turnon" id="welcomebar_yes_sbmtbtn" style="background:#00c67c;border-color:#00c67c;"><?php esc_html_e("Save & Turn on Bar","mystickymenu"); ?></button>
	</div>
</div>
<div class="mystickymenupopup-overlay" id="welcombar-sbmtvalidation-overlay-popup"></div>

<div id="mysticky-welcomebar-poptin-popup-confirm" style="display:none;" title="<?php esc_attr_e( 'Poptin pop-up is not configured properly', 'mystickymenu' ); ?>">
	<p>
		Seems like you haven't filled up the Poptin pop-up direct link field properly. Please <a href="https://help.poptin.com/article/show/72942-how-to-show-a-poptin-when-the-visitor-clicks-on-a-button-link-on-your-site" target="_blank">check the guide</a> to know how you can copy direct link of a pop-up from Poptin.
	</p>
</div>