<?php

add_action('wp_ajax_bbpress_ajax_login', 'bbpress_ajax_login_handler');
add_action('wp_ajax_nopriv_bbpress_ajax_login', 'bbpress_ajax_login_handler');

function bbpress_ajax_login_handler()
{
    // check_ajax_referer( 'bbpress-ajax-login', 'security' ); // Add security nonce

    $creds = array();
    $creds['user_login'] = $_POST['log'];
    $creds['user_password'] = $_POST['pwd'];
    $creds['remember'] = isset($_POST['rememberme']);

    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {
        // Login failed
        echo json_encode(array(
            'status' =>  'failed',
            'class' =>  'alert-danger',
            'message' => 'Login failed please try again',
        ));
    } else {
        // Login successful
        echo json_encode(array(
            'status' =>  'success',
            'class' =>  'alert-success',
            'message' => 'Login successful',
        ));
    }

    wp_die();
}


function forum_slider()
{
    ob_start();
    $forums = get_posts(array(
        'post_type' => 'forum',
        'numberposts' => -1,
        'post_parent' => 0,      // Top-level forums (categories)
        'meta_key'    => '_bbp_forum_type', // bbPress forum type meta key
        'meta_value'  => 'category', // Get only forums with 'category' type
    ));
?>
    <h2 class="text-heading mb-4">TOPICS + dISCUSSIONS</h2>
    <div class="swiper swiper-post-slider swiper-post-slider-nav-style-2">
        <div class="row g-4 swiper-wrapper">
            <?php foreach ($forums as $forum) { ?>
                <div class="col-lg-3 swiper-slide">
                    <?= do_shortcode('[forum_box id=' . $forum->ID . ']') ?>
                </div>
            <?php } ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('forum_slider', 'forum_slider');

function forum_box($atts)
{
    ob_start();
    extract(
        shortcode_atts(
            array(
                'id' => '',
            ),
            $atts
        )
    );
    $image = get_field('featured_image', $id);
    $category_colour = get_field('category_colour', $id);
?>
    <div class="forum-box box-style-1 position-relative d-flex align-items-center justify-content-center rounded overflow-hidden">
        <a href="<?= get_the_permalink($id) ?>">
            <div class="bg-image">
                <?= wp_get_attachment_image($image, 'large') ?>
            </div>
            <div class="inner position-relative">
                <div class="bubble-style-1" style="--bg-color: <?= $category_colour ?>">
                    <?= get_the_title($id) ?>
                </div>
            </div>
        </a>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('forum_box', 'forum_box');

function post_action($atts)
{
    ob_start();
    extract(
        shortcode_atts(
            array(
                'id' => '',
                'show_comment' => 'true'
            ),
            $atts
        )
    );
    $comment = '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none"> <path fill-rule="evenodd" clip-rule="evenodd" d="M14 22.125C13.051 22.125 12.1345 22.0145 11.2538 21.8268L7.4285 24.1262L7.47969 20.357C4.54737 18.5939 2.625 15.6786 2.625 12.375C2.625 6.99056 7.71775 2.625 14 2.625C20.2822 2.625 25.375 6.99056 25.375 12.375C25.375 17.7603 20.2822 22.125 14 22.125ZM14 1C6.82075 1 1 6.09356 1 12.375C1 15.9654 2.90531 19.1626 5.875 21.2467V27L11.5698 23.5444C12.3579 23.6744 13.1688 23.75 14 23.75C21.1793 23.75 27 18.6572 27 12.375C27 6.09356 21.1793 1 14 1Z" fill="#F77D67" stroke="#F77D67" stroke-width="0.5"/> </svg>';
    $comment_active = '<svg class="icon-active" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"> <path fill-rule="evenodd" clip-rule="evenodd" d="M13 0C5.82075 0 0 5.09356 0 11.375C0 14.9654 1.90531 18.1626 4.875 20.2467V26L10.5698 22.5444C11.3579 22.6744 12.1688 22.75 13 22.75C20.1793 22.75 26 17.6572 26 11.375C26 5.09356 20.1793 0 13 0Z" fill="#F77D67"/> </svg>';
    $heart = '<svg xmlns="http://www.w3.org/2000/svg" width="27" height="23" viewBox="0 0 27 23" fill="none"> <path d="M24.84 2.08268C24.18 1.41863 23.415 0.905512 22.545 0.543306C21.675 0.181103 20.73 0 19.71 0C18.15 0 16.8 0.362204 15.66 1.08661C14.82 1.62992 14.1 2.38451 13.5 3.35039C12.9 2.38451 12.18 1.62992 11.34 1.08661C10.2 0.362204 8.85 0 7.29 0C6.27 0 5.325 0.181103 4.455 0.543306C3.585 0.905512 2.82 1.41863 2.16 2.08268C0.72 3.5315 0 5.40289 0 7.69685C0 9.20604 0.42 10.6549 1.26 12.0433C1.92 13.1903 2.91 14.3373 4.23 15.4843C5.01 16.2087 6.24 17.2047 7.92 18.4724C9.18 19.378 10.08 20.0722 10.62 20.5551C11.52 21.2795 12.21 21.9436 12.69 22.5472C12.87 22.8491 13.14 23 13.5 23C13.86 23 14.13 22.8491 14.31 22.5472C14.85 21.8832 15.69 21.0984 16.83 20.1929C17.07 20.0118 17.205 19.7703 17.235 19.4685C17.265 19.1667 17.19 18.9101 17.01 18.6988C16.83 18.4875 16.59 18.3668 16.29 18.3366C15.99 18.3064 15.72 18.3819 15.48 18.563C14.7 19.1667 14.04 19.7402 13.5 20.2835C12.72 19.4987 11.28 18.3215 9.18 16.752C7.62 15.605 6.51 14.7297 5.85 14.126C4.65 13.0997 3.75 12.1037 3.15 11.1378C2.43 10.0512 2.07 8.9042 2.07 7.69685C2.07 6.06693 2.565 4.73884 3.555 3.7126C4.545 2.68635 5.79 2.17323 7.29 2.17323C9.27 2.17323 10.71 2.89764 11.61 4.34646C11.91 4.8294 12.15 5.3727 12.33 5.97638C12.39 6.27822 12.42 6.54987 12.42 6.79134C12.48 7.03281 12.6 7.25919 12.78 7.47047C12.96 7.68176 13.2 7.7874 13.5 7.7874C13.8 7.7874 14.04 7.68176 14.22 7.47047C14.4 7.25919 14.505 7.03281 14.535 6.79134C14.565 6.54987 14.61 6.27822 14.67 5.97638C14.85 5.3727 15.09 4.8294 15.39 4.34646C16.29 2.89764 17.73 2.17323 19.71 2.17323C21.21 2.17323 22.455 2.68635 23.445 3.7126C24.435 4.73884 24.93 6.06693 24.93 7.69685C24.93 9.14567 24.39 10.5341 23.31 11.8622C22.53 12.8885 21.33 14.0354 19.71 15.3031C19.47 15.4843 19.335 15.7257 19.305 16.0276C19.275 16.3294 19.35 16.586 19.53 16.7972C19.71 17.0085 19.95 17.1444 20.25 17.2047C20.55 17.2651 20.79 17.2047 20.97 17.0236C22.83 15.5748 24.21 14.2467 25.11 13.0394C26.37 11.3491 27 9.56824 27 7.69685C27 5.40289 26.28 3.5315 24.84 2.08268Z" fill="#F77D67"/> </svg>';
    $heart_active = '<svg class="icon-active" xmlns="http://www.w3.org/2000/svg" width="29" height="24" viewBox="0 0 29 24" fill="none"> <path d="M21.9902 0C28.2683 0 30.3474 7.27971 28.1546 11.2605C24.7892 17.441 14.503 24 14.503 24C14.503 24 4.17936 17.441 0.851488 11.2605C-1.34249 7.27971 0.700221 0 7.01592 0C12.8403 0 14.3143 5.04241 14.5042 5.80072C14.693 5.04241 16.1682 0 21.9926 0H21.9902Z" fill="#F77D67"/> </svg>';
    $share = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="21" viewBox="0 0 20 21" fill="none"> <rect y="0.470001" width="20" height="20" fill="url(#pattern0_4_1438)"/> <defs> <pattern id="pattern0_4_1438" patternContentUnits="objectBoundingBox" width="1" height="1"> <use xlink:href="#image0_4_1438" transform="scale(0.01)"/> </pattern> <image id="image0_4_1438" width="100" height="100" xlink:href="data:image/png;base64,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"/> </defs> </svg>';

    $class = '';
    $comment_class = '';

    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $user_favorites = get_user_meta($user_id, 'user_favorites', true);
        $id = (int)$id;
        if ($user_favorites && in_array($id, $user_favorites)) {
            $class = 'is-user-favorite';
        }

        $comment_count = get_comments_number($id);
    }
?>
    <div class="icon-lists post-action d-flex align-items-center">
        <?php if ($show_comment == 'true') { ?>
            <div class="icon-list d-flex align-items-center">
                <a class="icon-holder d-flex align-items-center comments <?= $comment_class ?>" href="<?= get_the_permalink($id) ?>#comments-box">
                    <?php
                    if ($comment_count == 0) {
                        echo $comment;
                    } else {
                        echo $comment_active;
                    }
                    ?>
                    <span><?= $comment_count ?></span>
                </a>
            </div>
        <?php } ?>
        <?php if (is_user_logged_in()) { ?>

            <div class="icon-list d-flex align-items-center">
                <a class="icon-holder d-flex align-items-center add-to-favorites-trigger <?= $class ?>" href="#">
                    <?= $heart . $heart_active ?>
                    <span><?= get_posts_number_of_favorites($id) ?></span>
                </a>
            </div>
        <?php } ?>

        <div class="icon-list d-flex align-items-center">
            <?= create_item_socials_v2(get_the_permalink($id), get_the_title($id), $share, '') ?>
        </div>
    </div>
<?php
    return ob_get_clean();
}

add_shortcode('post_action', 'post_action');

function featured_topics()
{
    ob_start();
    $featured_topics = get_field('featured_community_topic');
?>
    <div class="featured-box">
        <div class="featured-box-heading">
            <h2 class="text-heading mb-0">Featured community topics</h2>
        </div>

        <div class="featured-box-holder d-flex flex-wrap">
            <?php foreach ($featured_topics as $featured_topic) { ?>
                <div class="featured-box-item post-box" post-id="<?= $featured_topic ?>">
                    <a href="<?= get_the_permalink($featured_topic) ?>">
                        <h3 class="mb-3"><?= get_the_title($featured_topic) ?></h3>
                    </a>
                    <div class="topic-action d-flex align-items-center justify-content-between">
                        <div class="left">
                            <a class="read-more" href="<?= get_the_permalink($featured_topic) ?>">
                                Read more
                            </a>
                        </div>
                        <div class="right">
                            <?= do_shortcode('[post_action id=' . $featured_topic . ']') ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
<?php
    return ob_get_clean();
}
add_shortcode('featured_topics', 'featured_topics');

function upcoming_events()
{
    ob_start();
    $posts = get_posts(array(
        'post_type' => 'events',
        'numberposts' => 1
    ));
?>
    <h2>Upcoming Event</h2>
    <div class="blogs-loop-inner">
        <?php foreach ($posts as $post) { ?>
            <?php
            $speaker_name = get_field('speaker_name', $post->ID);
            $website_link = get_field('website_link', $post->ID);
            $url = $website_link ? $website_link : get_the_permalink($post->ID);
            ?>
            <div class="blog-tpl-23 blog-even-nor blog-nor format-post-page incount-0 post-type-events blog-top-offer-list " style="border-top: 5px solid #F77D66;">
                <div class="blog-l-img" style="background:url(https://theribbonbox.com/wp-content/uploads/2024/02/TFP-Fertility-webinar.jpg); background-size:cover; background-position:center;">
                    <a target="_blank" href="<?= $url ?>">
                        <img src="/wp-content/themes/lighttheme/images/a_squ_trans.png" style="border-bottom-color: rgba(0, 0, 0, 0);">
                    </a>
                </div>
                <div class="blog-l-text-out">
                    <div class="blog-l-text">
                        <a target="_blank" href="<?= $url ?>">
                            <h3><?= $post->post_title ?></h3>
                            <p class="speaker-name"><?= $speaker_name ?></p>
                        </a>
                        <div class="button-box button-green button-small">
                            <a target="_blank" href="<?= $url ?>">Find Out More</a>
                        </div>
                    </div>
                </div>
                <div class="end">
                </div>
            </div>
        <?php } ?>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('upcoming_events', 'upcoming_events');


function e_guides_community()
{
    ob_start();
    $posts = get_posts(array(
        'post_type' => 'product',
        'numberposts' => 3
    ));
?>
    <div class="featured-box">
        <div class="featured-box-heading">
            <h2 class="text-heading mb-0">E-Guides</h2>
        </div>
        <div class="featured-box-holder featured-box-holder-v2 d-flex flex-wrap">
            <?php foreach ($posts as $post) { ?>
                <div class="featured-box-item row post-box" post-id="<?= $post->ID ?>">
                    <div class="col-5 col-sm-3">
                        <div class="image-box">
                            <img src="<?= wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'medium') ?>" alt="<?= $post->post_title ?>">
                        </div>
                    </div>
                    <div class="col-7 col-sm-9">
                        <div class="content-box">
                            <a href="<?= get_the_permalink($post->ID) ?>">
                                <h3 class="mb-3 mt-0"><?= $post->post_title ?></h3>
                            </a>
                            <div class="post-excerpt mb-3">
                                <?= $post->post_excerpt ?>
                            </div>
                            <?= do_shortcode('[post_action show_comment="0" id=' . $post->ID . ']') ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="button-box button-accent button-small text-end button-box-v2 me-4 mb-4">
            <a href="/e-guides">View All E-Guides</a>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('e_guides_community', 'e_guides_community');

function blogs()
{
    ob_start();
    $posts = get_posts(array(
        'post_type' => 'community-post',
        'numberposts' => 9,
        'post_status' => array('private', 'publish')
    ));

?>
    <div class="blogs-holder">
        <div class="row g-4 ">
            <?php foreach ($posts as $post) { ?>
                <div class="col-lg-4">
                    <?= do_shortcode('[blog_box id=' . $post->ID . ' author=' . $post->post_author . ']') ?>
                </div>
            <?php } ?>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('blogs', 'blogs');


function blog_box($atts)
{
    ob_start();
    extract(
        shortcode_atts(
            array(
                'id' => '',
                'author' => '',
                'parent' => 0
            ),
            $atts
        )
    );
    $terms = get_the_terms($id, 'category');
    $include_terms = array(1165, 1159, 1163, 1164);
    $name = bp_get_profile_field_data(array(
        'field'     => 'Name',
        'user_id'   => $author
    ));
?>
    <div class="blogs-box d-flex post-box" post-id="<?= $id ?>">
        <div class="image-box">
            <div class="category-holder">
                <div class="row">
                    <?php foreach ($terms as $term) { ?>
                        <?php
                        if (in_array($term->term_id, $include_terms)) {
                            $category_colour = get_field('blog_cat_community_bg_color', $term);
                        ?>
                            <div class="col-auto <?= $term->slug ?>" style="--color: <?= $category_colour ?>"> <span><?= $term->name ?></span> </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <a href="<?= get_permalink($id) ?>">
                <img src="<?= get_the_post_thumbnail_url($id, 'large') ?>" alt="">
            </a>
        </div>
        <div class="blog-content d-flex">
            <div class="top">
                <div class="date-box d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M6 11C8.76144 11 11 8.76144 11 6C11 3.23858 8.76144 1 6 1C3.23858 1 1 3.23858 1 6C1 8.76144 3.23858 11 6 11Z" stroke="#B1B1B1" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6 2.66675V6.00008" stroke="#B1B1B1" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M8.35556 8.35556L6 6" stroke="#B1B1B1" stroke-linecap="round" stroke-linejoin="round" />
                    </svg> <?= get_the_date('', $id) ?>
                </div>
                <div class="heading-box">
                    <a href="<?= get_permalink($id) ?>">
                        <h3>
                            <?= get_the_title($id) ?>
                        </h3>
                    </a>
                </div>
            </div>
            <div class="bottom">
                <a class="read-more" href="<?= get_the_permalink($id) ?>">
                    Read more
                </a>
                <?= do_shortcode('[post_action id=' . $id . ']') ?>
                <div class="blog-user-profile">
                    <a href="<?= bp_core_get_user_domain($author) ?>" class="d-flex align-items-center">
                        <div class="avatar">
                            <?= bp_core_fetch_avatar(array('item_id' => $author, 'type' => 'thumb'));  ?>
                        </div>
                        <div class="name">
                            <?= $name ?>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('blog_box', 'blog_box');


function action_bp_before_member_header_meta()
{
    $notif = '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="18" viewBox="0 0 15 18" fill="none">
<path d="M7.52005 1.61905C4.83778 1.61905 2.65794 3.79067 2.65794 6.46282V8.79589C2.65794 9.28834 2.44725 10.0391 2.19604 10.4589L1.26415 12.0008C0.6888 12.9535 1.08587 14.011 2.13932 14.3662C5.63192 15.5287 9.40005 15.5287 12.8926 14.3662C13.8732 14.0433 14.3027 12.8889 13.7678 12.0008L12.8359 10.4589C12.5928 10.0391 12.3821 9.28834 12.3821 8.79589V6.46282C12.3821 3.79874 10.1942 1.61905 7.52005 1.61905Z" stroke="#292D32" stroke-miterlimit="10" stroke-linecap="round"/>
<path d="M9.04763 1.92857C8.7883 1.86224 8.5206 1.81066 8.24454 1.78118C7.44145 1.69274 6.67183 1.74433 5.95239 1.92857C6.19499 1.38322 6.79731 1 7.50001 1C8.20271 1 8.80503 1.38322 9.04763 1.92857Z" stroke="#292D32" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M9.97618 14.619C9.97618 15.981 8.8619 17.0952 7.49999 17.0952C6.82316 17.0952 6.19585 16.8146 5.75016 16.3689C5.30444 15.9232 5.0238 15.2959 5.0238 14.619" stroke="#292D32" stroke-miterlimit="10"/>
</svg>';
    $message = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
<path d="M12.7272 9.2089C12.9431 9.2089 13.1181 9.03386 13.1181 8.818C13.1181 8.60214 12.9431 8.42709 12.7272 8.42709C12.5114 8.42709 12.3363 8.60214 12.3363 8.818C12.3363 9.03386 12.5114 9.2089 12.7272 9.2089Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.81809 9.2089C9.03395 9.2089 9.209 9.03386 9.209 8.818C9.209 8.60214 9.03395 8.42709 8.81809 8.42709C8.60223 8.42709 8.42719 8.60214 8.42719 8.818C8.42719 9.03386 8.60223 9.2089 8.81809 9.2089Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M4.90903 9.2089C5.12492 9.2089 5.29994 9.03386 5.29994 8.818C5.29994 8.60214 5.12492 8.42709 4.90903 8.42709C4.69314 8.42709 4.51813 8.60214 4.51813 8.818C4.51813 9.03386 4.69314 9.2089 4.90903 9.2089Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.81811 16.6362C13.1359 16.6362 16.6362 13.1359 16.6362 8.81811C16.6362 4.50029 13.1359 1 8.81811 1C4.50029 1 1 4.50029 1 8.81811C1 10.2421 1.38072 11.5772 2.04592 12.7272L1.39091 16.2453L4.90906 15.5903C6.059 16.2555 7.39412 16.6362 8.81811 16.6362Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
</svg>';
    $x = '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
<circle cx="18" cy="18" r="18" fill="#2596FF"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M27 12.6574C26.374 12.9388 25.702 13.128 24.997 13.2146C25.717 12.7769 26.27 12.0852 26.531 11.2588C25.856 11.6645 25.108 11.9591 24.314 12.1172C23.679 11.4292 22.771 11 21.769 11C19.841 11 18.279 12.5831 18.279 14.5351C18.279 14.8127 18.311 15.0819 18.369 15.3407C15.471 15.1929 12.898 13.7868 11.178 11.6475C10.879 12.1689 10.706 12.7769 10.706 13.4245C10.706 14.6508 11.512 15.7313 12.448 16.3666C11.876 16.3478 11.057 16.1878 11.057 15.9223V15.9694C11.057 17.6805 12.07 19.1082 13.665 19.4348C13.373 19.5139 12.971 19.5581 12.652 19.5581C12.427 19.5581 12.161 19.5355 11.947 19.4932C12.392 20.8974 13.657 21.9195 15.183 21.9496C13.989 22.8955 12.473 23.4612 10.839 23.4612C10.557 23.4612 10.272 23.4442 10 23.4122C11.545 24.4136 13.375 25 15.345 25C21.764 25 25.271 19.6155 25.271 14.9454C25.271 14.792 25.267 14.6376 25.259 14.4861C25.941 13.9882 26.533 13.3661 27 12.6574Z" fill="white"/>
</svg>';
    $facebook = '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
<circle cx="18" cy="18" r="18" fill="#4969EC"/>
<path d="M22 10.0027L19.7775 10C17.6222 10 16.2299 11.4482 16.2299 13.692V15.3932H14V18.4716H16.2299L16.2272 25H19.3472L19.3499 18.4716H21.9086L21.9066 15.3939H19.3499V13.9505C19.3499 13.2564 19.5119 12.9052 20.4027 12.9052L21.9933 12.9045L22 10.0027Z" fill="white"/>
</svg>';
    $instagram = '<svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 32 32" fill="none"> <rect x="2" y="2" width="28" height="28" rx="6" fill="url(#paint0_radial_87_7153)"/> <rect x="2" y="2" width="28" height="28" rx="6" fill="url(#paint1_radial_87_7153)"/> <rect x="2" y="2" width="28" height="28" rx="6" fill="url(#paint2_radial_87_7153)"/> <path d="M23 10.5C23 11.3284 22.3284 12 21.5 12C20.6716 12 20 11.3284 20 10.5C20 9.67157 20.6716 9 21.5 9C22.3284 9 23 9.67157 23 10.5Z" fill="white"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M16 21C18.7614 21 21 18.7614 21 16C21 13.2386 18.7614 11 16 11C13.2386 11 11 13.2386 11 16C11 18.7614 13.2386 21 16 21ZM16 19C17.6569 19 19 17.6569 19 16C19 14.3431 17.6569 13 16 13C14.3431 13 13 14.3431 13 16C13 17.6569 14.3431 19 16 19Z" fill="white"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M6 15.6C6 12.2397 6 10.5595 6.65396 9.27606C7.2292 8.14708 8.14708 7.2292 9.27606 6.65396C10.5595 6 12.2397 6 15.6 6H16.4C19.7603 6 21.4405 6 22.7239 6.65396C23.8529 7.2292 24.7708 8.14708 25.346 9.27606C26 10.5595 26 12.2397 26 15.6V16.4C26 19.7603 26 21.4405 25.346 22.7239C24.7708 23.8529 23.8529 24.7708 22.7239 25.346C21.4405 26 19.7603 26 16.4 26H15.6C12.2397 26 10.5595 26 9.27606 25.346C8.14708 24.7708 7.2292 23.8529 6.65396 22.7239C6 21.4405 6 19.7603 6 16.4V15.6ZM15.6 8H16.4C18.1132 8 19.2777 8.00156 20.1779 8.0751C21.0548 8.14674 21.5032 8.27659 21.816 8.43597C22.5686 8.81947 23.1805 9.43139 23.564 10.184C23.7234 10.4968 23.8533 10.9452 23.9249 11.8221C23.9984 12.7223 24 13.8868 24 15.6V16.4C24 18.1132 23.9984 19.2777 23.9249 20.1779C23.8533 21.0548 23.7234 21.5032 23.564 21.816C23.1805 22.5686 22.5686 23.1805 21.816 23.564C21.5032 23.7234 21.0548 23.8533 20.1779 23.9249C19.2777 23.9984 18.1132 24 16.4 24H15.6C13.8868 24 12.7223 23.9984 11.8221 23.9249C10.9452 23.8533 10.4968 23.7234 10.184 23.564C9.43139 23.1805 8.81947 22.5686 8.43597 21.816C8.27659 21.5032 8.14674 21.0548 8.0751 20.1779C8.00156 19.2777 8 18.1132 8 16.4V15.6C8 13.8868 8.00156 12.7223 8.0751 11.8221C8.14674 10.9452 8.27659 10.4968 8.43597 10.184C8.81947 9.43139 9.43139 8.81947 10.184 8.43597C10.4968 8.27659 10.9452 8.14674 11.8221 8.0751C12.7223 8.00156 13.8868 8 15.6 8Z" fill="white"/> <defs> <radialGradient id="paint0_radial_87_7153" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(12 23) rotate(-55.3758) scale(25.5196)"> <stop stop-color="#B13589"/> <stop offset="0.79309" stop-color="#C62F94"/> <stop offset="1" stop-color="#8A3AC8"/> </radialGradient> <radialGradient id="paint1_radial_87_7153" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(11 31) rotate(-65.1363) scale(22.5942)"> <stop stop-color="#E0E8B7"/> <stop offset="0.444662" stop-color="#FB8A2E"/> <stop offset="0.71474" stop-color="#E2425C"/> <stop offset="1" stop-color="#E2425C" stop-opacity="0"/> </radialGradient> <radialGradient id="paint2_radial_87_7153" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(0.500002 3) rotate(-8.1301) scale(38.8909 8.31836)"> <stop offset="0.156701" stop-color="#406ADC"/> <stop offset="0.467799" stop-color="#6A45BE"/> <stop offset="1" stop-color="#6A45BE" stop-opacity="0"/> </radialGradient> </defs> </svg>';
    $tiktok = '<svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 32 32" fill="none"> <path d="M8.45095 19.7926C8.60723 18.4987 9.1379 17.7743 10.1379 17.0317C11.5688 16.0259 13.3561 16.5948 13.3561 16.5948V13.2197C13.7907 13.2085 14.2254 13.2343 14.6551 13.2966V17.6401C14.6551 17.6401 12.8683 17.0712 11.4375 18.0775C10.438 18.8196 9.90623 19.5446 9.7505 20.8385C9.74562 21.5411 9.87747 22.4595 10.4847 23.2536C10.3345 23.1766 10.1815 23.0889 10.0256 22.9905C8.68807 22.0923 8.44444 20.7449 8.45095 19.7926ZM22.0352 6.97898C21.0509 5.90039 20.6786 4.81139 20.5441 4.04639H21.7823C21.7823 4.04639 21.5354 6.05224 23.3347 8.02482L23.3597 8.05134C22.8747 7.7463 22.43 7.38624 22.0352 6.97898ZM28 10.0369V14.293C28 14.293 26.42 14.2312 25.2507 13.9337C23.6179 13.5176 22.5685 12.8795 22.5685 12.8795C22.5685 12.8795 21.8436 12.4245 21.785 12.3928V21.1817C21.785 21.6711 21.651 22.8932 21.2424 23.9125C20.709 25.246 19.8859 26.1212 19.7345 26.3001C19.7345 26.3001 18.7334 27.4832 16.9672 28.28C15.3752 28.9987 13.9774 28.9805 13.5596 28.9987C13.5596 28.9987 11.1434 29.0944 8.96915 27.6814C8.49898 27.3699 8.06011 27.0172 7.6582 26.6277L7.66906 26.6355C9.84383 28.0485 12.2595 27.9528 12.2595 27.9528C12.6779 27.9346 14.0756 27.9528 15.6671 27.2341C17.4317 26.4374 18.4344 25.2543 18.4344 25.2543C18.5842 25.0754 19.4111 24.2001 19.9423 22.8662C20.3498 21.8474 20.4849 20.6247 20.4849 20.1354V11.3475C20.5435 11.3797 21.2679 11.8347 21.2679 11.8347C21.2679 11.8347 22.3179 12.4734 23.9506 12.8889C25.1204 13.1864 26.7 13.2483 26.7 13.2483V9.91314C27.2404 10.0343 27.7011 10.0671 28 10.0369Z" fill="#EE1D52"/> <path d="M26.7009 9.91314V13.2472C26.7009 13.2472 25.1213 13.1853 23.9515 12.8879C22.3188 12.4718 21.2688 11.8337 21.2688 11.8337C21.2688 11.8337 20.5444 11.3787 20.4858 11.3464V20.1364C20.4858 20.6258 20.3518 21.8484 19.9432 22.8672C19.4098 24.2012 18.5867 25.0764 18.4353 25.2553C18.4353 25.2553 17.4337 26.4384 15.668 27.2352C14.0765 27.9539 12.6788 27.9357 12.2604 27.9539C12.2604 27.9539 9.84473 28.0496 7.66995 26.6366L7.6591 26.6288C7.42949 26.4064 7.21336 26.1717 7.01177 25.9257C6.31777 25.0795 5.89237 24.0789 5.78547 23.7934C5.78529 23.7922 5.78529 23.791 5.78547 23.7898C5.61347 23.2937 5.25209 22.1022 5.30147 20.9482C5.38883 18.9122 6.10507 17.6625 6.29444 17.3494C6.79597 16.4957 7.44828 15.7318 8.22233 15.0919C8.90538 14.5396 9.6796 14.1002 10.5132 13.7917C11.4144 13.4295 12.3794 13.2353 13.3565 13.2197V16.5948C13.3565 16.5948 11.5691 16.028 10.1388 17.0317C9.13879 17.7743 8.60812 18.4987 8.45185 19.7926C8.44534 20.7449 8.68897 22.0923 10.0254 22.991C10.1813 23.0898 10.3343 23.1775 10.4845 23.2541C10.7179 23.5576 11.0021 23.8221 11.3255 24.0368C12.631 24.8632 13.7249 24.9209 15.1238 24.3842C16.0565 24.0254 16.7586 23.2167 17.0842 22.3206C17.2888 21.7611 17.2861 21.1978 17.2861 20.6154V4.04639H20.5417C20.6763 4.81139 21.0485 5.90039 22.0328 6.97898C22.4276 7.38624 22.8724 7.7463 23.3573 8.05134C23.5006 8.19955 24.2331 8.93231 25.1734 9.38216C25.6596 9.61469 26.1722 9.79285 26.7009 9.91314Z" fill="#000000"/> <path d="M4.48926 22.7568V22.7594L4.57004 22.9784C4.56076 22.9529 4.53074 22.8754 4.48926 22.7568Z" fill="#69C9D0"/> <path d="M10.5128 13.7916C9.67919 14.1002 8.90498 14.5396 8.22192 15.0918C7.44763 15.7332 6.79548 16.4987 6.29458 17.354C6.10521 17.6661 5.38897 18.9168 5.30161 20.9528C5.25223 22.1068 5.61361 23.2983 5.78561 23.7944C5.78543 23.7956 5.78543 23.7968 5.78561 23.798C5.89413 24.081 6.31791 25.0815 7.01191 25.9303C7.2135 26.1763 7.42963 26.4111 7.65924 26.6334C6.92357 26.1457 6.26746 25.5562 5.71236 24.8839C5.02433 24.0451 4.60001 23.0549 4.48932 22.7626C4.48919 22.7605 4.48919 22.7584 4.48932 22.7564V22.7527C4.31677 22.2571 3.95431 21.0651 4.00477 19.9096C4.09213 17.8736 4.80838 16.6239 4.99775 16.3108C5.4985 15.4553 6.15067 14.6898 6.92509 14.0486C7.608 13.4961 8.38225 13.0567 9.21598 12.7484C9.73602 12.5416 10.2778 12.3891 10.8319 12.2934C11.6669 12.1537 12.5198 12.1415 13.3588 12.2575V13.2196C12.3808 13.2349 11.4148 13.4291 10.5128 13.7916Z" fill="#69C9D0"/> <path d="M20.5438 4.04635H17.2881V20.6159C17.2881 21.1983 17.2881 21.76 17.0863 22.3211C16.7575 23.2167 16.058 24.0253 15.1258 24.3842C13.7265 24.923 12.6326 24.8632 11.3276 24.0368C11.0036 23.823 10.7187 23.5594 10.4844 23.2567C11.5962 23.8251 12.5913 23.8152 13.8241 23.341C14.7558 22.9821 15.4563 22.1734 15.784 21.2774C15.9891 20.7178 15.9864 20.1546 15.9864 19.5726V3H20.4819C20.4819 3 20.4315 3.41188 20.5438 4.04635ZM26.7002 8.99104V9.9131C26.1725 9.79263 25.6609 9.61447 25.1755 9.38213C24.2352 8.93228 23.5026 8.19952 23.3594 8.0513C23.5256 8.1559 23.6981 8.25106 23.8759 8.33629C25.0192 8.88339 26.1451 9.04669 26.7002 8.99104Z" fill="#69C9D0"/> </svg>';
    $facebook_url = bp_get_profile_field_data(array(
        'field'     => 'Facebook URL',
        'user_id'   => bp_displayed_user_id()
    ));
    $x_url = bp_get_profile_field_data(array(
        'field'     => 'X URL',
        'user_id'   => bp_displayed_user_id()
    ));
    $instagram_url = bp_get_profile_field_data(array(
        'field'     => 'Instagram URL',
        'user_id'   => bp_displayed_user_id()
    ));
    $tiktok_url = bp_get_profile_field_data(array(
        'field'     => 'Tiktok URL',
        'user_id'   => bp_displayed_user_id()
    ));
?>
    <div class="before-member-header-meta">
        <div class="social-icons">
            <ul class="f-xl">
                <?php if ($facebook_url) { ?>
                    <li>
                        <a href="<?= $facebook_url ?>"><?= $facebook ?></a>
                    </li>
                <?php } ?>
                <?php if ($x_url) { ?>
                    <li>
                        <a href="<?= $x_url ?>"><?= $x ?></a>
                    </li>
                <?php } ?>
                <?php if ($instagram_url) { ?>
                    <li>
                        <a href="<?= $instagram_url ?>"><?= $instagram ?></a>
                    </li>
                <?php } ?>
                <?php if ($tiktok_url) { ?>
                    <li>
                        <a href="<?= $tiktok_url ?>"><?= $tiktok ?></a>
                    </li>
                <?php } ?>
            </ul>

        </div>
        <div class="profile-custom-button d-flex align-items-center justify-content-center">
            <ul>
                <li>
                    <a href="<?php bp_member_permalink(); ?>activity">POSTS</a>
                </li>
                <li>
                    <a href="<?php bp_member_permalink(); ?>friends">FRIENDS</a>
                    <span class="count">
                        <?= friends_get_total_friend_count()  ?>
                    </span>
                </li>

            </ul>
            <ul class="icons">
                <li>
                    <a href="<?php bp_member_permalink(); ?>notifications">
                        <?= $notif ?>
                        <span class="count">
                            <?= bp_notifications_get_unread_notification_count() ?>
                        </span>
                    </a>
                </li>
                <!---
                <li>
                    <a href="<?php bp_member_permalink(); ?>messages">
                        <?= $message ?>
                        <span class="count">
                            <?php //messages_get_unread_count() 
                            ?>
                        </span>
                    </a>
                </li>--->
            </ul>
        </div>
    </div>
<?php
}
add_filter('bp_before_member_header_meta', 'action_bp_before_member_header_meta');


function friends()
{
?>
    <?php
    if (bp_has_members('user_id=' . bp_loggedin_user_id() . '&type=alphabetical')) : ?>
        <ul id="friends-list" class="item-list">
            <?php while (bp_members()) : bp_the_member(); ?>
                <li>
                    <a class="d-flex align-items-center" href="<?php bp_member_permalink(); ?>">
                        <div class="avatar">
                            <?php bp_member_avatar(); ?>
                        </div>
                        <div class="friend-details">
                            <h4><?php bp_member_name(); ?></h4>
                            <div class="last-active">
                                <?php bp_member_last_active() ?>
                            </div>
                        </div>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <div id="message" class="info">
            <p><?php _e('No friends found.', 'text_domain'); ?></p>
        </div>
    <?php endif; ?>
<?php
}

add_shortcode('friends', 'friends');

function bbg_record_my_custom_post_type_posts($post_types)
{
    $post_types = array('community-post'); // Hier die Slugs der Custom Post Types eintragen, bei denen Erwähnungen im Beitrag selbst berücksichtigt werden
    return $post_types;
}
add_filter('bp_blogs_record_post_post_types', 'bbg_record_my_custom_post_type_posts');

function bbg_record_my_custom_post_type_comments($post_types)
{
    $post_types = array('community-post');
    return $post_types;
}
add_filter('bp_blogs_record_comment_post_types', 'bbg_record_my_custom_post_type_comments');


function get_user_registration_year($user_id = null)
{
    if ($user_id === null) {
        $user_id = get_current_user_id();
    }

    $user = get_userdata($user_id);
    $registered_date = $user->user_registered;
    $registered_year = date('Y', strtotime($registered_date));

    return $registered_year;
}

function community_nav()
{
    $community = '<svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 0L0 4.4V11H4.27777V7.33333H6.72223V11H11V4.4L5.5 0Z" fill="black"/> </svg>';
    $friends = '<svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none"> <path d="M6.09583 7.83749C5.31667 7.51666 5.20208 7.24166 5.20208 6.94374C5.20208 6.64582 5.43125 6.34791 5.68333 6.11874C6.14167 5.72916 6.39375 5.17916 6.39375 4.53749C6.39375 3.34582 5.61458 2.31458 4.19375 2.31458C2.79583 2.31458 1.99375 3.34582 1.99375 4.53749C1.99375 5.17916 2.24583 5.72916 2.70417 6.11874C2.95625 6.34791 3.18542 6.64582 3.18542 6.94374C3.18542 7.24166 3.07083 7.53958 2.26875 7.83749C1.12292 8.29583 0 8.82291 0 9.78541V9.85416V10.0833C0 10.5875 0.4125 11 0.939583 11H7.2875C7.81458 11 8.25 10.5875 8.25 10.0833V9.85416V9.76249C8.25 8.82291 7.24167 8.29583 6.09583 7.83749Z" fill="black"/> <path d="M9.16666 4.65208C8.525 4.4 8.43333 4.14792 8.43333 3.89583C8.43333 3.64375 8.61666 3.39167 8.84583 3.20833C9.23541 2.8875 9.44166 2.40625 9.44166 1.87917C9.44166 0.870833 8.77708 0 7.60833 0C6.53125 0 5.88958 0.733333 5.79791 1.62708C5.79791 1.71875 5.84375 1.7875 5.9125 1.83333C6.78333 2.38333 7.31041 3.34583 7.31041 4.51458C7.31041 5.38542 6.96666 6.16458 6.34791 6.71458C6.30208 6.76042 6.30208 6.85208 6.34791 6.89792C6.50833 7.0125 6.875 7.17292 7.10416 7.2875C7.17291 7.31042 7.21875 7.33333 7.2875 7.33333H10.0604C10.5875 7.33333 11 6.89792 11 6.41667V6.27917C11 5.47708 10.1292 5.04167 9.16666 4.65208Z" fill="black"/> </svg>';
    $groups = '<svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10" fill="none"> <path d="M10.2012 6.41961C10.2012 4.65038 8.76686 3.21606 6.99771 3.21606C5.22839 3.21606 3.79407 4.65038 3.79407 6.41961C3.79407 8.18885 5.22837 9.62315 6.99771 9.62315C7.33963 9.62315 7.66896 9.56904 7.97794 9.46988L9.82427 10L9.44942 8.4809C9.91831 7.92386 10.2012 7.20486 10.2012 6.41961Z" fill="black"/> <path d="M6.84682 2.48104C7.34755 2.48104 7.82493 2.57988 8.2643 2.75416C7.65231 1.14428 6.0958 0 4.27136 0C1.91242 0 0 1.91242 0 4.27144C0 5.31837 0.377264 6.27696 1.00248 7.0197L0.502587 9.04527L2.96432 8.33844C3.18219 8.40835 3.40811 8.46025 3.63961 8.49484C3.22572 7.87966 2.98362 7.13968 2.98362 6.34411C2.98362 4.21402 4.71661 2.48104 6.84682 2.48104Z" fill="black"/> </svg>';
    $profile = '<svg xmlns="http://www.w3.org/2000/svg" width="9" height="11" viewBox="0 0 9 11" fill="none"> <path d="M9 8.39735C9 7.13249 7.99267 6.10718 6.75 6.10718H2.25C1.00736 6.10718 0 7.13249 0 8.39735V10.6875H9V8.39735Z" fill="black"/> <path d="M4.5 4.58035C5.74264 4.58035 6.75 3.555 6.75 2.29017C6.75 1.02535 5.74264 0 4.5 0C3.25736 0 2.25 1.02535 2.25 2.29017C2.25 3.555 3.25736 4.58035 4.5 4.58035Z" fill="black"/> </svg>';
    ob_start();
?>
    <div class="community-nav">
        <ul class="list-inline d-flex flex-wrap align-items-center">
            <li>
                <a class="d-flex align-items-center" href="<?= get_the_permalink(39318) ?>">
                    <span class="icon"><?= $community ?></span>
                    <span>COMMUNITY</span>
                </a>
            </li>
            <li>
                <a class="d-flex align-items-center" href="/forums">
                    <span class="icon"><?= $groups ?></span>
                    <span>FORUMS</span>
                </a>
            </li>
            <?php if (is_user_logged_in()) { ?>
                <li>
                    <a class="d-flex align-items-center" href="/members/<?= bp_core_get_username(get_current_user_id())  ?>/friends">
                        <span class="icon"><?= $friends ?></span>
                        <span>FRIENDS</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php
    return ob_get_clean();
}

add_shortcode('community_nav', 'community_nav');


function community_nav_right()
{
    $messages = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none"> <path d="M16.2729 11.2303C16.554 11.2303 16.782 11.0023 16.782 10.7212C16.782 10.4401 16.554 10.2121 16.2729 10.2121C15.9917 10.2121 15.7638 10.4401 15.7638 10.7212C15.7638 11.0023 15.9917 11.2303 16.2729 11.2303Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"/> <path d="M11.1819 11.2303C11.463 11.2303 11.691 11.0023 11.691 10.7212C11.691 10.4401 11.463 10.2121 11.1819 10.2121C10.9008 10.2121 10.6728 10.4401 10.6728 10.7212C10.6728 11.0023 10.9008 11.2303 11.1819 11.2303Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"/> <path d="M6.09097 11.2303C6.37214 11.2303 6.60007 11.0023 6.60007 10.7212C6.60007 10.4401 6.37214 10.2121 6.09097 10.2121C5.80981 10.2121 5.58188 10.4401 5.58188 10.7212C5.58188 11.0023 5.80981 11.2303 6.09097 11.2303Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"/> <path d="M11.1819 20.9032C16.8051 20.9032 21.3638 16.3446 21.3638 10.7213C21.3638 5.09801 16.8051 0.539429 11.1819 0.539429C5.55858 0.539429 1 5.09801 1 10.7213C1 12.5758 1.49583 14.3146 2.36215 15.8123L1.50909 20.3941L6.09094 19.5411C7.58857 20.4073 9.32736 20.9032 11.1819 20.9032Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/> </svg>';
    $user = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
</svg>';
    $home = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16"> <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/> </svg>';
    ob_start();
?>
    <div class="community-nav">
        <ul class="list-inline d-flex flex-wrap justify-content-end align-items-center">
            <!---
            <li>
                <a class="d-flex align-items-center" href="/members/<?= bp_core_get_username(get_current_user_id())  ?>/messages">
                    <span class="icon"><?= $messages ?></span>
                    <span class="hide-mobile">MESSAGES</span>
                </a>
            </li>-->
            <li>
                <a class="d-flex align-items-center" href="/members/<?= bp_core_get_username(get_current_user_id())  ?>/">
                    <span class="icon"><?= $user ?></span>
                    <span class="hide-mobile">PROFILE</span>
                </a>
            </li>
            <li>
                <a class="d-flex align-items-center" href="<?= get_site_url() ?>">

                    <span class="hide-mobile">BACK TO TRB WEBSITE</span>
                </a>
            </li>
        </ul>
    </div>
<?php
    return ob_get_clean();
}

add_shortcode('community_nav_right', 'community_nav_right');

add_action('wp_ajax_nopriv_add_to_favorites_ajax', 'add_to_favorites_ajax'); // for not logged in users
add_action('wp_ajax_add_to_favorites_ajax', 'add_to_favorites_ajax');
function add_to_favorites_ajax()
{
    if (! is_user_logged_in()) {
        wp_send_json_error(array('message' => __('You must be logged in to add favorites.', 'your-textdomain')));
    }

    if (! isset($_POST['post_id'])) {
        wp_send_json_error(array('message' => __('Missing post ID.', 'your-textdomain')));
    }

    $user_id = get_current_user_id();
    $post_id = absint($_POST['post_id']);

    // Use an appropriate method to store favorites. Here's an example using user meta:
    $favorites = get_user_meta($user_id, 'user_favorites', true);
    $favorites = $favorites ? (array) $favorites : array();

    if (in_array($post_id, $favorites)) {
        $key = array_search($post_id, $favorites);
        $status = 'removed';
        if ($key !== false) {
            unset($favorites[$key]);
        }
    } else {
        $status = 'added';
        $favorites[] = $post_id;
    }

    update_user_meta($user_id, 'user_favorites', $favorites);

    wp_send_json_success(
        array(
            'message' => $status,
            'count' =>  get_posts_number_of_favorites($post_id)
        )
    );

    die();
}

function get_posts_number_of_favorites($post_id)
{
    $user_count = 0;
    $user_ids = get_users(array('fields' => 'ID'));

    // Loop through each user
    foreach ($user_ids as $user_id) {
        // Get the user's favorites
        $user_favorites = get_user_meta($user_id, 'user_favorites', true);

        // If the post ID is in the user's favorites, increment the count
        if (is_array($user_favorites) && in_array($post_id, $user_favorites)) {
            $user_count++;
        }
    }

    return $user_count;
}



add_action('wp_ajax_nopriv_community_posts', 'community_posts'); // for not logged in users
add_action('wp_ajax_community_posts', 'community_posts');
function community_posts()
{
    $s = isset($_POST['s']) ? $_POST['s'] : false;
    $post_type = isset($_POST['post_type']) ? $_POST['post_type'] : false;
    $category = isset($_POST['category']) ? $_POST['category'] : false;
    $posts_per_page = isset($_POST['posts_per_page']) ? $posts_per_page : 4;



    $args['post_status'] = 'publish';
    $args['post_type'] = $post_type;
    $args['posts_per_page'] = $posts_per_page;

    if ($category) {
        $args['tax_query'][] = array(
            array(
                'taxonomy' => 'community-post-category',
                'field' => 'term_id',
                'terms' => $category,
            ),
        );
    }

    if ($s) {
        $args['s'] = $s;
    }

    $the_query = new WP_Query($args);

    echo '<div class="swiper swiper-post-slider">';
    echo '<div class="row g-4 swiper-wrapper">';
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
            echo '<div class="col-lg-6 swiper-slide">';
            echo do_shortcode('[e_guides_post id=' . get_the_ID() . ']');
            echo '</div>';
        }
    } else {
        echo '<div class="col-lg-6">';
        echo "<h2>No results found for $s</h2>";
        echo '</div>';
    }
    echo '</div>';
    echo '<div class="swiper-pagination"></div>';
    echo '</div>';

    wp_reset_postdata();

    /*
	if ($data_val['has_pagination'] == true || $data_val['has_pagination'] == 'true') {
		echo _pagination(true, $the_query, array(
			'url' => $data_val['url'],
			'posts_per_page' => $query_val['posts_per_page'],
			's' => $query_val['s'],
		));
	}*/

    die();
}

function community_login()
{
    ob_start();
?>
    <div id="bbp_login_form">
        <?= do_shortcode('[bbp-login]') ?>
    </div>
    <?php if (!is_user_logged_in()) { ?>
        <div class="bbp-login-footer">
            <p style="text-align: center;">Don't have an account? Register <a href="https://theribbonbox.com/community-homepage/register/">here</a>.</p>
        </div>
    <?php } ?>
<?php
    return ob_get_clean();
}

add_shortcode('community_login', 'community_login');



function community_register()
{
    ob_start();
?>
    <p style="text-align: center;"><?= do_shortcode('[wpforms id="40016" title="false"]') ?></p>
    <?php if (!is_user_logged_in()) { ?>
        <p style="text-align: center;">Already have an account? Login <a href="https://theribbonbox.com/community-homepage/login">here</a>.</p>
    <?php } ?>
<?php
    return ob_get_clean();
}

add_shortcode('community_register', 'community_register');


function forum_bottom_sections()
{
    ob_start();
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <section class="cta lg-padding bg-black text-center">
        <div class="container">
            <h2 class="mb-4"><i>Looking for expert advice?</i></h2>
            <div class="button-box button-accent">
                <a href="https://theribbonbox.com/experts/match-with-an-expert">
                    MATCH WITH AN EXPERT
                </a>
            </div>
        </div>
    </section>
    <section class="forum-giveaways lg-padding bg-white">
        <?= do_shortcode('[_giveaway_list]') ?>
    </section>
    <section class="exclusive-articles bg-white lg-padding-bottom text-center">
        <div class="container">
            <a href="<?= get_the_permalink(39546) ?>" class="d-block box-style-1 position-relative rounded overflow-hidden">
                <div class="bg-image">
                    <?= wp_get_attachment_image(get_field('latest_conversation_background', 39318), 'large') ?>
                </div>
                <div class="inner position-relative">
                    <div class="heading">
                        <h2><?= get_field('latest_conversation_heading', 39318) ?></h2>
                    </div>
                    <div class="subheading" style="text-decoration: underline">
                        <?= get_field('latest_conversation_button_text', 39318) ?>
                    </div>
                </div>
            </a>
        </div>
    </section>
    <section class="events-section lg-padding" style="display: none">
        <div class="container text-center">

        </div>
    </section>
    <section class="e-guides-community lg-padding">
        <div class="container">
            <?= do_shortcode('[e_guides_community]') ?>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
    return ob_get_clean();
}

add_shortcode('forum_bottom_sections', 'forum_bottom_sections');


function registration__email()
{
    ob_start();
    $args = array(
        'meta_query' => array(
            array(
                'key'     => 'email_notification',
                'value'   => 'No',
                'compare' => '='
            )
        )
    );

    $user_query = new WP_User_Query($args);

    // Get the results
    $users = $user_query->get_results();

    // Check for results
    if (! empty($users)) {
        echo '<ul>';
        foreach ($users as $user) {
            $name =  $user->display_name;
            $username = $user->user_nicename;
            $password = $user->user_pass;
            echo '<li>' . $user->display_name . '</li>';
            echo '<li>' . $user->user_nicename . '</li>';
            echo '<li>' . $user->user_pass . '</li>';
        }
        echo '</ul>';
    } else {
        echo 'No users found.';
    }
    return ob_get_clean();
}
add_shortcode('registration__email', 'registration__email');

function wpf_dev_process_complete($fields, $entry, $form_data, $entry_id)
{

    // Optional, you can limit to specific forms. Below, we restrict output to
    // form #5.
    if (absint($form_data['id']) !== 40016) {
        return;
    }

    $args = array(
        'meta_query' => array(
            array(
                'key'     => 'email_notification',
                'value'   => 'No',
                'compare' => '='
            )
        )
    );

    $user_query = new WP_User_Query($args);

    // Get the results
    $users = $user_query->get_results();

    // Check for results
    if (! empty($users)) {
        foreach ($users as $user) {
            $user_id =  $user->ID;
            $name =  $user->display_name;
            $username = $user->user_nicename;
            $to_email = $user->user_email;
            $title = str_replace(get_the_title($parent), '', get_the_title($id));
            $subject = 'Welcome to The Ribbon Box Community';

            $headers = 'From: The Ribbon Box <website@theribbonbox.com>' . "\r\n";
            $content = '<div style="background-color: #f4f4f4;"> <table style="max-width: 600px; width: 100%; margin-left: auto; margin-right: auto; border-collapse: collapse; background-color: #fff; font-family:Trebuchet MS, Lucida Sans Unicode, Lucida Grande, Lucida Sans, Arial, sans-serif;"> <thead> <tr> <td style="background-color: #f77d66; padding: 10px 20px; text-align: center;"> <a href="https://theribbonbox.com/community-homepage/"> <img src="https://theribbonbox.com/wp-content/uploads/2025/01/trb-logo.png"> </a> </td> </tr> </thead> <tbody> <tr> <td style="padding: 40px 20px;"> <table style="width: 100%;"> <tbody> <tr> <td style="padding-bottom: 20px;"> <p style="margin-top: 0">Hi ' . $name . ', </p> <p style="margin-bottom: 0;"> Here are your details </p> </td> </tr> <tr> <td style="padding-bottom: 20px;"> <table> <tbody> <tr> <td> <strong>Username:</strong> </td> <td> ' . $username . ' </td> </tr> </tbody> </table> </td> </tr> <tr> <td> <table style="width: 100%; margin-left: auto; margin-right: auto;"> <tbody> <tr> <td style="background-color: #044146; padding: 10px; text-align: center;"> <a href="https://theribbonbox.com/community-homepage/login/" style="color:#fff !important; text-decoration: none !important; font-weight: bold; "> LOGIN </a> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> </tbody> <tfoot> <tr> <td style="background-color: #f77d66; padding: 10px 20px; text-align: center;"> <table style="width: 100%;"> <tbody> <tr> <td style="width: 40%;"> <img src="https://theribbonbox.com/wp-content/uploads/2025/01/trb-logo.png"> </td> <td style="width: 60%;"> <table style="margin-left: auto; margin-right: 0;"> <tbody> <tr> <td> <table> <tbody> <tr> <td style="padding: 5px;"> <a href="https://www.facebook.com/fertility.theribbonbox/" target="_blank"> <img src="https://theribbonbox.com/wp-content/uploads/2025/01/facebook.png"> </a> </td> <td style="padding: 5px;"> <a href="https://www.pinterest.co.uk/the_ribbon_box/" target="_blank"> <img src="https://theribbonbox.com/wp-content/uploads/2025/01/pinterest.png"> </a> </td> <td style="padding: 5px;"> <a href="https://www.linkedin.com/company/theribbonbox" target="_blank"> <img src="https://theribbonbox.com/wp-content/uploads/2025/01/linkedin.png"> </a> </td> <td style="padding: 5px;"> <a href="https://twitter.com/theribbonbox_" target="_blank"> <img src="https://theribbonbox.com/wp-content/uploads/2025/01/twitter-x.png"> </a> </td> <td style="padding: 5px;"> <a href="https://www.youtube.com/@theribbonbox" target="_blank"> <img src="https://theribbonbox.com/wp-content/uploads/2025/01/youtube.png"> </a> </td> <td style="padding: 5px;"> <a href="https://www.instagram.com/fertility_help_hub/" target="_blank"> <img src="https://theribbonbox.com/wp-content/uploads/2025/01/instagram.png"> </a> </td> <td style="padding: 5px;"> <a href="https://www.tiktok.com/@fertility.theribbonbox" target="_blank"> <img src="https://theribbonbox.com/wp-content/uploads/2025/01/tiktok.png"> </a> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> <tr> <td style="padding: 10px 20px;"> <table style="margin-left: auto; margin-right: 0;"> <tbody> <tr> <td style="text-align: center; width: auto; padding: 0 10px;"> <a style="color: #000 !important; text-decoration: none !important;" href="https://theribbonbox.com/community-homepage/">COMMUNITY</a> </td> <td style="text-align: center; width: auto; padding: 0 10px;"> <a style="color: #000 !important; text-decoration: none !important;" href="https://theribbonbox.com/forums/">FORUMS</a> </td> </tr> </tbody> </table> </td> </tr> </tfoot> </table> </div>';
            $content = str_replace('[title]', $title, $content);

            wp_mail($to_email, $subject, $content, $headers);

            update_user_meta($user_id, 'email_notification', 'Yes');
        }
    }
}
add_action('wpforms_process_complete', 'wpf_dev_process_complete', 10, 4);

function wpse27856_set_content_type()
{
    return "text/html";
}
add_filter('wp_mail_content_type', 'wpse27856_set_content_type');


function forum_sidebar()
{
    $community_posts = get_posts(array(
        'post_type' => 'topic',
        'posts_per_page' => 5,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'any',
    ));

    var_dump(bbp_get_user_favorites_topic_ids());

?>
    <div class="community-posts">
        <div class="featured-box">
            <div class="featured-box-heading">
                <h2 class="text-heading mb-0">Featured community posts</h2>
            </div>

            <div class="featured-box-holder d-flex flex-wrap">
                <?php foreach ($community_posts as $community_post) { ?>
                    <div class="featured-box-item post-box" post-id="<?= $community_post->ID ?>">
                        <a href="<?= get_the_permalink($community_post->ID) ?>">
                            <h3 class="mb-3"><?= get_the_title($community_post->ID) ?></h3>
                        </a>
                        <div class="topic-action d-flex align-items-center justify-content-between">
                            <div class="left">
                                <a class="read-more" href="<?= get_the_permalink($community_post->ID) ?>">
                                    Read more
                                </a>
                            </div>
                            <div class="right">
                                <?= do_shortcode('[post_action id=' . $community_post->ID . ']') ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
<?php
}

add_shortcode('forum_sidebar', 'forum_sidebar');
/**
 * Get users' favorite topics in bbPress.
 *
 * This function retrieves the IDs of topics that a specific user has marked as favorites.
 *
 * @param int $user_id The ID of the user whose favorite topics to retrieve.
 * @return array An array of topic IDs that the user has marked as favorites, or an empty array if none are found.
 */
function get_user_favorite_topics($user_id = 0)
{

    if (empty($user_id)) {
        $user_id = bbp_get_current_user_id();
    }

    if (empty($user_id)) {
        return array(); // No user ID, return empty array.
    }

    $favorites = bbp_get_user_favorites($user_id, true); // Get favorites as an array of topic IDs.

    if (empty($favorites) || ! is_array($favorites)) {
        return array(); // No favorites found, return empty array.
    }

    return $favorites;
}
