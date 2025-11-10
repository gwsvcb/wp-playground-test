<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// CPT Sample - Start

	function gws_sample_cpt() {

		$post_type_name = 'cpt_sample_name_here'; // CPT registered name here

		$labels = array(
			'name'               => __( 'Samples' ),
			'singular_name'      => __( 'Sample' ),
			'add_new'            => __( 'Add New', 'Sample' ),
			'add_new_item'       => __( 'Add New Sample' ),
			'edit_item'          => __( 'Edit Sample' ),
			'new_item'           => __( 'New Sample' ),
			'all_items'          => __( 'All Samples' ),
			'view_item'          => __( 'View Sample' ),
			'search_items'       => __( 'Search Samples' ),
			'not_found'          => __( 'No sample found' ),
			'not_found_in_trash' => __( 'No samples found in Bin.' ),
			'menu_name'          => 'Samples'
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'menu_icon' 	      => 'dashicons-dashboard',
			'menu_position'       => 4,
			'show_in_rest'        => true, // Replaces old editor with Gutenberg
			'supports'            => array( 'title', 'editor', 'revisions', 'excerpt', 'page-attributes', 'thumbnail' ),
			'taxonomies' 	      => array( 'post_tag', 'category' ), // Remove this if using "CPT Own Categories" and "CPT Own Tags" below (they can coexist though)
			'capability_type'     => array( $post_type_name, $post_type_name . 's' ), // Always add these capabilities to administrators or the CPT won't be visible
			'map_meta_cap'        => true,
			'has_archive'         => false, // Always set to "false" so the "rewrite" below works and it doesn't override the parent page with same slug E.g. "/services/" (parent) - "/services/web-design/" (CPT slug)
			'rewrite' 		      => array( 'slug' => 'slugnamehere' ), // Change CPT parent slug
			'publicly_queryable'  => true, // Change to "False" to make post not accessible
			'exclude_from_search' => false
		);

		// CPT Own Categories
		register_taxonomy(
			$post_type_name . '_categories',
			$post_type_name,
			array(
				'label'             => __( 'Categories' ),
				'rewrite'           => false,
				'hierarchical'      => true,
				'capabilities'      => array( 'edit_terms' => 'manage_categories' ),
				'show_admin_column' => true,
			)
		);

		// CPT Own Tags
		register_taxonomy(
			$post_type_name . '_tags',
			$post_type_name,
			array(
				'label'             => __( 'Tags' ),
				'rewrite'           => false,
				'hierarchical'      => false,
				'capabilities'      => array( 'edit_terms' => 'manage_categories' ),
				'show_admin_column' => true,
			)
		);

	  register_post_type( $post_type_name, $args );
	}
	
	add_action( 'init', 'gws_sample_cpt' );

// CPT Sample - End