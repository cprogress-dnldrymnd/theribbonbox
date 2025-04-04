<?php
echo "<!-- index-alt-post-types.php -->";
$pagep = "";

if (get_post_type( get_the_ID() ) == 'page'){
    $pagep = "page-padding";
}

if (!has_post_thumbnail($post->ID) ) {
    $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
}
else{
    $style = 'style="background:url(';
    //$style .= get_the_post_thumbnail_url($post['ID'], 'post-thumbnail');

    $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", get_the_post_thumbnail_url($post->ID, 'post-thumbnail'));
    $style .= $iUrl;
    $style .= '); background-size:cover; background-position:center;"';;

    echo '<div class="blog-top-ban1 blog-top-ban-main-content post-main-content page-main-content"><div class="blog-l-img" '.$style.'>
                <img src="/wp-content/themes/lighttheme/images/menu-trans-req.png"></div>';
}

//echo '<div class="post-main-content '.$pagep.'">';
echo  '<div class="blog-top-ban1 blog-top-ban-main-content post-main-content page-main-content '.$pagep.'">'
    . '  <div class="blog-l-text-out">'
    . '    <div class="blog-l-text page-main-content-cont">';
the_content();
echo '</div></div></div>';
//echo do_shortcode("[display_insider]");