<?php

/*
 * Core configuration and foundational setup for the theme/plugin
 * Includes essential filters, default templates, image sizes, and feature support
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Disables auto-update e-mails for core, plugins and themes
add_filter( 'auto_core_update_send_email', '__return_false' );
add_filter( 'auto_plugin_update_send_email', '__return_false' );
add_filter( 'auto_theme_update_send_email', '__return_false' );

// Custom media sizes
add_theme_support( 'post-thumbnails' );
add_image_size( 'banner_large', 1920, 1080 );
add_image_size( 'banner_medium', 1280, 720 );
add_image_size( 'banner_small', 1080, 608 );
add_image_size( 'card_large', 720, 480 );
add_image_size( 'card_medium', 480, 320 );
add_image_size( 'card_small', 360, 240 );
add_image_size( 'thumbnail_small', 80, 80, true );

// Apply Full-width template automatically to every defined content type (pages, posts, CPTs, etc)
function gws_default_page_template( $template ) {
	if ( is_singular( 'page' )  || is_singular( 'post' ) /* Add more CPTs here if needed */ ) {
		$default_template = locate_template( array( 'tpl-full-width.php' ) );
		if ( '' != $default_template ) {
			return $default_template;
		}
	}
	return $template;
}
add_filter( 'template_include', 'gws_default_page_template', 99 );

// Registers custom menu locations
function gws_theme_register_menus() {
    register_nav_menus( [
        'footer_col_1'    => __( 'Footer - Column 1', 'gws-site-functionality' ),
        'footer_col_2' => __( 'Footer - Column 2', 'gws-site-functionality' ),
        'footer_col_3'      => __( 'Footer - Column 3', 'gws-site-functionality' ),
    ] );
}
add_action( 'after_setup_theme', 'gws_theme_register_menus', 20 );

// Adds content before the main container's wrapper
// Can be used to add the header, banner image or other elements
function gws_before_content_header() {
	echo do_shortcode( '[header]' );
	// Show on all but password protected page
	if ( ! post_password_required() ) {
		echo do_shortcode( '[banner_image]' );
	}
	// Show on XXX page/s (commented by default as it can break the site due to pages IDs not existing)
	// if ( is_page( array( xxx, xxx, xxx ) ) ) {
	// 	echo do_shortcode( '[fl_builder_insert_layout id=xxx]' );
	// }
}
add_action( 'fl_before_content', 'gws_before_content_header' );

// Adds content after the main container's wrapper
// Can be used to add the footer, background shapes or other elements
function gws_after_content_footer() {
	echo do_shortcode( '[background_shape]' );
	echo do_shortcode( '[footer]' );
}
add_action( 'fl_after_content', 'gws_after_content_footer' );