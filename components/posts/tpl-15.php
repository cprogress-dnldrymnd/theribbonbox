<?php
$rtn .= '
<div class="blog-tpl-15 blog-top-ban blog-top-ban-podcast format-' . $format . ' incount-' . $in_count . ' post-type-' . $this_post_type . '">
<div class="blog-top-ban-podcast-inner">
<div class="blog-l-text-out" '.$border.'>
<div class="blog-l-text" >'.$featured_cur.'<h3>'.$currentcatname.'</h3>
<a href="'.get_permalink($post['ID']).'">
<h2>'.$post['post_title'].'</h2></a>'.$ex_txt.'<p>'.$text.'</p>
<h4>'.get_the_date('j M Y', $post["ID"]).'</h4>
<div class="blog-btns">
<a class="button-expert" href="'.get_permalink($post['ID']).'">Subscribe</a>
</div>
</div>
</div>
<div class="blog-l-img" '.$style.'>
<a href="'.get_permalink($post['ID']).'" class="bl-overlay"><span>'.$more_text.'</span></a>
<a href="'.get_permalink($post['ID']).'">'.$ext.'<img src="/wp-content/themes/lighttheme/images/vid_req.png"></a>
</div>
</div>
</div>';