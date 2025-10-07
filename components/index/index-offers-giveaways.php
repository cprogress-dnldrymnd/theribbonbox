<?php
//html comments remove by dd
//echo "<!-- index-offers-giveaways.php -->";

//$atts['post_type'] = "podcasts";
$loadMoreEv = true;

echo '<div class="search-filter-outer">
    <div class="search-outer">
    ' . do_shortcode('[ivory-search id="23880" title="Giveaways Search"]') . '
    </div>
    <div class="filter-outer"><div class="filter-btn">FILTER</div>
    <div class="filter-options"><div class="filter-options-inner">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eros justo, ultrices non mi quis, placerat maximus dolor. Duis consequat tempor arcu.</p>
    </div><div class="filter-search-btn"><a class="button-expert" tabindex="0">APPLY FILTER</a></div></div>
    </div>
    </div>
    <div class="search-filter-results">
    ' . do_shortcode("[blog_filter format='post-page' limit='8' post_type='giveaway-items' categoryid='". (isset($categories[0]) ? $categories[0]->term_id : '')."']") . '
    </div>';
//echo do_shortcode("[get_giveaway_event post_type='giveaway-items' post_id='23595']");
//echo do_shortcode("[giveaway_list page='1']");
//echo do_shortcode("[display_insider]");
echo '<link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick.css">
      <link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick-theme.css">
      <script src="/wp-content/themes/lighttheme"></script>';