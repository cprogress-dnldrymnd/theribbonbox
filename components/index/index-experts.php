<?php
echo "<!-- index-experts.php -->";

echo do_shortcode('[ivory-search id="23677" title="Experts Search"]');
echo '<div class="experts-page-cara">';
echo do_shortcode("[expert_list page='1' spotlight='1' title='Featured Experts']");
echo '</div>';
echo '<div class="experts-page-head"><h2>Wellbeing & Fertility Experts</h2></div>';
echo do_shortcode("[blog_filter format='post-page' post_type='expert_profiles' categoryid='1164,1159']");
echo '<div class="experts-page-head"><h2>Pregnancy & Parenting Experts</h2></div>';
echo do_shortcode("[blog_filter format='post-page' post_type='expert_profiles' categoryid='1165,1163']");

//echo do_shortcode("[category_list page='experts']");
echo do_shortcode("[display_matchexpert]");
echo do_shortcode("[display_expertboxes]");
//echo do_shortcode("[display_insider]");

echo '<link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick.css">
    <link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick-theme.css">
    <script src="/wp-content/themes/lighttheme"></script>';