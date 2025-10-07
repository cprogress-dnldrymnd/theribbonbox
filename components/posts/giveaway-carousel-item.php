<?php 

$rtn .= '
<div class="expert-summary tpl-gci">
    <div '.$style.'>
    <img src="'.$iUrl.'" style="'.$style.'" style="position:relative;">
        <a href="'.get_permalink($post['ID']).'" title="Read more about '. $post['post_title'] .'..."></a>
    </div>
    <div class="expert-text">
        <div class="expert-inner">
            <h2 style="margin-bottom: 0.5em;">'.$post['post_title'].'</h2>';