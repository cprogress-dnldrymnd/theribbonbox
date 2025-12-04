<?php
//html comments remove by dd
//echo "<!-- index-experts-subpages.php -->";
//$atts['post_type'] = "podcasts";

$eCat = "All";
if ($categories[0]->term_id != ""){
    $eCat = $categories[0]->cat_name;
}

//$category = get_the_category();
$parent = get_cat_name($categories[0]->category_parent);
if (!empty($parent)) {
    $eCat = $parent;
}
echo do_shortcode('[ivory-search id="23677" title="Experts Search"]');
echo '<div class="experts-page-cara xx" '.$categories[0]->term_id.'>';
echo do_shortcode("[expert_list page='1'  title='".$eCat . " Experts" ."' spotlight='1' categoryid='".$categories[0]->term_id."']");
echo '</div>';
echo '<link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick.css">
                  <link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick-theme.css">
                  <script src="/wp-content/themes/lighttheme"></script>';
//echo '<h2>123</h2>';
echo '<div class="experts-page-head"><h2>'.$eCat.' Experts</h2></div>';
echo do_shortcode("[blog_filter format='post-page' post_type='expert_profiles' categoryid='".$categories[0]->term_id."']");
echo do_shortcode("[category_list page='experts']");
echo do_shortcode("[display_expertboxes]");
//echo do_shortcode("[display_insider]");
echo do_shortcode("[display_matchexpert]");