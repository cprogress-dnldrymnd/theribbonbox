<?php
add_action('wp_head', 'addLinkstoHeader', 10);

/**
 * @return array|false[]
 *   An array in form: ['prev' => id, 'next' => id];
 */
function getPrevNextIds($post_id = null) {
  if (! $post_id) {
    global $post;
    // $post = get_post()->ID;
    // $prev_post = get_permalink(get_adjacent_post(false,'',true)->ID);
    // $next_post = get_permalink( get_adjacent_post(false,'',false)->ID);
    $post_id = $post->ID; // current post ID
  }
  $cat = get_the_category();
  $current_cat_id = $cat[0]->cat_ID; // current category ID

  $args = [
    'category' => $current_cat_id,
    'orderby'  => 'post_date',
    'order'    => 'DESC'
  ];
  $posts = get_posts( $args );
  // get IDs of posts retrieved from get_posts
  $ids = array();
  foreach ( $posts as $thepost ) {
    $ids[] = $thepost->ID;
  }
  // get and echo previous and next post in the same category
  $thisindex = array_search( $post_id, $ids );
  return [
    'prev' => isset( $ids[ $thisindex - 1 ] ) ? $ids[ $thisindex - 1 ] : false,
    'next' => isset( $ids[ $thisindex + 1 ] ) ? $ids[ $thisindex + 1 ] : false,
  ];
}

function addLinkstoHeader(){
    if (!is_single()) {
        return;
    }
    $ids = getPrevNextIds();

    ?>
    <?php if ($ids['prev']) : ?><link rel="prev" href="<?php echo get_permalink($ids['prev']) ?>">
        <?php else: ?><!-- <link rel="prev"> No previous post --><?php endif; ?>

    <?php if ($ids['next']) : ?><link rel="next" href="<?php echo get_permalink($ids['next']) ?>">
        <?php else: ?><!-- <link rel="next"> No next post --><?php endif; ?>
    <?php
}