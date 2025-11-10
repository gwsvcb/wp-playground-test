<?php

/*
 * Plugin Name:       GWS Site Functionality
 * Plugin URI:        https://www.gwsmedia.com/
 * Description:       Adds new functionalities to the website e.g.: registers custom post types, shortcodes, permissions, etc.
 * Version:           1.0
 * Author:            GWS Media
 * Author URI:        https://www.gwsmedia.com/
 * License:           GPL2
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       gws-site-functionality
 * Domain Path:       /languages
 * Requires PHP:      7.0
 * Requires at least: 6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Define plugin constants.
define( 'GWS_PLUGIN_DIR', plugin_dir_path(__FILE__) );
define( 'GWS_INCLUDES_DIR', GWS_PLUGIN_DIR . 'includes/' );

// Autoload all PHP files from a directory.
function gws_load_php_files( $dir ) {
    foreach ( glob( $dir . '*.php' ) as $file ) {
        require_once $file;
    }

    // Optionally, include subdirectories recursively
    foreach ( glob( $dir . '*', GLOB_ONLYDIR ) as $subdir ) {
        gws_load_php_files( $subdir . '/' );
    }
}

// Load components
gws_load_php_files( GWS_INCLUDES_DIR . 'core/' );

// Load custom post types
gws_load_php_files( GWS_INCLUDES_DIR . 'cpts/' );

// Load shortcodes and nested shortcode files
gws_load_php_files( GWS_INCLUDES_DIR . 'shortcodes/' );