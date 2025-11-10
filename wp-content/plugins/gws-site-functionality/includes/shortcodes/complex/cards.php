<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Cards pulling content from a specific custom post type
function gws_cpt_name_cards( $atts ) {    

	// Adds category attribute support to shortcode e.g.: [cpt_name_cards category="category-slug"]
// 	$atts = shortcode_atts( array( 'category' => ''	), $atts );

	// Adds multiple category attribute support to shortcode e.g.: [cpt_name_cards category="category-slug1, category-slug2"]
// 	$categories = explode( ',', $atts[ 'category' ] );

	// For more query parameters refer to: https://developer.wordpress.org/reference/classes/wp_query/
	$query = new WP_Query( array(
		'post_type' => array( 'post', 'page' ), // Custom post type name here
		'post_status'    => 'publish',
		'orderby'        => 'menu_order', // Replace 'menu_order' with 'meta_value' and add 'meta_key' => 'field_name' to sort posts using a specific field e.g. a surname field. Use 'rand' to sort randomly
		'order'          => 'ASC',
		'posts_per_page' => -1,
		'has_password'   => null,
		
		// Super useful to create a reverse ACF Relationship field e.g.: select on X page/post all the pages/posts where X page/post should appear
// 		'meta_query'     => array( array(
// 								'key'     => 'acf_relationship_field_name_here',
// 								'value'   => '"' . get_the_ID() . '"',
// 								'compare' => 'LIKE'
// 							) ),
		
		// Category attribute needed to support shortcode categorisation e.g.: [cpt_name_cards category="category-slug"]		
// 		'tax_query'      => array( array(
// 		                        'taxonomy'  => 'cpt_category', // Replace with custom post type category name
// 		                        'field'     => 'slug', // Other attributes can be use like 'term_id', etc
// 		                        'terms'     => $categories
// 		                    ) )
	 ) );

	// Get number of posts published (useful to display jobs available, etc)
	$get_post_count = wp_count_posts( 'cpt_name' )->publish;
	
	ob_start();
		
		?>

			<section>
				
				<h2 id="jump-link">Heading</h2>
				
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit duis gravida<br>Placerat odio ut rhoncus nunc volutpat a. Nullam fringilla venenatis urna quis.</p>
				
				<?php if ( empty( $query->have_posts() ) ): ?>
				
				<div class="cards-grid-empty">
					
					<p>Sorry, there are no posts available at this moment.</p>
					
				</div>
				
				<?php endif; ?>

				<div class="cards">

				<?php while ( $query->have_posts() ) : $query->the_post(); 

					$post_id = get_the_ID(); // current post in the $query loop

					$image_id  = get_post_thumbnail_id( $post_id );
					$image_src_source = wp_get_attachment_image_src( $image_id, 'card_medium' );
					$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

					if ( $image_src_source ) {
						$image_src = $image_src_source[0];
					} else {
						$image_src = get_stylesheet_directory_uri() . '/assets/images/fallback.png';
						$image_alt = '';
					}

					$page_title = get_the_title( $post_id );

					if ( function_exists( 'get_field' ) ) {
						$title_alt = get_field( 'page_settings_alt_title', $post_id );
						$blurb     = get_field( 'page_settings_blurb', $post_id );
					}

					$title = ! empty( $title_alt ) ? $title_alt : $page_title;

				?>

					<div class="card">
						
						<figure class="image-wrapper">
							
							<img loading="lazy" decoding="async" src="<?php echo esc_url( $image_src ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
							
						</figure>

						<div class="content-wrapper">
							
							<h3 class="heading"><?php echo esc_html( $title ); ?></h3>

							<?php if ( ! empty( $blurb ) ): ?>
							
							<p class="clamp"><?php echo esc_html( $blurb ); ?></p>
							
							<?php endif; ?>
							
							<a class="button" href="<?php echo esc_url( get_permalink() ); ?>" aria-label="Read more about <?php echo esc_attr( $title ); ?>">Read More</a>
							
						</div>	

					</div>

					<?php endwhile; ?>
					
					<?php wp_reset_postdata(); ?>

				</div>

					
				<?php if( $query->have_posts() ): ?>
				
					<div class="fixed">
						
						<a class="button pill" href="#jump-link">Button Jump Link</a>
						
					</div>
				
				<?php endif; ?>	
					
			</section>
	
		<?php
	
	return ob_get_clean();
       
}
add_shortcode( 'cards', 'gws_cpt_name_cards' );