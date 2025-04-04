<?php
$rtn .= '
<div class="blog-tpl-23 blog-even-nor blog-nor format-' . $format . ' incount-' . $in_count . ' post-type-' . $this_post_type . ' blog-top-offer-list '.$adClas.'" '.$border.'>
<div class="blog-l-img" '.$style.'>
<a '.$new_tab.' href="'.$link.'" class="bl-overlay"><span>'.$more_text.'</span></a>
<a '.$new_tab.' href="'.$link.'">'.$ext. '<img src="/wp-content/themes/lighttheme/images/a_squ_trans.png"></a>
</div>
<div class="blog-l-text-out">
<div class="blog-l-text" >' .$featured_cur.'<h3>'.$currentcatname.'</h3>
<a '.$new_tab.' href="'.$link.'">
<h2>'.$post['post_title'].'</h2>'.$speakerName.'</a>'.$ex_txt;