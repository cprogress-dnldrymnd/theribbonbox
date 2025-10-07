<?php
echo '
<!-- index-videos-page.php -->
<div class="search-filter-outer">
<div class="search-outer">
    '.do_shortcode('[ivory-search id="23695" title="Video Search"]').'
</div>
<div class="filter-outer"><div class="filter-btn">FILTER</div>
<div class="filter-options"><div class="filter-options-inner">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eros justo, ultrices non mi quis, placerat maximus dolor. Duis consequat tempor arcu.</p>
</div><div class="filter-search-btn"><a class="button-expert" tabindex="0">APPLY FILTER</a></div></div>
</div>
</div>
<div class="search-filter-results">
'.do_shortcode("[blog_filter format='post-page' ".($design ?? '')." post_type='videos' limit='43' add_ad='Yes' categoryid='".(isset($categories[0]) ? $categories[0]->term_id : '')."']").'
</div>
<h2 class="vid-h2-tren">Trending Videos</h2>
<div class="experts-page-cara vid-pod-page-cara">
'.do_shortcode("[vid_pod_list page='1' post_type='videos']").'
</div>
'.do_shortcode("[category_list page='videos']").'
<link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick.css">
<link rel="stylesheet" href="/wp-content/themes/lighttheme/stylesheet/slick-theme.css">
<script src="/wp-content/themes/lighttheme"></script>
'.do_shortcode("[display_followus]");