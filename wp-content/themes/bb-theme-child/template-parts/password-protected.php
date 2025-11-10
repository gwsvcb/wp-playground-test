<?php

function gws_password_protected_page() {

	global $post;

	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );

	ob_start();

		?>

			<div class="content-wrapper">

				<div class="icon" aria-hidden="true"></div>

				<h2 tabindex="1">This content is protected</h2>

				<p tabindex="1">To access, please enter the password below.</p>

				<form action="<?php echo esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) ?>" class="form-inline post-password-form" method="post">		

					<input id="password" type="password" name="post_password" autocomplete="new-password" spellcheck="false" placeholder="Enter your password" aria-label="Enter your password" tabindex="1" size="20"><button id="toggle-password" class="inactive" type="button" aria-label="Show password" tabindex="1" onclick="showPassword()"></button><input id="submit" type="submit" name="submit" value="Submit" tabindex="1" aria-label="Submit password to access content">

				</form>

			</div>

			<button class="button" type="button" onclick="history.back();" tabindex="1" aria-label="Go back to previous page">Go Back</button>

			<script>
				function showPassword() {
					var x = document.getElementById( 'password' );
					var button = document.getElementById( 'toggle-password' );
					if ( x.type === 'password' ) {
						x.type = 'text';
						button.setAttribute( 'aria-label', 'Hide password' );
						button.classList.add( 'active' );
						button.classList.remove( 'inactive' );
					} else {
						x.type = 'password';
						button.setAttribute( 'aria-label', 'Show password' );
						button.classList.add( 'inactive' );
						button.classList.remove( 'active' );
					}
				}
			</script>

		<?php

	return ob_get_clean();

}

add_filter( 'the_password_form', 'gws_password_protected_page', 99 );

// Hides the header, footer or both if it's a password protected page
function gws_password_protected_page_no_header_footer() {
	if ( post_password_required() ) {
// 		remove_action( 'fl_before_content', 'gws_before_content_header' );
		remove_action( 'fl_after_content', 'gws_after_content_footer' );
	}
}
add_action( 'wp', 'gws_password_protected_page_no_header_footer' );

// Adds a new class to the "body" if it's a password protected page
function gws_password_protected_page_custom_class( $classes ) {
    if ( post_password_required() ) {
        $classes[] = 'password-protected-page';
    }
    return $classes;
}
add_filter( 'body_class', 'gws_password_protected_page_custom_class' );