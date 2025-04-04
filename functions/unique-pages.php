<?php


add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/css/style-login.css' );
    //wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/js/style-login.js' );
}