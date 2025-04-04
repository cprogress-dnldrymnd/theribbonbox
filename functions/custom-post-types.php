<?php

add_action( 'init', 'testimonial_init' );
function testimonial_init() {
    $args = array(
        'label' => 'Testimonial',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'testimonial'),
        'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',)
    );
    register_post_type( 'testimonial', $args );
}


/*add_action( 'init', 'win_init' );
function win_init() {
    $args = array(
        'label' => 'Giveaway',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'giveaway'),
        'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',)
    );
    register_post_type( 'giveaway', $args );
}*/

/*add_action( 'init', 'giveaway_init' );
function giveaway_init() {
    $args = array(
        'label' => 'Home Page Give Away',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'give-away'),
        'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',)
    );
    register_post_type( 'give-away', $args );
}*/

/*
// Sponsor Custom Post Type
add_action( 'init', 'sponsor_init' );
function sponsor_init() {
    // set up product labels
    $labels = array(
        'name' => 'Sponsors',
        'singular_name' => 'Sponsor',
        'add_new' => 'Add New Sponsor',
        'add_new_item' => 'Add New Sponsor',
        'edit_item' => 'Edit Sponsor',
        'new_item' => 'New Sponsor',
        'all_items' => 'All Sponsors',
        'view_item' => 'View Sponsor',
        'search_items' => 'Search Sponsors',
        'not_found' =>  'No Sponsors Found',
        'not_found_in_trash' => 'No Sponsors found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Sponsors',
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'sponsor'),
        'query_var' => true,
        'menu_icon' => 'dashicons-randomize',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes'
        )
    );
    register_post_type( 'sponsor', $args );

    // register taxonomy
    register_taxonomy('sponsor_category', 'sponsor', array('hierarchical' => true, 'label' => 'Sponsor Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'sponsor-category' )));
}

// Sponsor Custom Post Type
add_action( 'init', 'partner_init' );
function partner_init() {
    // set up product labels
    $labels = array(
        'name' => 'Partners Networks',
        'singular_name' => 'Partner Network',
        'add_new' => 'Add New Partner Network',
        'add_new_item' => 'Add New Partner Network',
        'edit_item' => 'Edit Partner Network',
        'new_item' => 'New Partner Network',
        'all_items' => 'All Partners Networks',
        'view_item' => 'View Partner Network',
        'search_items' => 'Search Partners Networks',
        'not_found' =>  'No Partners Networks Found',
        'not_found_in_trash' => 'No Partners Networks found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Partners Networks',
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'partner-network'),
        'query_var' => true,
        'menu_icon' => 'dashicons-randomize',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes'
        )
    );
    register_post_type( 'partner-network', $args );

    // register taxonomy
    register_taxonomy('partner-category', 'partner-network', array('hierarchical' => true, 'label' => 'Partner Network Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'partner-category' )));
}

add_action( 'init', 'youtube_init' );
function youtube_init() {
    $labels = array(
        'name' => 'Interviews & Videos',
        'singular_name' => 'Interviews & Videos',
        'add_new' => 'Add Interviews & Videos',
        'add_new_item' => 'Add New Interviews & Videos',
        'edit_item' => 'Edit Interviews & Videos',
        'new_item' => 'New Interviews & Videos',
        'all_items' => 'All Interviews & Videos',
        'view_item' => 'View Interviews & Videos',
        'search_items' => 'Search Interviews & Videos',
        'not_found' =>  'No Interviews & Videos Found',
        'not_found_in_trash' => 'No Interviews & Videos found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Interviews & Videos',
    );
    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'youtube-video'),
        'query_var' => true,
        'menu_icon' => 'dashicons-randomize',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes'
        )
    );

   register_post_type( 'youtube-video', $args );
   // register taxonomy
   register_taxonomy('youtube_category', 'youtube-video', array('hierarchical' => true, 'label' => 'Interviews & Videos Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'youtube_category' )));
}


add_action( 'init', 'podcast_init' );
function podcast_init() {
    // set up product labels
    $labels = array(
        'name' => 'Podcast',
        'singular_name' => 'Podcast',
        'add_new' => 'Add Podcast',
        'add_new_item' => 'Add New Podcast',
        'edit_item' => 'Edit Podcast',
        'new_item' => 'New Podcast',
        'all_items' => 'All Podcast',
        'view_item' => 'View Podcast',
        'search_items' => 'Search Podcast',
        'not_found' =>  'No Podcast Found',
        'not_found_in_trash' => 'No Podcast found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Podcast',
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'podcast'),
        'query_var' => true,
        'menu_icon' => 'dashicons-randomize',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes'
        )
    );
    register_post_type( 'podcast', $args );

    // register taxonomy
    register_taxonomy('podcast_category', 'podcast', array('hierarchical' => true, 'label' => 'Podcast Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'podcast_category' )));
}

add_action( 'init', 'create_client_tax' );

function create_client_tax() {
    register_taxonomy(
            'podcast_tag', //your tags taxonomy
            'podcast',  // Your post type
            array(
                'hierarchical'  => false,
                'label'         => __( 'Tags'),
                'singular_name' => __( 'Tag' ),
                'rewrite'       => true,
                'query_var'     => true
            )
        );
}

function discount_init() {
    // set up product labels
    $labels = array(
        'name' => 'Offers and Discounts',
        'singular_name' => 'Offers and Discounts',
        'add_new' => 'Add Offer and Discount',
        'add_new_item' => 'Add New Offer and Discount',
        'edit_item' => 'Edit Offer and Discount',
        'new_item' => 'New Offer and Discount',
        'all_items' => 'All Offer and Discount',
        'view_item' => 'View Offer and Discount',
        'search_items' => 'Search Offer and Discount',
        'not_found' =>  'No Offer and Discount Found',
        'not_found_in_trash' => 'No Offer and Discount found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Offers and Discounts',
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'offer-and-discount'),
        'query_var' => true,
        'menu_icon' => 'dashicons-randomize',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes'
        )
    );
    register_post_type( 'offer-and-discount', $args );

    // register taxonomy
    register_taxonomy('discount-category', 'offer-and-discount', array('hierarchical' => true, 'label' => 'Offer and Discount Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'discount-category' )));
}
add_action( 'init', 'discount_init' );
*/