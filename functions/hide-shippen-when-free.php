<?php
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );
function my_hide_shipping_when_free_is_available( $rates ) {
    $free = array();

    foreach ( $rates as $rate_id => $rate ) {
        if ( 'free_shipping' === $rate->method_id ) {
            $free[ $rate_id ] = $rate;
            break;
        }
    }

    return ! empty( $free ) ? $free : $rates;
}