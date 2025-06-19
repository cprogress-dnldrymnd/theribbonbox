<?php
//html comments remove by dd
//echo "<!-- index-the-ribbon-box-podcast.php -->";

$design = " design='full-pod-list' ";
echo do_shortcode('[ivory-search id="23692" title="Podcast Search"]');
echo do_shortcode("[blog_filter format='post-page' ".$design." post_type='podcasts' func='podcast-limit4' limit='4' categoryid='1159,1164,1165,1163']");
echo '<h2 class="vid-h2-tren">Trending Podcasts</h2>';
echo '<div class="experts-page-cara vid-pod-page-cara">';
echo do_shortcode("[vid_pod_list page='1' post_type='podcasts']");
echo '</div>';
echo '<link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick.css">
                  <link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick-theme.css">
                  <script src="/wp-content/themes/lighttheme"></script>';
echo do_shortcode("[display_followus]");