<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Phone number shortcode
function gws_phone_number() {		
	$phone = get_theme_mod( 'details_phone' );
	$phone_text = substr( $phone, -11, 4 ) . " " . substr( $phone, -7, 3 ) . " " . substr( $phone, -4, 4 );  
	$phone_link = substr( $phone, -10, 10 );		
	ob_start();
		?>
			<a class="phone" href="tel:+44<?php echo esc_attr( preg_replace( '/\D+/', '', $phone_link ) ); ?>" aria-label="Call us at <?php echo esc_html( $phone_text ); ?>"><?php echo esc_html( $phone_text ); ?></a>
		<?php
	return ob_get_clean();
}
add_shortcode( 'phone', 'gws_phone_number' );

// Phone number alt. shortcode
function gws_phone_number_alt() {		
	$phone = get_theme_mod( 'details_phone_alt' );
	$phone_text = substr( $phone, -11, 4 ) . " " . substr( $phone, -7, 3 ) . " " . substr( $phone, -4, 4 );  
	$phone_link = substr( $phone, -10, 10 );		
	ob_start();
		?>
			<a class="phone" href="tel:+44<?php echo esc_attr( preg_replace( '/\D+/', '', $phone_link ) ); ?>" aria-label="Call us at <?php echo esc_html( $phone_text ); ?>"><?php echo esc_html( $phone_text ); ?></a>
		<?php
	return ob_get_clean();
}
add_shortcode( 'phone_alt', 'gws_phone_number_alt' );

// Email address shortcode
function gws_email_address() {	
	$email = get_theme_mod( 'details_email' );
	$email_subject = get_theme_mod( 'details_email_subject' );
	ob_start();
		?>
			<a class="email" href="mailto:<?php echo esc_html( $email ); ?>?subject=<?php echo esc_html( $email_subject ); ?>" aria-label="Email us to <?php echo esc_html( $email ); ?>"><?php echo esc_html( $email ); ?></a>
		<?php
	return ob_get_clean();
}
add_shortcode( 'email', 'gws_email_address' );

// Address shortcode 
function gws_address() {				
	$address = get_theme_mod( 'details_address' );
	$address_map = get_theme_mod( 'details_address_map' );	
	ob_start();
		?>
			<?php if ( $address_map ): ?>					
				<a href="<?php echo esc_url( $address_map ); ?>" target="_blank" aria-label="Open address in Google Maps"><?php echo esc_html( $address ); ?></a>
			<?php else: ?>
				<?php echo esc_html( $address ); ?>
			<?php endif; ?>
		<?php
	return ob_get_clean();
}
add_shortcode( 'address', 'gws_address' );

// Social media platforms shortcode
// "File Manager" plugin (https://en-gb.wordpress.org/plugins/wp-file-manager/) needed
// Create the folder path: Assets » Icons » Social Media inside "wp-content"
function gws_social_media_accounts() {

	$social_platforms = [
		'facebook'  => [ 'setting' => 'details_sm_facebook',  'label' => 'Facebook',             'icon' => 'facebook.svg',  'class' => 'facebook' ],
		'instagram' => [ 'setting' => 'details_sm_instagram', 'label' => 'Instagram',            'icon' => 'instagram.svg', 'class' => 'instagram' ],
		'linkedin'  => [ 'setting' => 'details_sm_linkedin',  'label' => 'LinkedIn',             'icon' => 'linkedin.svg',  'class' => 'linkedin' ],		
		'x'         => [ 'setting' => 'details_sm_x',         'label' => 'X (Formerly Twitter)', 'icon' => 'x.svg',         'class' => 'x-twitter' ],
		'youtube'   => [ 'setting' => 'details_sm_youtube',   'label' => 'YouTube',              'icon' => 'youtube.svg',   'class' => 'youtube' ],
	];
	
    $links = [];
    foreach ( $social_platforms as $key => $platform ) {
        $links[ $key ] = get_theme_mod( $platform[ 'setting' ] );
    }

    ob_start();
		?>
			<?php if ( array_filter( $links ) ): ?>
			<div class="social-media-accounts" role="navigation" aria-label="Social media accounts">			
				<?php foreach ( $social_platforms as $key => $platform ): ?>			
				<?php if ( $links[ $key ] ): ?>
				<a class="social-media-icon <?php echo esc_attr( $platform[ 'class' ] ); ?> svg-filter" href="<?php echo esc_url( $links[ $key ] ); ?>" target="_blank">
					<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/icons/social-media/' . $platform['icon'] ); ?>" alt="<?php echo esc_attr( $platform[ 'label' ] ); ?> (opens in new tab)">
				</a>
				<?php endif; ?>
				<?php endforeach; ?>				
			</div>
			<?php endif; ?>
		<?php
    return ob_get_clean();
}
add_shortcode('social_media', 'gws_social_media_accounts');