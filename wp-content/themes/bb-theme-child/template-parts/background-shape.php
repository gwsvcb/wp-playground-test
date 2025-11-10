<?php

function gws_background_shape() {

	if ( function_exists( 'get_field' ) ) {
		$shape_true = get_field( 'show_background_shape' );
		$shape_start = esc_attr( get_field( 'background_shape_start' ) ) . '%';
		$shape_end = esc_attr( get_field( 'background_shape_end' ) ) . '%';	
		$shape_top = esc_attr( get_field( 'background_shape_top' )[ 'value' ] ?? '');
		$shape_bottom = esc_attr( get_field( 'background_shape_bottom' )[ 'value' ] ?? '' );
		$shape_flip = get_field( 'background_shape_flip' ) ? 'flip' : '';
	}

	if ( ! $shape_true ) {
		return '';
	}
	
	ob_start();

	?>

		<div class="background-shape black <?php echo esc_attr( $shape_flip ); ?>" style="--start: <?php echo $shape_start; ?>; --end: <?php echo $shape_end; ?>" aria-hidden="true">

			<div class="top <?php echo $shape_top; ?>"></div>

			<div class="bottom <?php echo $shape_bottom; ?>"></div>
			
		</div>

	<?php

	return ob_get_clean();

}

add_shortcode( 'background_shape' , 'gws_background_shape' );