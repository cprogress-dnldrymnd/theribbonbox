<?php
$rtn .=
'<div class="expert-summary tpl-eci">
  <div '.$style.'>
    <a href="'.get_permalink($post['ID']).'" title="Read more about '. $post['post_title'] .'...">
      <img src="'.$iUrl.'" style="'.$style.'" style="position:relative;">
      ' . $featured_cur . '
      <!--<img src="/wp-content/themes/lighttheme/images/a_squ_trans.png">-->
    </a>
  </div>';