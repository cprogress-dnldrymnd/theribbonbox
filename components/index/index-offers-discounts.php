<?php
//html comments remove by dd
//echo "<!-- index-offers-discounts.php -->";

//$atts['post_type'] = "podcasts";
echo '<div class="search-filter-outer">';
echo '<div class="search-outer">';
echo do_shortcode('[ivory-search id="23907" title="Discounts Search"]');
echo '</div>';
echo '<div class="filter-outer"><div class="filter-btn">FILTER</div>';
echo '<div class="filter-options"><div class="filter-options-inner">';
echo '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eros justo, ultrices non mi quis, placerat maximus dolor. Duis consequat tempor arcu.</p>';
echo '</div><div class="filter-search-btn"><a class="button-expert" tabindex="0">APPLY FILTER</a></div></div>';
echo '</div>';
echo '</div>';
echo '<div class="search-filter-results">';
echo do_shortcode("[blog_filter format='post-page' limit='8' post_type='offer-items' categoryid='".(isset($categories[0]) ? $categories[0]->term_id : '')."']");
echo '</div>';
//echo do_shortcode("[display_insider]");
//echo do_shortcode("[get_giveaway_event post_type='offer-items']");