<?php ob_start(); ?>
    <!-- home-banner.php -->
    <div class="blog-top-ban format-' . $format . ' home banner">
        <div class="blog-l-img">
            <a href="'.get_permalink($post['ID']).'">
                <img src="<?= $iUrl ?>" style="background-size:cover; background-position:center;">
                <span class="bl-overlay">'.$more_text.'</span>
                </img>
            </a>
            <a class="bl-overlay" href="'.get_permalink($post['ID']).'">'.$ext. '
                <img src="/wp-content/themes/lighttheme/images/menu-trans-req.png">
            </a>
        </div>
        <div class="blog-l-text-out"
        ' .$border.'>
        <div class="blog-l-text">'.$featured_cur.'
            <h3>'.$currentcatname.'</h3>
            <a href="'.get_permalink($post['ID']).'">
                <h2>'.$post['post_title'].'</h2>
            </a>
            <h4>'.get_the_date('j M Y', $post["ID"]).'</h4>
            <p class="text">'.$text.'</p>
            <div class="blog-btns">
                <a href="'.get_permalink($post['ID']).'">'.$more_t_text.'</a>
            </div>
        </div>
    </div>
    </div>';
<?php $rtn .= ob_get_clean(); ?>