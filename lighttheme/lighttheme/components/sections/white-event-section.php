<?php
$rtn .= '
<div class="blog-top-ban blog-top-ban-podcast">
    <div class="blog-top-ban-podcast-inner">
        <div class="blog-l-text-out" '.$border.'>
            <div class="blog-l-text" >
                <h2 class="type">'.$head_text.'</h2>
                '.($featured_cur ?? '').'
                <h3 class="category">'.$currentcatname.'</h3>
                <a '.$new_tab.' href="'.$link.'">
                    <h3 class="title">'.$post['post_title'].'</h3>
                    '.$speakerName.'
                </a>
                '.$ex_txt.'
                <p class="text">'.($text ?? '').'</p>
                <div class="blog-btns">
                    <a class="button-expert" '.$new_tab.' href="'.$link.'">'.$button_text.'</a>
                </div>
            </div>
        </div>
        <div class="blog-l-img" '.$style.'>
            <a '.$new_tab.' href="'.$link.'" class="bl-overlay">
            <span>'.($more_text ?? '').'</span>
            </a>
            <a '.$new_tab.' href="'.$link.'">
            '.($ext ?? ''). '
            <img src="/wp-content/themes/lighttheme/images/vid_req.png">
            </a>
        </div>
    </div>
</div>';