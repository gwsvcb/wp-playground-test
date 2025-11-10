<?php

/*
 * Security enhancements and hardening measures
 * Includes filters and actions to hide sensitive data, disable unused endpoints, and reduce exposure to spam or attacks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Remove the WordPress version from the public source code
// This only removes it from the head tags and the RSS Feeds, won't remove it from the readme.html file in the root folder
remove_action('wp_head', 'wp_generator');
function gws_remove_wp_version() {
	return '';
}
add_filter( 'the_generator', 'gws_remove_wp_version' );

// Disable login by email
remove_filter( 'authenticate', 'wp_authenticate_email_password', 20 );

// Change failed login message
function gws_failed_login() {
	return 'Invalid email, username or password.';
}
add_filter( 'login_errors', 'gws_failed_login' );

// Disable REST API for User Enumeration
function gws_disable_rest_user_endpoints() {
	if ( is_user_logged_in() ) {
		return;
	}
	// Remove user endpoints
	remove_action( 'rest_api_init', 'create_initial_rest_routes', 99 );
	// Remove user query vars
	add_filter( 'rest_endpoints', function ( $endpoints ) {
		if ( isset( $endpoints[ '/wp/v2/users' ] ) ) {
			unset( $endpoints[ '/wp/v2/users' ] );
		}
		if ( isset( $endpoints[ '/wp/v2/users/(?P<id>[\d]+)' ] ) ) {
			unset( $endpoints[ '/wp/v2/users/(?P<id>[\d]+)' ] );
		}
		return $endpoints;
	} );
}
add_action( 'init', 'gws_disable_rest_user_endpoints' );

// Disable xmlrpc.php
add_filter( 'xmlrpc_enabled', '__return_false' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );

//Remove WordPress comments
// Redirect users trying to access comments page, remove comments metabox, disable comments support
function gws_disable_comments_admin_init() {
    global $pagenow;
    // Redirect any user trying to access comments page
    if ( $pagenow === 'edit-comments.php' ) {
        wp_safe_redirect( admin_url() );
        exit;
    }
    // Remove comments metabox from dashboard
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    // Disable support for comments and trackbacks in all post types
    foreach ( get_post_types() as $post_type ) {
        if ( post_type_supports( $post_type, 'comments' ) ) {
            remove_post_type_support( $post_type, 'comments' );
            remove_post_type_support( $post_type, 'trackbacks' );
        }
    }
}
add_action( 'admin_init', 'gws_disable_comments_admin_init' );
// Remove comments page from admin menu
function gws_remove_comments_menu() {
    remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'gws_remove_comments_menu' );
// Remove comments links from admin bar
function gws_remove_comments_from_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'comments' );
}
add_action( 'wp_before_admin_bar_render', 'gws_remove_comments_from_admin_bar' );
// Close comments on the front-end
add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );
// Hide existing comments
add_filter( 'comments_array', '__return_empty_array', 10, 2 );