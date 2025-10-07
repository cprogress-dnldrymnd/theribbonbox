<?php
//html comments remove by dd
//echo "<!-- index-post-types-featured-content.php -->";

include 'index-standard-post-types-style.php';

$featured_podcast = get_field("promo_podcast", $post->ID);
$featured_video = get_field("featured_podcast_video", $post->ID);
$featured_giveaway = get_field("featured", $post->ID);
$featured_expert = get_field("featured_expert", $post->ID);

$featured_handpicked = get_field("handpicked", $post->ID);

$featured_cur = "";

if (!empty($featured_podcast) || !empty($featured_video) || !empty($featured_giveaway) || !empty($featured_expert)){
    $featured_cur = '<div class="featured-sign" style="background:'.$bcolour.';"><p class="light-text"><span>Featured<br>'.$post_type_simp.'</span></p></div>';
}

if (!empty($featured_podcast) || !empty($featured_video) || !empty($featured_giveaway) || !empty($featured_expert)){
    //$featured_cur = '<div class="featured-sign" style="background:'.$bcolour.'e8;"><p class="light-text"><span>Featured<br>'.$post_type_simp.'</span></p></div>';
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Featured</span><br>'.$post_type_simp.'</p></div>';
}

if (!empty($featured_handpicked)){
    //$featured_cur = '<div class="featured-sign" style="background:'.$bcolour.';"><p class="light-text"><span>Handpicked<br>'.$currentcatname.'</span></p></div>';
    $featured_cur =  '<div class="exprets-de-circle" style="background:'.$bcolour.'e8;"><p '.$ad.'><span>Handpicked</span><br>'.$currentcatname.'</p></div>';
}

$post_sticker = get_field("post_sticker", $post->ID);

if (!empty($post_sticker)){
    include 'index-post-sticker.php';
}

$post_type = get_post_type( get_the_ID() );
if ($post_type == 'expert_profiles'){
    include 'index-expert-profiles.php';
} else if ($post_type == 'giveaway-items'){
    include 'index-giveaway-items.php';
} else if ($post_type == 'offer-items'){
    include 'index-offer-items.php';
} else if ($post_type == 'events'){
    include 'index-events.php';
} else {
    include 'index-other-pages.php';
}

//echo '
//<div class="tpl-54 blog-top-ban">
//    <div class="blog-l-img" '.$style.'>
//        <img src="/wp-content/themes/lighttheme/images/menu-trans-req.png">
//    </div>
//    <div class="blog-l-text-out" '.$border.'>
//        <div class="blog-l-text" >
//            <h3>'.$currentcatname.'</h3>
//            <h2>'.$post['post_title'].'</h2>
//            <p>'.$text.'</p>
//            <h4>'.get_the_date('j M Y', $post->ID).'</h4>
//            <div class="blog-btns">
//                <a href="'.get_permalink($post->ID).'">Read More</a>
//            </div>
//        </div>
//    </div>
//</div>';


//echo '<div class="blogposts-outer">';
if (has_post_thumbnail( $post->ID ) ):
    //echo '<img src="'.get_the_post_thumbnail_url($post).'">';
endif;
//echo '<span class="date-span"><strong>'.get_the_date('F j, Y', $post->ID).'</strong></span>';
//echo "<h1>" . the_title() . "</h1>";
//the_content();
//echo "</div>";