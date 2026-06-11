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

/**
 * Tag-like (non-hierarchical) taxonomies for the "offer-items" post type.
 */
add_action( 'init', 'trb_offer_items_taxonomies' );
function trb_offer_items_taxonomies() {
    $taxonomies = array(
        'health-goal'    => array( 'Health Goal', 'Health Goals' ),
        'lifestyle'      => array( 'Lifestyle', 'Lifestyles' ),
        'life-stage'     => array( 'Life Stage', 'Life Stages' ),
        'discount-level' => array( 'Discount Level', 'Discount Levels' ),
    );

    foreach ( $taxonomies as $slug => $names ) {
        list( $singular, $plural ) = $names;

        register_taxonomy( $slug, 'offer-items', array(
            'hierarchical'      => false, // tags-style
            'labels'            => array(
                'name'                       => $plural,
                'singular_name'              => $singular,
                'menu_name'                  => $plural,
                'all_items'                  => 'All ' . $plural,
                'edit_item'                  => 'Edit ' . $singular,
                'update_item'                => 'Update ' . $singular,
                'add_new_item'               => 'Add New ' . $singular,
                'new_item_name'              => 'New ' . $singular . ' Name',
                'search_items'               => 'Search ' . $plural,
                'popular_items'              => 'Popular ' . $plural,
                'separate_items_with_commas' => 'Separate ' . strtolower( $plural ) . ' with commas',
                'add_or_remove_items'        => 'Add or remove ' . strtolower( $plural ),
                'choose_from_most_used'      => 'Choose from the most used ' . strtolower( $plural ),
                'not_found'                  => 'No ' . strtolower( $plural ) . ' found',
            ),
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => $slug ),
        ) );
    }
}