<?php
$rtn .= '
<!-- Post with yellow line above picture; text above picture -->
<!-- almost identical to tp-48 -->
<div class="blog-tpl-47 blog-odd-nor  blog-nor format-' . $format . ' incount-' . $in_count . ' post-type-' . $this_post_type . ' blog-nor-half">
  <div class="blog-l-text-out">
    <div class="blog-l-text">
      <h3>'.$currentcatname.'</h3>
      <a href="'.get_permalink($post['ID']).'">
      <h2>'.$post['post_title'].'</h2></a>
      <h4>'.get_the_date('j M Y', $post["ID"]).'</h4>
      <div class="blog-btns">
        <a href="'.get_permalink($post['ID']).'">'.$more_t_text.'</a>
      </div>
    </div>
  </div>
  <!--<img class="blg-bg-col" src="/wp-content/themes/lighttheme/images/menu-trans-req.png"/>-->
  <div class="blog-l-img" style="'. $addBorder .'">
    <a href="'.get_permalink($post['ID']).'">
      <img src="'.$iUrl.'" style="background-size:cover; background-position:center;">
        <span class="bl-overlay">'.$more_text.'</span>
      </img>
    </a>
    <a class="bl-overlay" href="'.get_permalink($post['ID']).'">
      '.$ext. '
      <!--<img src="/wp-content/themes/lighttheme/images/menu-trans-req.png">-->
    </a>
  </div>
</div>';