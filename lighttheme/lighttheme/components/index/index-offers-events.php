<?php
echo '
<!-- index-offers-events.php -->
<div class="search-filter-outer">
    <div class="search-outer">
        ' .do_shortcode('[ivory-search id="24727" title="Events Search"]') .'
    </div>
    <div class="filter-outer">
        <div class="filter-btn">FILTER</div>
        <div class="filter-options">
            <div class="filter-options-inner">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eros justo, ultrices non mi quis, placerat maximus dolor. Duis consequat tempor arcu.</p>
            </div>
            <div class="filter-search-btn"><a class="button-expert" tabindex="0">APPLY FILTER</a></div>
        </div>
    </div>
</div>

<div class="search-filter-results">
    ' .do_shortcode("[blog_filter format='post-page' limit='8' post_type='events' categoryid='".(isset($categories[0]) ? $categories[0]->term_id : '')."']").'
</div>';
//echo do_shortcode("[display_insider]");