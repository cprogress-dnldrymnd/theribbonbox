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
