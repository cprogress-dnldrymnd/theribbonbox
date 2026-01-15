<?php

function get_excluded_b2b_posts() {
  //is_b2b_user();
  if (is_b2b_page()) {
    return [];
  }
  // Is not a B2B page

  $excluded_posts_IDs = [];
  $args_featured = [
    'post_type' => ['post', 'events', 'offer-items'],
    'meta_query' => [
      [
        'key' => 'b2b_content',
        'value' => '1',
        'compare' => 'LIKE',
      ],
    ],
  ];
  $query_featured = new WP_Query($args_featured);
  if ($query_featured->have_posts()) {
    while ($query_featured->have_posts()) {
      $query_featured->the_post();
      $excluded_posts_IDs[] = get_the_ID();
    }
  }
  //echo $excluded_posts_IDs;

  wp_reset_query(); // Unsure if this is necessary
  return $excluded_posts_IDs;
}

add_shortcode('b2b_posts', 'get_b2b_posts');
function get_b2b_posts($attributes) {
  $posts = get_posts([
    'posts_per_page'  => $attributes['limit'],
    'offset'          => $attributes['offset'],
    'post_type'       => 'post',
    'meta_key'        => 'b2b_content',
    'meta_value'      => '1'
  ]);
  //d($posts);
  //var_dump(count($posts));

  $templates = [
    'home-small-post-odd.php', //tpl-50.php
    'home-small-post-even.php', //tpl-49.php
    'home-small-post-odd.php', //tpl-50.php

    'home-posts-odd.php', // 46.php
    'home-posts-even.php', // 45.php

    'tpl-48.php',
    'tpl-47.php',
  ];

  $rtn = '<div class="blogs-loop"><div class="blogs-loop-inner">';
  for ($i = 0; $i < count($posts); $i++) {
    /** @var WP_Post $post */
    $post = [
      'ID' => $posts[$i]->ID,
      'post_title' => $posts[$i]->post_title,
    ];
    $format = 'normal-4';
    $in_count = $i;
    $this_post_type = 'post';
    $addBorder = 'border-top: 5px solid #ffdbd1;';
    $iUrl = get_the_post_thumbnail_url($posts[$i], 'thumbnail');
    $more_text = '';
    $ext = ''; // get_permalink($posts[$i]);
    $ex_txt = '';
    $more_t_text = 'Read more';

    $categories = get_the_category($posts[$i]->ID);
    if ($categories) {
      $currentcat = $categories[0]->cat_ID;
      $currentcatname = $categories[0]->cat_name;
    }
    $template = $templates[$i + $attributes['offset']];
    include get_template_directory() . "/components/posts/$template";
  }
  $rtn .= '</div></div>';
  return $rtn;
}
