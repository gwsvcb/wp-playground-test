<?php

/*
 * Miscellaneous functions that don't fit into other categories
 * Use sparingly; try to organize new functions in more specific files when possible
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Remove WordPress logo from the admin bar
function gws_adminbar_remove_wp_logo() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'wp-logo' );
}
add_action( 'wp_before_admin_bar_render', 'gws_adminbar_remove_wp_logo' );

// Remove emoji icons
function gws_disable_wp_emojicons() {
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	add_filter( 'tiny_mce_plugins', 'gws_disable_emojicons_tinymce' );
	add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', 'gws_disable_wp_emojicons' );

function gws_disable_emojicons_tinymce( $plugins ) {
	return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
}

// Custom CSS for the dashboard area
function gws_custom_css_admin() {
  echo '<style>
  	
  			/* Built-in File Editors Background */
			.CodeMirror-wrap {
				filter: invert(100%) !important;
			}
			
			/* Gutenberg Blocks */
			.wp-block {
				max-width: 100%;
			    border: 1px solid #ddd;
				border-radius: 0 !important;
			    padding: 12px;
			}
	
			.wp-block[data-align="wide"] {
				max-width: 720px;
			}

			.wp-block[data-align="full"] {
				max-width: none;
			}
	
  		</style>';
}
add_action( 'admin_head', 'gws_custom_css_admin' );