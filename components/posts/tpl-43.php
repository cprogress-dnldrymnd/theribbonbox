<?php
$rtn .= '
<div class="blog-tpl-43 blog-odd-nor blog-nor format-' . $format . ' incount-' . $in_count . ' post-type-' . $this_post_type . ' ">
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
<div class="blog-l-img" '.$style.'>
<a href="'.get_permalink($post['ID']).'" class="bl-overlay"><span>'.$more_text.'</span></a>
<a href="'.get_permalink($post['ID']).'">'.$ext. '<img src="/wp-content/themes/lighttheme/images/menu-trans-req.png"></a>
</div>
</div>';