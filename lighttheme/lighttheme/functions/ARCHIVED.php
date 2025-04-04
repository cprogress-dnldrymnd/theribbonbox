<?php


/*
* Define a constant path to our single template folder
*/
//define(SINGLE_PATH, TEMPLATEPATH . '/single');

/**
 * Filter the single_template with our custom function
 */
//add_filter('single_template', 'my_single_template');

/**
 * Single template function which will choose our template
 */

/*
function my_single_template($single) {
  global $wp_query, $post;

  foreach((array)get_the_category() as $cat) :
    return SINGLE_PATH . '/single-cat-blog.php';
  endforeach;
}
*/