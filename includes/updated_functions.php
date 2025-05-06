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
    $rtn.="<script type='text/javascript'>
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
    <div class="white-event-section  event-giveaway-outer event-giveaway-outer-light-bg" >
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
							<?php if($display_form_on_homepage && current_user_can('administrator')) { ?>
								<div class="giveaway-form-email">
									<?= do_shortcode('[wpforms id="40566" title="false"]') ?>
								</div>
							<?php } else { ?>
								<div class="blog-btns">
									<a class="button-expert"
										href="<?= $post_args['post_permalink'] ?>">Enter Now</a>
								</div>
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
