<?php
//html comments remove by dd
//echo "<!-- index-podcast-category-pages.php -->";

$design = "";
if (get_the_ID() == "23883" || get_the_ID() == "23885" || get_the_ID() == "23887" || get_the_ID() == "23889") {
    $design = " design='full-pod-list' ";
}
//$atts['post_type'] = "podcasts";
echo do_shortcode('[ivory-search id="23692" title="Podcast Search"]');
echo do_shortcode("[blog_filter format='post-page' ".$design." post_type='podcasts' pod_layout='noheader' limit='13' categoryid='".$categories[0]->term_id."']");
echo '<h2 class="vid-h2-tren">Trending Podcasts</h2>';
echo '<div class="experts-page-cara vid-pod-page-cara">';
echo do_shortcode("[vid_pod_list page='1' post_type='podcasts']");
echo '</div>';
echo do_shortcode("[category_list page='podcasts']");
echo '<link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick.css">
                  <link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick-theme.css">
                  <script src="/wp-content/themes/lighttheme"></script>';
echo do_shortcode("[display_followus]");