<?php
//html comments remove by dd
//echo "<!-- index-standard-post-types-style.php -->";

$post_type_simp = "";

if ( $cur_post_type_val == 'videos') {          $post_type_simp = "Video";}
if ( $cur_post_type_val == 'podcasts') {        $post_type_simp = "Podcast";}
if ( $cur_post_type_val == 'expert_profiles') { $post_type_simp = "Expert";}
if ( $cur_post_type_val == 'offer-items') {     $post_type_simp = "Offer";}
if ( $cur_post_type_val == 'giveaway-items') {  $post_type_simp = "Giveaway";}

if (! has_post_thumbnail($post->ID) ) {
    $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center; color: blue;"';
}
else{
    if (!empty(get_field("post_large_image", $post->ID))){
        $style = 'style="color: blue; background:url(';
        //$style .= get_the_post_thumbnail_url($post['ID'], 'post-thumbnail');
        $iUrl = get_field("post_large_image", $post->ID);
        $style .= $iUrl;
        $style .= '); background-size:cover; background-position:center; color: blue;"';

    } else if (!empty(get_field("partner_inner_banner", $post->ID))){
        $image = get_field("partner_inner_banner", $post->ID);
        $size = 'full';
        $partner_inner_banner = $image['url'];

        $style = 'style="background:url(';
        //$style .= get_the_post_thumbnail_url($post['ID'], 'post-thumbnail');

        $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", $partner_inner_banner);
        $style .= $iUrl;
        $style .= '); background-size:cover; background-position:center;"';

    }
    else{
        $style = 'style="background:url(';
        //$style .= get_the_post_thumbnail_url($post['ID'], 'post-thumbnail');
        $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", get_the_post_thumbnail_url($post->ID, 'post-thumbnail'));
        $style .= $iUrl;
        $style .= '); background-size:cover; background-position:center; color: blue;"';
    }

}

$categories = get_the_category(get_the_ID());
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

$ad = "";
$addd = "";
$hexRGB = $bcolour;
//$is_bright_colour =
//    hexdec(substr($hexRGB,0,2))
//    + hexdec(substr($hexRGB,2,2))
//    + hexdec(substr($hexRGB,4,2)) > 100;
//if ($is_bright_colour){
//    //$ad = "bright color";
//}
//else{
//    //$ad = "dark color";
//    $ad = 'class="light-text"';
//    $addd = "light-text";
//}
$ad = 'class="light-text"';
$addd = "light-text";

if ($bcolour == "#034146"){
    $ad = 'class="light-text"';
    $addd = "light-text";
} else{
    $ad = "";
    $addd = "";
}