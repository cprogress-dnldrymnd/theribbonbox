<?php
//revamp section deprecated
$heading_text = '';
$podcast_heading_text = '';

if(is_b2b_user()) {
    $heading_text = 'Watch these next';
    $podcast_heading_text = 'Exclusive Podcasts';
} else {
    $heading_text = 'Trending Video';
    $podcast_heading_text = 'Podcast Episodes';
}

$rtn .= '
<div class="blog-tpl-51 blog-odd-nor blog-nor format-' . $format . ' incount-' . $in_count . ' post-type-' . $this_post_type . ' blog-nor-full blog-top-1 blog-item-vid vid-1-corner">
    <div class="blog-l-text-out">
        <div class="blog-l-text">
            <h2 class="hp-lgvid-h2">'. $heading_text .'</h2>
            <h3>'.$currentcatname.'</h3>
            <a href="'.get_permalink($post['ID']).'">
                <h2>'.$post['post_title'].'</h2></a>
            <p class="text">'.$text.'</p>
            <h4>'.get_the_date('j M Y', $post["ID"]).'</h4>
            <div class="blog-btns">
                <a href="'.get_permalink($post['ID']).'">WATCH NOW</a>
            </div>
        </div>
    </div>
    <div class="blog-l-img vid-1-corner-border" style="'. $addBorder .'">
        <a class="main-image" href="'.get_permalink($post['ID']).'">
            <img src="'.$iUrl.'" style="background-size:cover; background-position:center;">
                <span class="bl-overlay">'.$more_text.'</span>
            </img>
        </a>
        <a class="bl-overlay" href="'.get_permalink($post['ID']).'">
            '.$ext. '
            <!--<img src="/wp-content/themes/lighttheme/images/menu-trans-req.png">-->
        </a>
        '.$ext. '
    </div>
</div><br>
<h2 class="hp-lgpod-h2">'. $podcast_heading_text .'</h2>
';