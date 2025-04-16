<?php

add_shortcode('get_category_posts_nav_new', 'get_category_posts_nav_new_function');
function get_category_posts_nav_new_function(){
  //set_trb_message('get_category_posts_nav_new_function()');

  $cat_html = [];

  // Get 4 most recent posts
  // For each category

  $cat_args = array(
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => 0,
    'meta_query' => array(
      array(
        'key'     => 'page_category',
        'value'   =>  'NULL',
        'compare' => '!='
      )
    ),
    'post_status' => 'publish',
  );

  $categories=get_categories($cat_args);
  //set_trb_message('Categories: ' . count($categories));

  $excluded_posts = get_excluded_b2b_posts();

  // Should loop approximately 60 times
  foreach($categories as $category) {
    $categoryid = $category->cat_ID;
    //var_dump('$category->cat_name: ' . $category->cat_name . '<br>');
    //$currentcatname = $category->cat_name;
    //$currentcatslug = $category->slug;

    //$post_types = [
    //    "post",
    //    "expert_profiles",
    //    "podcasts",
    //    "videos",
    //    "offer-items",
    //    "giveaway-items",
    //    "events",
    //];

    $args = [
      'numberposts' =>    4, // Number of recent posts thumbnails to display
      'order' =>          'desc',
      'post_status' =>    'publish', // Show only the published posts
      'category' =>       $categoryid,
      'exclude' =>        $excluded_posts,
      //'post_type' =>      $post_types,
    ];


    $preferred_post_type = 'post';
    global $categories_post_types;
    $categories_post_type_info = array_filter($categories_post_types, function($var) use ($categoryid) {
      return $var['categoryid'] == $categoryid;
    });
    if (is_array($categories_post_type_info) && $categories_post_type_info) {
      $categories_post_type_info = reset($categories_post_type_info);
      //d($categories_post_type_info);
      //set_trb_message($categories_post_type_info['post_type']);
      $preferred_post_type = $categories_post_type_info['post_type'];
      $args['post_type'] = $preferred_post_type;
    }

    if (isset($orderby) && $orderby) {
      $args['orderby'] = $orderby;
    }

    //d($args);
    $recent_posts = wp_get_recent_posts($args);
    //set_trb_message(count($recent_posts));
    //var_dump(count($recent_posts) . '<br>');
    //d(count($recent_posts));

    // Fertility
    if ($categoryid == 22814) {
      set_trb_message(count($recent_posts));
    }
    if(!is_page(41256)) { 
    $html = "<h2 data-category='" . $category->cat_name. "'>Trending This Week</h2>";
    //$html = "<h2>".$categoryid."</h2>";
    } else {
      $html = '';
    }
    $html .= '<div class="menu-posts-outer">';

    // Should loop 4 * 60 = 240
    if(is_page(41256)) { 
     $html .= '<div class="menu-post-left">';
    $html .= "<h2 data-category='" . $category->cat_name. "'>Trending This Week</h2>";

    }
    foreach ($recent_posts as $post) {
      $html .= renderRecentPost($post);
    }
    if(is_page(41256)) { 
     $html .= '</div>';
     $html .= '<div class="menu-cta">';
     $html .= '<div class="menu-cta-inner">';
     $html .= '<div class="bg-image"> '.wp_get_attachment_image(41297, 'large').' </div>';
     $html .= '<div class="menu-cta-content">';
     $html .= '<h3>Become part of the Community</h3>';
     $html .= '<div class="button-box button-accent button-small text-end button-box-v2 ">
            <a href="/e-guides">JOIN TODAY</a>
        </div>';
     $html .= '</div>';
     $html .= '</div>';
     $html .= '</div>';
    }
    //if ($category->cat_name === 'Parenting') {
    //    var_dump($html);
    //}
    wp_reset_query();
    $html .= '</div>';

    

    $recent_posts_data = [
      'id' => $categoryid,
      'html' => $html,
      'post_type' => $preferred_post_type,
    ];
    array_push($cat_html, $recent_posts_data);
  }
  wp_reset_query();



  // Build post lists for non-category menu items (e.g. Experts)
  $nonCatMenuItems = [];
  $types = 'expert_profiles';
  array_push($nonCatMenuItems,
    ['id' => 22846, 'name' => 'Experts',                        'post_type' => $types, 'category' => null,],
    ['id' => 30447, 'name' => 'Experts > All experts',          'post_type' => $types, 'category' => null,],
    ['id' => 22852, 'name' => 'Experts > Wellbeing',            'post_type' => $types, 'category' => 1159,],
    ['id' => 22848, 'name' => 'Experts > Fertility',            'post_type' => $types, 'category' => 1164,],
    ['id' => 22851, 'name' => 'Experts > Pregnancy',            'post_type' => $types, 'category' => 1165,],
    ['id' => 22850, 'name' => 'Experts > Parenting',            'post_type' => $types, 'category' => 1163,],
    ['id' => 22849, 'name' => 'Experts > Match with an expert', 'post_type' => $types, 'category' => null,],
  );
  $types = ['videos', 'podcasts'];
  array_push($nonCatMenuItems,
    ['id' => 22855, 'name' => 'Watch & listen', 'post_type' => $types, 'category' => null],
    ['id' => 27090, 'name' => 'Videos & podcasts', 'post_type' => $types, 'category' => null],
  );
  $types = 'podcasts';
  array_push($nonCatMenuItems,
    ['id' => 22861, 'name' => 'The Ribbon Box Podcast', 'post_type' => $types, 'category' => null],
    ['id' => 23893, 'name' => 'Podcast > Wellbeing', 'post_type' => $types, 'category' => 1159],
    ['id' => 23894, 'name' => 'Podcast > Fertility', 'post_type' => $types, 'category' => 1164],
    ['id' => 23892, 'name' => 'Podcast > Pregnancy', 'post_type' => $types, 'category' => 1165],
    ['id' => 23891, 'name' => 'Podcast > Parenting', 'post_type' => $types, 'category' => 1163],
  );
  $types = 'videos';
  array_push($nonCatMenuItems,
    ['id' => 22856, 'name' => 'Videos', 'post_type' => $types, 'category' => null],
    ['id' => 22866, 'name' => 'Videos > Wellbeing', 'post_type' => $types, 'category' => 1159],
    ['id' => 22865, 'name' => 'Videos > Fertility', 'post_type' => $types, 'category' => 1164],
    ['id' => 22864, 'name' => 'Videos > Pregnancy', 'post_type' => $types, 'category' => 1165],
    ['id' => 22863, 'name' => 'Videos > Parenting', 'post_type' => $types, 'category' => 1163],
  );
  array_push($nonCatMenuItems,
    ['id' => 23831, 'name' => 'Offers',     'post_type' => ['offer-items', 'giveaway-items', 'events'], 'category' => null],
    ['id' => 22884, 'name' => 'Giveaways',  'post_type' => 'giveaway-items',  'category' => null],
    ['id' => 22883, 'name' => 'Discounts',  'post_type' => 'offer-items',     'category' => null],
    ['id' => 22882, 'name' => 'Events',     'post_type' => 'events',          'category' => null],
  );

  foreach ($nonCatMenuItems as $item) {
    $args = [
      'numberposts' =>    4, // Number of recent posts thumbnails to display
      'order' =>          'desc',
      'post_status' =>    'publish', // Show only the published posts
      'exclude' =>        $excluded_posts,
      'post_type' =>      $item['post_type'],
    ];
    if ($item['category']) {
      $args['category'] = $item['category'];
    }
    $recent_posts = wp_get_recent_posts($args);
if(!is_page(41256)) { 

    $html = "<h2>Trending This Week</h2>";
}     else {
  $html ='';
}
    $html .= '<div class="menu-posts-outer">';
    if(is_page(41256)) { 
     $html .= '<div class="menu-post-left">';
    $html .= "<h2>Trending This Week</h2>";

    }
    foreach ($recent_posts as $post) {
      $html .= renderRecentPost($post);
    }

    if(is_page(41256)) { 
     $html .= '</div>';
     $html .= '<div class="menu-cta">';
     $html .= '<div class="menu-cta-inner">';
     $html .= '<div class="bg-image"> '.wp_get_attachment_image(41297, 'large').' </div>';
     $html .= '<div class="menu-cta-content">';
     $html .= '<h3>Become part of the Community</h3>';
     $html .= '<div class="button-box button-accent button-small text-end button-box-v2 ">
            <a href="/community">JOIN TODAY</a>
        </div>';
     $html .= '</div>';
     $html .= '</div>';
     $html .= '</div>';
    }
    $html .= '</div>';


    $recent_posts_data = [
      'menuItemId' => $item['id'],
      'html' => $html,
      //'post_type' => $item['post_type'],
    ];
    array_push($cat_html, $recent_posts_data);
  }





  // Get 4 most recent posts
  // For each post type (for page links)

  $post_types = [
    "post",
    "expert_profiles",
    "podcasts",
    "videos",
    "offer-items",
    "giveaway-items",
    "events",
  ];
  foreach ($post_types as $pt) {
    $cont = false;

//        if ($pt == "post"){
//            $cont = true;
//        } else if ($pt != "post"){
//            $cont = true;
//        }

//        if ($cont) {
//            $post_typesV = explode('/', $pt);
//
//            $args = array(
//                'numberposts' => 4, // Number of recent posts thumbnails to display
//                'order' => 'desc',
//                'post_status' => 'publish', // Show only the published posts
//                'post_type' => $post_typesV,
//                'exclude' => get_excluded_b2b_posts(),
//            );
//            if (isset($orderby)) {
//                $args['orderby'] = $orderby;
//            }
//            $recent_posts = wp_get_recent_posts($args);
//
//            $return = "<h2>Trending This Week</h2>";
//            $return .= '<div class="menu-posts-outer">';
//
//            foreach ($recent_posts as $post) {
//                $return .= renderRecentPost($post);
//            }
//            wp_reset_query();
//
//            $return .= '</div>';
//            $recent_posts_data = array(
//                'id' => $categoryid,
//                'html' => $return,
//                "post_type" => $pt,
//            );
//            array_push($cat_html, $recent_posts_data);
//        }
  }
  return json_encode($cat_html);
}

function renderRecentPost($post) {
  $return = '';
  //d($post_type);
  //d($post["ID"]);

  //$post_type = $pt;

  //$post_type  = get_post_type();
  if (isset($post_type) && ($post_type == "expert_profiles" || $post_type == "offer-items1")) {
    $img_url = "";
    if ($post_type == "expert_profiles") {
      $image = get_field("partner_inner_banner", $post['ID']);
      //$size = 'thumbnail';
      //$img_url = $image['sizes'][ $size ];
      //$image = get_field("partner_inner_banner", $post['ID']);
      //$img_url = wp_get_attachment_image_url( $image, $size );
      $size = 'thumbnail';
      $img_url = $image['sizes'][$size];
    }
    //if ($post_type == "offer-items"){ $img_url = get_field("partner_inner_banner", $post['ID']); }

    $style = 'style="';
    //$style .= get_the_post_thumbnail_url($post['ID'], 'post-thumbnail');
    $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", $img_url);
    $style .= $iUrl;
    $style .= ') background-size:cover; background-position:center;"';;

  }
  else {
    if (!has_post_thumbnail($post['ID'])) {
      $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
    } else {
      $style = 'style="background:url(';
      //$style .= get_the_post_thumbnail_url($post['ID'], 'post-thumbnail');
      $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], 'thumbnail'));
      $style .= $iUrl;
      $style .= '); background-size:cover; background-position:center;"';;
    }
  }

  // remove once have images...
  //$style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';

  $categories = get_the_category($post["ID"]);
  $currentcat = $categories[0]->cat_ID;
  $currentcatname = $categories[0]->cat_name;
  $currentcatslug = $categories[0]->slug;

  $cat_p = get_ancestors($categories[0]->term_id, 'category');

  if (!empty($categoryid)) {
    $term1 = get_term_by('id', $categoryid, 'category');
    $currentcat = $categoryid;
    $currentcatname = $term1->name;
    $currentcatslug = $term1->slug;
    //$termIdVal = 'term_' . $categoryid;
    //$categories = get_category($termIdVal);
    $cat_p = get_ancestors($categoryid, 'category');
  }

  $termIdVal = 'term_' . $currentcat;

  if (count($cat_p) > 0) {
    $termIdVal = 'term_' . $cat_p[0];
  }

  $bcolour = "#F77D66";
  if (!empty(get_field("category_colour", $termIdVal))) {
    $bcolour = get_field("category_colour", $termIdVal);
  }
  $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
  $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
  $style = str_replace('style="', 'style="' . $addBorder, $style);

  $cur_post_type = get_post_type($post["ID"]);

  $ext = '';
  if ($cur_post_type == "videos") {
    $ext = '<img src="/wp-content/themes/lighttheme/images/vid-btn.png" class="vid-btn">';
  }
  if ($cur_post_type == "podcasts") {
    $ext = '<img src="/wp-content/themes/lighttheme/images/pod-btn.png" class="vid-btn">';
  }

  $post_image = get_the_post_thumbnail_url($post['ID'], 'thumbnail');

  $return .=
    '<a class="post format-nav-recent post-type-' . $cur_post_type. '"
            href="' . get_permalink($post['ID']) . '" title="Read more about ' . $post['post_title'] . '...">'
    . '<img src="'.$post_image.'" ' . $style . ' class="blog-post-img" style="background-size:cover; background-position:center;">'
    . '<h4>' . $currentcatname . '</h4>'
    . '<h3>' . $post['post_title'] . "</h3>"
    . '</a>';
  return $return;
}


//add_shortcode('get_category_posts_nav', 'get_category_posts_nav_function');
//function get_category_posts_nav_function(){
//
//    $cat_args = array(
//        'orderby' => 'name',
//        'order' => 'ASC',
//        'hide_empty' => 0,
//            'meta_query' => array(
//                array(
//                    'key'     => 'page_category',
//                    'value'   =>  'NULL',
//                    'compare' => '!='
//                )
//            ),
//        'post_status' => 'publish',
//    );
//
//
//    $cat_html = [];
//
//    $categories=get_categories($cat_args);
//
//    foreach($categories as $category) :
//
//        $categoryid = $category->cat_ID;
//        $currentcatname = $category->cat_name;
//        $currentcatslug = $category->slug;
//
//        $post_types = array("post", "expert_profiles", "videos/podcasts", "podcasts", "videos", "offer-items/giveaway-items/events", "offer-items", "giveaway-items", "events");
//        //$post_types = array("events");
//
//        foreach ($post_types as $pt) {
//
//            $cont = false;
//
//            if ($pt == "post"){
//                $cont = true;
//            } else if ($pt != "post" && true){
//                $cont = true;
//            }
//
//            if ($cont){
//                $post_typesV = explode('/', $pt);
//
//                $recent_posts = wp_get_recent_posts(array(
//                    'numberposts' => 4, // Number of recent posts thumbnails to display
//                    'orderby'           => $orderby,
//                    'order'             => 'desc',
//                    'post_status' => 'publish', // Show only the published posts
//                    'category'         => $categoryid,
//                    'post_type' => $post_typesV,
//                ));
//
//                $return = "<h2>Trending This Week</h2>";
//
//                $return .= '<div class="menu-posts-outer">';
//
//                foreach($recent_posts as $post) :
//
//
//                if (isset($post_type) && ($post_type == "expert_profiles" || $post_type == "offer-items1")){
//                    $img_url = "";
//                    if ($post_type == "expert_profiles"){
//                        $image = get_field("partner_inner_banner", $post['ID']);
//                        //$size = 'thumbnail';
//                        //$img_url = $image['sizes'][ $size ];
//                        //$image = get_field("partner_inner_banner", $post['ID']);
//                        //$img_url = wp_get_attachment_image_url( $image, $size );
//                        $size = 'thumbnail';
//                        $img_url = $image['sizes'][ $size ];
//                    }
//                    //if ($post_type == "offer-items"){ $img_url = get_field("partner_inner_banner", $post['ID']); }
//
//                        $style = 'style="background:url(';
//                        //$style .= get_the_post_thumbnail_url($post['ID'], 'post-thumbnail');
//                        $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", $img_url);
//                        $style .= $iUrl;
//                        $style .= '); background-size:cover; background-position:center;"';;
//
//                } else{
//                    if (!has_post_thumbnail($post['ID']) ) {
//                        $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
//                    }
//                    else{
//                        $style = 'style="background:url(';
//                        //$style .= get_the_post_thumbnail_url($post['ID'], 'post-thumbnail');
//                        $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], 'thumbnail'));
//                        $style .= $iUrl;
//                        $style .= '); background-size:cover; background-position:center;"';;
//                    }
//                }
//
//
//                // remove once have images...
//                //$style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
//
//                $categories = get_the_category($post["ID"]);
//                $currentcat = $categories[0]->cat_ID;
//                $currentcatname = $categories[0]->cat_name;
//                $currentcatslug = $categories[0]->slug;
//
//                $cat_p = get_ancestors( $categories[0]->term_id, 'category' );
//
//                if (!empty($categoryid)){
//                    $term1 = get_term_by( 'id', $categoryid, 'category' );
//                    $currentcat = $categoryid;
//                    $currentcatname = $term1->name;
//                    $currentcatslug = $term1->slug;
//                    //$termIdVal = 'term_' . $categoryid;
//                    //$categories = get_category($termIdVal);
//                    $cat_p = get_ancestors( $categoryid, 'category' );
//                }
//
//                $termIdVal = 'term_' . $currentcat;
//
//                if (count($cat_p) > 0){
//                    $termIdVal = 'term_' . $cat_p[0];
//                }
//
//
//
//
//                $bcolour = "#F77D66";
//
//                if (!empty(get_field("category_colour", $termIdVal))){
//                    $bcolour = get_field("category_colour", $termIdVal);
//                }
//
//                $border = 'style="border-top: 5px solid '.$bcolour.';"';
//                $addBorder = 'border-top: 5px solid '.$bcolour.';';
//
//                $style = str_replace('style="', 'style="'.$addBorder, $style);
//
//
//                $cur_post_type = get_post_type($post["ID"]);
//
//                $ext = '';
//
//                if ($cur_post_type == "videos"){
//                    $ext = '<img src="/wp-content/themes/lighttheme/images/vid-btn.png" class="vid-btn">';
//                }
//
//                if ($cur_post_type == "podcasts"){
//                    $ext = '<img src="/wp-content/themes/lighttheme/images/pod-btn.png" class="vid-btn">';
//                }
//
//
//                $return .= '<a href="'.get_permalink($post['ID']).'" title="Read more about '. $post['post_title'] .'...">';
//                $return .= '<div '.$style. ' class="blog-post-img"><img src="/wp-content/themes/lighttheme/images/menu-trans-req.png">' .$ext.'</div>';
//                $return .= '<h4>'.$currentcatname.'</h4>';
//                $return .= '<h3>' . $post['post_title'] . "</h3>";
//                $return .= '</a>';
//
//                endforeach; wp_reset_query();
//
//                $return .= '</div>';
//
//
//                $recent_posts_data = array('id' => $categoryid, 'html' => $return, "post_type" => $pt);
//
//
//                array_push($cat_html, $recent_posts_data);
//
//            }
//
//
//        }
//
//        endforeach; wp_reset_query();
//
//    return json_encode($cat_html);
//}

// add_shortcode('display_post_tags', 'display_post_tags');

// function display_post_tags($title) {
//     $tags = get_tags($post->ID);
//         foreach($tags as $tag) {
//             echo'<a href="'. get_tag_link($tag->term_id) .'" rel="tag">'.$tag->name.'</a>';
//         }
// }