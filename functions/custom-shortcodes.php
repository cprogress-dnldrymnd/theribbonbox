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

function get_socials_function()
{
    $rtn = '<div class="social-icons"> 
                <a href="https://www.facebook.com/fertility.theribbonbox/" target="_blank" class="facebook"></a>
                <a href="https://www.pinterest.co.uk/the_ribbon_box/" target="_blank" class="pinterest"></a> 
                <a href="https://www.linkedin.com/company/theribbonbox" target="_blank" class="linkedin"></a>
                <a href="https://twitter.com/theribbonbox_" target="_blank" class="twitter"></a> 
                <a href="https://www.youtube.com/@theribbonbox" target="_blank" class="youtube"></a> 
                <a href="https://www.instagram.com/fertility_help_hub/" target="_blank" class="instagram mobile-social"></a>
                <a href="https://www.tiktok.com/@fertility.theribbonbox" target="_blank" class="ticktok mobile-social"></a>
              <!--  <a href="https://www.tiktok.com/@parenting.theribbonbox" target="_blank" class="ticktok"></a>   -->
                 <!--<a href="/" target="_blank" class="instagram"></a> 
                  <a href="/" target="_blank" class="youtube"></a> -->
            </div>
			<div class="social-icons social-icons-txt"> 
                 <a href="https://www.instagram.com/parenting.theribbonbox/" target="_blank" class="instagram">
                 @parenting.theribbonbox</a> | 
				 <a href="https://www.instagram.com/fertility.theribbonbox/" target="_blank" class="instagram1">@fertility.theribbonbox</a>
            </div>
			<div class="social-icons social-icons-txt">  
				<a href="https://www.tiktok.com/@fertility.theribbonbox" target="_blank" class="ticktok">@fertility.theribbonbox</a> |
				<a href="https://www.tiktok.com/@theribbonbox" target="_blank" class="ticktok1">@theribbonbox</a>
            </div>';

    return $rtn;
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
    $rtn = '<div class="post-follow-us"><div class="post-follow-us-inner"><h2>Follow Us</h2><hr>
                                <div class="cat-links">
                                    <a href="/wellbeing">Wellbeing</a> |
                                    <a href="/fertility">Fertility</a> |
                                    <a href="/pregnancy">Pregnancy</a> |
                                    <a href="/parenting">Parenting</a>
                                </div>
                                ' . do_shortcode("[get_socials]") . '
                                </div></div>';

    return $rtn;
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
    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'ads',
        'numberposts' => 1, // Number of recent posts thumbnails to display
        'orderby' => 'rand',
        'post_status' => 'publish' // Show only the published posts
    ));

    $rtn = '';

    $ad_img = get_field("ad_image", 24562);
    $ad_url = get_field("ad_url", 24562);
    $rtn .= '<a class="ad-item" href="' . $ad_url . '" target="_blank">';
    $rtn .= wp_get_attachment_image($ad_img, 'large');
    $rtn .= '</a>';
    wp_reset_query();

    return $rtn;
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
        $rtn .= '<div class="expert-outer"><div class="expert-entry">';
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



  $('.expert-entry').slick({
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
        $rtn .= '<div class="expert-outer"><div class="expert-entry">';
    } else {
        $rtn .= '<div class="expert-outer"><h2>Wellbeing & Fertility Experts</h2><div class="expert-entry">';
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



      $('.expert-entry').slick({
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



      $('.expert-entry').slick({
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
