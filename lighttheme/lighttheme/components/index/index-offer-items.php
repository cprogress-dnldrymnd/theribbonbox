<?php
echo "<!-- index-offer-items.php -->";

$ext = "";

$title = get_the_title();

$location = get_field("location", $post->ID);
$percentage_0ff = get_field("percentage-0ff", $post->ID);
$apply__code = get_field("apply__code", $post->ID);
$offer_expired_text = get_field("offer-expired-text", $post->ID);
$offer_expiry_date = get_field("offer_expiry_date", $post->ID);
$website_link = get_field("website_link", $post->ID);


echo '<div class="blog-top-ban blog-top-ban-main-content"><div class="blog-l-img" '.$style.'><img src="/wp-content/themes/lighttheme/images/menu-trans-req.png"></div><div class="blog-l-text-out" '.$border.'><div class="blog-l-text blog-p-text" >'.$featured_cur.'';

if ( !empty($offer_expiry_date) ):
    $today = date("Y-m-d");
    $date = $offer_expiry_date;
    $time = strtotime($date);
    $newformat = date('Y-m-d',$time);

    $time = strtotime($date);
    $newukformat = date('d-m-Y',$time);

    $date_txt = "Offer Open: ";

    if ($newformat < $today) {
        $date_txt = "Offer Closed: ";
    }

    if ( !empty($offer_expired_text) ):
        $date_txt = $offer_expired_text." ";
    endif;


    echo '<h3>'.$date_txt.$newukformat . '</h3>';
endif;

echo '<h3>'.$currentcatname.'</h3><h1>'.get_the_title().'</h1>';

echo '<div class="post-main-content">';
the_content();
echo '</div>';



echo '<div class="offer-outer">';
if ( !empty($percentage_0ff) ):
    echo '<h4>Discount: <strong>'.$percentage_0ff.'</strong></h4>';
endif;
if ( !empty($apply__code) ):
    echo '<h4>Discount Code: <strong>'.$apply__code.'</strong></h4>';
endif;

if ( !empty($website_link) ):
    $btn_txt = "Visit Offer";
    echo '<div class="visit-links-ex"><a href="'.$website_link.'" target="_blank" class="button-expert">'.$btn_txt.'</a></div>';
endif;

echo '</div>';



$postUrl = get_permalink($post->ID);

echo '<section class="sharing-box">
                                    <h4>Share This Offer</h4>';
echo '<div class="giveaway-outer-form giveaway-outer giveaway-thanks" style="margin:0;"><div class="giveaway-inner-form giveaway-inner" style="padding:0;">';
echo create_item_socials(get_permalink($post->ID), get_the_title());
echo '</div></div>';
echo '</section>';

echo '</div></div></div>';

echo do_shortcode("[display_followus]");


