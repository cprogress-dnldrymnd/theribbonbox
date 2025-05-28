<?php
add_shortcode('_homeblog_filter', '_homeblog_filter_function');
function _homeblog_filter_function($attr)
{
    //see home.php for other shortcodes

    $fertility_category_id = 1164;
    $wellbeing_category_id = 1159;
    $content =
        do_shortcode('[blog_filter format="home-banner" categoryid="' . $fertility_category_id . '" home="1"]')
        . do_shortcode('[blog_filter format="normal-2" limit="2" categoryid="' . $wellbeing_category_id . '" home="1"]')
        . do_shortcode('[_giveaway_list]');

    return $content;
}

function _giveaway_list_function($attr)
{

    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'giveaway-items',
        'numberposts' => 3, // Number of recent posts thumbnails to display
        'orderby' => 'date',
        'order' => 'desc',
        'post_status' => 'publish', // Show only the published posts,
        'has_password' => false,
        /*'meta_query' => array(
            array(
                'key' => 'select_competition_date', // Replace with your custom field key.
                'value' => date('Y-m-d'), // Today's date.
                'compare' => '>=', // Greater than or equal to today.
                'type' => 'DATE' // Important: Specify the meta_value type as DATE.
            )
        )*/
    ));


    $rtn = "";

    $count = count($recent_posts);
    /*
    if ($count > 1) {
        $class = 'bg-cream';
    } else {
        $class = 'bg-white';
    }*/
    $class = 'bg-white';

    $rtn .= '<div class="expert-outer giveaways-homepage ' . $class . '"><h2>Giveaways</h2>';
    $rtn .= '<div class="blogs-loop-carousel-holder">';
    $rtn .= '<div class="blogs-loop-carousel-inner">';
    $rtn .= '<div class="blogs-loop blogs-loop-v2 blogs-loop-carousel">';
    /*
    if ($count > 1) {
        $rtn .= '<div class="blogs-loop-inner">';
    }*/
    foreach ($recent_posts as $post) :
        $select_competition_date = get_field("select_competition_date", $post['ID']);
        $date = $select_competition_date;
        $time = strtotime($date);
        $displayformatB = date('j M Y', $time);
        $categories = get_the_category($post['ID']);
        $currentcat = $categories[0]->cat_ID;
        $currentcatname = $categories[0]->cat_name;
        $cat_p = get_ancestors($categories[0]->term_id, 'category');
        $termIdVal = 'term_' . $currentcat;

        if (count($cat_p) > 0) {
            $termIdVal = 'term_' . $cat_p[0];
        }

        $bcolour = "#F77D66";

        if (!empty(get_field("category_colour", $termIdVal))) {
            $bcolour = get_field("category_colour", $termIdVal);
        }

        $addBorder = 'border-top: 5px solid ' . $bcolour . ';';
        if (!has_post_thumbnail($post['ID'])) {
            $style = 'style="background:url(';
            $iUrl = get_field("post_large_image", $post['ID']);
            $style .= $iUrl;
            $style .= '); background-size:cover; background-position:center;  ' . $addBorder . '"';
        } else {
            $style = 'style="background:url(';
            $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], 'full'));
            $style .= $iUrl;
            $style .= '); background-size:cover; background-position:center;  ' . $addBorder . '"';
        }

        $post_args = array(
            'post_id' => $post['ID'],
            'post_title' => get_the_title($post['ID']),
            'post_permalink' => get_the_permalink($post['ID']),
            'date' => $displayformatB,
            'style' => $style,
            'addBorder' => $addBorder,
            'currentcatname' => $currentcatname,
        );
        /*
        if ($count > 1) {
            $rtn .= blog_post_style_1($post_args);
        } else {
            $rtn .= blog_post_style_2($post_args);
        }*/

        $rtn .= blog_post_style_2($post_args);

    endforeach;
    /*
    if ($count > 1) {
        $rtn .= '</div>';
    }*/
    $rtn .= '</div>';
    $rtn .= '</div>';
    $rtn .= '</div>';

    wp_reset_query();


    $rtn .= '</div>';
    $rtn .= "<script type='text/javascript'>
    $(document).ready(function () {
        if ($('.blogs-loop-carousel').length > 0) {
            $('.blogs-loop-carousel').slick({
                centerMode: true,
                centerPadding: '0px',
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 5000,
            });
        }
    });
</script>";

    return $rtn;
}
add_shortcode('_giveaway_list', '_giveaway_list_function');


function blog_post_style_1($post_args)
{
    ob_start();
?>
    <div class="blog-tpl-20 blog-even-nor blog-nor format-post-page incount-0 post-type-giveaway-items blog-top-offer-list post-<?= $post_args['post_id'] ?>"
        style="<?= $post_args['addBorder'] ?>">
        <div class="blog-l-img" <?= $post_args['style'] ?>>
            <a href="<?= $post_args['post_permalink'] ?>"
                class="bl-overlay"><span>Read<br>More</span></a>
            <a href="<?= $post_args['post_permalink'] ?>"><img
                    src="/wp-content/themes/lighttheme/images/a_squ_trans.png"></a>
        </div>
        <div class="blog-l-text-out">
            <div class="blog-l-text">

                <h3><?= $post_args['currentcatname'] ?></h3>
                <a href="<?= $post_args['post_permalink'] ?>">
                    <h2><?= $post_args['post_title'] ?></h2>
                </a>
                <h3 class="date-giveaways">Event Date: <?= $post_args['date'] ?></h3>

                <div class="blog-btns">
                    <a style="color:#000;" href="<?= $post_args['post_permalink'] ?>">Enter Now</a>
                </div>
            </div>
        </div>
        <div class="end">
        </div>
    </div>
<?php
    return ob_get_clean();
}

add_shortcode('blog_post_style_1', 'blog_post_style_1');


function blog_post_style_2($post_args)
{
    ob_start();
    $display_form_on_homepage = get_field('display_form_on_homepage', $post_args['post_id']);
?>
    <div class="white-event-section  event-giveaway-outer event-giveaway-outer-light-bg">
        <div class="event-giveaway-inner">
            <div class="blog-top-ban blog-top-ban-podcast">
                <div class="blog-top-ban-podcast-inner">
                    <div class="blog-l-text-out" style="border-top: 5px solid #034146;">
                        <div class="blog-l-text">
                            <h3 class="category"><?= $post_args['currentcatname'] ?></h3>
                            <a href="<?= $post_args['post_permalink'] ?>">
                                <h3 class="title">
                                    <?= $post_args['post_title'] ?>
                                </h3>

                            </a>
                            <h3 class="date-giveaways"><?= $post_args['date'] ?></h3>
                            <p class="text"></p>
                            <?php if ($display_form_on_homepage) { ?>
                                <div class="giveaway-form-email">
                                    <?= do_shortcode('[wpforms id="40566" title="false"]') ?>
                                </div>
                            <?php } else { ?>
                                <?= $post_args['select_competition_date'] ?>
                                <?php if (is_past_date($post_args['select_competition_date']) != false) { ?>
                                    <div class="blog-btns">
                                        <a class="button-expert"
                                            href="<?= $post_args['post_permalink'] ?>">Enter Now</a>
                                    </div>
                                <?php } else { ?>
                                    <div class="blog-btns">
                                        <a class="button-expert"
                                            href="<?= $post_args['post_permalink'] ?>">Giveaway Closed</a>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="blog-l-img" <?= $post_args['style'] ?>>
                        <a href="<?= $post_args['post_permalink'] ?>" class="bl-overlay">
                            <span></span>
                        </a>
                        <a href="<?= $post_args['post_permalink'] ?>">

                            <img src="/wp-content/themes/lighttheme/images/vid_req.png"
                                style="border-bottom-color: rgba(0, 0, 0, 0);">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}

add_shortcode('blog_post_style_2', 'blog_post_style_2');

/**
 * Checks if a given date string represents a date in the past.
 *
 * @param string $date_string The date string to check (e.g., '2023-10-26', 'December 15, 2024').
 * WordPress's strtotime() function will be used to parse this string.
 * @return bool True if the date is in the past, false otherwise.
 */
function is_past_date($date_string)
{
    $timestamp = strtotime($date_string);

    // Check if strtotime() successfully parsed the date string.
    if (false === $timestamp) {
        // Invalid date string, consider it not in the past.
        return false;
    }

    // Get the current timestamp.
    $current_timestamp = current_time('timestamp');

    // Compare the provided timestamp with the current timestamp.
    return $timestamp < $current_timestamp;
}


function get_socials_v2()
{
    ob_start();
    global $theme_option_page;
    $facebook_social = get_field('facebook_social', $theme_option_page);
    $pinterest_social = get_field('pinterest_social', $theme_option_page);
    $linkedin_social = get_field('linkedin_social', $theme_option_page);
    $x_social = get_field('x_social', $theme_option_page);
    $youtube_social = get_field('youtube_social', $theme_option_page);

?>
    <div class="socials-v2 row g-3 g-lg-4 justify-content-center text-center">
        <?php if ($facebook_social) { ?>
            <div class="col-auto">
                <a target="_blank" href="<?= $facebook_social ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                    </svg>
                </a>
            </div>
        <?php } ?>
        <?php if ($pinterest_social) { ?>
            <div class="col-auto">
                <a target="_blank" href="<?= $pinterest_social ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pinterest" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 0 0-2.915 15.452c-.07-.633-.134-1.606.027-2.297.146-.625.938-3.977.938-3.977s-.239-.479-.239-1.187c0-1.113.645-1.943 1.448-1.943.682 0 1.012.512 1.012 1.127 0 .686-.437 1.712-.663 2.663-.188.796.4 1.446 1.185 1.446 1.422 0 2.515-1.5 2.515-3.664 0-1.915-1.377-3.254-3.342-3.254-2.276 0-3.612 1.707-3.612 3.471 0 .688.265 1.425.595 1.826a.24.24 0 0 1 .056.23c-.061.252-.196.796-.222.907-.035.146-.116.177-.268.107-1-.465-1.624-1.926-1.624-3.1 0-2.523 1.834-4.84 5.286-4.84 2.775 0 4.932 1.977 4.932 4.62 0 2.757-1.739 4.976-4.151 4.976-.811 0-1.573-.421-1.834-.919l-.498 1.902c-.181.695-.669 1.566-.995 2.097A8 8 0 1 0 8 0" />
                    </svg>
                </a>
            </div>
        <?php } ?>
        <?php if ($linkedin_social) { ?>
            <div class="col-auto">
                <a target="_blank" href="<?= $linkedin_social ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                    </svg>
                </a>
            </div>
        <?php } ?>
        <?php if ($x_social) { ?>
            <div class="col-auto">
                <a target="_blank" href="<?= $x_social ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                        <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                    </svg>
                </a>
            </div>
        <?php } ?>
        <?php if ($youtube_social) { ?>
            <div class="col-auto">
                <a target="_blank" href="<?= $youtube_social ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                        <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z" />
                    </svg>
                </a>
            </div>
        <?php } ?>
    </div>

<?php
    return ob_get_clean();
}

add_shortcode('get_socials_v2', 'get_socials_v2');


add_shortcode('e_guides_post', 'e_guides_post');

function create_item_socials_v2($url, $title, $icon = '<img class="me-2" src="https://theribbonbox.com/wp-content/uploads/2024/11/share.png"
						alt="">', $text = 'SHARE')
{
    $rtn = '<div class="post-share post-share-v2"><a class="post-share-btn" href="#"><div class="share d-flex align-items-center">
					' . $icon . '
					' . $text . '
				</div></a><div class="post-share-items" style="display:none;"><div class="social-icons"> 
                        <a href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '" target="_blank" class="whatsapp" href="whatsapp://send?text=This is WhatsApp sharing example using link" data-action="share/whatsapp/share" rel="nofollow"></a>
                        <a href="mailto:?subject=' . $title . '+&body=' . $url . '" target="_blank" class="emailshare" rel="nofollow"></a>
                        <a href="' . $url . '" target="_blank" class="facebook" rel="nofollow"></a>
                        <a href="' . $url . '" target="_blank" class="pinterest" rel="nofollow"></a> 
                        <a href="' . $url . '" target="_blank" class="linkedin" rel="nofollow"></a>
                        <a href="https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title . '" target="_blank" class="twitter" rel="nofollow"></a> 
            </div></div></div>';
    return $rtn;
}
