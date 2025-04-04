<?php
$rtn .= '
<!-- Hero section (banner) for pages like Exercise -->
<div class="blog-tpl-24 blog-top-ban format-' . $format . ' incount-' . $in_count . ' post-type-' . $this_post_type . '">
    <div class="blog-l-img">
        <a href="'.get_permalink($post['ID']).'">
            <img src="'.$iUrl.'" style="background-size:cover; background-position:center;">
        </a>
        <a href="'.get_permalink($post['ID']).'">
          '.$ext. '
          <!--<img src="/wp-content/themes/lighttheme/images/menu-trans-req.png">-->
        </a>
    </div>
    <div class="blog-l-text-out" ' .$border.'>
        <div class="blog-l-text" >
            '.$featured_cur.'
            <h3>'.$currentcatname.'</h3>
            <a href="'.get_permalink($post['ID']).'">
                <h2>'.$post['post_title'].'</h2>
            </a>
            '.$ex_txt.'
            <p>'.$text.'</p>
            <h4>'.get_the_date('j M Y', $post["ID"]).'</h4>
            <div class="blog-btns">
                <a href="'.get_permalink($post['ID']).'">'.$more_t_text.'</a>
                |  <div style="display:inline-block;">'.create_item_socials(get_permalink($post['ID']), $post['post_title']).'</div>
            </div>
        </div>
    </div>
</div>';