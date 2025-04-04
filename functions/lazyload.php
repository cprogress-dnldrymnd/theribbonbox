<?php
// add_filter( 'wp_lazy_loading_enabled', '__return_false' );
/*
add_filter( 'the_content', 'my_lazyload_content_images' );
add_filter( 'widget_text', 'my_lazyload_content_images' );
add_filter( 'wp_get_attachment_image_attributes', 'my_lazyload_attachments', 10, 2 );

// Replace the image attributes in Post/Page Content
function my_lazyload_content_images( $content ) {
    $content = preg_replace( '/(<img.+)(src)/Ui', '$1data-$2', $content );
    $content = preg_replace( '/(<img.+)(srcset)/Ui', '$1data-$2', $content );
    return $content;
}

// Replace the image attributes in Post Listing, Related Posts, etc.
function my_lazyload_attachments( $atts, $attachment ) {
    $atts['data-src'] = $atts['src'];
    unset( $atts['src'] );

    if( isset( $atts['srcset'] ) ) {
        $atts['data-srcset'] = $atts['srcset'];
        unset( $atts['srcset'] );
    }

    return $atts;
}

add_action( 'wp_enqueue_scripts', 'my_lazyload_assets', 10 );
function my_lazyload_assets() {
    $js_dir = get_stylesheet_directory_uri() . '/js';
    wp_enqueue_script( 'my-lazyload', $js_dir . '/lazyload.js', [], '', true );
}*/