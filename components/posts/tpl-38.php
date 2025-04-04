<?php

$rtn .= '
<div class="blog-tpl-38 blog-even-nor blog-nor format-' . $format . ' incount-' . $in_count . ' style-' . $styles_str . ' post-type-' . $this_post_type . ' blog-nor-half blog-top-offer-list blog-nor-half-1" style="background: #fff !important;">
<img class="blg-bg-col" src="/wp-content/themes/lighttheme/images/menu-trans-req.png" style="display: none;"/>
    <div class="blog-l-img" style="'. $addBorder .'">
    <a href="'.get_permalink($post['ID']).'">
        <img src="'.$iUrl.'" style="background-size:cover; background-position:center;">
        <span class="bl-overlay">'.$more_text.'</span>
        </img>
    </a>
    <a class="bl-overlay" href="'.get_permalink($post['ID']).'">'.$ext. '
        <img src="/wp-content/themes/lighttheme/images/menu-trans-req.png">
    </a>
    </div>
<div class="blog-l-text-out">
<div class="blog-l-text" >' .$featured_cur.'<h3>'.$currentcatname.'</h3>
<a href="'.get_permalink($post['ID']).'">
<h2>'.$post['post_title'].'</h2></a>'.$ex_txt.'<h4>'.get_the_date('j M Y', $post["ID"]).'</h4>
<div class="blog-btns">
<a href="'.get_permalink($post['ID']).'">'.$more_t_text.'</a>
</div>'.create_item_socials(get_permalink($post['ID']), $post['post_title']).'</div>
</div>
<div class="end">
</div>
</div>';