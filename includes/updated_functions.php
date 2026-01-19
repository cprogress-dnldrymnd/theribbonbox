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
//deprecated
function _giveaway_list_function($attr)
{

    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'giveaway-items',
        'numberposts' => 3, // Number of recent posts thumbnails to display
        'orderby' => 'date',
        'order' => 'desc',
        'post_status' => 'publish', // Show only the published posts,
        'has_password' => false,
        'meta_query' => array(
            array(
                'key' => 'select_competition_date', // Replace with your custom field key.
                'value' => date('Y-m-d'), // Today's date.
                'compare' => '>=', // Greater than or equal to today.
                'type' => 'DATE' // Important: Specify the meta_value type as DATE.
            )
        )
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
                                <?php if (isDatePast($post_args['select_competition_date']) != false) { ?>
                                    <div class="blog-btns">
                                        <a class="button-expert"
                                            href="<?= $post_args['post_permalink'] ?>">Enter Now</a>
                                    </div>
                                <?php } else { ?>
                                    <div class="blog-btns">
                                        <a class="button-expert "
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
 * Method 1: Using the DateTime class (Recommended/OOP Style)
 * This is the most robust method as it handles timezones and leap years correctly.
 */
function isDatePast($dateString)
{
    // Get current date, reset time to midnight for accurate day comparison
    $today = new DateTime();
    $today->setTime(0, 0, 0);

    // Create DateTime object from input
    $inputDate = DateTime::createFromFormat('Y-m-d', $dateString);

    // Check if input format was valid
    if (!$inputDate) {
        return "Invalid date format";
    }

    // Reset time to midnight for the input date as well
    $inputDate->setTime(0, 0, 0);

    // Compare
    if ($inputDate < $today) {
        return true;
    } else {
        return false;
    }
}
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
    global $theme_option_page, $theme_icons;
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
                    <?= $theme_icons['facebook'] ?>
                </a>
            </div>
        <?php } ?>
        <?php if ($pinterest_social) { ?>
            <div class="col-auto">
                <a target="_blank" href="<?= $pinterest_social ?>">
                    <?= $theme_icons['pinterest'] ?>
                </a>
            </div>
        <?php } ?>
        <?php if ($linkedin_social) { ?>
            <div class="col-auto">
                <a target="_blank" href="<?= $linkedin_social ?>">
                    <?= $theme_icons['linkedin'] ?>
                </a>
            </div>
        <?php } ?>
        <?php if ($x_social) { ?>
            <div class="col-auto">
                <a target="_blank" href="<?= $x_social ?>">
                    <?= $theme_icons['x'] ?>
                </a>
            </div>
        <?php } ?>
        <?php if ($youtube_social) { ?>
            <div class="col-auto">
                <a target="_blank" href="<?= $youtube_social ?>">
                    <?= $theme_icons['youtube'] ?>
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
                        <a target="_blank" class="whatsapp" href="whatsapp://send?text=' . $title . ' ' . $url . '" data-action="share/whatsapp/share" rel="nofollow"></a>
                        <a href="mailto:?subject=' . $title . '+&body=' . $url . '" target="_blank" class="emailshare" rel="nofollow"></a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '"  target="_blank" class="facebook" rel="nofollow"></a>
                        <a href="https://pinterest.com/pin/create/button/?url=&media=' . $url . '" target="_blank" class="pinterest" rel="nofollow"></a> 
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '" target="_blank" class="linkedin" rel="nofollow"></a>
                        <a href="https://x.com/intent/tweet?url=' . $url . '&text=' . $title . '" target="_blank" class="twitter" rel="nofollow"></a> 
            </div></div></div>';
    return $rtn;
}

function create_item_socials_v3($url, $title)
{
    ob_start();
    global $theme_icons;

?>
    <div class="social-icons-v3">
        <a target="_blank" href="whatsapp://send?text=<?= $title . ' ' . $url ?>" data-action="share/whatsapp/share" rel="nofollow">
            <?= $theme_icons['whatsapp'] ?>
        </a>
        <a href="mailto:?subject<?= $title ?>+&body=<?= $url  ?>" target="_blank" rel="nofollow">
            <?= $theme_icons['email'] ?>
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $url  ?>" target="_blank" rel="nofollow">
            <?= $theme_icons['facebook'] ?>
        </a>
        <a href="https://pinterest.com/pin/create/button/?url=&media=<?= $url  ?>" target="_blank" rel="nofollow">
            <?= $theme_icons['pinterest'] ?>
        </a>
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $url  ?>" target="_blank" rel="nofollow">
            <?= $theme_icons['linkedin'] ?>
        </a>
        <a href="https://x.com/intent/tweet?url=<?= $url  ?>&text=' . $title . '" target="_blank" rel="nofollow">
            <?= $theme_icons['x'] ?>
        </a>
    </div>
<?php
    return ob_get_clean();
}
