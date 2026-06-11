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
$top_banner  = absint($section['top_banner'] ?? 0);
$top_banner_link = $section['top_banner_link'] ?? '';

$sidebar_ads = isset($section['sidebar_ads']) && is_array($section['sidebar_ads']) ? $section['sidebar_ads'] : array();
$grid_ads    = isset($section['grid_ads']) && is_array($section['grid_ads']) ? $section['grid_ads'] : array();

// Enqueue the AJAX script (registered in functions/offer-filter.php) and the
// Dashicons used by the accordion chevron + pagination (not loaded on the front
// end for logged-out visitors by default).
wp_enqueue_script('trb-offer-filter');
wp_enqueue_style('dashicons');

// Parse the current request so a direct URL (?of_paged=2&of_cat=…) renders correctly.
$args     = trb_offer_filter_parse_request($_GET);
$settings = array('per_page' => $per_page, 'grid_ads' => $grid_ads);
$results  = trb_offer_filter_get_results($args, $settings);

$sort_options = trb_offer_filter_sort_options();
$tax_config   = trb_offer_filter_taxonomies();

// Categories shown in the sidebar: top-level categories that have offer-items,
// with a per-offer-type count.
$category_terms = get_terms(array(
    'taxonomy'   => 'category',
    'parent'     => 0,
    'hide_empty' => false,
));
$category_list = array();
if (!is_wp_error($category_terms)) {
    foreach ($category_terms as $term) {
        $c = new WP_Query(array(
            'post_type'      => 'offer-items',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'fields'         => 'ids',
            'no_found_rows'  => false,
            'cat'            => $term->term_id,
        ));
        if ($c->found_posts > 0) {
            $category_list[] = array('term' => $term, 'count' => (int) $c->found_posts);
        }
    }
}

// Config the script needs to rebuild AJAX requests (per_page + grid ads).
$instance = 'offer-filter-' . absint($section_index ?? 0);
$js_config = array(
    'perPage' => $per_page,
    'gridAds' => array_values(array_filter(array_map(function ($ad) {
        $image = absint($ad['image'] ?? 0);
        return $image ? array('image' => $image, 'link' => $ad['link'] ?? '') : null;
    }, $grid_ads))),
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

        <div class="offer-filter-layout">
            <!-- ------------------------------------------------------- Sidebar -->
            <aside class="offer-filter-sidebar">
                <form class="offer-filter-form" onsubmit="return false;">
                    <h3 class="offer-filter-sidebar-title">Search &amp; Filter</h3>

                    <div class="offer-filter-search">
                        <input type="search" name="of_s" class="offer-filter-search-input"
                               value="<?php echo esc_attr($args['search']); ?>" placeholder="Search…" autocomplete="off">
                    </div>

                    <?php // First sidebar sponsored ad.
                    if (!empty($sidebar_ads[0]['image'])) {
                        echo trb_render_offer_ad($sidebar_ads[0]['image'], $sidebar_ads[0]['link'] ?? '', 'medium', 'offer-filter-ad offer-filter-ad--sidebar');
                    } ?>

                    <?php if (!empty($category_list)) : ?>
                        <div class="offer-filter-group offer-filter-categories">
                            <h4 class="offer-filter-group-title">Categories</h4>
                            <ul class="offer-filter-cat-list">
                                <?php foreach ($category_list as $row) :
                                    $term = $row['term'];
                                    $active = ((int) $args['category'] === (int) $term->term_id); ?>
                                    <li>
                                        <a href="#" class="offer-filter-cat<?php echo $active ? ' is-active' : ''; ?>"
                                           data-cat="<?php echo esc_attr($term->term_id); ?>">
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
                                            <span><?php echo esc_html($term->name); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="button" class="offer-filter-reset">RESET ALL</button>

                    <?php // Second sidebar sponsored ad.
                    if (!empty($sidebar_ads[1]['image'])) {
                        echo trb_render_offer_ad($sidebar_ads[1]['image'], $sidebar_ads[1]['link'] ?? '', 'medium', 'offer-filter-ad offer-filter-ad--sidebar');
                    } ?>
                </form>
            </aside>

            <!-- ----------------------------------------------------- Results -->
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

                <?php if ($top_banner) :
                    echo trb_render_offer_ad($top_banner, $top_banner_link, 'large', 'offer-filter-ad offer-filter-ad--banner'); ?>
                <?php endif; ?>

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
            </div>
        </div>
    </div>
</div>
