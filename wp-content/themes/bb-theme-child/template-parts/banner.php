<?php

function gws_banner_image_with_content( $post_id = null ) {

	$post_id = isset( $post_id ) ? $post_id : get_the_ID();
	$post = get_post( $post_id );
	$banner_id = 'banner-' . uniqid();
	$thumbnail_id = get_post_thumbnail_id( $post_id );

	if ( $thumbnail_id ) {
		$image_src = wp_get_attachment_image_src( $thumbnail_id, 'banner_medium' )[0];
		$image_src_small = wp_get_attachment_image_src( $thumbnail_id, 'card_medium' )[0];
	} else {
		$image_src = $image_src_small = get_stylesheet_directory_uri() . '/assets/images/fallback.png';
	}

	$page_title = get_the_title();
	
	if ( function_exists( 'get_field' ) ) {
		$title_alt = get_field( 'page_settings_alt_title' );
		$blurb = get_field( 'page_settings_blurb' );
		$primary_button_text = get_field( 'page_settings_button_text' );
		$primary_button_link = get_field( 'page_settings_button_link' );
		$secondary_button_text = get_field( 'page_settings_button_text_2' );
		$secondary_button_link = get_field( 'page_settings_button_link_2' );
	}

	$title = ! empty( $title_alt ) ? $title_alt : $page_title;
	
	$primary_button_link_target = $primary_button_link['target'] ? $primary_button_link['target'] : '_self';
	$secondary_button_link_target = $secondary_button_link['target'] ? $secondary_button_link['target'] : '_self';
	
	ob_start();

	?>

		<style>
			@media screen and (max-width: 767px) {
				#<?php echo $banner_id; ?> {
					background-image: url('<?php echo esc_url( $image_src_small ); ?>') !important;
				}
			}
		</style>

		<div id="<?php echo esc_attr( $banner_id ); ?>"
			 class="banner has-content overlay black"
			 style="background-image: url('<?php echo esc_url( $image_src ); ?>'); background-position: center center; background-size: cover;">
			
			<div class="content-wrapper container-max-width">

				<h1 class="heading big"><?php echo $title; ?></h1>

				<?php if ( ! empty( $blurb ) ) : ?>
				
					<p class="big-text"><?php echo esc_html( $blurb ); ?></p>
				
				<?php endif; ?>

			    <?php if ( ! empty( $primary_button_text ) || ! empty( $secondary_button_text ) ) : ?>

			        <div class="buttons-wrapper">

			            <?php if ( !empty( $primary_button_text ) && !empty( $primary_button_link ) ) : ?>

			                <a class="button pill" href="<?php echo esc_url( $primary_button_link['url'] ); ?>" target="<?php echo esc_attr( $primary_button_link_target ); ?>">

			                	<?php echo esc_html( $primary_button_text ); ?>

			                </a>

			            <?php endif; ?>

			            <?php if ( !empty( $secondary_button_text ) && !empty( $secondary_button_link ) ) : ?>

			                <a class="button pill secondary" href="<?php echo esc_url( $secondary_button_link['url'] ) ; ?>" target="<?php echo esc_attr( $secondary_button_link_target ); ?>">

			                    <?php echo esc_html( $secondary_button_text ); ?>

			                </a>
			                
			            <?php endif; ?>

			        </div>
				
				<?php endif; ?>
			
			</div>
		</div>

	<?php

	return ob_get_clean();
}

add_shortcode( 'banner_image', 'gws_banner_image_with_content' );