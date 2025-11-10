<?php

/*
 * Plugin Name:       GWS Site Details
 * Plugin URI:        https://www.gwsmedia.com/
 * Description:       Adds a new admin menu to your WordPress dashboard, allowing you to easily manage and update your contact details and social media links.
 * Version:           1.0
 * Author:            GWS Media
 * Author URI:        https://www.gwsmedia.com/
 * License:           GPL2
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       gws-site-details
 * Domain Path:       /languages
 * Requires PHP:      7.0
 * Requires at least: 6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Load shortcodes
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';


// Site details dashboard menu with fields (phone, email, address, social media links, etc)
function gws_site_details() {
	add_menu_page(
		__( 'Site Details', 'gws-site-details' ), // Specifies the page title in the browser's tab and the text domain (used for translations)
		__( 'Site Details', 'gws-site-details' ), // Specifies the menu title in the admin dashboard and the text domain (used for translations)
		'edit_theme_options',                     // Specifies the minimum user permissions required to access the content and edit this menu item
		'site-details',                           // Specifies the menu page URL
		'gws_site_details_contents',              // Specifies the callback function that outputs the content of the page when the menu item is clicked (defined right below)
		'dashicons-admin-settings',               // Specifies the icon to display next to the menu item in the admin dashboard
		75                                        // Specifies the position in the admin dashboard where this item will appear
	);
}
add_action( 'admin_menu', 'gws_site_details' );

function gws_site_details_contents() {
	
	$contents_keys = [
		'details_announcement_bar',
		'details_announcement_message',
		'details_announcement_button_text',
		'details_announcement_button_link',
		'details_phone',
		'details_phone_alt',
		'details_email',
		'details_email_subject',
		'details_address',
		'details_address_map',
		'details_sm_facebook',
		'details_sm_instagram',
		'details_sm_linkedin',
		'details_sm_x',		
		'details_sm_youtube'
	];

	if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
		foreach ( $contents_keys as $key ) {
			if ( isset( $_POST[ $key ] ) ) {
				// Handle checkbox field correctly
				if ( 'details_announcement_bar' === $key ) {
					set_theme_mod( $key, 1 ); // Checkbox is checked
				} else {
					set_theme_mod( $key, $_POST[ $key ] ); // Other fields
				}
			} else {
				// If checkbox is not set (unchecked), set it to false
				if ( 'details_announcement_bar' === $key ) {
					set_theme_mod( $key, 0 ); // Checkbox is unchecked
				}
			}
		}

		if ( ! isset( $_REQUEST[ '_wpnonce' ] ) || ! wp_verify_nonce( $_REQUEST[ '_wpnonce' ], 'save_site_details' ) ) {
			return;
		}

		foreach ( $contents_keys as $key ) {
			set_theme_mod( $key, $_POST[ $key ] );
		}
	}

	$contents = [];
	foreach ( $contents_keys as $key ) {
		$contents[ $key ] = get_theme_mod( $key );
	}

	$site_url = get_bloginfo( 'url' );
	$site_url_clean = preg_replace( '#^https?://#i', '', $site_url );
	
	?>

	<style>

	#flush_all{display:none}#main-content{position:relative;padding-right:20px;padding-left:10px}#intro.container{width:100%;border-radius:0;margin-top:0;margin-left:-20px}.container{border-radius:8px;background:#fff;padding:20px;margin-top:30px;box-shadow:0 1px 2px rgba(16,24,40,10%);overflow:hidden}.container fieldset:nth-child(2){margin-bottom:0}.container fieldset:nth-child(3){margin-top:24px}.container fieldset:last-child{margin-bottom:0}h1,h2{position:relative;display:flex;align-items:center;padding-bottom:20px;margin-top:0}h1{font-size:23px;font-weight:400;margin-bottom:20px}h1::after,h2::after{content:"";position:absolute;bottom:-1px;left:calc(50% - 50vw);display:block;width:100vw;border-bottom:1px solid #c3c4c7}a{display:inline-flex;align-items:center}a[target="_blank"]::after{content:"";display:inline-block;height:14px;width:14px;background:#2271b1;-webkit-mask-image:var(--mask);mask-image:var(--mask);mask-repeat:no-repeat;mask-size:100%;mask-position:50% 50%;margin-left:2px;--mask:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='%2300000'%3E%3Cpath d='M210.78-109.78q-42.24 0-71.62-29.38-29.38-29.38-29.38-71.62v-538.44q0-42.24 29.38-71.62 29.38-29.38 71.62-29.38H477v101H210.78v538.44h538.44V-477h101v266.22q0 42.24-29.38 71.62-29.38 29.38-71.62 29.38H210.78ZM407.02-337 337-407.02l342.19-342.2H552v-101h298.22V-552h-101v-127.19L407.02-337Z'/%3E%3C/svg%3E")}a[target="_blank"]:hover::after{background:#135e96}fieldset{display:block;width:100%;margin-bottom:24px}.announcement-fields{display:none}.label-content{margin-bottom:10px}label{display:inline-flex;align-items:center;font-size:14px;font-weight:600}label span{font-weight:400;margin-left:4px}.tooltip{position:relative;display:inline-block}.tooltip:hover label{cursor:help}.tooltip-text{position:absolute;top:-35px;left:calc(100% - 20px);max-width:320px;width:max-content;border-radius:3px;color:#fff;background-color:#1d2327;padding:6px;filter:drop-shadow(3px 3px 3px rgba(0,0,0,20%));visibility:hidden;z-index:1}.tooltip-text code{background:rgba(255,255,255,15%)}.tooltip-text::after{content:"";position:absolute;left:6px;bottom:-11px;border:solid 6px #fff0;border-top-color:#1d2327}.tooltip:hover .tooltip-text{visibility:visible}p.description{margin-top:5px}.input-wrapper{position:relative;display:flex}input{display:block;width:100%;min-height:30px!important;font-size:14px!important;padding:0 8px 0 26px!important;margin:0!important}input[type="checkbox"],input[type="radio"]{height:20px!important;min-height:20px!important;width:20px!important;min-width:20px!important;margin-right:6px!important;overflow:hidden!important}input[type=checkbox]:checked::before{content:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M14.83 4.89l1.34.94-5.81 8.38H9.02L5.78 9.67l1.34-1.25 2.57 2.4z' fill='%23fff'/%3E%3C/svg%3E");height:22px!important;width:22px!important;background:#2271b1!important;margin:-2px -3px!important}::placeholder{color:#000;opacity:30%}::-ms-input-placeholder{color:#000;opacity:35%}h2 .icon{position:relative;top:0;left:0;height:24px;width:24px;margin-right:8px}h2 .icon::after{background:#98a2b3}.icon{display:inline-flex;position:absolute;top:7px;left:7px;height:16px;width:16px}.icon.help{position:unset}.icon::after{content:""!important;height:100%;width:100%;background:#8c8f94;-webkit-mask-image:var(--mask);mask-image:var(--mask);mask-repeat:no-repeat;mask-size:100%;mask-position:50% 50%}button{position:absolute;top:14px;right:20px;z-index:99}.announcement-bar::after{--mask:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='%2300000'%3E%3Cpath d='M640-440v-80h160v80H640Zm48 280-128-96 48-64 128 96-48 64Zm-80-480-48-64 128-96 48 64-128 96ZM120-360v-240h160l200-200v640L280-360H120Zm280-246-86 86H200v80h114l86 86v-252ZM300-480Z'/%3E%3C/svg%3E")}.contact-details::after{--mask:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='%2300000'%3E%3Cpath d='M560-440h200v-80H560v80Zm0-120h200v-80H560v80ZM200-320h320v-22q0-45-44-71.5T360-440q-72 0-116 26.5T200-342v22Zm160-160q33 0 56.5-23.5T440-560q0-33-23.5-56.5T360-640q-33 0-56.5 23.5T280-560q0 33 23.5 56.5T360-480ZM160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm0-80h640v-480H160v480Zm0 0v-480 480Z'/%3E%3C/svg%3E")}.social-media::after{--mask:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='%2300000'%3E%3Cpath d='M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480v58q0 59-40.5 100.5T740-280q-35 0-66-15t-52-43q-29 29-65.5 43.5T480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480v58q0 26 17 44t43 18q26 0 43-18t17-44v-58q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93h200v80H480Zm0-280q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Z'/%3E%3C/svg%3E")}.help::after{background:#2271b1;--mask:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='%2300000'%3E%3Cpath d='M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z'/%3E%3C/svg%3E")}.text::after{--mask:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='%2300000'%3E%3Cpath d='M280-160v-520H80v-120h520v120H400v520H280Zm360 0v-320H520v-120h360v120H760v320H640Z'/%3E%3C/svg%3E")}.phone::after{--mask:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 -960 960 960'%3E%3Cpath d='M798-120q-125 0-247-54.5T329-329Q229-429 174.5-551T120-798q0-18 12-30t30-12h162q14 0 25 9.5t13 22.5l26 140q2 16-1 27t-11 19l-97 98q20 37 47.5 71.5T387-386q31 31 65 57.5t72 48.5l94-94q9-9 23.5-13.5T670-390l138 28q14 4 23 14.5t9 23.5v162q0 18-12 30t-30 12Z'/%3E%3C/svg%3E")}.email::after{--mask:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 -960 960 960'%3E%3Cpath d='M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280 320-200v-80L480-520 160-720v80l320 200Z'/%3E%3C/svg%3E")}.address::after{--mask:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='24' viewBox='0 -960 960 960' width='24' fill='%2300000'%3E%3Cpath d='M480-480q33 0 56.5-23.5T560-560q0-33-23.5-56.5T480-640q-33 0-56.5 23.5T400-560q0 33 23.5 56.5T480-480Zm0 400Q319-217 239.5-334.5T160-552q0-150 96.5-239T480-880q127 0 223.5 89T800-552q0 100-79.5 217.5T480-80Z'/%3E%3C/svg%3E")}.url::after{--mask:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='%2300000'%3E%3Cpath d='M480-160q18 0 34.5-2t33.5-6l-48-72H360v-40q0-33 23.5-56.5T440-360h80v-120h-80q-17 0-28.5-11.5T400-520v-80h-18q-26 0-44-17.5T320-661q0-9 2.5-18t7.5-17l62-91q-101 29-166.5 113T160-480h40v-40q0-17 11.5-28.5T240-560h80q17 0 28.5 11.5T360-520v40q0 17-11.5 28.5T320-440v40q0 33-23.5 56.5T240-320h-37q42 72 115 116t162 44Zm304-222q8-23 12-47.5t4-50.5q0-112-68-197.5T560-790v110q33 0 56.5 23.5T640-600v80q19 0 34 4.5t29 18.5l81 115ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z'/%3E%3C/svg%3E")}@media screen and (min-width:1201px){#fields .container:nth-child(1){margin-top:206px!important}}@media screen and (min-width:993px){#intro.container{position:fixed;top:32px;width:calc(100% - 200px);z-index:99}#fields .container:nth-child(1){margin-top:226px}button{position:fixed;top:46px;right:20px;z-index:99}}@media screen and (min-width:769px){#main-content{padding-left:0}}
		
	</style> 

	<div id="main-content">
		
		<div id="intro" class="container">
			
			<h1>Site Details</h1>

			<p>You can invoke the content you input in the fields below, marked with the <b>"<span class="icon help"></span>"</b> icon, by using a shortcode. <i>(<b><a href="https://wordpress.com/support/wordpress-editor/blocks/shortcode-block/" target="_blank">What is a shortcode?</a></b>)</i></p>

			<p>For example, typing anywhere on the site the <code><b>[email]</b></code> shortcode will generate a clickable link that renders the content from the <b>"Email"</b> and <b>"Email Subject"</b> fields below. It would look something like the following: <b><a href="mailto:info@<?php echo $site_url_clean; ?>?subject=Email subject sample">info@<?php echo $site_url_clean; ?></a></b>.</p>
			
		</div>

		<div id="fields">

			<div class="form">

				<form class="login-form form" method="post" action="#">

					<div class="container">
					
						<h2><span class="icon announcement-bar"></span>Announcement Bar</h2>
					
						<fieldset>
							<div class="input-wrapper">
								<input id="announcement" name="details_announcement_bar" type="checkbox" value="1" <?php checked( get_theme_mod( 'details_announcement_bar' ), 1 ); ?> />
								<label>Check this box to display an announcement bar at the top of the page. Additional fields will appear for further customization once enabled.</label>
							</div>
						</fieldset>
						
						<fieldset class="announcement-fields">
							<div class="label-content">
								<label>Message</label>
								<p class="description">Enter the message you want to display on the announcement bar.</p>
							</div>
							<div class="input-wrapper">
								<div class="icon text"></div>
								<input id="announcement-message" name="details_announcement_message" type="text" value="<?php echo $contents[ 'details_announcement_message' ]; ?>" />
							</div>
						</fieldset>
						
						<fieldset class="announcement-fields">
							<div class="label-content">
								<label>Button Text <span>(Optional)</span></label>
								<p class="description">Enter the text for the button (e.g., <b>"Shop Now"</b>, <b>"Learn More"</b>, etc). This button will be placed next to the announcement message.</p>
							</div>
							<div class="input-wrapper">
								<div class="icon text"></div>
								<input id="announcement-button-text" name="details_announcement_button_text" type="text" value="<?php echo $contents[ 'details_announcement_button_text' ]; ?>" />
							</div>
						</fieldset>
						
						<fieldset class="announcement-fields">
							<div class="label-content">
								<label>Button Link <span>(Optional)</span></label>
								<p class="description">Enter the URL for the button link. You can use either a <b>relative URL</b> (e.g., <code>/shop</code>) for links within the same website or an <b>absolute URL</b> (e.g., <code>https://example.com/shop</code>) for links that point to external websites.</p>
							</div>
							<div class="input-wrapper">
								<div class="icon url"></div>
								<input id="announcement-button-link" name="details_announcement_button_link" type="text" value="<?php echo $contents[ 'details_announcement_button_link' ]; ?>" />
							</div>
						</fieldset>
						
					</div>

					<div class="container">
					
						<h2><span class="icon contact-details"></span>Contact Details</h2>
					
						<fieldset>
							<div class="label-content">
								<div class="tooltip">
									<label>Phone <span class="icon help"></span></label>
									<span class="tooltip-text">Type <code><b>[phone]</b></code> to use this shortcode.</span>
								</div>
								<p class="description">Enter a valid UK phone number without spaces or the country code (e.g., <b>"01123456789"</b>). Max. 11 characters.</p>
							</div>
							<div class="input-wrapper">
								<div class="icon phone"></div>
								<input id="phone" name="details_phone" type="text" minlength="11" maxlength="11" value="<?php echo $contents[ 'details_phone' ]; ?>" placeholder="01123456789" required />
							</div>
						</fieldset>

						<fieldset>
							<div class="label-content">
								<div class="tooltip">
									<label>Phone Alt. <span>(Optional)</span> <span class="icon help"></span></label>
									<span class="tooltip-text">Type <code><b>[phone_alt]</b></code> to use this shortcode.</span>
								</div>
								<p class="description">Enter a valid UK phone number without spaces or the country code (e.g., <b>"01123456789"</b>). Max. 11 characters.</p>
							</div>
							<div class="input-wrapper">
								<div class="icon phone"></div>
								<input id="phone-alt" name="details_phone_alt" type="text" minlength="11" maxlength="11" value="<?php echo $contents[ 'details_phone_alt' ]; ?>" placeholder="01123456789" />
							</div>
						</fieldset>

						<fieldset>
							<div class="label-content">
								<div class="tooltip">
									<label>Email <span class="icon help"></span></label>
									<span class="tooltip-text">Type <code><b>[email]</b></code> to use this shortcode.</span>
								</div>
								<p class="description">Enter a valid email address that you would like to use as your main point of contact.</p>
							</div>
							<div class="input-wrapper">
								<div class="icon email"></div>
								<input id="email" name="details_email" type="email" value="<?php echo $contents[ 'details_email' ]; ?>" placeholder="info@<?php echo $site_url_clean; ?>" required />
							</div>
						</fieldset>

						<fieldset>
							<div class="label-content">
								<label>Email Subject</label>
								<p class="description">Enter a generic subject similar to the placeholder text below. Max. 50 characters.</p>
							</div>
							<div class="input-wrapper">
								<div class="icon email"></div>
								<input id="email-subject" name="details_email_subject" type="text" maxlength="50" value="<?php echo $contents[ 'details_email_subject' ]; ?>" placeholder="<?php echo get_bloginfo( 'name' ); ?> Website Enquiry" required />
							</div>
						</fieldset>

						<fieldset>
							<div class="label-content">
								<div class="tooltip">
									<label>Address <span class="icon help"></span></label>
									<span class="tooltip-text">Type <code><b>[address]</b></code> to use this shortcode.</span>
								</div>
								<p class="description">Enter the full company address, excluding the company name.</p>
							</div>
							<div class="input-wrapper">
								<div class="icon address"></div>
								<input id="address" name="details_address" type="text" value="<?php echo $contents[ 'details_address' ]; ?>" required />
							</div>
						</fieldset>

						<fieldset>
							<div class="label-content">
								<label>Google Maps <span>(Optional)</span></label>
								<p class="description">Enter a valid URL from Google Maps <i>(<b><a href="https://support.google.com/maps/answer/7101463#14139729" target="_blank">How to share, send or print directions from Google Maps</a></b>)</i>. The URL should be in the format similar to the placeholder text below.</p>
								<p class="description">This will convert the <code><b>[address]</b></code> shortcode into a clickable link that opens Google Maps in a new tab.</p>
							</div>
							<div class="input-wrapper">
								<div class="icon url"></div>
								<input id="address-map" name="details_address_map" type="url" value="<?php echo $contents[ 'details_address_map' ]; ?>" placeholder="https://maps.app.goo.gl/tGKR3X1Cf19DvYD18" />
							</div>
						</fieldset>

					</div>
					
					<div class="container">
						
						<h2><span class="icon social-media"></span>Social Media</h2>
					
						<fieldset>
							<div class="label-content">
								<label>Facebook <span>(Optional)</span></label>
							</div>
							<div class="input-wrapper">
								<div class="icon url"></div>
								<input id="facebook" name="details_sm_facebook" type="url" value="<?php echo $contents[ 'details_sm_facebook' ]; ?>" />
							</div>
						</fieldset>

						<fieldset>
							<div class="label-content">
								<label>Instagram <span>(Optional)</span></label>
							</div>
							<div class="input-wrapper">
								<div class="icon url"></div>
								<input id="instagram" name="details_sm_instagram" type="url" value="<?php echo $contents[ 'details_sm_instagram' ]; ?>" />
							</div>
						</fieldset>
						
						<fieldset>
							<div class="label-content">
								<label>LinkedIn <span>(Optional)</span></label>
							</div>
							<div class="input-wrapper">
								<div class="icon url"></div>
								<input id="linkedin" name="details_sm_linkedin" type="url" value="<?php echo $contents[ 'details_sm_linkedin' ]; ?>" />
							</div>
						</fieldset>
						
						<fieldset>
							<div class="label-content">
								<label>X <span>(Optional)</span></label>
							</div>
							<div class="input-wrapper">
								<div class="icon url"></div>
								<input id="twitter" name="details_sm_x" type="url" value="<?php echo $contents[ 'details_sm_x' ]; ?>" />
							</div>
						</fieldset>

						<fieldset>
							<div class="label-content">
								<label>YouTube <span>(Optional)</span></label>
							</div>
							<div class="input-wrapper">
								<div class="icon url"></div>
								<input id="youtube" name="details_sm_youtube" type="url" value="<?php echo $contents[ 'details_sm_youtube' ]; ?>" />
							</div>
						</fieldset>
					
					</div>
						
					<?php wp_nonce_field( 'save_site_details' ); ?>
					<button class="button-primary" type="submit" name="submit">Save Details</button>

				</form>

			</div>

		</div>

	</div>
	
	<script type="text/javascript">
	    document.addEventListener('DOMContentLoaded', function() {
	        const checkbox = document.getElementById('announcement');
	        const announcementFields = document.querySelectorAll('.announcement-fields');
	        function toggleAnnouncementFields() {
	            if ( checkbox.checked ) {
	                announcementFields.forEach( function( field ) {
	                    field.style.display = 'block';
	                } );
	            } else {
	                announcementFields.forEach( function( field ) {
	                    field.style.display = 'none';
	                } );
	            }
	        }
	        toggleAnnouncementFields();
	        checkbox.addEventListener( 'change', toggleAnnouncementFields );
	    } );
	</script>

	<?php

}

// Runs when the plugin is activated
// It sets an option to trigger a redirect to the plugin's admin page on the next admin load
function gws_site_details_activate() {
    // Set a flag to trigger redirect on next admin load
    update_option( 'gws_site_details_do_activation_redirect', true );
}
register_activation_hook( __FILE__, 'gws_site_details_activate' );

// Runs during admin initialization
// If the activation redirect flag is set, it redirects the user to the plugin's admin page
// The flag is then deleted to prevent repeated redirects
function gws_site_details_redirect() {
    // Check the flag
    if ( get_option( 'gws_site_details_do_activation_redirect', false ) ) {
        // Delete the flag to avoid multiple redirects
        delete_option( 'gws_site_details_do_activation_redirect' );
        // Avoid redirecting during AJAX or if in network admin
        if ( is_network_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
            return;
        }
        // Redirect to your plugin's admin page
        wp_safe_redirect( admin_url( 'admin.php?page=site-details' ) );
        exit;
    }
}
add_action( 'admin_init', 'gws_site_details_redirect' );