<?php
/**
 * Beaver Builder Child Theme
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://docs.wpbeaverbuilder.com/
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

/**
 * Enqueue child theme style.css file
 * Do not delete this, you will need it
 */
add_action( 'wp_enqueue_scripts', function() {
  wp_enqueue_style(
    'child-style',
    get_stylesheet_uri(),
    array( 'fl-automator-skin' ),
    wp_get_theme()->get( 'Version' )
  );
});
/**
 * Add your custom theme functions below!
 */

// Load template parts
require_once get_stylesheet_directory() . '/template-parts/header_alt_nav.php';
require_once get_stylesheet_directory() . '/template-parts/banner.php';
require_once get_stylesheet_directory() . '/template-parts/password-protected.php';
require_once get_stylesheet_directory() . '/template-parts/background-shape.php';
require_once get_stylesheet_directory() . '/template-parts/footer.php';

// Load includes
require_once get_stylesheet_directory() . '/inc/acf-bb-child-fields.php';

// Enqueue custom scripts
function gws_enqueue_scripts() {
	global $post;
    $announcement_enabled = get_theme_mod( 'details_announcement_bar' );
    if ( ! empty( $announcement_enabled ) ) {
        wp_enqueue_script( 'gws-announcement-script', get_stylesheet_directory_uri() . '/assets/js/announcement.js', array(), filemtime( get_stylesheet_directory() . '/assets/js/announcement.js' ), true );
    }
	if ( is_singular() && isset( $post->post_content ) && has_shortcode( $post->post_content, 'cards' ) ) {
    	wp_enqueue_script( 'gws-cards-script', get_stylesheet_directory_uri() . '/assets/js/cards.js', array(), filemtime( get_stylesheet_directory() . '/assets/js/cards.js' ), true );
	}
}
add_action( 'wp_enqueue_scripts', 'gws_enqueue_scripts' );