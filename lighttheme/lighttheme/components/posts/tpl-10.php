<?php
$rtn .= '
<div class="blog-tpl-10 blog-even-nor blog-nor format-' . $format . ' incount-' . $in_count . ' post-type-' . $this_post_type . ' ' . $adClas . '">
<div class="blog-l-img" ' . $style . '>
<a href="' . get_permalink($post['ID']) . '" class="bl-overlay"><span>' . $more_text . '</span></a>
<a href="' . get_permalink($post['ID']) . '">' . $ext . '<img src="/wp-content/themes/lighttheme/images/a_squ_trans.png"></a>
</div>
<div class="blog-l-text-out">
<div class="blog-l-text" >' . $featured_cur . '<h3>' . $currentcatname . '</h3>
<a href="' . get_permalink($post['ID']) . '">
<h2>' . $post['post_title'] . '</h2></a>' . $ex_txt;