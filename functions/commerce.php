<?php
add_theme_support('woocommerce');
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

add_action( 'after_setup_theme', function() {
    add_theme_support( 'woocommerce' );
} );


add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 150,
        'single_image_width'    => 300,

        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
    ) );
}

add_action( 'pre_get_posts', 'iconic_hide_out_of_stock_products' );
function iconic_hide_out_of_stock_products( $q ) {
    if ( ! $q->is_main_query() || is_admin() ) {
        return;
    }
    $outofstock_term = get_term_by( 'name', 'outofstock', 'product_visibility' );
    if ($outofstock_term) {

        $tax_query = (array) $q->get('tax_query');
        $tax_query[] = array(
            'taxonomy' => 'product_visibility',
            'field' => 'term_taxonomy_id',
            'terms' => array( $outofstock_term->term_taxonomy_id ),
            'operator' => 'NOT IN'
        );
        $q->set( 'tax_query', $tax_query );
    }
    remove_action( 'pre_get_posts', 'iconic_hide_out_of_stock_products' );
}

add_action( 'after_setup_theme', 'customtheme_add_woocommerce_support' );
function customtheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}


/**
 * Disable out of stock variations
 * https://github.com/woocommerce/woocommerce/blob/826af31e1e3b6e8e5fc3c1004cc517c5c5ec25b1/includes/class-wc-product-variation.php
 * @return Boolean
 */



add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );
function iconic_cart_count_fragments( $fragments ) {
    $fragments['div.header-cart-count'] = '<div class="header-cart-count">' . WC()->cart->get_cart_contents_count() . '</div>';
    return $fragments;
}