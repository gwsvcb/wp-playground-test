<?php

function gws_footer() {

	$aria_hidden = post_password_required() ? 'true' : '';
	
	ob_start();
	
		?>
			<footer id="main-footer" <?php echo $aria_hidden ? 'aria-hidden="true"' : ''; ?> >
				
				<div id="footer-top" class="container-max-width">
					<h2 class="heading">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
				</div>
				
				<div id="footer-middle" class="container-max-width">
					
					<div>
						<h3 class="heading">Heading</h3>
						
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque iaculis vulputate ipsum, in fringilla justo dignissim eget. Nunc id facilisis elit, eu aliquet urna.</p>
						<?php echo do_shortcode( '[social_media]' ); ?>
						
					</div>
					
					<div>
						
						<h3 class="heading">Heading</h3>
						
						<?php
							if ( has_nav_menu( 'footer_col_1' ) ) {
								wp_nav_menu( [
									'theme_location' => 'footer_col_1',
									'container'      => 'nav',
									'fallback_cb'    => false,
								] );
							}
						?>
						
					</div>
					
					<div>
						
						<h3 class="heading">Heading</h3>
						
						<?php
							if ( has_nav_menu( 'footer_col_2' ) ) {
								wp_nav_menu( [
									'theme_location' => 'footer_col_2',
									'container'      => 'nav',
									'fallback_cb'    => false,
								] );
							}
						?>
						
					</div>
					
					<div>
						
						<h3 class="heading">Heading</h3>
						
						<?php
							if ( has_nav_menu( 'footer_col_3' ) ) {
								wp_nav_menu( [
									'theme_location' => 'footer_col_3',
									'container'      => 'nav',
									'fallback_cb'    => false,
								] );
							}
						?>
						
					</div>					
					
				</div>
				
				<div id="footer-bottom" class="container-max-width">
					
					<span>© <?php echo date( 'Y' ); ?> <?php echo get_bloginfo( 'name' ); ?>. All Rights Reserved.</span>
					
					<a href="/privacy-policy/">Privacy Policy</a>
					
					<a href="/terms-conditions/">Terms & Conditions</a>
					
					<span>Website by <a href="https://www.gwsmedia.com/" target="_blank" aria-label="GWS Media (opens in new tab)">GWS Media</a></span>
					
				</div>
				
			</footer>

		<?php
	
	return ob_get_clean();
	
}

add_shortcode( 'footer', 'gws_footer' );