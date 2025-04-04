<?php


add_action( 'admin_menu', 'pw_add_admin_menu' );
add_action( 'admin_init', 'pw_settings_init' );
function pw_add_admin_menu(  ) {
    add_menu_page( 'wpset', 'wpset', 'manage_options', 'pset', 'pw_options_page' );
}

function pw_settings_init(  ) {
    register_setting( 'general', 'pw_settings' );

    add_settings_section(
        'pw_pluginPage_section',
        __( 'Term Dates', 'pw' ),
        'pw_settings_section_callback',
        'general'
    );


    add_settings_field(
        'pw_intro',
        __( 'Intro', 'pw' ),
        'pw_intro_render',
        'general',
        'pw_pluginPage_section'
    );
}

function pw_textarea_intro_render(  ) {
    $options = get_option( 'pw_settings', array() );
    include 'components/pw_textarea.php';
}

function pw_intro_render() {
    $options = get_option( 'pw_settings', array() );
    $content = isset( $options['pw_intro'] ) ?  $options['pw_intro'] : false;
    wp_editor( $content, 'pw_intro', array(
        'textarea_name' => 'pw_settings[pw_intro]',
        'media_buttons' => false,
    ) );
}

// section content cb
function pw_settings_section_callback() {
    echo '<p>Please copy the following code to the location you would like the term dates infromation to be displayed. Ensure that the text editor is on "Text" so that you are able to pase this code as HTML.</p><p>&lt;div id="term-dates"&gt;&lt;/div&gt;</p>';
}