<?php
//html comments remove by dd
//echo "<!-- index-giveaway-items.php -->";

$ext = "";

$title = get_the_title();

$listing = get_field("listing", $post->ID);
$featured = get_field("featured", $post->ID);
$promo = get_field("promo", $post->ID);
$select_competition_option = get_field("select_competition_option", $post->ID);
$select_competition_date = get_field("select_competition_date", $post->ID);
$select_competition_button_name = get_field("select_competition_button_name", $post->ID);
$hide_join_banner = get_field("hide_join_banner", $post->ID);
$giveaway_form = get_field("giveaway_form", $post->ID);
//var_dump($giveaway_form);


$postUrl = get_permalink($post->ID);

$isOpen = false;
$competition_closes = '';
if ( !empty($select_competition_date) ):
    $today = date("Y-m-d");
    $date = $select_competition_date;
    $time = strtotime($date);
    $newformat = date('Y-m-d',$time);
    $displayformat = date('d-m-Y',$time);
    $displayformatB = date('j M Y',$time);

    $date_txt = "Giveaway Closed: ";

    if ($newformat > $today) {
        $isOpen = true;
        $date_txt = "Giveaway Open: ";
        //echo '<div class="giveaway-outer giveaway-closed"><div class="giveaway-inner"><h3>Sorry, this competition has now closed.</h3><p>To see our other competitions <a href="/">Click Here.</a></p><hr></div></div>';
        //echo '<div class="giveaway-outer giveaway-thanks"><div class="giveaway-inner"><h3>Thank you for entering our giveaway.</h3><p>We will be in touch if you are the winner.</p><hr></div></div>';
        //echo '<div class="giveaway-outer giveaway-sub-thanks"><div class="giveaway-inner"><h3>Thank you for subscribing.</h3><p>Welcome to The Ribbon Box.</p><hr></div></div>';
    }

    if ( !empty($offer_expired_text) ):
        $date_txt = $offer_expired_text." ";
    endif;


    //echo '<h3>'.$date_txt.$displayformat . '</h3>';
    $competition_closes = '<h3 class="date-giveaways">THIS COMPETITION CLOSES '.$displayformatB . '</h3>';
endif;

$login = '';
if (!post_password_required($post->ID)){

    if (!empty($giveaway_form) && $isOpen){
        $login .= '<div class="giveaway-outer-form giveaway-outer giveaway-thanks"><div class="giveaway-inner-form giveaway-inner">';
        $login .= '<h3>Enter Below For Your Chance To Win</h3>';
        $login .= '<h4>'.get_the_title().'</h4>';
        $login .= $giveaway_form;

        $partner_name = get_field("partner_name", $post->ID);

        //if (!empty($partner_name)){
        //    //echo '<p>By entering you are agreeing to marketing from The Ribbon Box and '.$partner_name.'. You are welcome to unsubscribe at any time.</p>';
        //} else {
        //    //echo '<p>By entering you are agreeing to marketing from The Ribbon Box. You are welcome to unsubscribe at any time.</p>';
        //}

        //echo '<h5>SHARE THIS COMPETITION</h5>';
        //echo create_item_socials(get_permalink($post->ID), get_the_title());
        //echo '</div></div>';
        $login .= '</div>';

    } else{
        $login .= '<div class="giveaway-outer giveaway-closed"><div class="giveaway-inner"><h3>Sorry, this competition has now closed.</h3><p>To see our other competitions <a href="/">Click Here.</a></p><hr></div></div>';
    }
}

ob_start();
the_content();
$the_content = ob_get_clean();

echo '
<div data-template="index-giveaway-items.php" class="blog-top-ban blog-top-ban-main-content test">
    <!--<div class="blog-l-img" /*$style*/>
        <img src="/wp-content/themes/lighttheme/images/menu-trans-req.png">
    </div>-->

    <div class="blog-l-text-out" '.$border.'>
        <div class="blog-l-text blog-p-text" >
            <header>
                '.$featured_cur.'
                <h3>'.$currentcatname.'</h3>
                <h1>'.get_the_title().'</h1>
                
                ' . $competition_closes . '
                <div class="detail-page-socials">
                    '. create_item_socials(get_permalink($post->ID), get_the_title()).'
                </div>
            </header>
            <br>
            
            <div class="main-giveaway-img" '.$style.'>
                <div class="main-giveaway-corner-border">
                    <img src="/wp-content/themes/lighttheme/images/vid_req.png" alt="Fertility Help">
                </div>
            </div>
            ' . $the_content . '
            ' . $login . '
            <div class="post-sub">
                <h3>Want to receive more great articles like this every day? Subscribe to our mailing list</h3>
                <a href="/subscribe" class="sub-pop-btn">SUBSCRIBE</a>
            </div>
            <section class="sharing-box">
                <h4>Share This Competition</h4>
                <div class="giveaway-outer-form giveaway-outer giveaway-thanks" style="margin:0;">
                    <div class="giveaway-inner-form giveaway-inner" style="padding:0;">
                        ' . create_item_socials(get_permalink($post->ID), get_the_title()) . '
                    </div>
                </div>
            </section>
            ' . get_the_breadcrumb_function($_SERVER['REQUEST_URI'], get_the_title()) . '
        </div>
    </div>
</div>';

//echo do_shortcode("[display_followus]");


