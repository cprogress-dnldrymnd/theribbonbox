<?php
//html comments remove by dd
//echo "<!-- index-expert-profiles.php -->";

$ext = "";

$title = get_the_title();

$partner_locations = get_field("partner_locations", $post->ID);
//$partner_inner_banner = get_field("partner_inner_banner", $post->ID);

$visit_partners_website_button_text = get_field("visit_partner’s_website_button_text", $post->ID);
$partner_website = get_field("partner_website", $post->ID);
$follow_our_partner_heading_text = get_field("follow_our_partner_heading_text", $post->ID);
$facebook_link = get_field("facebook_link", $post->ID);
$twitter_link = get_field("twitter_link", $post->ID);
$youtube_link = get_field("youtube_link", $post->ID);
$linkedin_link = get_field("linkedin_link", $post->ID);
$instagram_link = get_field("instagram_link", $post->ID);
$pinterest_link = get_field("pinterest_link", $post->ID);
$tiktok_link = get_field("tiktok_link", $post->ID);
$profile_video = get_field("profile_video", $post->ID);
$all_partners_desktop_thumbnail = get_field("all_partners_desktop_thumbnail", $post->ID);
$all_partners_mobile_thumbnail = get_field("all_partners_mobile_thumbnail", $post->ID);
$virtual_consultations = get_field("virtual_consultations", $post->ID);
$online_purchases = get_field("online_purchases", $post->ID);

$opening_times = get_field("opening_times", $post->ID);
$address = get_field("address", $post->ID);
$phone_number = get_field("phone_number", $post->ID);
$email_address = get_field("email_address", $post->ID);

$youtube_video_url = get_field("youtube_video_url", $post->ID);
$youtube_video_text = get_field("youtube_video_text", $post->ID);

$youtube_video_image = get_field("youtube_video_image", $post->ID);

$expert_quote = get_field("expert_quote", $post->ID);

$image = get_field("partner_inner_banner", $post->ID);
$size = 'full';
$partner_inner_banner = $image['url'];

if (!empty($partner_inner_banner)){
    $style = 'style="background:url(';
    //$style .= get_the_post_thumbnail_url($post['ID'], 'post-thumbnail');

    $iUrl = str_replace("https://theribbonbox.viltac.com/", "https://www.fertilityhelphub.com/", $partner_inner_banner);
    $style .= $iUrl;
    $style .= '); background-size:cover; background-position:center;"';
}


echo '
<div class="blog-top-ban blog-top-ban-main-content experts-top-ban">
    <div class="blog-l-img" '.($style ?? '').'>
        <img src="/wp-content/themes/lighttheme/images/menu-trans-req.png">
        <div class="banner-star-rating '.($addd1 ?? '').'" style="background:'.($bcolour1 ?? '').';">
            <h3>The Ribbon Box Partner</h3>'.do_shortcode("[stars_rating_avg]").'
        </div>
        </div>
        <div class="expert-top-outer">
            <div class="blog-l-text-out" '.($border ?? '').'>
                <div class="blog-l-text blog-p-text" >
                    '.($featured_cur ?? '').'
                    <h3>'.($currentcatname ?? '').'</h3>
                    <h1>'.get_the_title().'</h1>
                    <div class="subtitle-ex">'.get_the_excerpt().'</div>
                    <div class="detail-page-socials">'. create_item_socials(get_permalink($post->ID), get_the_title()).'</div>
                </div>
            </div>
            <div class="experts-top-ban-bg"></div>
        </div>
    <div class="experts-top-content blog-l-text blog-p-text blog-l-text-out blog-l-text-out-no-bg">
        <div class="post-main-content">';
the_content();
echo '</div>';
echo '<div class="exprets-de-out">';
echo '<div class="exprets-de-circle" style="background:'.$bcolour.';"><p '.$ad.'><span>'.$currentcatname.'</span><br>Expert</p></div>';
echo '<h2 id="de-h2">Contact '.get_the_title().'</h2>';
echo '<table><tr>';
echo '<td><h3>Opening Times</h3>';
if ( !empty($opening_times) ):
    echo '<p class="opening-times">'.$opening_times.'</p>';
endif;
echo '<hr>';
echo '</td>';
echo '<td><h3>Location</h3>';
if ( !empty($address) ):
    echo '<p class="address">'.$address.'</p>';
endif;
echo '<hr>';
echo '</td>';
echo '<td rowspan="2" style="vertical-align: bottom;">';
if ( !empty($partner_website) ):
    $btn_txt = "Visit Website";
    if ( !empty($visit_partners_website_button_text) ):
        $btn_txt = $visit_partners_website_button_text;
    endif;
    echo '<div class="visit-links-ex"><a href="'.$partner_website.'" target="_blank" class="button-expert">'.$btn_txt.'</a></div>';
endif;
echo '<div class="visit-links-ex"><a href="'.$partner_website.'" id="sharelink" target="_blank" class="button-expert button-expert-share">Share This Profile</a></div>';
echo '</td>';
echo '</tr>';
echo '<tr><td><h3>Get In Touch</h3><div class="ex-contact">';
if ( !empty($phone_number) ):
    echo '<a class="pho" href="tel:'.$phone_number.'">'.$phone_number.'</a>';
endif;
if ( !empty($email_address) ):
    echo '<a class="ema" href="mailto:'.$email_address.'">'.$email_address.'</a>';
endif;
echo '</div></td>';
echo '<td><h3>Follow</h3>';
echo '<div class="social-links-ex">';
if ( !empty($facebook_link) ):
    echo '<a href="'.$facebook_link.'" target="_blank" class="facebook icon-bg"></a>';
endif;
if ( !empty($twitter_link) ):
    echo '<a href="'.$twitter_link.'" target="_blank" class="twitter icon-bg"></a>';
endif;
if ( !empty($instagram_link) ):
    echo '<a href="'.$instagram_link.'" target="_blank" class="instagram icon-bg"></a>';
endif;
if ( !empty($pinterest_link) ):
    echo '<a href="'.$pinterest_link.'" target="_blank" class="pinterest icon-bg"></a>';
endif;
if ( !empty($linkedin_link) ):
    echo '<a href="'.$linkedin_link.'" target="_blank" class="linkedin icon-bg"></a>';
endif;
if ( !empty($youtube_link) ):
    echo '<a href="'.$youtube_link.'" target="_blank" class="youtube icon-bg"></a>';
endif;
if ( !empty($tiktok_link) ):
    echo '<a href="'.$tiktok_link.'" target="_blank" class="ticktok icon-bg"></a>';
endif;
echo '</div>';
echo '</td>';
echo '</tr></table>';

echo '</div>';

echo '<section class="sharing-box">
                                    <h4>Share This Profile</h4>';
echo '<div class="giveaway-outer-form giveaway-outer giveaway-thanks" style="margin:0;"><div class="giveaway-inner-form giveaway-inner" style="padding:0;">';
echo create_item_socials(get_permalink($post->ID), get_the_title());
echo '</div></div>';
echo '</section>';

echo '<div class="back-to-outer"><a href="/experts">< Back to All Experts</a></div>';



echo '</div>';

if (!empty($youtube_video_url) || !empty($youtube_video_text)){
    echo '<div class="expert-vid-text">';
    echo '<div class="expert-vid-text-inner">';
    if (!empty($youtube_video_url)) {
        echo '<div class="expert-vid-sec">';
        echo '<div class="blog-l-img" style="background:url('.$youtube_video_image.'); background-size:cover; background-position:center;"><a href="'.$youtube_video_url.'" class="bl-overlay" data-lity><span>Read<br>More</span></a><a href="'.$youtube_video_url.'" data-lity><img src="/wp-content/themes/lighttheme/images/vid-btn.png" class="vid-btn"><img src="/wp-content/themes/lighttheme/images/menu-trans-req.png"></a></div>';
        echo '</div>';
        echo '<link href="/wp-content/themes/lighttheme/js/lity/lity.css" rel="stylesheet">
            <script src="/wp-content/themes/lighttheme/js/lity/lity.js"></script>';
    }
    if (!empty($youtube_video_text)) {
        echo '<div class="expert-txt-sec">';
        echo '<h3>Watch</h3>';
        echo '<p class="youtube_video_text">'.$youtube_video_text.'</p>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
} else {
    if (!empty($expert_quote)){
        echo '<div class="expert-vid-text">';
        echo '<div class="expert-vid-text-inner">';
        echo '<h3 class="expert-quote-h3">'.$expert_quote.'</h3>';
        echo '</div>';
        echo '</div>';
    }
}

echo '<div class="experts-top-content blog-l-text blog-p-text">';


echo '<div class="post-nav-single">';

$prev_post = get_previous_post();
$id = $prev_post ? $prev_post->ID : '';
$permalink1 = get_permalink( $id );

$next_post = get_next_post();
$nid = $next_post ? $next_post->ID : '';
$permalink = get_permalink($nid);

echo '<div class="nav-previous"><h4>';
echo previous_post_link( '%link', __( '< Previous Expert', 'twentyeleven' ) );
echo '</h4>';//<h3><a href="';
//echo $permalink1;
//echo '">';
//echo $prev_post->post_title;
//echo '</a></h3></div>';
echo '</div>';

echo '<div class="nav-next"><h4>';
echo next_post_link( '%link', __( 'Next Expert >', 'twentyeleven' ) );
echo '</h4>';//<h3><a href="';
//echo $permalink;
//echo '">';
//echo $next_post->post_title;
//echo '</a></h3></div></div>';
echo '</div>';


//the_content();

if (!empty($profile_video)):
    echo'<div class="profile-video">
                                  <iframe width="100%" height="480" src="https://www.youtube.com/embed/'.$profile_video.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                  </div>';
endif;

$postUrl = get_permalink($post->ID);

echo '<div class="post-comments-single">';

$commentscount = get_comments_number();
if ($commentscount > 0){
    echo '<h3>Latest Reviews</h3>';
}
comments_template();
echo '</div>';







//echo '</div></div></div>';
echo '</div></div>';

?>
    <script type="text/javascript">
        $("#sharelink").click(function(e){
            e.preventDefault();
            //sharing-box
            $([document.documentElement, document.body]).animate({
                scrollTop: $(".sharing-box").offset().top - $("header").height() -30
            }, 1000);
        });
    </script>

    <script type="text/javascript">
        if ($("#comment").length > 0){
            $("#comment").attr("placeholder", "COMMENT*");
        }
        if($("#submit").length > 0){
            $("#submit").val("ADD REVIEW");
        }
        if ($("#reply-title").length > 0){
            $("#reply-title").html("Leave Your Review");
        }
    </script>

<?php