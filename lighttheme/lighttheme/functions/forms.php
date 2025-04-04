<?php
/**
 * Redirect URL with random success value for WPForms after form submission.
 *
 * @link https://wpforms.com/developers/wpforms_process_complete/
 *
 * @param array  $fields    Sanitized fields data.
 * @param array  $entry     The current entry data.
 * @param array  $form_data Form data.
 */
function custom_wpforms_redirect_with_random_success( $fields, $entry, $form_data ) {
    // Check if the form ID matches the form you want to modify (26281 in the example).
    if ( absint( $form_data['id'] ) === 28522 ) {
        // Generate a random success value with 9 digits.
        $random_success = rand( 100000000, 999999999 );
        // Append the random success value as a query parameter to the URL.
        $redirect_url = add_query_arg( 'succes', $random_success, '/thank-you-for-subscribing/' );
        // Redirect the user to the modified URL.
        wp_redirect( $redirect_url );
        exit;
    }
}
add_action( 'wpforms_process_complete', 'custom_wpforms_redirect_with_random_success', 10, 3 );

add_shortcode('display_login_form', 'display_login_form');

function display_login_form() {
    $args = array(
        'echo' => true
        // 'redirect' => site_url('/b2b-home-page'),
    );
    return wp_login_form($args);
}