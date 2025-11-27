<?php

if (current_user_can('administrator')) {
    echo 'Only visible to admin';
    $post_id = $post['ID'];
    $cat = get_top_level_term_by_post_id($post_id, 'category');
    $category_colour = get_field('category_colour', $cat) ? get_field('category_colour', $cat) : '#3B1527';
    $category_text_color = get_field('category_text_color', $cat) ? get_field('category_text_color', $cat) : '#FFDBD1';
?>
    <div class="post-hero" style="--bg-color: <?= $category_colour ?>; --text-color: <?= $category_text_color ?>">
        <div class="container-fluid g-0 p-0">
            <div class="row g-0 flex-column-reverse flex-lg-row">
                <div class="col-lg-6 d-flex align-items-center">
                    <div class="post-hero-content">
                        <div class="post-title">
                            <h1>
                                <?= get_the_title($post_id) ?>
                            </h1>
                        </div>
                        <?php if (get_the_excerpt($post_id)) { ?>
                            <div class="post-excerpt">
                                <?= get_the_excerpt($post_id) ?>
                            </div>
                        <?php } ?>
                        <div class="author-date d-flex gap-3 align-items-center flex-wrap">
                            <?= do_shortcode("[author_bio_v2 id=$post_id]") ?>
                            <div class="dot"></div>
                            <div class="date">
                                <?= get_the_date('', $post_id) ?>
                            </div>
                        </div>
              
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="post-image image-box h-100">
                        <?= get_the_post_thumbnail($post_id, 'large') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}


$rtn .= '
<!-- Hero section (banner) for pages like Exercise -->
<div class="blog-tpl-24 blog-top-ban format-' . $format . ' incount-' . $in_count . ' post-type-' . $this_post_type . '">
    <div class="blog-l-img">
        <a href="' . get_permalink($post['ID']) . '">
            <img src="' . $iUrl . '" style="background-size:cover; background-position:center;">
        </a>
        <a href="' . get_permalink($post['ID']) . '">
          ' . $ext . '
          <!--<img src="/wp-content/themes/lighttheme/images/menu-trans-req.png">-->
        </a>
    </div>
    <div class="blog-l-text-out" ' . $border . '>
        <div class="blog-l-text" >
            ' . $featured_cur . '
            <h3>' . $currentcatname . '</h3>
            <a href="' . get_permalink($post['ID']) . '">
                <h2>' . $post['post_title'] . '</h2>
            </a>
            ' . $ex_txt . '
            <p>' . $text . '</p>
            <h4>' . get_the_date('j M Y', $post["ID"]) . '</h4>
            <div class="blog-btns">
                <a href="' . get_permalink($post['ID']) . '">' . $more_t_text . '</a>
                |  <div style="display:inline-block;">' . create_item_socials(get_permalink($post['ID']), $post['post_title']) . '</div>
            </div>
        </div>
    </div>
</div>';

$page_id = (int) get_the_ID();

$widget_paths = [
    22659 => 'fertility-category-page.js',
    22620 => 'wellbeing-category-page-gallery.js',
    22702 => 'pregnancy-category-page-gallery.js',
    22749 => 'parenting-category-page-gallery.js',
];

if (isset($widget_paths[$page_id])) {
    $rtn .= '<script async class="snapppt-widget" src="' .
        esc_url('https://app.addsauce.com/widgets/widget_loader/b5e9e572-93fb-ff48-5213-dbb8e74cc9ec/' . $widget_paths[$page_id]) .
        '"></script>';
}
