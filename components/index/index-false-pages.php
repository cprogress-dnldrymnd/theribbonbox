<!-- This template isn't being used because the 'if' statement calling it ends in '&& false' -->
<?php
echo "<!-- index-false-pages.php -->";

if (!has_post_thumbnail($post->ID) ) {
    $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
}
else{
    $style = 'style="background:url(';
    //$style .= get_the_post_thumbnail_url($post['ID'], 'post-thumbnail');

    $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", get_the_post_thumbnail_url($post->ID, 'post-thumbnail'));
    $style .= $iUrl;
    $style .= '); background-size:cover; background-position:center;"';;
}

$categories = get_the_category(get_the_ID());
$currentcat = $categories[0]->cat_ID;
$currentcatname = $categories[0]->cat_name;
$currentcatslug = $categories[0]->slug;

$cat_p = get_ancestors( $categories[0]->term_id, 'category' );

$termIdVal = 'term_' . $cat_p[0];


$bcolour = "#F77D66";

if (!empty(get_field("category_colour", $termIdVal))){
    $bcolour = get_field("category_colour", $termIdVal);
}

$border = 'style="border-top: 5px solid '.$bcolour.';"';
$addBorder = 'border-top: 5px solid '.$bcolour.';';


echo '<div class="blog-top-ban1 blog-top-ban-main-content post-main-content page-main-content">'
    .'  <div class="blog-l-img" '.$style.'><img src="/wp-content/themes/lighttheme/images/menu-trans-req.png"></div>'
    .'  <div class="blog-l-text-out">'
    .'    <div class="blog-l-text page-main-content-cont">';
the_content();
echo '</div></div></div>';