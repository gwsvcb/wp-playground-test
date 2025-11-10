<?php

function gws_header() {

    $aria_hidden = post_password_required() ? 'true' : '';

    $logo = file_exists( get_stylesheet_directory() . '/assets/images/logo.svg' ) ? get_stylesheet_directory_uri() . '/assets/images/logo.svg' : get_stylesheet_directory_uri() . '/assets/images/logo.png';

    ob_start();

    ?>

    <a class="screen-reader-text" href="#main-navigation" aria-label="Skip to navigation" <?php echo $aria_hidden ? 'aria-hidden="true"' : ''; ?> >Skip to navigation</a>
    
    <a class="screen-reader-text" href="#fl-main-content" aria-label="Skip to content" <?php echo $aria_hidden ? 'aria-hidden="true"' : ''; ?> >Skip to content</a>
    
    <a class="screen-reader-text" href="#main-footer" aria-label="Skip to footer" <?php echo $aria_hidden ? 'aria-hidden="true"' : ''; ?> >Skip to footer</a>
    
    <header <?php echo $aria_hidden ? 'aria-hidden="true"' : ''; ?> >

        <?php

        $announcement_bar = get_theme_mod( 'details_announcement_bar' );
        $announcement_message = get_theme_mod( 'details_announcement_message' );
        $button_text = get_theme_mod( 'details_announcement_button_text' );
        $button_link = get_theme_mod( 'details_announcement_button_link' );

        if ( ! empty( $announcement_bar ) ) :

        ?>

        <aside id="announcement-bar" role="alert" aria-label="Announcement">
			
            <p>
                <?php echo esc_html( $announcement_message ); ?>
            </p>

            <?php if ( ! empty( $button_text ) && ! empty( $button_link ) ) : ?>

                <a href="<?php echo esc_url( $button_link ); ?>">
                    <?php echo esc_html( $button_text ); ?>
                </a>

            <?php endif; ?>

            <button class="announcement-close" aria-label="Close announcement bar"></button>

        </aside>

        <?php endif; ?>  

        <div id="top-bar" class="container-max-width">

            <div class="contact-details" role="navigation" aria-label="Contact details">

                <?php echo do_shortcode( '[phone]' ); ?><?php echo do_shortcode( '[email]' ); ?>

            </div>

            <?php echo do_shortcode( '[social_media]' ); ?>

        </div>

        <div id="main-header" class="container-max-width">

            <div class="logo">

                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Visit <?php echo esc_attr( get_bloginfo( 'name' ) ); ?>'s homepage">

                     <img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">

                </a>

            </div>

            <div class="navigation">

                <?php echo do_shortcode( '[fl_builder_insert_layout id=xxx]' ); ?>

            </div>

        </div>

    </header>

    <?php

    return ob_get_clean();

}

add_shortcode( 'header', 'gws_header' );