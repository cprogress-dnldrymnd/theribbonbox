<?php
//revamp section
if (current_user_can('administrator')) {
    $rtn .= do_shortcode('[post_box id=' . $post["ID"] . ']');
} else {
    $rtn .= '
<div class="blog-tpl-37 blog-even-nor blog-nor format-' . $format . ' incount-' . $in_count . ' style-' . $styles_str . ' post-type-' . $this_post_type . ' blog-nor-half blog-nor-half-list-1">
    ' . $featured_cur . '
    <div class="blog-l-img" ' . $style . '>
        <a href="' . get_permalink($post['ID']) . '" class="bl-overlay">
        <span>' . $more_text . '</span></a>
        <a href="' . get_permalink($post['ID']) . '">
        ' . $ext . '<img src="/wp-content/themes/lighttheme/images/a_squ_trans.png"></a>
    </div>
    <div class="blog-l-text-out">
        <div class="blog-l-text">
            <h3>' . $currentcatname . '</h3>
            <a href="' . get_permalink($post['ID']) . '">
            <h2>' . $post['post_title'] . '</h2></a>
            <h4>' . get_the_date('j M Y', $post["ID"]) . '</h4>
            <div class="blog-btns">
                <a href="' . get_permalink($post['ID']) . '">' . $more_t_text . '</a>
            </div>
            ' . create_item_socials(get_permalink($post['ID']), $post['post_title']) . '
        </div>
    </div>
</div>';
}
