<?php

/*
 * Small behavioral tweaks and WordPress customizations
 * Includes filters, actions, and utility functions that enhance or adjust core/plugin/theme functionality
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Use lowercase filenames for all uploads
add_filter( 'sanitize_file_name', 'mb_strtolower' );

// Enable excerpts on pages
// add_post_type_support( 'page', 'excerpt' );

// Remove excerpt metabox from the post edit screen
function gws_remove_excerpt_support() {
    remove_post_type_support( 'post', 'excerpt' );
}
add_action( 'init', 'gws_remove_excerpt_support' );

// Allow HTML in category descriptions
remove_filter( 'pre_term_description', 'wp_filter_kses' );

// Remove auto <p> set by WordPress
remove_filter( 'the_content', 'wpautop' );

// Disable Beaver Builder's built-in Skip to content link (added on /bb-child-theme/template-parts/header.php)
function gws_remove_bb_skip_to_link() {
	remove_action( 'fl_body_open', 'FLTheme::skip_to_link', 20 );
}
add_action( 'after_setup_theme', 'gws_remove_bb_skip_to_link' );

// Hide unpublished pages/posts from the navigation
function gws_hide_unpublished_from_menu( $items, $args ) {
	foreach( $items as $itemID => $object ) {
		if ( ( get_post_status( $object->object_id ) == 'draft' ) || ( get_post_status( $object->object_id ) == 'private' ) ) {
			unset ( $items[ $itemID ] );
		}
	}
	return $items;
}
add_filter( 'wp_nav_menu_objects', 'gws_hide_unpublished_from_menu', 10, 2 );

// Move Yoast SEO to the bottom of the page
function gws_yoast_bottom_page() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'gws_yoast_bottom_page' );

// Removes "Protected:" and "Private:" from the post title
add_filter( 'protected_title_format', 'gws_remove_protected_private_text' );
function gws_remove_protected_private_text() {
	return __( '%s' );
}
add_filter( 'private_title_format', 'gws_remove_protected_private_text' );

// Remove search on 404 page
function gws_remove_search_form_404() {
	$template = $GLOBALS[ 'template' ];
	$template_file = substr( $template, strrpos( $template, '/' ) + 1 );
	if ( $template_file === '404.php' ) {
		return '';
	}
}
add_filter( 'get_search_form', 'gws_remove_search_form_404' );