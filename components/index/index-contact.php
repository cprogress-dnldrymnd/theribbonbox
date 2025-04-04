<?php
echo "<!-- index-contact.php -->";

$nav = array(
    'post_type' => 'page',
    'orderby' => 'menu_order',
    'numberposts' => 100000,
    'order' => 'ASC',
    'post_parent' => $post->ID
);

$child_pages = get_posts($nav);

if (isset($child_pages->post_count) && $child_pages->post_count > 0){
    if ( empty( get_the_content() ) ){
        echo '<div class="oth-tile-outer mind-bread">';
    } else{
        echo '<div class="oth-tile-outer">';
    }


    if (the_title('','',false) == "Sectors"){
        echo '<div class="oth-tile-inner sectors-tile-inner">';
    } else{
        echo '<div class="oth-tile-inner">';
    }

    foreach ($child_pages as $postItm) :
        echo '<a href="'.get_permalink($postItm->ID).'" class="oth-strip-itm" style="background:url('.get_the_post_thumbnail_url($postItm->ID).'); background-size: cover; background-position: center;">
                        <img src="/wp-content/themes/lighttheme/images/squ_trans.png">
                        <span class="oth-tl-over"></span>
                        <span class="oth-strip-in">
                            <h3>'.$postItm->post_title.'</h3>
                            <span class="oth-strip-lnk">Read More</span>
                        </span></a>';
    endforeach;
    wp_reset_postdata();
    echo '<div class="end"></div>';
    echo '</div>';
    echo '</div>';

}