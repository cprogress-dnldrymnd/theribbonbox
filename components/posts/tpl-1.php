<?php
$rtn .= '
<div class="blog-tpl-1 blog-top-ban blog-top-ban-podcast format-' . $format . ' incount-' . $in_count . ' post-type-' . ($this_post_type ?? '') . '">
    <div class="blog-top-ban-podcast-inner">
        <div class="blog-l-text-out" '.($border ?? '').'>
            <div class="blog-l-text" >'.($featured_cur ?? '').'<a href="'.(isset($post) ? get_permalink($post['ID']) : '').'">
                <h2><i>The Ribbon Box</i> <br> PODCAST</h2></a>
                '.($ex_txt ?? '').'
                <p>'.$pc_post_excerpt.'</p>
                <div class="blog-btns">
                    <a class="button-expert sub-pop-btn" href="'.(isset($post) ? get_permalink($post['ID']) : '').'">Subscribe</a>
                </div>
            </div>
        </div>
        <div class="blog-l-img" '.$style.'>
            <a href="'.(isset($post) ? get_permalink($post['ID']) : '').'" class="bl-overlay"><span>'.($more_text ?? '').'</span></a>
            <a href="'.(isset($post) ? get_permalink($post['ID']) : '').'">'.($ext ?? ''). '<img src="/wp-content/themes/lighttheme/images/vid_req.png"></a>
        </div>
    </div>
</div>';