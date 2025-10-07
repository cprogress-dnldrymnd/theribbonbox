<?php

add_action( 'wp_ajax_blog_filter_load_function', 'blog_filter_load_function' );
add_action( 'wp_ajax_nopriv_blog_filter_load_function', 'blog_filter_load_function' );

function blog_filter_load_function() {
    $format =     $_POST['format'];
    $limit =      $_POST['limit'];
    $curtotal =   $_POST['curtotal'];
    $categoryid = $_POST['categoryid'];
    $post_type =  $_POST['post_type'];
    $add_ad =     $_POST['add_ad'];

    echo do_shortcode("[blog_filter
        format='".$format."'
        limit='".$limit."'
        add_ad='".$add_ad."'
        curtotal='".$curtotal."'
        categoryid='".$categoryid."'
        post_type='".$post_type."'
    ]");
    wp_die();
}


add_action( 'wp_ajax_blog_load_post_function', 'blog_load_post_function' );
add_action( 'wp_ajax_nopriv_blog_load_post_function', 'blog_load_post_function' );

function blog_load_post_function() {
    $categoryid = $_POST['categoryid'];
    $posttype = $_POST['posttype'];
    $excludeids = $_POST['excludeids'];

    echo do_shortcode("[blog_load_next categoryid='".$categoryid."' posttype='".$posttype."' exclude='".$excludeids."']");
    wp_die();
}