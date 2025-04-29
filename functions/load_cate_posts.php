<?php

add_action( 'wp_ajax_load_cate_posts', 'load_cate_posts' );
add_action( 'wp_ajax_nopriv_load_cate_posts', 'load_cate_posts' );
function load_cate_posts() {
    $categoryId  = 1;
    $post_type  = $_POST['post_type'] ?? null;

    $return = "<h2>Trending This Week</h2>";

    $return .= '<div class="menu-posts-outer">';

    $post_types = null;
    if ($post_type) {
        $post_types = explode('/', $post_type);
    }

    // load posts in that category

    $category = get_term( $categoryId, 'category' );
    //$category_name = $category->name;

    if (empty($categoryId)){
        $categoryId = null;
    }

    $args = [
        'numberposts' => 4, // Number of recent posts thumbnails to display
        'post_status' => 'publish', // Show only the published posts
        'orderby' => 'post_date',
        //'orderby' => 'rand',
        'cat' => $categoryId,
        'order' => 'DESC',
    ];
    if ($post_types) {
        $args['post_type'] = $post_types;
    }
    $recent_posts = wp_get_recent_posts($args);

    foreach($recent_posts as $post) :

        if ($post_type == "expert_profiles" || $post_type == "offer-items1"){
            $img_url = "";
            if ($post_type == "expert_profiles"){
                $image = get_field("partner_inner_banner", $post['ID']);
                //$size = 'thumbnail';
                //$img_url = $image['sizes'][ $size ];
                //$image = get_field("partner_inner_banner", $post['ID']);
                //$img_url = wp_get_attachment_image_url( $image, $size );
                $size = 'thumbnail';
                $img_url = $image['sizes'][ $size ];
            }
            //if ($post_type == "offer-items"){ $img_url = get_field("partner_inner_banner", $post['ID']); }

            $style = 'style="background:url(';
            //$style .= get_the_post_thumbnail_url($post['ID'], 'post-thumbnail');
            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", $img_url);
            $style .= $iUrl;
            $style .= '); background-size:cover; background-position:center;"';;

        } else{
            if (!has_post_thumbnail($post['ID']) ) {
                $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
            }
            else{
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

        $cat_p = get_ancestors( $categories[0]->term_id, 'category' );

        $termIdVal = 'term_' . $currentcat;

        if (count($cat_p) > 0){
            $termIdVal = 'term_' . $cat_p[0];
        }




        $bcolour = "#F77D66";

        if (!empty(get_field("category_colour", $termIdVal))){
            $bcolour = get_field("category_colour", $termIdVal);
        }

        $border = 'style="border-top: 5px solid '.$bcolour.';"';
        $addBorder = 'border-top: 5px solid '.$bcolour.';';

        $style = str_replace('style="', 'style="'.$addBorder, $style);


        $cur_post_type = get_post_type($post["ID"]);

        $ext = '';

        if ($cur_post_type == "videos"){
            $ext = '<img src="/wp-content/themes/lighttheme/images/vid-btn.png" class="vid-btn">';
        }

        if ($cur_post_type == "podcasts"){
            $ext = '<img src="/wp-content/themes/lighttheme/images/pod-btn.png" class="vid-btn">';
        }


        $return .= '<a href="'.get_permalink($post['ID']).'" title="Read more about '. $post['post_title'] .'...">';
        $return .= '<div '.$style.' class="blog-post-img"><img src="/wp-content/themes/lighttheme/images/menu-trans-req.png">'.$ext.'</div>';
        $return .= '<h4>'.$currentcatname.'</h4>';
        $return .= '<h3>' . $post['post_title'] . "</h3>";
        $return .= '</a>';
    endforeach; wp_reset_query();

    $return .= '</div>';

    echo $return;
    wp_die();
}