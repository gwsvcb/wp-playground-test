<?php

/*
 * Database optimization and cleanup utilities
 * Handles post revision limits, old data removal, and other strategies to maintain database performance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Limit the number of post revisions stored in the database
// When a post is saved, it checks if the number of revisions exceeds the set limit. If so, it deletes the oldest excess revisions permanently
function gws_limit_post_revisions( $post_id ) {
    $max_revisions = 20;
    $revisions = wp_get_post_revisions( $post_id );
    // Check if the number of revisions exceeds the maximum allowed
    if ( count( $revisions ) > $max_revisions ) {
        // Get the oldest revisions beyond the allowed limit
        $revisions_to_delete = array_slice( $revisions, $max_revisions );
        // Loop through and permanently delete each excess revision
        foreach ( $revisions_to_delete as $revision ) {
            wp_delete_post( $revision->ID, true );
        }
    }
}
add_action( 'save_post', 'gws_limit_post_revisions' );

// Disable trackbacks support
function gws_disable_pingbacks_trackbacks() {
    foreach ( get_post_types() as $post_type ) {
        if ( post_type_supports( $post_type, 'trackbacks' ) ) {
            remove_post_type_support( $post_type, 'trackbacks' );
        }
    }
}
add_action( 'init', 'gws_disable_pingbacks_trackbacks' );
// Prevent WordPress from sending pingbacks/trackbacks
add_filter( 'pre_ping', '__return_empty_array' );
// Disable XML-RPC pingback method to block incoming pings
add_filter( 'xmlrpc_methods', function( $methods ) {
    unset( $methods['pingback.ping'] );
    return $methods;
});
// Filter comments query to exclude pingbacks and trackbacks
function gws_disable_incoming_pings( $query ) {
    if ( is_admin() && $query->is_main_query() && $query->get( 'post_type' ) === 'comment' ) {
        $query->set( 'type', 'comment' );
    }
}
add_action( 'pre_get_posts', 'gws_disable_incoming_pings' );
// Disable pingback flag option in settings
add_filter( 'pre_option_default_pingback_flag', '__return_zero' );