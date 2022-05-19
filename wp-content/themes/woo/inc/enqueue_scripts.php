<?php
/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'woo-css', get_theme_file_uri( 'assets/css/main.min.css' ) );
    wp_enqueue_script( 'woo-js', get_theme_file_uri( 'assets/js/main.min.js' ), array(), null, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
} );
