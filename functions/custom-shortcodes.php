<?php

use function Sodium\compare;

include __DIR__ . '/../shortcodes/blog-filter.php';
include 'categories_post_types.php';

add_shortcode('comment', function () {
    return '';
});

include 'custom-shortcodes-get_category_posts_nav_new.php';

/**
 * @param $url
 *   E.g. /fertility/mitochondrial-donation-treatment/
 * @param $title
 * @return string
 */
function get_the_breadcrumb_function($url, $title)
{
    //d($url);
    //d($title);
    $rtn = '';
    // url parts, e.g. ["", "fertility", "mitochondrial-donation-treatment", ""]
    $arr = explode("/", $url);
    // strip out empty items
    $arr = array_filter($arr, 'strlen');
    //d($arr);
    $arrLength = count($arr);
    $acnt = 1;
    $rtn .= '
      <ul id="breadcrumbs">
        <li><a href="' . get_option('home') . '">Home</a></li>';
    foreach ($arr as $itm) {
        if ($itm === "podcasts") {
            $itm = "watch-listen/the-ribbon-box-podcast";
        } else if ($itm == "videos") {
            $itm = "watch-listen/videos";
        }

        /** @var WP_Term|WP_Post_Type|WP_Post|WP_User|null $category */
        $queried_obj = get_queried_object();
        //d($queried_obj);
        if ($itm === "category" || $itm === "tag") {
            $back_title = $queried_obj->name;
            $back_url = $url;
        }
        // First part
        else if ($acnt === 1) {
            $back_id = url_to_postid('/' . $itm);
            //d($back_id);
            $back_title = get_the_title($back_id);
            $back_url = '/' . $itm;
        }
        // Last part (the post itself)
        else if ($acnt == $arrLength) {
            $back_title = $title;
            $back_url = null;
        } else {
            $back_url = "";
            for ($i = 0; $i < $arrLength; ++$i) {
                if ($arr[$i] != "") {
                    $back_url .= "/" . $arr[$i];
                }
            }
            //d($back_url);
            $back_id = url_to_postid($back_url);
            //d($back_id);
            $back_title = get_the_title($back_id);
        }
        $rtn .= "<li>" . ($back_url ? "<a href='$back_url'>" : '') . $back_title . ($back_url ? "</a>" : '') . "</li>";
        $acnt++;
    }

    $rtn .= '</ul>';
    return $rtn;
}

add_shortcode('get_the_breadcrumb', 'get_the_breadcrumb_function');

function get_socials_function($atts)
{
    ob_start();
    extract(
        shortcode_atts(
            array(
                'social' => 'all',
            ),
            $atts
        )
    );
?>
    <?php if ($social == 'all' || $social == 'icons-only') {  ?>
        <div class="social--icons d-flex gap-3 align-items-center">
            <a href="https://www.facebook.com/fertility.theribbonbox/" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                </svg>
            </a>
            <a href="https://www.pinterest.co.uk/the_ribbon_box/" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pinterest" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 0 0-2.915 15.452c-.07-.633-.134-1.606.027-2.297.146-.625.938-3.977.938-3.977s-.239-.479-.239-1.187c0-1.113.645-1.943 1.448-1.943.682 0 1.012.512 1.012 1.127 0 .686-.437 1.712-.663 2.663-.188.796.4 1.446 1.185 1.446 1.422 0 2.515-1.5 2.515-3.664 0-1.915-1.377-3.254-3.342-3.254-2.276 0-3.612 1.707-3.612 3.471 0 .688.265 1.425.595 1.826a.24.24 0 0 1 .056.23c-.061.252-.196.796-.222.907-.035.146-.116.177-.268.107-1-.465-1.624-1.926-1.624-3.1 0-2.523 1.834-4.84 5.286-4.84 2.775 0 4.932 1.977 4.932 4.62 0 2.757-1.739 4.976-4.151 4.976-.811 0-1.573-.421-1.834-.919l-.498 1.902c-.181.695-.669 1.566-.995 2.097A8 8 0 1 0 8 0" />
                </svg>
            </a>
            <a href="https://www.linkedin.com/company/theribbonbox" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                </svg>
            </a>
            <a href="https://twitter.com/theribbonbox_" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                    <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                </svg>
            </a>
            <a href="https://www.youtube.com/@theribbonbox" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                    <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z" />
                </svg>
            </a>
        </div>
    <?php } ?>
    <?php if ($social == 'all' || $social == 'instagram') {  ?>

        <div class="social--icons flex-column flex-sm-row social--icons-text d-flex gap-3 align-items-sm-center my-3 ">
            <a class="d-flex gap-3 align-items-center" href="https://www.instagram.com/parenting.theribbonbox/" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                </svg>
                <span>@parenting.theribbonbox</span>
            </a>
            <span class="sep sep d-none d-sm-block">|</span>
            <a class="d-flex gap-3 align-items-center" href="https://www.instagram.com/fertility.theribbonbox/" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram d-block d-sm-none" viewBox="0 0 16 16">
                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                </svg>
                <span>@fertility.theribbonbox</span>
            </a>
        </div>
    <?php } ?>
    <?php if ($social == 'all' || $social == 'tiktok') {  ?>

        <div class="social--icons flex-column flex-sm-row social--icons-text d-flex gap-3 align-items-sm-center my-3 ">
            <a class="d-flex gap-3 align-items-center" href="https://www.tiktok.com/@fertility.theribbonbox" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                    <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z" />
                </svg>
                <span>@fertility.theribbonbox</span>
            </a>
            <span class="sep d-none d-sm-block">|</span>
            <a class="d-flex gap-3 align-items-center" href="https://www.tiktok.com/@theribbonbox" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok d-block d-sm-none" viewBox="0 0 16 16">
                    <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z" />
                </svg>
                <span>@theribbonbox</span>
            </a>
        </div>
    <?php } ?>

<?php
    return ob_get_clean();
}

add_shortcode('get_socials', 'get_socials_function');


function get_giveaway_event_function($attr)
{

    $categoryid = "";
    $limit = 100000;
    $format = "";
    $post_type = "";
    $post_id = 0;
    $style_format = "";

    if (!empty($attr["categoryid"])) {
        $categoryid = $attr["categoryid"];
    }
    if (!empty($attr["limit"])) {
        $limit = $attr["limit"];
    }
    if (!empty($attr["format"])) {
        $format = $attr["format"];
    }
    if (!empty($attr["post_type"])) {
        $post_type = $attr["post_type"];
    }
    if (!empty($attr["post_id"])) {
        $post_id = $attr["post_id"];
    }
    if (!empty($attr["style_format"])) {
        $style_format = $attr["style_format"];
    }

    $recent_posts;

    $exclude_post_ids = get_excluded_b2b_posts();

    if ($post_id != 0) {
        $recent_posts = wp_get_recent_posts(array(
            'numberposts' => 1, // Number of recent posts thumbnails to display
            'post_status' => 'publish', // Show only the published posts
            'orderby' => 'post_date',
            //'orderby' => 'rand',
            'post_type' => $post_type,
            'order' => 'DESC',
            'include' => $post_id
        ));
    } else {
        $recent_posts = wp_get_recent_posts(array(
            'numberposts' => 1, // Number of recent posts thumbnails to display
            'post_status' => 'publish', // Show only the published posts
            //'orderby' => 'rand',
            //'orderby' => 'rand',
            'post_type' => $post_type,
            'order' => 'DESC',
            'exclude' => $exclude_post_ids,
            'meta_query' => array(
                array(
                    'key'     => 'featured',
                    'value'   => '1',
                    'compare' => '='
                )
            ),
        ));
    }



    $rtn = '<div class="white-event-section event-giveaway-outer ' . $style_format . '">';
    $rtn .= '<div class="event-giveaway-inner">';

    foreach ($recent_posts as $post) :
        $categories = get_the_category($post["ID"]);
        $currentcat = $categories[0]->cat_ID;
        $currentcatname = $categories[0]->cat_name;
        $currentcatslug = $categories[0]->slug;

        $cat_p = get_ancestors($categories[0]->term_id, 'category');
        $termIdVal = 'term_' . $currentcat;

        if (count($cat_p) > 0) {
            $termIdVal = 'term_' . $cat_p[0];
        }


        $link = get_permalink($post['ID']);
        $website_link = get_field("website_link", $post["ID"]);
        $new_tab = "";
        if (!empty($website_link)) {
            $link = $website_link;
            $new_tab = "target='_blank'";
        }

        $speakerName = "";
        $speaker_name = get_field("speaker_name", $post["ID"]);
        if (!empty($speaker_name)) {
            $speakerName = '<p class="speaker-name">' . $speaker_name . '</p>';
        }


        $bcolour = "#F77D66";

        if (!empty(get_field("category_colour", $termIdVal))) {
            $bcolour = get_field("category_colour", $termIdVal);
        }

        $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
        $addBorder = 'border-top: 5px solid ' . $bcolour . ';';

        if (!has_post_thumbnail($post['ID'])) {
            $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
        } else {
            $style = 'style="background:url(';
            //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], 'full'));
            $style .= $iUrl;
            $style .= '); background-size:cover; background-position:center;"';;
        }

        $head_text = "";
        $button_text = "";

        $select_competition_date = "";

        if ($post_type == "giveaway-items") {
            $head_text = "Win";
            $button_text = "Enter Now";
            $select_competition_date = get_field("select_competition_date", $post["ID"]);
        }
        if ($post_type == "events") {
            $head_text = "Event";
            $button_text = "REGISTER HERE";
            $select_competition_date = get_field("select_competition_date", $post["ID"]);
        }
        if ($post_type == "offer-items") {
            $head_text = "Offer";
            $button_text = "Register Here";
            $select_competition_date = get_field("offer_expiry_date", $post["ID"]);
        }

        if (!empty($select_competition_date)):
            $today = date("Y-m-d");
            $date = $select_competition_date;
            $time = strtotime($date);
            $newformat = date('Y-m-d', $time);
            $displayformat = date('d-m-Y', $time);
            $displayformatB = date('j M Y', $time);


            $date_txt = "Giveaway Closed: ";

            $live_post = false;

            if ($newformat > $today) {
                $date_txt = "Giveaway Open: ";
                $live_post = true;
            }

            if (!empty($offer_expired_text)):
                $date_txt = $offer_expired_text . " ";
            endif;


            //$ex_txt = '<h3 class="date-giveaways">'.$date_txt.$displayformat . '</h3>';ENTRIES CLOSE
            $ex_txt = '<h3 class="date-giveaways">ENTRIES CLOSE ' . $displayformatB . '</h3>';
        endif;

        include get_template_directory() . '/components/sections/white-event-section.php';

    /*if ($cur_post_type == "offer-items"){ 
                    $rtn .= '<div class="blog-btns"><a href="'.get_permalink($post['ID']).'">Buy Now</a></div><hr>';
                    $apply__code = get_field("apply__code", $post["ID"]);
                    if ( !empty($apply__code) ):
                        $rtn .= '<h3>Use code <strong>'.$apply__code.'</strong> at checkout</h3>';
                        $rtn .= '<div class="listen-btns"><a data-code="'.$apply__code.'" class="copy-discount" href="'.get_permalink($post['ID']).'">Buy With Discount</a></div>'; 
                    else:
                        $rtn .= '<div class="listen-btns"><a href="'.get_permalink($post['ID']).'">Buy With Discount</a></div>'; 
                    endif;
                    
                }
                else if ($cur_post_type == "giveaway-items"){ $rtn .= '<div class="blog-btns"><a href="'.get_permalink($post['ID']).'">Enter Now</a></div>'; }

                $rtn .= '</div></div><div class="end"></div></div>';*/

    endforeach;
    wp_reset_query();
    $rtn .= '</div></div>';
    return $rtn;
}

add_shortcode('get_giveaway_event', 'get_giveaway_event_function');


function create_item_socials($url, $title)
{
    $rtn = '<div class="post-share">
				<a class="post-share-btn" href="">Share</a>
				<div class="post-share-items" style="display:none;">
					<div class="social-icons"> 
							<a href="whatsapp://send?text=' . $title . ' ' . $url . '" target="_blank" class="whatsapp" data-action="share/whatsapp/share" rel="nofollow"></a>
							<a href="mailto:?subject=' . $title . '+&body=' . $url . '" target="_blank" class="emailshare" rel="nofollow"></a>
							<a href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '" target="_blank" class="facebook" rel="nofollow"></a>
							<a href="https://www.pinterest.com/pin/create/button/?url=' . $url . '&media=&description=' . $title . '" target="_blank" class="pinterest" rel="nofollow"></a>
							<a href="https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title . ' &summary=&source=" target="_blank" class="linkedin" rel="nofollow"></a>
							<a href="https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title . '" target="_blank" class="twitter" rel="nofollow"></a> 
					</div>
				</div>
			</div>';
    if (is_page(get_query_var('cat'))) {
        return;
    } else {
        return $rtn;
    }
}

function list_categories_function() {}

add_shortcode('list_categories', 'list_categories_function');

function display_matchexpert_function()
{
    $rtn = '<div class="match-expert-outer"><div class="match-expert-inner">
            <div class="match-expert-text"><div class="match-expert-text-inner"><h3>Not sure which expert is right for you?</h3><a class="button-expert" href="/experts/match-with-an-expert">Match with an expert</a></div><img src="/wp-content/themes/lighttheme/images/a_squ_trans.png"></div>
            <div class="match-expert-img"><div class="" ><img src="' . get_the_post_thumbnail_url(22820, 'full') . '"></div></div>
            </div></div></div>';

    return $rtn;
}

add_shortcode('display_matchexpert', 'display_matchexpert_function');

function display_insider_function()
{
    $rtn = '
        <div class="post-follow-us insider-outer">
            <div class="post-follow-us-inner">
                <h2>Become an Insider</h2><hr>
                <div class="cat-links">
                    <a href="/wellbeing">Wellbeing</a> |
                    <a href="/fertility">Fertility</a> |
                    <a href="/pregnancy">Pregnancy</a> |
                    <a href="/parenting">Parenting</a>
                </div>
                <p>OUR WEEKLY NEWSLETTER OF TAILORED EXPERT ADVICE, TIPS AND GIVEAWAYS - STRAIGHT TO YOUR INBOX</p>
                <a class="button-expert sub-pop-btn" href="/" >SUBSCRIBE</a>
                <p class="no-spam"><br>NO SPAM, JUST RELATABLE CONTENT</p>
            </div>
        </div>';

    return $rtn;
}
add_shortcode('display_insider', 'display_insider_function');

function display_home_section()
{
    ob_start();
    global $theme_option_page;
    $home_section_image = get_field('home_section_image', $theme_option_page);
    $home_section_heading = get_field('home_section_heading', $theme_option_page);
    $home_section_description = get_field('home_section_description', $theme_option_page);

?>

    <div class="home-section bg-black">
        <div class="container">
            <div class="row">
                <div class="col">
                    <?= wp_get_attachment_image($home_section_image, 'large') ?>
                </div>
                <div class="col">
                    <h3><?= $home_section_heading ?></h3>
                    <div class="desc">
                        <?= wpautop($home_section_description) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    return ob_get_clean();
}

add_shortcode('display_home_section', 'display_home_section');



function display_expertboxes_function()
{
    ob_start();
    global $theme_option_page;
    $experts_banner_heading = get_field('experts_banner_heading', $theme_option_page);
    $experts_banner_description = get_field('experts_banner_description', $theme_option_page);
?>
    <div class="experts-banner post-follow-us post-follow-us-outer" style="margin-bottom:0 !important;">
        <div class="post-follow-us-inner">
            <h2 class="mt-0"><?= $experts_banner_heading ?></h2>
            <hr>
            <?= wpautop($experts_banner_description) ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('display_expertboxes', 'display_expertboxes_function');



add_shortcode('display_followus', 'display_followus_function');
function display_followus_function()
{
    ob_start();
    //revamp section
    if (current_user_can('administrator')) { ?>
        <div class="post-follow-us-revamp trb-px">
            <div class="post-follow-us-revamp-outer mw-1400">
                <div class="post-follow-us-revamp-inner">
                    <h2>Follow our <i>Socials</i></h2>
                </div>
                <div class="post-follow-us-revamp-inner">
                    <?= do_shortcode("[get_socials social='instagram']") ?>
                </div>
                <div class="post-follow-us-revamp-inner">
                    <?= do_shortcode("[get_socials social='tiktok']") ?>
                </div>
                <div class="post-follow-us-revamp-inner">
                    <?= do_shortcode("[get_socials social='icons-only']") ?>
                </div>
            </div>
        </div>
    <?php } else { ?>

        <div class="post-follow-us">
            <div class="post-follow-us-inner">
                <h2>Follow Us</h2>
                <hr>
                <div class="cat-links">
                    <a href="/wellbeing">Wellbeing</a> |
                    <a href="/fertility">Fertility</a> |
                    <a href="/pregnancy">Pregnancy</a> |
                    <a href="/parenting">Parenting</a>
                </div>
                <?= do_shortcode("[get_socials]") ?>
            </div>
        </div>


    <?php
    }

    return ob_get_clean();
}


add_shortcode('homeblog_filter', 'homeblog_filter_function');
function homeblog_filter_function($attr)
{
    //see home.php for other shortcodes

    $fertility_category_id = 1164;
    $wellbeing_category_id = 1159;
    $content =
        do_shortcode('[blog_filter format="home-banner" categoryid="' . $fertility_category_id . '" home="1"]')
        . do_shortcode('[blog_filter format="normal-2" limit="2" categoryid="' . $wellbeing_category_id . '" home="1"]')
        . do_shortcode('[giveaway_list]');
    /* . do_shortcode('[expert_list categoryid="1164,1159" title="Wellbeing &amp; Fertility Experts" home="1"]');
        . do_shortcode('[blog_filter format="normal-4" limit="3" categoryid="1159" home="1"]');
        . do_shortcode('[category_list]');
        . '<h2 class="hp-h2">Watch &amp; Listen</h2>';
        . do_shortcode('[blog_filter format="video-half" post_type="videos" limit="2" categoryid="1159" home="1"]');
        . do_shortcode('[blog_filter format="video" limit="4"]');
        . do_shortcode('[blog_filter format="normal-4" limit="3" categoryid="1165" home="1"]');
        . do_shortcode('[expert_list categoryid="1165,1163" title="Pregnancy &amp; Parenting Experts"]');
        . do_shortcode('[display_insider]');
        . do_shortcode('[blog_filter format="normal-4" limit="3" categoryid="1165" home="1"]');
        . do_shortcode('[blog_filter format="normal-1" limit="2" categoryid="1163" home="1"]');
        . do_shortcode('[blog_filter format="normal-2" limit="2" categoryid="1159" home="1"]');
        . do_shortcode('[display_followus]');
        . do_shortcode('[blog_filter format="normal-4" limit="6" categoryid="1159" home="1"]');
        . do_shortcode('[blog_filter format="normal-3" limit="2" categoryid="1165" home="1"]');*/
    return $content;
}

function replace_between($str, $needle_start, $needle_end, $replacement)
{
    $pos = strpos($str, $needle_start);
    $start = $pos === false ? 0 : $pos + strlen($needle_start) - 15;

    $pos = strpos($str, $needle_end, $start);
    $end = $start === false ? strlen($str) : $pos;

    return substr_replace($str, $replacement,  $start, $end - $start + 1);
}

function get_string_between($string, $start, $end)
{
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function blog_load_next_function($attr)
{


    $categoryid = "";
    $posttype = "";
    $excludeids;
    if (!empty($attr["categoryid"])) {
        $categoryid = $attr["categoryid"];
    }
    if (!empty($attr["posttype"])) {
        $posttype = $attr["posttype"];
    }
    if (!empty($attr["exclude"])) {
        $excludeids = $attr["exclude"];
        $excludeids = explode(',', $excludeids);
    }

    $recent_posts;
    //var_dump($excludeids);

    if (!empty($categoryid)) {

        $recent_posts = wp_get_recent_posts(array(
            'numberposts' => 1, // Number of recent posts thumbnails to display
            'orderby'           => 'date',
            'order'             => 'desc',
            'post_status' => 'publish', // Show only the published posts
            'post_type' => $posttype,
            'category'         => $categoryid,
            'exclude' => $excludeids,
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => 'b2b_content',
                    'value' => '1',
                    'compare' => '!='
                ),
                array(
                    'key' => 'b2b_content',
                    'compare' => 'NOT EXISTS',
                ),
            )
        ));
    } else {

        $recent_posts = wp_get_recent_posts(array(
            'numberposts' => 1, // Number of recent posts thumbnails to display
            'orderby'           => 'date',
            'order'             => 'desc',
            //'category__not_in' => get_terms('category', array(
            //'fields' => 'ids'
            //)),
            'post_type' => $posttype,
            'post_status' => 'publish', // Show only the published posts
            'exclude' => $excludeids,
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => 'b2b_content',
                    'value' => '1',
                    'compare' => '!='
                ),
                array(
                    'key' => 'b2b_content',
                    'compare' => 'NOT EXISTS',
                ),
            )
        ));
    }




    $rtn = '';

    $cur_id = 0;

    $ex_list = $attr["exclude"];


    foreach ($recent_posts as $post) :

        $cur_id = $post['ID'];

        $ex_list .= "," . $cur_id;

        if (!has_post_thumbnail($post['ID'])) {
            $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center;"';
        } else {
            $style = 'style="';
            //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
            $iUrl = str_replace("//theribbonbox.viltac.com/", "//www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], 'full'));
            $style .= $iUrl;
            $style .= ')background-size:cover; background-position:center;"';;
        }

        $categories = get_the_category($post["ID"]);
        $currentcat = $categories[0]->cat_ID;
        $currentcatname = $categories[0]->cat_name;
        $currentcatslug = $categories[0]->slug;

        $cat_p = get_ancestors($categories[0]->term_id, 'category');

        $termIdVal = 'term_' . $currentcat;

        if (count($cat_p) > 0) {
            $termIdVal = 'term_' . $cat_p[0];
        }


        $bcolour = "#F77D66";

        if (!empty(get_field("category_colour", $termIdVal))) {
            $bcolour = get_field("category_colour", $termIdVal);
        }

        $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
        $addBorder = 'border-top: 5px solid ' . $bcolour . ';';

        $author = "";
        $author_id = $post['post_author'];
        //if (get_post_type( get_the_ID() ) == 'post'){
        $author = get_the_author_meta('display_name', $author_id) . "&nbsp;&nbsp;|&nbsp;&nbsp;";
        //}

        if (get_post_type($post["ID"]) == 'videos') {
            $article_author = get_field("article_author", $post["ID"]);
            if (!empty($article_author)) {
                $author = "" . $article_author . "&nbsp;&nbsp;|&nbsp;&nbsp; ";
            }

            $guest_name = get_field("guest_name", $post["ID"]);
            if (!empty($guest_name)) {
                $author .= "FEATURING " . $guest_name . "&nbsp;&nbsp;|&nbsp;&nbsp;";
            }
        }

        $site_url = get_site_url();
        $post_url = get_permalink($post['ID']);

        $new_post_url = str_replace($site_url, "", $post_url);

        $post_id = $post['ID'];
        $queried_post = get_post($post_id);
        //$content = $queried_post->post_content;
        //$content = apply_filters('wpautop', $content);
        //$content = str_replace(']]>', ']]>', $content);

        $content = $queried_post->post_content;

        // $tags = get_the_tags($post_id);
        // if (is_array($tags)) {
        //     foreach($tags as $tag) {
        //         $tag_link = '<span>Tags: <a href="/tag/'.$tag->slug.'" rel="tag">'.$tag->name.'</a></span>';
        //     }
        // }

        $separate_meta = __(', ');
        $tags_links = get_the_tag_list('', $separate_meta, '', $post_id);

        if (get_post_type($post_id) != 'podcasts') {
            $content .= 'Tags:: ' . $tags_links ?? '';
        }

        $content = apply_filters('the_content', $content);
        //echo $content;

        add_filter('the_content', 'my_content_filter');

        $rtn .= '
            <div class="tpl-53 blog-top-ban blog-top-ban-main-content blog-postitem" data-posturl="' . $new_post_url . '">
                <div class="blog-l-img" ' . $style . '>
                    <img src="' . $iUrl . '">
                </div>
                <div class="blog-l-text-out" ' . $border . '>
                    ' . ($featured_cur ?? '') . '
                    <div class="blog-l-text blog-p-text" >
                        <header>
                            <h3>' . $currentcatname . '</h3>
                            <h1>' . get_the_title($post['ID']) . '</h1>
                            <p>' . ($text ?? '') . '</p>
                            <h4>' . $author . get_the_date('j M Y', $post['ID']) . '</h4>
                            <div class="detail-page-socials">
                                ' . create_item_socials(get_permalink($post['ID']), get_the_title()) . '
                            </div>
                        </header>
                        <hr class="hr-post">
                        <div class="post-main-content">';
        //$rtn .= '<h3>' .get_permalink($post['ID']). ' - '. $site_url.'</h3>';
        WPBMap::addAllMappedShortcodes();



        //[vc_video link=”https://youtu.be/1GfPpnWUDT8″]
        $rtn .= '<div class="post-main-content-nonshort">';
        if (strpos($content,  "[vc_video link=") == true) {

            $parsed = get_string_between($content, '[vc_video link=', ']');

            $vowels = array('”', '"', '&ab_channel=TheRibbonBox', 'amp;ab_channel=TheRibbonBox', 'https://m.youtube.com/watch?v=', '&amp;feature=youtu.be', '#8221;', '″', '#8243;', '&', 'https://youtu.be/', 'https://www.youtube.com/watch?v=');
            $str2 = str_replace($vowels, "", $parsed);
            //$str2 = $parsed;

            $content = replace_between($content, '[vc_video link=', ']', '<iframe style="width:100%; height:394px; margin-bottom:35px;" src="https://www.youtube.com/embed/' . $str2 . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen=""></iframe>');

            //$rtn .= '<h1>...yes...('.$str2.')</h1>';
        } else {
            //$rtn .= '<h1>...no...</h1>';
        }

        //$rtn .= '<div class="post-main-content-nonshort">' . $content;
        //$rtn .= '</div>';


        $rtn .= do_shortcode($content);
        $rtn .= '</div>';

        $rtn .= '';
        $rtn .= '<div class="post-sub"><h3>Want to receive more great articles like this every day? Subscribe to our mailing list</h3><a href="/subscribe" class="sub-pop-btn">SUBSCRIBE</a></div>';
        $rtn .= '</div>' . get_the_breadcrumb_function($new_post_url, get_the_title($post['ID'])) . '</div></div>';

    endforeach;
    wp_reset_query();

    if (count($recent_posts)) {
        $rtn .= do_shortcode("[display_followus]");

        $rtn .= '<div class="loadingnextOuter"><a id="loadNext" class="loadmore" data-posttype="' . $posttype . '" data-categoryid="' . $categoryid . '" data-exclude="' . $ex_list . '"></a></div>';

        return $rtn;
    }
}

add_shortcode('blog_load_next', 'blog_load_next_function');



function category_list_function($attr)
{

    $cPage = "";

    if (!empty($attr["page"])) {
        $cPage = $attr["page"];
    }

    $cat_args = array(
        'orderby' => 'name',
        'order' => 'ASC',
        'parent'   => 0,
        'hide_empty' => 0,
        'meta_query' => array(
            array(
                'key'     => 'page_category',
                'value'   =>  'NULL',
                'compare' => '!='
            )
        ),
        'post_status' => 'publish',
    );

    $categories = get_categories($cat_args);

    $cnt = 0;

    $rtn = "";

    if ($cPage == "experts") {
        $rtn .= '<div class="category-outer"><h2>Explore Experts</h2><div class="category-entry">';
    } else if ($cPage == "videos") {
        $rtn .= '<div class="category-outer"><h2>Explore Videos</h2><div class="category-entry">';
    } else if ($cPage == "podcasts") {
        $rtn .= '<div class="category-outer"><h2>Explore Podcasts</h2><div class="category-entry">';
    } else {
        $rtn .= '<div class="category-outer"><h2>Explore By</h2><div class="category-entry">';
    }



    foreach ($categories as $category) :

        $bcolour = "#F77D66";

        $termIdVal = 'term_' . $category->term_id;

        if (!empty(get_field("category_colour", $termIdVal))) {
            $bcolour = get_field("category_colour", $termIdVal);
        }

        if (!empty(get_field("page_category", $termIdVal))) {
            $pageId = get_field("page_category", $termIdVal);
        }

        $hexRGB = $bcolour;
        $ad = "";
        if ($bcolour != "#034146") {
            $ad = '';
            $addd = "";
            //$ad = "bright color";
        } else {
            //$ad = "dark color";

            $ad = 'class="light-col"';
        }

        $background = 'style="background:' . $bcolour . ';"';

        $socials = '';

        $pageId = get_field("page_category", $termIdVal);

        $category_description_new = get_field("category_description_new", $termIdVal);

        $page = get_post($pageId[0]);
        $page_title = $page->post_title;
        //echo $excerpt;

        $style = "";

        if (empty(get_field("category_image", $termIdVal))) {
            //echo "<p class="post-image"><img src='/wp-content/themes/lighttheme/images/logo-bl.png' />";
            //$style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:contain; background-position:center;"';
        } else {

            $image = get_field("category_image", $termIdVal);
            $size = 'large';
            $img_url = $image['sizes'][$size];


            $style = 'style="';
            $style .= $img_url;
            $style .= ' background-size:cover; background-position:center;"';;
        }

        $rtn .= '<div class="category-summary">';
        //$rtn .= '<div '.$style.'>';
        $rtn .= '<div>';
        if ($cPage != "experts" && !empty($category_description_new)) {
            $rtn .= '<div class="ex-car-pop">';
            $rtn .= '<div class="ex-car-pop-inner">';
            $rtn .= '<div class="category-text" ' . $background . '>';
            $rtn .= '<div class="category-inner">';
            $rtn .= '<h2 ' . $ad . '>' . $page_title . '</h2>';
            $rtn .= '<div ' . $ad . '>';
            //$rtn .= '<span class="ex-car-pop-inner-close">X</span>';
            $rtn .= '</div>';
            $rtn .= '</div>';
            $rtn .= '</div>';
            $rtn .= '<div class="category-inner-pop-text">';
            $rtn .= $category_description_new;
            if ($cPage == "experts") {
                $rtn .= '<a href="' . get_permalink($pageId[1]) . '" title="Read more about ' . $post['post_title'] . '...">';
                $rtn .= '<h3 ' . $ad . '>View ' . $page_title . ' Experts</h3>';
            } else if ($cPage == "videos") {
                $rtn .= '<a href="' . get_permalink($pageId[2]) . '" title="Read more about ' . $post['post_title'] . '...">';
                $rtn .= '<h3 ' . $ad . '>View ' . $page_title . ' Videos</h3>';
            } else if ($cPage == "podcasts") {
                $rtn .= '<a href="' . get_permalink($pageId[3]) . '" title="Read more about ' . $post['post_title'] . '...">';
                $rtn .= '<h3 ' . $ad . '>View ' . $page_title . ' Podcasts</h3>';
            } else {
                $rtn .= '<a href="' . get_permalink($pageId[0]) . '" title="Read more about ' . $post['post_title'] . '...">';
                $rtn .= '<h3 ' . $ad . '>View ' . $page_title . ' Content</h3>';
            }
            //$rtn .= '<a href="'.get_permalink($pageId[0]).'" title="Read more about '. $post['post_title'] .'...">';

            $rtn .= '</a>';
            $rtn .= '</div>';
            $rtn .= '</div>';
            $rtn .= '</div>';
        }
        if ($cPage == "experts") {
            $rtn .= '<a href="' . get_permalink($pageId[1]) . '" title="Read more about ' . $post['post_title'] . '...">';
        } else if ($cPage == "videos") {
            $rtn .= '<a href="' . get_permalink($pageId[2]) . '" title="Read more about ' . $post['post_title'] . '...">';
        } else if ($cPage == "podcasts") {
            $rtn .= '<a href="' . get_permalink($pageId[3]) . '" title="Read more about ' . $post['post_title'] . '...">';
        } else {
            $rtn .= '<a href="' . get_permalink($pageId[0]) . '" title="Read more about ' . $post['post_title'] . '...">';
        }
        //$rtn .= '<img src="/wp-content/themes/lighttheme/images/a_squ_trans.png">';

        $rtn .= '<img src="' . $img_url . '">';

        $rtn .= '</a>';
        $rtn .= '</div>';


        $rtn .= '<div class="category-text" ' . $background . '>';
        if ($cPage == "experts") {
            $rtn .= '<a href="' . get_permalink($pageId[1]) . '" title="Read more about ' . $page_title . '...">'; // $post['post_title']
        } else if ($cPage == "videos") {
            $rtn .= '<a href="' . get_permalink($pageId[2]) . '" title="Read more about ' . $page_title . '...">'; // $post['post_title']
        } else if ($cPage == "podcasts") {
            $rtn .= '<a href="' . get_permalink($pageId[3]) . '" title="Read more about ' . $page_title . '...">'; // $post['post_title']
        } else {
            $rtn .= '<a href="' . get_permalink($pageId[0]) . '" title="Read more about ' . $page_title . '...">'; // $post['post_title']
        }
        $rtn .= '<div class="category-inner">';
        $rtn .= '<h2 ' . $ad . '>' . $page_title . '</h2>';


        if ($cPage == "experts") {
            $rtn .= '<h3 ' . $ad . '>Discover ' . $page_title . ' Experts</h3>';
        } else if ($cPage == "videos") {
            $rtn .= '<h3 ' . $ad . '>Discover ' . $page_title . ' Videos</h3>';
        } else if ($cPage == "podcasts") {
            $rtn .= '<h3 ' . $ad . '>Discover ' . $page_title . ' Podcasts</h3>';
        } else {
            $rtn .= '<h3 ' . $ad . '>View Content</h3>';
        }

        $rtn .= '</a>';

        //$rtn .= category_description($category->term_id);



        if (!empty($speciality)) {
            $rtn .= '<p class="speciality">' . $speciality . '</p>';
        }
        if (!empty($position)) {
            $rtn .= '<p class="position">' . $position . '</p>';
        }
        if (!empty($ward)) {
            $rtn .= '<p class="ward">' . $ward . '</p>';
        }
        if (!empty($socials)) {
            $rtn .= '<div class="people-socials">';
            $rtn .= $socials;
            $rtn .= '</div>';
        }
        //$rtn .= '<h3>'.'Category'.'</h3>';
        //$rtn .= '<a class="button-expert" href="'.get_permalink($post['ID']).'" title="Read more about '.$post['post_title'].  '...">VIEW EXPERT PROFILE</a></div>';
        $rtn .= '</div>';

        $rtn .= '</div></div>';

    endforeach;
    wp_reset_query();


    $rtn .= '</div></div>';
    $rtn .= "<script type='text/javascript'>
        $(document).ready(function(){

$('.category-summary .category-inner1').hover(function(e){
    if ($('.category-outer .slick-list > .ex-car-pop-inner').length > 0){

        
    } else{
        $('.category-outer .slick-list').append($(this).find('.ex-car-pop').html());
    }

    
});

$(document).on('click','.ex-car-pop-inner-close', function(e){
    e.preventDefault();
    $('.category-outer .slick-list > .ex-car-pop-inner').remove();
});


if ($('.main-content-outer').length > 0){



  $('.category-entry').slick({
    dots: true,
   centerMode: true,
  centerPadding: '60px',
  slidesToShow: 3,
  infinite: true,
  autoplay: true,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 900,
      settings: {
        
        centerMode: true,
        centerPadding: '150px',
        slidesToShow: 1
      }
    },
    {
      breakpoint: 600,
      settings: {
        
        centerMode: true,
        centerPadding: '1px',
        slidesToShow: 1
      }
    }
  ]
  });
}
});
    </script>";

    return $rtn;
}
add_shortcode('category_list', 'category_list_function');

function ad_list_function($attr)
{
    ob_start();
    global $theme_option_page;
    $top_banner_ad = get_field('top_banner_ad', $theme_option_page);
    $ads = get_posts(array(
        'post_type' => 'ads',
        'numberposts' => 1, // Number of recent posts thumbnails to display
        'orderby' => 'rand',
        'post_status' => 'publish',
        'fields' => 'ids',
        'meta_query'  => array(
            array(
                'key'     => 'ad_type',   // The custom field key
                'value'   => 'ad_strip',  // The value to exclude
                'compare' => '!='         // The comparison operator (NOT EQUAL TO)
            )
        )
    ));
    ?>
    <?php if ($top_banner_ad) { ?>
        <div class="ads ads--v2 py-4">
            <div class="container">
                <a href="<?= get_field('ad_url', $ads[0]) ?>" target="_blank">
                    <div class="d-none d-sm-block">
                        <?= wp_get_attachment_image(get_field('ad_image', $ads[0]), 'full') ?>
                    </div>
                    <div class="d-block d-sm-none">
                        <?= wp_get_attachment_image(get_field('ad_image_mobile', $ads[0]), 'full') ?>
                    </div>
                </a>
            </div>
        </div>
    <?php } ?>
<?php
    return ob_get_clean();
}
add_shortcode('ad_list', 'ad_list_function');


function giveaway_list_function($attr)
{
    $cPage = "";
    if (!empty($attr["page"])) {
        $cPage = $attr["page"];
    }
    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'giveaway-items',
        'numberposts' => 7, // Number of recent posts thumbnails to display
        'orderby' => 'date',
        'order' => 'desc',
        'post_status' => 'publish' // Show only the published posts
    ));

    $cnt = 0;

    $rtn = "";


    if ($cPage == "") {
        $rtn .= '<div class="expert-outer"><h2>Giveaways</h2><div class="expert-entry">';
    } else {
        $rtn .= '<div class="expert-outer"><div class="expert-entry giveaway-entry">';
    }


    foreach ($recent_posts as $post) :
        $p_img = get_the_post_thumbnail_url($post['ID'], 'thumbnail');
        $phone = get_field("phone", $post['ID']);
        $email = get_field("email", $post['ID']);
        $facebook = get_field("facebook", $post['ID']);
        $twitter = get_field("twitter", $post['ID']);
        $linkedin = get_field("linkedin", $post['ID']);
        $ward = get_field("ward", $post['ID']);
        $position = get_field("position", $post['ID']);
        $speciality = get_field("speciality", $post['ID']);


        $categories = get_the_category($post["ID"]);
        $currentcat = $categories[0]->cat_ID;
        $currentcatname = $categories[0]->cat_name;
        $currentcatslug = $categories[0]->slug;

        $cat_p = get_ancestors($categories[0]->term_id, 'category');

        $termIdVal = 'term_' . $currentcat;

        if (count($cat_p) > 0) {
            $termIdVal = 'term_' . $cat_p[0];
        }


        $bcolour = "#F77D66";

        if (!empty(get_field("category_colour", $termIdVal))) {
            $bcolour = get_field("category_colour", $termIdVal);
        }

        $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
        $addBorder = 'border-top: 5px solid ' . $bcolour . ';';

        $socials = '';

        if (!empty($phone)) {
            $socials .= '<a href="tel:' . $phone . '"><img src="/wp-content/themes/lighttheme/images/icons/phone.png"></a>';
        }
        if (!empty($email)) {
            $socials .= '<a href="mailto:' . $email . '"><img src="/wp-content/themes/lighttheme/images/icons/email.png"></a>';
        }
        if (!empty($facebook)) {
            $socials .= '<a target="_blank" href="' . $facebook . '"><img src="/wp-content/themes/lighttheme/images/icons/facebook-dark.png"></a>';
        }
        if (!empty($twitter)) {
            $socials .= '<a target="_blank" href="' . $twitter . '"><img src="/wp-content/themes/lighttheme/images/icons/twitter-dark.png"></a>';
        }
        if (!empty($linkedin)) {
            $socials .= '<a target="_blank" href="' . $linkedin . '"><img src="/wp-content/themes/lighttheme/images/icons/linkedin-dark.png"></a>';
        }

        $style = "";


        if (!has_post_thumbnail($post['ID'])) {
            $style = 'style="';
            //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
            $iUrl = get_field("post_large_image", $post['ID']);
            $style .= $iUrl;
            $style .= '); background-size:cover; background-position:center;  ' . $addBorder . '"';
        } else {
            $style = 'style="';
            //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
            $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], 'full'));
            $style .= $iUrl;
            $style .= '); background-size:cover; background-position:center;  ' . $addBorder . '"';
        }

        $ex_txt = "";

        $select_competition_date = get_field("select_competition_date", $post["ID"]);

        if (!empty($select_competition_date)):
            $today = date("Y-m-d");
            $date = $select_competition_date;
            $time = strtotime($date);
            $newformat = date('Y-m-d', $time);
            $displayformat = date('d-m-Y', $time);
            $displayformatB = date('j M Y', $time);


            $date_txt = "Giveaway Closed: ";

            $live_post = false;

            if ($newformat > $today) {
                $date_txt = "Giveaway Open: ";
                $live_post = true;
            }

            if (!empty($offer_expired_text)):
                $date_txt = $offer_expired_text . " ";
            endif;


            //$ex_txt = '<h3 class="date-giveaways">'.$date_txt.$displayformat . '</h3>';ENTRIES CLOSE
            $ex_txt = '<h3 class="date-giveaways">ENTRIES CLOSE ' . $displayformatB . '</h3>';
        endif;

        include get_template_directory() . '/components/posts/giveaway-carousel-item.php';

        // $rtn .= '
        //     <div class="expert-summary test">
        //         <div '.$style.'>
        //             <a href="'.get_permalink($post['ID']).'" title="Read more about '. $post['post_title'] .'...">
        //                 <img src="/wp-content/themes/lighttheme/images/a_squ_trans.png">
        //             </a>
        //         </div>
        //         <div class="expert-text">
        //             <div class="expert-inner">
        //                 <h2 style="margin-bottom: 0.5em;">'.$post['post_title'].'</h2>';

        if (!empty($speciality)) {
            $rtn .= '<p class="speciality">' . $speciality . '</p>';
        }
        if (!empty($position)) {
            $rtn .= '<p class="position">' . $position . '</p>';
        }
        if (!empty($ward)) {
            $rtn .= '<p class="ward">' . $ward . '</p>';
        }
        if (!empty($socials)) {
            $rtn .= '<div class="people-socials">';
            $rtn .= $socials;
            $rtn .= '</div>';
        }
        $rtn .= '<h3 class="category-giveaways">' . $currentcatname . '</h3>';
        $rtn .= $ex_txt;
        //$rtn .= '<a class="button-expert" href="'.get_permalink($post['ID']).'" title="Read more about '.$post['post_title'].  '...">VIEW EXPERT PROFILE</a></div>';
        //$rtn .= '<form class="button-form"><input type="email" placeholder="ENTER EMAIL"></input><button value="">-></button></form></div>';
        $rtn .= '<a class="button-expert" href="' . get_permalink($post['ID']) . '" title="Read more about ' . $post['post_title'] .  '...">ENTER NOW</a></div>';
        $rtn .= '</div></div>';

    endforeach;
    wp_reset_query();


    $rtn .= '</div></div>';
    $rtn .= "<script type='text/javascript'>
        $(document).ready(function(){

if ($('.main-content-outer').length > 0){



  $('.giveaway-entry').slick({
   centerMode: true,
  centerPadding: '60px',
  slidesToShow: 3,
  autoplay: true,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 900,
      settings: {
        
        centerMode: true,
        centerPadding: '150px',
        slidesToShow: 1
      }
    },
    {
      breakpoint: 600,
      settings: {
        
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
  });
}
});
    </script>";

    return $rtn;
}
add_shortcode('giveaway_list', 'giveaway_list_function');


function vid_pod_list_function($attr)
{

    $categoryid;

    if (!empty($attr["categoryid"])) {
        $categoryid = $attr["categoryid"];
    }
    if (!empty($attr["post_type"])) {
        $post_type = $attr["post_type"];
    }

    $post_types = explode('/', $post_type);

    $recent_posts;

    if (!empty($categoryid)) {

        $recent_posts = wp_get_recent_posts(array(
            'post_type' => $post_types,
            'numberposts' => 20, // Number of recent posts thumbnails to display
            'orderby' => 'date',
            'order' => 'desc',
            'post_status' => 'publish', // Show only the published posts
            'category'         => $categoryid,
        ));
    } else {

        $recent_posts = wp_get_recent_posts(array(
            'post_type' => $post_types,
            'numberposts' => 20, // Number of recent posts thumbnails to display
            'orderby' => 'date',
            'order' => 'desc',
            'post_status' => 'publish' // Show only the published posts
        ));
    }





    $cnt = 0;

    $rtn = "";

    $isPage = false;

    if (!empty($attr["page"])) {
        $isPage = true;
    }

    if ($isPage) {
        $rtn .= '<div class="expert-outer"><div class="expert-entry giveaway-entry">';
    } else {
        $rtn .= '<div class="expert-outer"><h2>Wellbeing & Fertility Experts</h2><div class="expert-entry giveaway-entry">';
    }



    foreach ($recent_posts as $post) :
        $p_img = get_the_post_thumbnail_url($post['ID'], 'thumbnail');
        $phone = get_field("phone", $post['ID']);
        $email = get_field("email", $post['ID']);
        $facebook = get_field("facebook", $post['ID']);
        $twitter = get_field("twitter", $post['ID']);
        $linkedin = get_field("linkedin", $post['ID']);
        $ward = get_field("ward", $post['ID']);
        $position = get_field("position", $post['ID']);
        $speciality = get_field("speciality", $post['ID']);

        $categories = get_the_category($post["ID"]);
        $currentcat = $categories[0]->cat_ID;
        $currentcatname = $categories[0]->cat_name;
        $currentcatslug = $categories[0]->slug;

        $cat_p = get_ancestors($categories[0]->term_id, 'category');

        if (!empty($categoryid)) {
            $term1 = get_term_by('id', $categoryid, 'category');
            $currentcat = $categoryid;
            $currentcatname = $term1->name;
            $currentcatslug = $term1->slug;
            //$termIdVal = 'term_' . $categoryid;
            //$categories = get_category($termIdVal);
            $cat_p = get_ancestors($categoryid, 'category');
        }

        $termIdVal = 'term_' . $currentcat;

        if (count($cat_p) > 0) {
            $termIdVal = 'term_' . $cat_p[0];
        }


        $bcolour = "#F77D66";

        if (!empty(get_field("category_colour", $termIdVal))) {
            $bcolour = get_field("category_colour", $termIdVal);
        }

        $border = 'style="border-top: 5px solid ' . $bcolour . ';"';
        $addBorder = 'border-top: 5px solid ' . $bcolour . ';';

        ////



        $socials = '';

        if (!empty($phone)) {
            $socials .= '<a href="tel:' . $phone . '"><img src="/wp-content/themes/lighttheme/images/icons/phone.png"></a>';
        }
        if (!empty($email)) {
            $socials .= '<a href="mailto:' . $email . '"><img src="/wp-content/themes/lighttheme/images/icons/email.png"></a>';
        }
        if (!empty($facebook)) {
            $socials .= '<a target="_blank" href="' . $facebook . '"><img src="/wp-content/themes/lighttheme/images/icons/facebook-dark.png"></a>';
        }
        if (!empty($twitter)) {
            $socials .= '<a target="_blank" href="' . $twitter . '"><img src="/wp-content/themes/lighttheme/images/icons/twitter-dark.png"></a>';
        }
        if (!empty($linkedin)) {
            $socials .= '<a target="_blank" href="' . $linkedin . '"><img src="/wp-content/themes/lighttheme/images/icons/linkedin-dark.png"></a>';
        }

        $style = "";

        if (!has_post_thumbnail($post['ID'])) {
            $style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:cover; background-position:center; position:relative; ' . $addBorder . '"';
        } else {
            if (!empty(get_field("post_large_image", $post['ID']))) {
                $style = 'style="background:url(';
                //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                $iUrl = get_field("post_large_image", $post['ID']);
                $style .= $iUrl;
                $style .= '); background-size:cover; background-position:center; position:relative; ' . $addBorder . '"';
            } else {
                $style = 'style="background:url(';
                //$style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", get_the_post_thumbnail_url($post['ID'], 'full'));
                $style .= $iUrl;
                $style .= '); background-size:cover; background-position:center; position:relative; ' . $addBorder . '"';
            }
        }

        $ext = '';

        $cur_post_type = get_post_type($post["ID"]);

        if ($cur_post_type == "videos") {
            $ext = '<img src="/wp-content/themes/lighttheme/images/vid-btn.png" class="vid-btn">';
        }
        if ($cur_post_type == "podcasts") {
            $ext = '<img src="/wp-content/themes/lighttheme/images/pod-btn.png" class="vid-btn">';
        }

        $rtn .=
            '<div class="expert-summary tpl-es">'
            . '<div ' . $style . '>' . $ext
            . '<a href="' . get_permalink($post['ID']) . '" title="Read more about ' . $post['post_title'] . '...">'
            . '<img src="/wp-content/themes/lighttheme/images/a_squ_trans.png">'
            . '</a>'
            . '</div>';

        $rtn .= '<div class="expert-text">';
        $rtn .= '<div class="expert-inner">';
        if ($isPage) {
            $rtn .= '<h3>' . $currentcatname . '</h3>';
        }
        $rtn .= '<h2>' . $post['post_title'] . '</h2>';
        if (!empty($speciality)) {
            $rtn .= '<p class="speciality">' . $speciality . '</p>';
        }
        if (!empty(get_the_excerpt($post["ID"]))) {
            $rtn .= '<p class="post-id">' . get_the_excerpt($post["ID"]) . '</p>';
        }
        if (!empty($position)) {
            $rtn .= '<p class="position">' . $position . '</p>';
        }
        if (!empty($ward)) {
            $rtn .= '<p class="ward">' . $ward . '</p>';
        }
        if (!empty($socials)) {
            $rtn .= '<div class="people-socials">';
            $rtn .= $socials;
            $rtn .= '</div>';
        }
        if (!$isPage) {
            $rtn .= '<h3>' . $currentcatname . '</h3>';
        }
        if ($cur_post_type == "videos") {
            $rtn .= '<a class="button-expert" href="' . get_permalink($post['ID']) . '" title="Read more about ' . $post['post_title'] .  '...">WATCH NOW</a></div>';
        }
        if ($cur_post_type == "podcasts") {
            $rtn .= '<a class="button-expert" href="' . get_permalink($post['ID']) . '" title="Read more about ' . $post['post_title'] .  '...">LISTEN NOW</a></div>';
        }

        $rtn .= '</div></div>';

    endforeach;
    wp_reset_query();


    $rtn .= '</div></div>';

    if ($isPage) {
        $rtn .= "<script type='text/javascript'>
            $(document).ready(function(){

    if ($('.main-content-outer').length > 0){



      $('.giveaway-entry').slick({
       centerMode: true,
      centerPadding: '0',
      slidesToShow: 3,
      autoplay: true,
      autoplaySpeed: 2000,
      responsive: [
        {
          breakpoint: 900,
          settings: {
            centerMode: true,
            centerPadding: '1500px',
            slidesToShow: 3
          }
        },
        {
          breakpoint: 600,
          settings: {
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 1
          }
        }
      ]
      });
    }
    });
        </script>";
    } else {

        $rtn .= "<script type='text/javascript'>
            $(document).ready(function(){

    if ($('.main-content-outer').length > 0){



      $('.giveaway-entry').slick({
       centerMode: true,
      centerPadding: '60px',
      slidesToShow: 3,
      autoplay: true,
  autoplaySpeed: 2000,
      responsive: [
    {
      breakpoint: 900,
      settings: {
        
        centerMode: true,
        centerPadding: '150px',
        slidesToShow: 1
      }
    },
    {
      breakpoint: 600,
      settings: {
        
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
      ]
      });
    }
    });
        </script>";
    }

    return $rtn;
}
add_shortcode('vid_pod_list', 'vid_pod_list_function');

include __DIR__ . '/../shortcodes/expert-list.php';


function hp_tile_large_function($attr)
{
    $nav = array(
        'post_type' => 'page',
        'orderby' => 'menu_order',
        'numberposts' => 100000,
        'order' => 'ASC',
        'post__in' => array(29)
        //'post_parent' => $post->ID
    );

    $child_pages = get_posts($nav);



    foreach ($child_pages as $postItm) :

        $html = $postItm->post_content;

        $html = html_entity_decode(strip_tags($html));

        $strArray = explode('.', $html);

        $paragraph = substr($html, 0, 250);

        echo '<div class="home-topics-outer" style="background:url(' . get_the_post_thumbnail_url($postItm->ID) . '); background-position:center; background-size: cover;">
    <div class="home-topics-inner">
    <div class="home-topics-txt">
       <h2>' . $postItm->post_excerpt . '</h2>
       <p><a class="button" href="' . get_permalink($postItm->ID) . '">Volutnteer Now</a></p>
    </div>
    </div>
</div>';

    endforeach;
}

add_shortcode('hp_tile_large', 'hp_tile_large_function');

function hp_tile_list_function($attr)
{
    $nav = array(
        'post_type' => 'page',
        'orderby' => 'menu_order',
        'numberposts' => 100000,
        'order' => 'ASC',
        'post__in' => array(15, 13, 17)
        //'post_parent' => $post->ID
    );

    $child_pages = get_posts($nav);

    echo '<div class="hp-mx-wd">';

    foreach ($child_pages as $postItm) :
        echo '<a href="' . get_permalink($postItm->ID) . '" class="oth-strip-itm" style="background:url(' . get_the_post_thumbnail_url($postItm->ID) . '); background-size: cover; background-position: center;"><img src="/wp-content/themes/lighttheme/images/rec_trans.png"><span class="oth-tl-over"></span><span class="oth-strip-in"><h3>' . $postItm->post_title . '</h3><p>' . $postItm->post_excerpt . '</p><!--<span class="oth-strip-lnk">Read More</span></span>--></a>';

    endforeach;

    echo '</div>';
}

add_shortcode('hp_tile_list', 'hp_tile_list_function');

function related_portfolio_filter_function($attr)
{

    $rtn = "";


    $term_id = 0;

    $recent_posts;

    if (!empty($attr["category"])) {
        $term = get_term_by('name', $attr["category"], 'portfolio_categories');
        $term_id = array($attr["category"]);

        //echo $term_id;

        $recent_posts = wp_get_recent_posts(array(
            'post_type' => 'portfolio_list',
            'numberposts' => 4, // Number of recent posts thumbnails to display
            'orderby'           => 'rand',
            //'order'             => 'desc',
            'tax_query' => array(
                array(
                    'taxonomy' => 'portfolio_categories',
                    'field' => 'term_id',
                    'terms' => $term_id,
                )
            ),
            'post_status' => 'publish', // Show only the published posts
            'exclude' => $attr["current_id"]
        ));
    } else {
        $recent_posts = wp_get_recent_posts(array(
            'post_type' => 'portfolio_list',
            'numberposts' => 100000, // Number of recent posts thumbnails to display
            'orderby'           => 'date',
            'order'             => 'desc',
            'post_status' => 'publish' // Show only the published posts
        ));
    }


    $cnt = 0;

    $rtn .= '<div class="awards-cta-inner1 btn-download1">';

    foreach ($recent_posts as $post) :

        $port_logo = get_field("portfolio_logo", $post['ID']);

        $term = get_the_terms($post['ID'], 'portfolio_categories');
        $names  = wp_list_pluck($term, 'name');
        $output = "";
        foreach ($names as $name) {
            $output .= '<span class="cat-tag">' . $name . '</span>';
        }
        //$output = implode( ', ', $names );


        //$rtn .= '<li style="background:url('.$port_logo.'); background-position:center; background-size:cover;"><a href="'.get_permalink($post['ID']).'"><img src="/wp-content/themes/lighttheme/images/rectangle_trans.png">';
        //$rtn .= '</a></li>';

        $rtn .= '<a href="' . get_permalink($post['ID']) . '" title="View ' . $post['post_title'] . ' Portfolio"><table class="dl-table"><tr><td rowspan="2"><div class="dl-img" style="background:url(' . $port_logo . ');"><img src="/wp-content/themes/lighttheme/images/rectangle_trans.png"></div></td><td>' . $post['post_title'] . '</td></tr><tr><td style="text-align:right;">' . $output . '</td></table><div class="download-overlay"></div></a>';


    endforeach;
    wp_reset_query();

    $rtn .= '</div>';

    return $rtn;
}

add_shortcode('related_portfolio_filter_list', 'related_portfolio_filter_function');

function portfolio_filter_function($attr)
{

    $rtn = "";


    $term_id = 0;

    $recent_posts;

    if (!empty($attr["category"])) {
        $term = get_term_by('name', $attr["category"], 'portfolio_categories');
        $term_id = $term->term_id;

        $recent_posts = wp_get_recent_posts(array(
            'post_type' => 'portfolio_list',
            'numberposts' => 100000, // Number of recent posts thumbnails to display
            'orderby'           => 'date',
            'order'             => 'desc',
            'tax_query' => array(
                array(
                    'taxonomy' => 'portfolio_categories',
                    'field' => 'term_id',
                    'terms' => $term_id,
                )
            ),
            'post_status' => 'publish' // Show only the published posts
        ));
    } else {
        $recent_posts = wp_get_recent_posts(array(
            'post_type' => 'portfolio_list',
            'numberposts' => 100000, // Number of recent posts thumbnails to display
            'orderby'           => 'date',
            'order'             => 'desc',
            'post_status' => 'publish' // Show only the published posts
        ));
    }


    $cnt = 0;

    $rtn .= '<div class="portfolio-outer portfolio-outer-pc"><ul>';

    foreach ($recent_posts as $post) :



        $port_logo = get_field("portfolio_logo", $post['ID']);

        $rtn .= '<li style="background:url(' . $port_logo . '); background-position:center; background-size:cover;"><a href="' . get_permalink($post['ID']) . '"><img src="/wp-content/themes/lighttheme/images/rectangle_trans.png">';
        $rtn .= '</a></li>';


    endforeach;
    wp_reset_query();

    $rtn .= '</ul></div>';

    return $rtn;
}

add_shortcode('portfolio_filter_list', 'portfolio_filter_function');

function hp_portfolio_function($limit)
{

    $rtn = "";

    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'portfolio_list',
        'numberposts' => 6, // Number of recent posts thumbnails to display
        'orderby'           => 'date',
        'order'             => 'desc',
        'meta_query' => array(
            array(
                'key'     => 'featured_portfolio',
                'value'   => 'Yes',
                'compare' => 'LIKE'
            )
        ),
        'post_status' => 'publish' // Show only the published posts
    ));

    $cnt = 0;

    $rtn .= '<div class="portfolio-outer"><ul>';

    foreach ($recent_posts as $post) :

        $port_logo = get_field("portfolio_logo", $post['ID']);

        $rtn .= '<li style="background:url(' . $port_logo . '); background-position:center; background-size:cover;"><a href="' . get_permalink($post['ID']) . '"><img src="/wp-content/themes/lighttheme/images/rectangle_trans.png">';
        $rtn .= '</a></li>';


    endforeach;
    wp_reset_query();

    $rtn .= '</ul></div>';

    return $rtn;
}

add_shortcode('cat_list_events', 'cat_list_events_function');

function cat_list_events_function()
{
    $rtn = "";

    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'events-pt',
        'numberposts' => 10000000, // Number of recent posts thumbnails to display
        'post_status' => 'publish' // Show only the published posts
    ));

    $rtn .= '<div class="other-topics-outer"><div class="hp-cat-outer"><ul>';

    foreach ($recent_posts as $post) :
        $port_logo = get_the_post_thumbnail_url($post['ID'], 'thumbnail');
        $html = $post['post_content'];
        $html = html_entity_decode(strip_tags($html));
        $strArray = explode('.', $html);
        $paragraph = substr($html, 0, 250);

        $trns = "squ_trans.png";

        $rtn .= '<li><h3>Events</h3><a href="' . get_permalink($post['ID']) . '"><div style="background:url(' . $port_logo . '); background-position:center; background-size:cover; position:relative;"><img src="/wp-content/themes/lighttheme/images/' . $trns . '"><span><strong>' . get_the_date('F j, Y', $post["ID"]) . '</strong></span></div>';
        $rtn .= '<div class="hp-cat-txt"><h3>' . $post['post_title'] . '</h3><p>' . $paragraph . '</p></div></a><div class="btn-container"><a href="' . get_permalink($post['ID']) . '" class="hp-vm-btn">Read More</a></div></li>';
    endforeach;
    wp_reset_query();

    $rtn .= '</ul></div></div>';

    return $rtn;
}

add_shortcode('cat_list_research', 'cat_list_research_function');

function cat_list_research_function()
{
    $rtn = "";

    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'research-pt',
        'numberposts' => 10000000, // Number of recent posts thumbnails to display
        'post_status' => 'publish' // Show only the published posts
    ));

    $rtn .= '<div class="other-topics-outer"><div class="hp-cat-outer"><ul>';

    foreach ($recent_posts as $post) :
        $port_logo = get_the_post_thumbnail_url($post['ID'], 'thumbnail');
        $html = $post['post_content'];
        $html = html_entity_decode(strip_tags($html));
        $strArray = explode('.', $html);
        $paragraph = substr($html, 0, 250);

        $trns = "squ_trans.png";

        $rtn .= '<li><h3>Research</h3><a href="' . get_permalink($post['ID']) . '"><div style="background:url(' . $port_logo . '); background-position:center; background-size:cover; position:relative;"><img src="/wp-content/themes/lighttheme/images/' . $trns . '"><span><strong>' . get_the_date('F j, Y', $post["ID"]) . '</strong></span></div>';
        $rtn .= '<div class="hp-cat-txt"><h3>' . $post['post_title'] . '</h3><p>' . $paragraph . '</p></div></a><div class="btn-container"><a href="' . get_permalink($post['ID']) . '" class="hp-vm-btn">Read More</a></div></li>';
    endforeach;
    wp_reset_query();

    $rtn .= '</ul></div></div>';

    return $rtn;
}

add_shortcode('cat_list_programmes', 'cat_list_programmes_function');

function cat_list_programmes_function()
{
    $rtn = "";

    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'programmes-pt',
        'numberposts' => 10000000, // Number of recent posts thumbnails to display
        'post_status' => 'publish' // Show only the published posts
    ));

    $rtn .= '<div class="other-topics-outer"><div class="hp-cat-outer"><ul>';

    foreach ($recent_posts as $post) :
        $port_logo = get_the_post_thumbnail_url($post['ID'], 'thumbnail');
        $html = $post['post_content'];
        $html = html_entity_decode(strip_tags($html));
        $strArray = explode('.', $html);
        $paragraph = substr($html, 0, 250);

        $trns = "squ_trans.png";

        $rtn .= '<li><h3>Programmes</h3><a href="' . get_permalink($post['ID']) . '"><div style="background:url(' . $port_logo . '); background-position:center; background-size:cover; position:relative;"><img src="/wp-content/themes/lighttheme/images/' . $trns . '"><span><strong>' . get_the_date('F j, Y', $post["ID"]) . '</strong></span></div>';
        $rtn .= '<div class="hp-cat-txt"><h3>' . $post['post_title'] . '</h3><p>' . $paragraph . '</p></div></a><div class="btn-container"><a href="' . get_permalink($post['ID']) . '" class="hp-vm-btn">Read More</a></div></li>';
    endforeach;
    wp_reset_query();

    $rtn .= '</ul></div></div>';

    return $rtn;
}

add_shortcode('cat_list_policy', 'cat_list_policy_function');

function cat_list_policy_function()
{
    $rtn = "";

    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'policy-pt',
        'numberposts' => 10000000, // Number of recent posts thumbnails to display
        'post_status' => 'publish' // Show only the published posts
    ));

    $rtn .= '<div class="other-topics-outer"><div class="hp-cat-outer"><ul>';

    foreach ($recent_posts as $post) :
        $port_logo = get_the_post_thumbnail_url($post['ID'], 'thumbnail');
        $html = $post['post_content'];
        $html = html_entity_decode(strip_tags($html));
        $strArray = explode('.', $html);
        $paragraph = substr($html, 0, 250);

        $trns = "squ_trans.png";

        $rtn .= '<li><h3>Policy</h3><a href="' . get_permalink($post['ID']) . '"><div style="background:url(' . $port_logo . '); background-position:center; background-size:cover; position:relative;"><img src="/wp-content/themes/lighttheme/images/' . $trns . '"><span><strong>' . get_the_date('F j, Y', $post["ID"]) . '</strong></span></div>';
        $rtn .= '<div class="hp-cat-txt"><h3>' . $post['post_title'] . '</h3><p>' . $paragraph . '</p></div></a><div class="btn-container"><a href="' . get_permalink($post['ID']) . '" class="hp-vm-btn">Read More</a></div></li>';
    endforeach;
    wp_reset_query();

    $rtn .= '</ul></div></div>';

    return $rtn;
}

add_shortcode('cat_list_press', 'cat_list_press_function');

function cat_list_press_function()
{
    $rtn = "";

    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'post',
        'numberposts' => 10000000, // Number of recent posts thumbnails to display
        'post_status' => 'publish' // Show only the published posts
    ));

    $rtn .= '<div class="other-topics-outer"><div class="hp-cat-outer"><ul>';

    foreach ($recent_posts as $post) :
        $port_logo = get_the_post_thumbnail_url($post['ID'], 'thumbnail');
        $html = $post['post_content'];
        $html = html_entity_decode(strip_tags($html));
        $strArray = explode('.', $html);
        $paragraph = substr($html, 0, 250);

        $trns = "squ_trans.png";

        $rtn .= '<li><h3>Press</h3><a href="' . get_permalink($post['ID']) . '"><div style="background:url(' . $port_logo . '); background-position:center; background-size:cover; position:relative;"><img src="/wp-content/themes/lighttheme/images/' . $trns . '"><span><strong>' . get_the_date('F j, Y', $post["ID"]) . '</strong></span></div>';
        $rtn .= '<div class="hp-cat-txt"><h3>' . $post['post_title'] . '</h3><p>' . $paragraph . '</p></div></a><div class="btn-container"><a href="' . get_permalink($post['ID']) . '" class="hp-vm-btn">Read More</a></div></li>';
    endforeach;
    wp_reset_query();

    $rtn .= '</ul></div></div>';

    return $rtn;
}

add_shortcode('hp_cat_list', 'hp_cat_list_function');

function hp_cat_list_function()
{
    $rtn = "";

    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'events-pt',
        'numberposts' => 1, // Number of recent posts thumbnails to display
        'post_status' => 'publish' // Show only the published posts
    ));

    $rtn .= '<div class="hp-cat-outer"><ul>';

    foreach ($recent_posts as $post) :
        $port_logo = get_the_post_thumbnail_url($post['ID'], 'thumbnail');
        $html = $post['post_content'];
        $html = html_entity_decode(strip_tags($html));
        $strArray = explode('.', $html);
        $paragraph = substr($html, 0, 250);

        $trns = "squ_trans.png";

        $rtn .= '<li><h3>Events</h3><a href="' . get_permalink($post['ID']) . '"><div style="background:url(' . $port_logo . '); background-position:center; background-size:cover; position:relative;"><img src="/wp-content/themes/lighttheme/images/' . $trns . '"><span><strong>' . get_the_date('F j, Y', $post["ID"]) . '</strong></span></div>';
        $rtn .= '<div class="hp-cat-txt"><h3>' . $post['post_title'] . '</h3><p>' . $paragraph . '</p></div></a><div class="btn-container"><a href="/events" class="hp-vm-btn">View All</a></div></li>';
    endforeach;
    wp_reset_query();

    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'research-pt',
        'numberposts' => 1, // Number of recent posts thumbnails to display
        'post_status' => 'publish' // Show only the published posts
    ));

    foreach ($recent_posts as $post) :
        $port_logo = get_the_post_thumbnail_url($post['ID'], 'thumbnail');
        $html = $post['post_content'];
        $html = html_entity_decode(strip_tags($html));
        $strArray = explode('.', $html);
        $paragraph = substr($html, 0, 250);

        $trns = "squ_trans.png";

        $rtn .= '<li><h3>Research</h3><a href="' . get_permalink($post['ID']) . '"><div style="background:url(' . $port_logo . '); background-position:center; background-size:cover; position:relative;"><img src="/wp-content/themes/lighttheme/images/' . $trns . '"><span><strong>' . get_the_date('F j, Y', $post["ID"]) . '</strong></span></div>';
        $rtn .= '<div class="hp-cat-txt"><h3>' . $post['post_title'] . '</h3><p>' . $paragraph . '</p></div></a><div class="btn-container"><a href="/what-we-do/research" class="hp-vm-btn">View All</a></div></li>';
    endforeach;
    wp_reset_query();

    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'programmes-pt',
        'numberposts' => 1, // Number of recent posts thumbnails to display
        'post_status' => 'publish' // Show only the published posts
    ));

    foreach ($recent_posts as $post) :
        $port_logo = get_the_post_thumbnail_url($post['ID'], 'thumbnail');
        $html = $post['post_content'];
        $html = html_entity_decode(strip_tags($html));
        $strArray = explode('.', $html);
        $paragraph = substr($html, 0, 250);

        $trns = "squ_trans.png";

        $rtn .= '<li><h3>Programmes</h3><a href="' . get_permalink($post['ID']) . '"><div style="background:url(' . $port_logo . '); background-position:center; background-size:cover; position:relative;"><img src="/wp-content/themes/lighttheme/images/' . $trns . '"><span><strong>' . get_the_date('F j, Y', $post["ID"]) . '</strong></span></div>';
        $rtn .= '<div class="hp-cat-txt"><h3>' . $post['post_title'] . '</h3><p>' . $paragraph . '</p></div></a><div class="btn-container"><a href="/what-we-do/programmes" class="hp-vm-btn">View All</a></div></li>';
    endforeach;
    wp_reset_query();

    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'policy-pt',
        'numberposts' => 1, // Number of recent posts thumbnails to display
        'post_status' => 'publish' // Show only the published posts
    ));

    foreach ($recent_posts as $post) :
        $port_logo = get_the_post_thumbnail_url($post['ID'], 'thumbnail');
        $html = $post['post_content'];
        $html = html_entity_decode(strip_tags($html));
        $strArray = explode('.', $html);
        $paragraph = substr($html, 0, 250);

        $trns = "squ_trans.png";

        $rtn .= '<li><h3>Policy</h3><a href="' . get_permalink($post['ID']) . '"><div style="background:url(' . $port_logo . '); background-position:center; background-size:cover; position:relative;"><img src="/wp-content/themes/lighttheme/images/' . $trns . '"><span><strong>' . get_the_date('F j, Y', $post["ID"]) . '</strong></span></div>';
        $rtn .= '<div class="hp-cat-txt"><h3>' . $post['post_title'] . '</h3><p>' . $paragraph . '</p></div></a><div class="btn-container"><a href="/what-we-do/policy" class="hp-vm-btn">View All</a></div></li>';
    endforeach;
    wp_reset_query();

    $rtn .= '</ul></div>';

    return $rtn;
}

add_shortcode('hp_blog_list', 'hp_blog_list_function');

function hp_blog_list_function()
{
    $rtn = "";

    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'post',
        'numberposts' => 3, // Number of recent posts thumbnails to display
        'post_status' => 'publish' // Show only the published posts
    ));

    $cnt = 0;

    $rtn .= '<div class="hp-bl-outer"><ul>';

    foreach ($recent_posts as $post) :

        $cnt++;

        $port_logo = get_the_post_thumbnail_url($post['ID'], 'thumbnail');
        $html = $post['post_content'];
        $html = html_entity_decode(strip_tags($html));
        $strArray = explode('.', $html);
        $paragraph = substr($html, 0, 250);

        $trns = "squ_trans.png";

        if ($cnt != 1) {
            $trns = "rec_trans.png";
        }


        $rtn .= '<li style="background: linear-gradient(0deg, rgba(0,0,0,1) 0%, rgba(0,0,0,0.700717787114846) 24%, rgba(255,255,255,0) 100%), url(' . $port_logo . '); background-position:center; background-size:cover;"><a href="' . get_permalink($post['ID']) . '"><img src="/wp-content/themes/lighttheme/images/' . $trns . '">';
        $rtn .= '<div class="hp-bl-txt"><h3>' . $post['post_title'] . '</h3><p>' . $paragraph . '</p><p><strong>' . get_the_date('F j, Y', $post["ID"]) . '</strong></p></div></a></li>';


    endforeach;
    wp_reset_query();

    $rtn .= '</ul></div>';

    return $rtn;
}

add_shortcode('hp_blog', 'hp_blog_function');

function hp_blog_function()
{
    echo '<div class="blog-home-page-outer">';
    echo '<h2>Latest News</h2>';
    include 'blog_posts_home.php';
    echo '<div class="end"></div>';
    echo '</div>';
}

add_shortcode('hp_blog', 'hp_blog_function');

function blog_list_function()
{
    echo '<div class="blog-home-page-outer blog-listings-page-outer blog-page-b">';
    include 'blog_listing.php';
    echo '<div class="end"></div>';
    echo '</div>';
}

add_shortcode('blog_list', 'blog_list_function');

function faq_list_function()
{
    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'faq_s',
        'numberposts' => 100000, // Number of recent posts thumbnails to display
        'orderby' => 'id',
        'order' => 'ASC',
        'post_status' => 'publish' // Show only the published posts
    ));

    $cnt = 0;

    echo '<div class="faq-outer"><ul>';

    foreach ($recent_posts as $post) :
        echo '<li><h4>'
            . $post['post_title']
            . '</h4>'
            . '<span><p class="recent-posts">'
            . $post['post_content']
            . '</p></span>'
            . '<div class="faq-btn"></div>'
            . '</li>';

    endforeach;
    wp_reset_query();

    echo '</ul></div>';
}

add_shortcode('faq_list', 'faq_list_function');

function testimonials_list_function()
{
    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'testimonial',
        'numberposts' => 7, // Number of recent posts thumbnails to display
        'orderby' => 'id',
        'order' => 'ASC',
        'post_status' => 'publish' // Show only the published posts
    ));

    $cnt = 0;

    echo '<div class="test-home-outer">
    <div class="test-back">
    <h3>Testimonials</h3>
    <h2>What Our Clients Say</h2>
        <div class="test-container">
            <div class="flexslider" style="height: auto !important;">
                <ul class="slides">';

    foreach ($recent_posts as $post) :


        echo '<li class="bannerimg1 flex-active-slide" data-type="background" data-speed="2" data-featured="Yes" data-thumb-alt=""><table class="test-tbl"><tr><td><div class="test-text"><i>';
        echo $post['post_content'];
        echo '</i><br><br>';
        echo '<strong>';
        echo $post['post_title'];
        echo '</strong>';
        if (!empty(get_field("company_name", $post["ID"]))) {
            echo ', ' . get_field("company_name", $post["ID"]);
        }
        echo '</div>';
        echo '</td>
                            </tr>
                        </table>
                        <div class="end"></div>
                    </li>';


    endforeach;
    wp_reset_query();

    echo '      </ul><div class="end"></div>
            </div>
        </div>
        <div class="end"></div>
    </div>
</div>';
}

add_shortcode('testimonials_list', 'testimonials_list_function');

function people_list_all_function()
{
    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'people_lst',
        'numberposts' => 1000, // Number of recent posts thumbnails to display
        'orderby' => 'post_title',
        'order' => 'ASC',
        'post_status' => 'publish' // Show only the published posts
    ));

    $cnt = 0;

    echo '<div class="blog-home-page-outer people-outer people-outer-pg"><div class="blog-home-page-outer people-entry content-container unit size3of4 blog-home-page">';

    foreach ($recent_posts as $post) :
        $p_img = get_the_post_thumbnail_url($post['ID'], 'thumbnail');
        $phone = get_field("phone", $post['ID']);
        $email = get_field("email", $post['ID']);
        $facebook = get_field("facebook", $post['ID']);
        $twitter = get_field("twitter", $post['ID']);
        $linkedin = get_field("linkedin", $post['ID']);
        $ward = get_field("ward", $post['ID']);
        $position = get_field("position", $post['ID']);

        $socials = '';

        if (!empty($phone)) {
            $socials .= '<a href="tel:' . $phone . '"><img src="/wp-content/themes/lighttheme/images/icons/phone.png"></a>';
        }
        if (!empty($email)) {
            $socials .= '<a href="mailto:' . $email . '"><img src="/wp-content/themes/lighttheme/images/icons/email.png"></a>';
        }
        if (!empty($facebook)) {
            $socials .= '<a target="_blank" href="' . $facebook . '"><img src="/wp-content/themes/lighttheme/images/icons/facebook-dark.png"></a>';
        }
        if (!empty($twitter)) {
            $socials .= '<a target="_blank" href="' . $twitter . '"><img src="/wp-content/themes/lighttheme/images/icons/twitter-dark.png"></a>';
        }
        if (!empty($linkedin)) {
            $socials .= '<a target="_blank" href="' . $linkedin . '"><img src="/wp-content/themes/lighttheme/images/icons/linkedin-dark.png"></a>';
        }

        $style = "";

        if (!has_post_thumbnail($post['ID'])) {
            //echo "<p class="post-image"><img src='/wp-content/themes/lighttheme/images/logo-bl.png' />";
            //$style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:contain; background-position:center;"';
        } else {
            $style = 'style="background:url(';
            $style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
            $style .= '); background-size:cover; background-position:center;"';;
        }

        echo '<div class="post-summary Blog-blog-item">';
        echo '<div ' . $style . '>';
        echo '<a href="' . get_permalink($post['ID']) . '" title="Read more about ' . $post['post_title'] . '...">';
        echo '<img src="/wp-content/themes/lighttheme/images/squ_trans.png">';
        echo '</a>';
        echo '</div>';


        echo '<div class="post-text">';
        echo '<div class="post-inner">';
        echo '<h2 style="margin-bottom: 0.5em;">' . $post['post_title'] . '</h2>';
        //echo '<p class="position">'.$position.'</p>';
        if (!empty($position)) {
            echo '<p class="position">' . $position . '</p>';
        }
        if (!empty($ward)) {
            echo '<p class="ward">' . $ward . '</p>';
        }
        if (!empty($socials)) {
            echo '<div class="people-socials">';
            echo $socials;
            echo '</div>';
        }
        echo '<p style="text-align: center; margin-top: 1em;"><a class="button-blog-list" href="' . get_permalink($post['ID']) . '" title="Read more about ' . $post['post_title'] .  '...">Read More</a></p></a></div>';
        echo '</div></div>';

    endforeach;
    wp_reset_query();


    echo '</div></div>';
}

add_shortcode('people_all_list', 'people_list_all_function');

function people_list_function()
{
    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'people_lst',
        'numberposts' => 7, // Number of recent posts thumbnails to display
        'orderby' => 'id',
        'order' => 'ASC',
        'post_status' => 'publish' // Show only the published posts
    ));

    $cnt = 0;

    echo '<div class="blog-home-page-outer people-outer"><h2>Who We Are</h2><div class="blog-home-page-outer people-entry content-container unit size3of4 blog-home-page">';

    foreach ($recent_posts as $post) :
        $p_img = get_the_post_thumbnail_url($post['ID'], 'thumbnail');
        $phone = get_field("phone", $post['ID']);
        $email = get_field("email", $post['ID']);
        $facebook = get_field("facebook", $post['ID']);
        $twitter = get_field("twitter", $post['ID']);
        $linkedin = get_field("linkedin", $post['ID']);
        $ward = get_field("ward", $post['ID']);
        $position = get_field("position", $post['ID']);

        $socials = '';

        if (!empty($phone)) {
            $socials .= '<a href="tel:' . $phone . '"><img src="/wp-content/themes/lighttheme/images/icons/phone.png"></a>';
        }
        if (!empty($email)) {
            $socials .= '<a href="mailto:' . $email . '"><img src="/wp-content/themes/lighttheme/images/icons/email.png"></a>';
        }
        if (!empty($facebook)) {
            $socials .= '<a target="_blank" href="' . $facebook . '"><img src="/wp-content/themes/lighttheme/images/icons/facebook-dark.png"></a>';
        }
        if (!empty($twitter)) {
            $socials .= '<a target="_blank" href="' . $twitter . '"><img src="/wp-content/themes/lighttheme/images/icons/twitter-dark.png"></a>';
        }
        if (!empty($linkedin)) {
            $socials .= '<a target="_blank" href="' . $linkedin . '"><img src="/wp-content/themes/lighttheme/images/icons/linkedin-dark.png"></a>';
        }

        $style = "";

        if (!has_post_thumbnail($post['ID'])) {
            //echo "<p class="post-image"><img src='/wp-content/themes/lighttheme/images/logo-bl.png' />";
            //$style = 'style="background:url(/wp-content/themes/lighttheme/images/logo-bl.png); background-size:contain; background-position:center;"';
        } else {
            $style = 'style="background:url(';
            $style .= get_the_post_thumbnail_url($post['ID'], 'thumbnail');
            $style .= '); background-size:cover; background-position:center;"';;
        }

        echo '<div class="post-summary Blog-blog-item">';
        echo '<div ' . $style . '>';
        echo '<a href="' . get_permalink($post['ID']) . '" title="Read more about ' . $post['post_title'] . '...">';
        echo '<img src="/wp-content/themes/lighttheme/images/squ_trans.png">';
        echo '</a>';
        echo '</div>';


        echo '<div class="post-text">';
        echo '<div class="post-inner">';
        echo '<h2 style="margin-bottom: 0.5em;">' . $post['post_title'] . '</h2>';
        if (!empty($position)) {
            echo '<p class="position">' . $position . '</p>';
        }
        if (!empty($ward)) {
            echo '<p class="ward">' . $ward . '</p>';
        }
        if (!empty($socials)) {
            echo '<div class="people-socials">';
            echo $socials;
            echo '</div>';
        }
        echo '<p style="text-align: center; margin-top: 1em;"><a class="button-blog-list" href="' . get_permalink($post['ID']) . '" title="Read more about ' . $post['post_title'] .  '...">Read More</a></p></a></div>';
        echo '</div></div>';

    endforeach;
    wp_reset_query();


    echo '</div></div>';
    echo "<script type='text/javascript'>
        $(document).ready(function(){
  $('.people-entry').slick({
   centerMode: true,
  centerPadding: '5px',
  slidesToShow:3,
  autoplay: true,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 980,
      settings: {
        centerMode: true,
        centerPadding: '5px',
        slidesToShow: 2
      }
    },
    {
      breakpoint: 520,
      settings: {
        centerMode: true,
        centerPadding: '5px',
        slidesToShow: 1
      }
    }
  ]
  });
});
    </script>";
}

add_shortcode('people_list', 'people_list_function');

add_shortcode('testimonials_list_all', 'testimonials_list_all_function');
function testimonials_list_all_function()
{
    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'testimonial',
        'numberposts' => 100000, // Number of recent posts thumbnails to display
        'orderby' => 'id',
        'order' => 'ASC',
        'post_status' => 'publish' // Show only the published posts
    ));

    $cnt = 0;

    echo '
        <div class="test-home-outer">
            <div class="test-back">
                <div class="test-container">
                    <div class="" style="height: auto !important;">
                        <ul class="">';
    foreach ($recent_posts as $post) :
        echo '
                                    <li class="bannerimg1 flex-active-slide" data-type="background" data-speed="2" data-featured="Yes" data-thumb-alt="">
                                        <table class="test-tbl"><tr>
                                            <td>
                                                <div class="test-img" style="background:url(); background-size:cover; background-position:center top;">
                                                    <img src="/wp-content/themes/lighttheme/images/squ_trans.png">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="test-text">
                                                ' . $post['post_excerpt'] . '
                                                <br><br>
                                                <strong>
                                                ' . $post['post_title'] . '
                                                </strong></div>
                                            </td>
                                        </tr></table>
                                        <div class="end"></div>
                                    </li>';
    endforeach;
    wp_reset_query();
    echo '
                        </ul>
                        <div class="end"></div>
                    </div>
                </div>
                <div class="end"></div>
            </div>
        </div>';
}

add_shortcode('mc-subscribe-form', 'mc_subscribe_form_shortcode');
function mc_subscribe_form_shortcode()
{
    return file_get_contents(__DIR__ . '/../components/mc-subscribe-form.html');
}
