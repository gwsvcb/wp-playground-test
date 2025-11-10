<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Post title shortcode
function gws_post_title() {
	return get_the_title();
}
add_shortcode( 'title', 'gws_post_title' );

// Post author shortcode
function post_author() {
    global $post;
    $post_id = $post->ID;
    $author = get_the_author( $post_id );
    return $author;
}
add_shortcode( 'author', 'post_author' );

// Post date shortcode
function gws_post_date() {
	return get_the_date();
}
add_shortcode( 'date', 'gws_post_date' );

// Post date last modified shortcode
function gws_post_date_modified( $atts ) {
	if ( empty( $atts[ 'format' ] ) ) {
		$atts[ 'format' ] = get_option( 'date_format' );
	}
	return get_the_modified_date( $atts[ 'format' ] );
}
add_shortcode( 'date_modified', 'gws_post_date_modified' );