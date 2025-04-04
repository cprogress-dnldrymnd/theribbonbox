<?php
if( ! empty( $pagination_posts ) ){
  $output = '<ol class="pagination hidden">';
  foreach ( $pagination_posts as $pagination_post ){
    $output .= '<li><a href="' . get_permalink( $pagination_post->ID ) . '">'
      . $pagination_post->post_title . '</a></li>';
  }
  $output .= '</ol>';
  echo $output;
}