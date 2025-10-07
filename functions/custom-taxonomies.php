<?php
/*
add_action( 'init', 'create_giveaway_tag' );
function create_giveaway_tag() {
    register_taxonomy(
            'giveaway_tag', //your tags taxonomy
            'giveaway',  // Your post type
            array(
                'hierarchical'  => false,
                'label'         => __( 'Tags'),
                'singular_name' => __( 'Tag' ),
                'rewrite'       => true,
                'query_var'     => true
            )
        );
}*/


/*add_action( 'init', 'create_partner_tag' );
function create_partner_tag() {
    register_taxonomy(
        'partner_tag', //your tags taxonomy
        'partner-network',  // Your post type
        array(
            'hierarchical'  => false,
            'label'         => __( 'Tags'),
            'singular_name' => __( 'Tag' ),
            'rewrite'       => true,
            'query_var'     => true
        )
    );
}*/

add_action( 'init', 'experiences_taxonomy');
function experiences_taxonomy() {
    register_taxonomy(
        'experiences_categories',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
        'experiences',        //post type name
        array(
            'hierarchical' => true,
            'label' => 'Experience Categories',  //Display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'experiences', // This controls the base slug that will display before each term
                'with_front' => false // Don't display the category base before
            )
        )
    );
}