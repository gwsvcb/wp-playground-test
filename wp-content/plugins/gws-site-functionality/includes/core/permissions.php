<?php

/*
 * User role and permission controls
 * Manages access to admin features, custom capabilities, and upload permissions based on user roles
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Upload extra media files types (SVG, PSD, etc)
function gws_myme_types( $mime_types ) {
	if( current_user_can( 'administrator') ) {
		$mime_types[ 'svg' ] = 'image/svg+xml'; //Adding SVG extension
		return $mime_types;
	}
}
add_filter( 'upload_mimes', 'gws_myme_types', 1, 1 );

// Hide certain "Dashboard" items
function gws_remove_admin_menus() {
	if ( ! current_user_can( 'administrator' ) ) {
		remove_menu_page( 'wpcf7' );
		remove_menu_page( 'wpseo_workouts' );
		remove_menu_page( 'tools.php' );
		remove_submenu_page( 'themes.php', 'themes.php' );
		remove_submenu_page( 'themes.php', 'widgets.php' );
		remove_submenu_page( 'themes.php', 'edit.php?post_type=wp_block' );
	}
}
add_action( 'admin_menu', 'gws_remove_admin_menus' );

// Edit "Privacy Policy" page if user can edit pages
function gws_privacy_page_permissions( $caps, $cap, $user_id, $args ) {
	if ( ! is_user_logged_in() ) return $caps;
	if ( 'manage_privacy_options' === $cap ) {
		$manage_name = is_multisite() ? 'manage_network' : 'edit_pages';
		$caps = array_diff( $caps, [ $manage_name ] );
	}
	return $caps;
}
add_action( 'map_meta_cap', 'gws_privacy_page_permissions', 1, 4 );

// Flamingo "Inbound messages" permissions
add_filter( 'flamingo_map_meta_cap', function( $meta_caps ) {
	$meta_caps = array_merge( $meta_caps, array(
		'flamingo_edit_inbound_message'  => 'edit_theme_options',
		'flamingo_edit_inbound_messages' => 'edit_theme_options',
	) );
	return $meta_caps;
} );

// Restrict access to "Customiser"
function gws_customizer_permissions() {
	if ( ! current_user_can( 'administrator' ) ) {				
		$screen = get_current_screen();
		$base = $screen->id;
		if( in_array( $base, array( 'customize' ) ) ) {
			wp_die( 'You do not have permission to access this page.' );
		}
		remove_submenu_page( 'themes.php', 'customize.php?return=' . urlencode( $_SERVER[ 'REQUEST_URI' ] ) );
	}
}
add_action( 'current_screen', 'gws_customizer_permissions' );
// Remove "Customize" from the admin bar
function gws_customize_admin_bar() {
	if ( ! current_user_can( 'administrator' ) ) {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu( 'customize' );
	}
}
add_action( 'wp_before_admin_bar_render', 'gws_customize_admin_bar' );

// Contact Form 7 custom capabilities
function gws_wpcf7_capabilities( $meta_caps ) {		 
	$meta_caps = array(
    	'wpcf7_edit_contact_form'   => 'new_wpcf7_edit',
		'wpcf7_edit_contact_forms'  => 'new_wpcf7_edit',
		'wpcf7_read_contact_forms'  => 'new_wpcf7_read',
		'wpcf7_delete_contact_form' => 'new_wpcf7_delete',
		'wpcf7_manage_integration'  => 'new_wpcf7_manage' );
	return $meta_caps;
}
add_filter( 'wpcf7_map_meta_cap', 'gws_wpcf7_capabilities', 10, 1 );