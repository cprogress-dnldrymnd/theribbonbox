<?php
add_filter( 'nav_menu_link_attributes', 'trb_av_menu_link_attributes', 10, 3 );
/*
 * Filters the HTML attributes applied to a menu item's anchor element.
 */
function trb_av_menu_link_attributes( $atts, $item, $args ) {
    $cat_args = array(
        'orderby' => 'name',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key'     => 'page_category',
                'value'   =>  $item->object_id,
                'compare' => 'LIKE'
            )
        ),
        'post_status' => 'publish',
    );

    $categories=get_categories($cat_args);

    $atts['pageId'] = $item->object_id;
    //$atts['categoryId'] = $categories[0]->term_id;

    if (! isset($categories[0])) {
        return;
    }
    $category_id = $categories[0]->term_id;

    if (empty($category_id)){
        //$category_id = "0";
    }

    if ($item->object_id == "24548"){$atts['categoryId'] = "1159";}
    else if ($item->object_id == "24549"){$atts['categoryId'] = "1164";}
    else if ($item->object_id == "24550"){$atts['categoryId'] = "1165";}
    else if ($item->object_id == "24551"){$atts['categoryId'] = "1163";}
    else {$atts['categoryId'] = $categories[0]->term_id;}

    if ($item->object_id == "22822" || $item->object_id == "22824"){ $atts['post_type'] = "videos/podcasts"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "22828"){ $atts['post_type'] = "videos"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "22832"){ $atts['post_type'] = "videos"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "22830"){ $atts['post_type'] = "videos"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "22834"){ $atts['post_type'] = "videos"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "22836"){ $atts['post_type'] = "videos"; $atts['cus_post'] = "1"; }

    else if ($item->object_id == "22826"){ $atts['post_type'] = "podcasts"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "23883"){ $atts['post_type'] = "podcasts"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "23885"){ $atts['post_type'] = "podcasts"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "23887"){ $atts['post_type'] = "podcasts"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "23889"){ $atts['post_type'] = "podcasts"; $atts['cus_post'] = "1"; }

    else if ($item->object_id == "22808"){ $atts['post_type'] = "expert_profiles"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "22810"){ $atts['post_type'] = "expert_profiles"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "22812"){ $atts['post_type'] = "expert_profiles"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "22814"){ $atts['post_type'] = "expert_profiles"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "22816"){ $atts['post_type'] = "expert_profiles"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "22818"){ $atts['post_type'] = "expert_profiles"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "22820"){ $atts['post_type'] = "expert_profiles"; $atts['cus_post'] = "1"; }

    else if ($item->object_id == "23831"){ $atts['post_type'] = "offer-items/giveaway-items/events"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "22840"){ $atts['post_type'] = "giveaway-items"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "22842"){ $atts['post_type'] = "offer-items"; $atts['cus_post'] = "1"; }
    else if ($item->object_id == "22844"){ $atts['post_type'] = "events"; $atts['cus_post'] = "1"; }
    else { $atts['post_type'] = "post"; }

    return $atts;
}