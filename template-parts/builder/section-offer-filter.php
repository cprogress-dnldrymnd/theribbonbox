<?php
/**
 * Builder section: Offer Items — Search & Filter.
 * Expects $section (array) and $section_index (int) in scope.
 *
 * Sidebar (search + category list + taxonomy filters + sponsored ads) next to a
 * results grid (sort + optional banner ad + ".product-widget--box" cards + AJAX
 * pagination). Initial render is driven by URL params so direct links and no-JS
 * loads still work; js/offer-filter.js takes over for search / sort / reset /
 * pagination and keeps the URL in sync.
 */

if (!function_exists('trb_offer_filter_get_results')) {
    return;
}

$title       = $section['title'] ?? '';
$description = $section['description'] ?? '';
$per_page    = max(1, absint($section['per_page'] ?? 15));

// Enqueue the AJAX script (registered in functions/offer-filter.php) and the
// Dashicons used by the accordion chevron + pagination (not loaded on the front
// end for logged-out visitors by default).
wp_enqueue_script('trb-offer-filter');
wp_enqueue_style('dashicons');

// Parse the current request so a direct URL (?of_paged=2&of_cat=…) renders correctly.
$args        = trb_offer_filter_parse_request($_GET);
$category_id = $args['category'];

// Ads come from the trb-picks-ad CPT, routed by the ad_location field.
// Each location gets one random ad: category-specific first, random fallback.
$grid_ad = function_exists('trb_get_picks_ad') ? trb_get_picks_ad($category_id, 'grid') : null;

$settings = array('per_page' => $per_page, 'grid_ad' => $grid_ad);
$results  = trb_offer_filter_get_results($args, $settings);

$sort_options = trb_offer_filter_sort_options();
$tax_config   = trb_offer_filter_taxonomies();

// Categories shown in the sidebar: top-level categories that have offer-items,
// with a per-offer-type count (shared/cached helper so the rewrite rules and the
// sidebar stay in sync).
$category_list = trb_offer_filter_get_categories();

// Base path for the pretty category URLs, e.g. "/offers/". Category filtering
// produces /offers/{category-slug}/ instead of ?of_cat=ID.
$base_path = trailingslashit((string) wp_parse_url(get_permalink(get_the_ID()), PHP_URL_PATH));

// Config the script needs to rebuild AJAX requests + pretty URLs.
$instance = 'offer-filter-' . absint($section_index ?? 0);
$js_config = array(
    'perPage'   => $per_page,
    'baseUrl'   => $base_path,
    'hasGridAd' => $grid_ad !== null,
);
?>
<div class="offer-filter" id="offer-filter"
     data-config="<?php echo esc_attr(wp_json_encode($js_config)); ?>">
    <div class="container">
        <?php if ($title || $description) : ?>
            <div class="offer-filter-intro">
                <?php if ($title) : ?><h2 class="offer-filter-title"><?php echo wp_kses_post($title); ?></h2><?php endif; ?>
                <?php if ($description) : ?><div class="offer-filter-desc"><?php echo wp_kses_post(wpautop($description)); ?></div><?php endif; ?>
            </div>
        <?php endif; ?>

        <button type="button" class="offer-filter-mobile-toggle">
            <span class="dashicons dashicons-filter" aria-hidden="true"></span>
            Search &amp; Filter
        </button>

        <div class="offer-filter-layout">
            <aside class="offer-filter-sidebar">
                <form class="offer-filter-form" onsubmit="return false;">
                    <div class="offer-filter-sidebar-header">
                        <h3 class="offer-filter-sidebar-title">Search &amp; Filter</h3>
                        <button type="button" class="offer-filter-mobile-close" aria-label="Close filters">
                            <span class="dashicons dashicons-no-alt" aria-hidden="true"></span>
                        </button>
                    </div>

                    <div class="offer-filter-search">
                        <span class="offer-filter-search-icon dashicons dashicons-search" aria-hidden="true"></span>
                        <input type="search" name="of_s" class="offer-filter-search-input"
                               value="<?php echo esc_attr($args['search']); ?>" placeholder="Search…" autocomplete="off">
                    </div>

                    <div class="offer-filter-ad-top-sidebar-wrap">
                        <?php echo function_exists('trb_render_picks_ad') ? trb_render_picks_ad($category_id, 'top_sidebar', 'medium', 'offer-filter-ad offer-filter-ad--sidebar') : ''; ?>
                    </div>

                    <?php if (!empty($category_list)) : ?>
                        <div class="offer-filter-group offer-filter-categories">
                            <h4 class="offer-filter-group-title">Categories</h4>
                            <ul class="offer-filter-cat-list">
                                <?php foreach ($category_list as $row) :
                                    $term = $row['term'];
                                    $active = ((int) $args['category'] === (int) $term->term_id);
                                    $cat_url = esc_url($base_path . $term->slug . '/'); ?>
                                    <li>
                                        <a href="<?php echo $cat_url; ?>" class="offer-filter-cat<?php echo $active ? ' is-active' : ''; ?>"
                                           data-cat="<?php echo esc_attr($term->term_id); ?>"
                                           data-cat-slug="<?php echo esc_attr($term->slug); ?>">
                                            <span class="offer-filter-cat-name"><?php echo esc_html($term->name); ?></span>
                                            <span class="offer-filter-cat-count">(<?php echo (int) $row['count']; ?>)</span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="offer-filter-group offer-filter-filters">
                        <h4 class="offer-filter-group-title">Filters</h4>
                        <?php foreach ($tax_config as $slug => $cfg) :
                            $terms = get_terms(array('taxonomy' => $slug, 'hide_empty' => false));
                            if (is_wp_error($terms) || empty($terms)) {
                                continue;
                            }
                            $selected   = $args['tax'][$slug] ?? array();
                            $is_accordion = ($cfg['control'] === 'accordion');
                            $open       = !$is_accordion || !empty($selected);
                            ?>
                            <div class="offer-filter-tax offer-filter-tax--<?php echo esc_attr($cfg['control']); ?><?php echo $open ? ' is-open' : ''; ?>"
                                 data-taxonomy="<?php echo esc_attr($slug); ?>">
                                <?php if ($is_accordion) : ?>
                                    <button type="button" class="offer-filter-tax-toggle">
                                        <?php echo esc_html($cfg['label']); ?>
                                        <span class="offer-filter-tax-chevron dashicons dashicons-arrow-down-alt2" aria-hidden="true"></span>
                                    </button>
                                <?php else : ?>
                                    <span class="offer-filter-tax-label"><?php echo esc_html($cfg['label']); ?></span>
                                <?php endif; ?>
                                <div class="offer-filter-tax-body">
                                    <?php foreach ($terms as $term) : ?>
                                        <label class="offer-filter-check">
                                            <input type="checkbox" name="of_tax[<?php echo esc_attr($slug); ?>][]"
                                                   value="<?php echo esc_attr($term->term_id); ?>"
                                                   <?php checked(in_array((int) $term->term_id, array_map('intval', $selected), true)); ?>>
                                            <span class="offer-filter-box" aria-hidden="true"></span>
                                            <span class="offer-filter-check-label"><?php echo esc_html($term->name); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="button" class="offer-filter-reset">RESET ALL</button>

                    <button type="button" class="offer-filter-apply">Search</button>

                    <div class="offer-filter-ad-bottom-sidebar-wrap">
                        <?php echo function_exists('trb_render_picks_ad') ? trb_render_picks_ad($category_id, 'bottom_sidebar', 'medium', 'offer-filter-ad offer-filter-ad--sidebar') : ''; ?>
                    </div>
                </form>
            </aside>

            <div class="offer-filter-overlay" hidden></div>

            <div class="offer-filter-main">
                <div class="offer-filter-toolbar">
                    <span class="offer-filter-count"><?php echo esc_html($results['count']); ?></span>
                    <label class="offer-filter-sort">
                        <span class="offer-filter-sort-label">Sort by:</span>
                        <select class="offer-filter-sort-select" name="of_sort">
                            <?php foreach ($sort_options as $value => $opt) : ?>
                                <option value="<?php echo esc_attr($value); ?>" <?php selected($args['sort'], $value); ?>><?php echo esc_html($opt['label']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>

                <div class="offer-filter-ad-above-wrap">
                    <?php echo function_exists('trb_render_picks_ad') ? trb_render_picks_ad($category_id, 'above_result', 'large', 'offer-filter-ad offer-filter-ad--banner') : ''; ?>
                </div>

                <div class="offer-filter-results">
                    <div class="product-widget--holder style-2 offer-slider offer-filter-grid">
                        <div class="product-widget--inner offer-filter-grid-inner">
                            <?php echo $results['grid']; ?>
                        </div>
                    </div>
                    <div class="offer-filter-pagination-wrap">
                        <?php echo $results['pagination']; ?>
                    </div>
                    <div class="offer-filter-loading" hidden><span class="offer-filter-spinner"></span></div>
                </div>

                <div class="offer-filter-ad-below-wrap">
                    <?php echo function_exists('trb_render_picks_ad') ? trb_render_picks_ad($category_id, 'below_result', 'large', 'offer-filter-ad offer-filter-ad--banner') : ''; ?>
                </div>
            </div>
        </div>
    </div>
</div>