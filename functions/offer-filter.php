<?php
/**
 * Offer Items — Search & Filter
 *
 * Provides:
 *   - trb_render_offer_card()        Reusable ".product-widget--box" card (shared by the
 *                                    Offer Slider and the Offer Filter grid).
 *   - trb_offer_filter_get_results() Query + render the results grid, count and pagination.
 *   - AJAX handler                   Search / sort / reset / pagination without a reload.
 *   - Asset registration             js/offer-filter.js + localized ajax url / nonce.
 *
 * The custom "offer-items" taxonomies live in functions/custom-taxonomies.php.
 */

if (!defined('ABSPATH')) {
    exit;
}

/* -------------------------------------------------------------------------- */
/* Config                                                                     */
/* -------------------------------------------------------------------------- */

/**
 * Taxonomies shown as filter groups in the sidebar, in display order.
 * 'control' is how the terms are presented: 'checkbox' (always open) or
 * 'accordion' (collapsible list of checkboxes).
 */
function trb_offer_filter_taxonomies()
{
    return array(
        'health-goal'    => array('label' => 'Health Goal', 'control' => 'accordion'),
        'lifestyle'      => array('label' => 'Lifestyle', 'control' => 'accordion'),
        'life-stage'     => array('label' => 'Life Stage', 'control' => 'accordion'),
        'discount-level' => array('label' => 'Discount Level', 'control' => 'accordion'),
    );
}

/**
 * Sort options: request value => array(label, orderby, order).
 */
function trb_offer_filter_sort_options()
{
    return array(
        'date_desc'  => array('label' => 'Date added', 'orderby' => 'date', 'order' => 'DESC'),
        'date_asc'   => array('label' => 'Oldest first', 'orderby' => 'date', 'order' => 'ASC'),
        'title_asc'  => array('label' => 'Name (A–Z)', 'orderby' => 'title', 'order' => 'ASC'),
        'title_desc' => array('label' => 'Name (Z–A)', 'orderby' => 'title', 'order' => 'DESC'),
    );
}

/* -------------------------------------------------------------------------- */
/* Reusable offer card                                                        */
/* -------------------------------------------------------------------------- */

/**
 * Render a single offer as a ".product-widget--box" card and return the HTML.
 *
 * Shared by the Offer Slider carousel and the Offer Filter grid so the card
 * markup lives in one place.
 *
 * @param int   $offer_id Offer post ID.
 * @param array $args {
 *     @type string $cta_text      CTA link label. Default 'Claim Discount'.
 *     @type bool   $show_discount Show the "X% Off" line (from the ACF percentage field).
 *     @type string $image_size    Thumbnail size. Default 'medium'.
 *     @type string $extra_class   Extra class added to .product-widget--box.
 * }
 * @return string
 */
function trb_render_offer_card($offer_id, $args = array())
{
    $args = wp_parse_args($args, array(
        'cta_text'      => 'Claim Discount',
        'show_discount' => false,
        'image_size'    => 'medium',
        'extra_class'   => '',
    ));

    $has_acf = function_exists('get_field');

    // Link: external website_link (new tab) or the post permalink.
    $website_link = $has_acf ? get_field('website_link', $offer_id) : '';
    $url    = $website_link ?: get_permalink($offer_id);
    $target = $website_link ? ' target="_blank" rel="noopener"' : '';

    // Image: featured image, else the ACF large image, else nothing.
    $img_html = '';
    if (has_post_thumbnail($offer_id)) {
        $img_html = get_the_post_thumbnail($offer_id, $args['image_size']);
    } elseif ($has_acf) {
        $acf_img = get_field('post_large_image', $offer_id);
        $acf_url = is_array($acf_img) ? ($acf_img['url'] ?? '') : $acf_img;
        if ($acf_url) {
            $img_html = '<img src="' . esc_url($acf_url) . '" alt="' . esc_attr(get_the_title($offer_id)) . '">';
        }
    }

    $cats     = get_the_category($offer_id);
    $cat_term = !empty($cats) ? $cats[0] : null;
    $cat_name = $cat_term ? $cat_term->name : '';
    $cat_url  = $cat_term ? trb_offer_category_url($cat_term) : '';

    // The offer title may carry light inline formatting (e.g. "<i>code name</i>");
    // allow a small whitelist so it renders instead of showing the literal tags.
    $title_allowed = array(
        'i'      => array(),
        'em'     => array(),
        'b'      => array(),
        'strong' => array(),
        'span'   => array('class' => array()),
        'br'     => array(),
    );

    // Badges shown on the card: the "featured" ACF flag plus "lifestyle" terms.
    $badges = array();
    if ($has_acf && get_field('featured', $offer_id)) {
        $badges[] = array('label' => 'Featured', 'class' => 'offer-badge--featured');
    }
    $lifestyle_terms = get_the_terms($offer_id, 'lifestyle');
    if ($lifestyle_terms && !is_wp_error($lifestyle_terms)) {
        foreach ($lifestyle_terms as $term) {
            $badges[] = array(
                'label' => $term->name,
                'class' => 'offer-badge--lifestyle offer-badge--' . $term->slug,
            );
        }
    }
    // Show at most two badges per offer (Featured takes priority, added first).
    $badges = array_slice($badges, 0, 2);

    // Discount line, e.g. "10% Off".
    $discount = '';
    if ($args['show_discount'] && $has_acf) {
        $pct = trim((string) get_field('percentage-0ff', $offer_id));
        if ($pct !== '') {
            $discount = (stripos($pct, 'off') !== false) ? $pct : $pct . ' Off';
        }
    }

    // Discount code shown in a copy-to-clipboard box (js/offer-copy-code.js).
    $code = $has_acf ? trim((string) get_field('apply__code', $offer_id)) : '';

    $box_class = 'product-widget--box';
    if ($args['extra_class'] !== '') {
        $box_class .= ' ' . $args['extra_class'];
    }

    ob_start();
    ?>
    <div class="<?php echo esc_attr($box_class); ?>">
        <?php if ($img_html) : ?>
            <div class="product-widget--image">
                <a href="<?php echo esc_url($url); ?>"<?php echo $target; ?>><?php echo $img_html; ?></a>
            </div>
        <?php endif; ?>
        <div class="product-widget--content">
            <?php if ($cat_name) : ?>
                <div class="product-cat">
                    <?php if ($cat_url) : ?>
                        <a href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
                    <?php else : ?>
                        <?php echo esc_html($cat_name); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <h3 class="product-name"><a href="<?php echo esc_url($url); ?>"<?php echo $target; ?>><?php echo wp_kses(get_the_title($offer_id), $title_allowed); ?></a></h3>
            <?php if (!empty($badges)) : ?>
                <div class="offer-badges">
                    <?php foreach ($badges as $badge) : ?>
                        <span class="offer-badge <?php echo esc_attr($badge['class']); ?>"><?php echo esc_html($badge['label']); ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if ($discount !== '') : ?>
                <div class="product-discount"><?php echo esc_html($discount); ?></div>
            <?php endif; ?>
            <?php if ($code !== '') : ?>
                <div class="product-code">
                    <span class="product-code-value"><?php echo esc_html($code); ?></span>
                    <button type="button" class="product-code-copy" data-code="<?php echo esc_attr($code); ?>" aria-label="Copy discount code <?php echo esc_attr($code); ?>">
                        <span class="product-code-copy-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                        </span>
                        <span class="product-code-copy-done" aria-hidden="true">Copied!</span>
                    </button>
                </div>
            <?php endif; ?>
            <?php if ($args['cta_text'] !== '') : ?>
                <div class="product-widget--cta"><a href="<?php echo esc_url($url); ?>"<?php echo $target; ?>><?php echo esc_html($args['cta_text']); ?></a></div>
            <?php endif; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * URL for an offer card's clickable category chip: the Offer Filter page filtered
 * by that category (pretty /{page-path}/{slug}/ URL) when such a page exists, else
 * the standard category archive as a fallback.
 *
 * @param WP_Term $term Category term.
 * @return string
 */
function trb_offer_category_url($term)
{
    if (!$term || is_wp_error($term) || empty($term->slug)) {
        return '';
    }
    $host_ids = trb_offer_filter_host_page_ids();
    if (!empty($host_ids)) {
        $base = get_permalink($host_ids[0]);
        if ($base) {
            // Only emit the pretty /{host}/{slug}/ URL when a matching rewrite
            // rule exists for this slug (i.e. the category has published offers).
            // Otherwise the URL has no rule and WordPress 404-guesses it back to
            // the article landing page, so fall back to the unfiltered discounts
            // hub rather than the category archive.
            $known = trb_offer_filter_get_offer_category_slugs();
            if (in_array($term->slug, $known, true)) {
                return trailingslashit($base) . $term->slug . '/';
            }
            return trailingslashit($base);
        }
    }
    $link = get_category_link($term->term_id);
    return is_wp_error($link) ? '' : $link;
}

/**
 * Render an image "ad" card (sidebar or grid), optionally linked, with a
 * "Sponsored" tag. Returns '' when no image is set.
 *
 * @param int    $image_id   Attachment ID.
 * @param string $link       Optional URL.
 * @param string $size       Image size.
 * @param string $wrap_class Wrapper class.
 * @return string
 */
function trb_render_offer_ad($image_id, $link = '', $size = 'medium', $wrap_class = 'offer-filter-ad')
{
    $image_id = absint($image_id);
    if (!$image_id) {
        return '';
    }
    $img = wp_get_attachment_image($image_id, $size, false, array('loading' => 'lazy'));
    if (!$img) {
        return '';
    }

    $inner = $link
        ? '<a href="' . esc_url($link) . '" target="_blank" rel="noopener nofollow">' . $img . '</a>'
        : $img;

    return '<div class="' . esc_attr($wrap_class) . '"><span class="offer-filter-sponsored">Sponsored</span>' . $inner . '</div>';
}

/* -------------------------------------------------------------------------- */
/* trb-picks-ad helpers                                                       */
/* -------------------------------------------------------------------------- */

/**
 * Fetch one trb-picks-ad post for the given location and category.
 * Tries category-specific ads first; falls back to any published ad for that
 * location if none match the category (or if no category is given).
 * Returns null if no ad with a featured image exists for that location.
 *
 * @param int    $category_id WP category term ID (0 = no category filter).
 * @param string $location    grid | top_sidebar | bottom_sidebar | above_result | below_result
 * @return array|null { image: int, link: string } or null.
 */
function trb_get_picks_ad($category_id, $location)
{
    $valid = array('grid', 'top_sidebar', 'bottom_sidebar', 'above_result', 'below_result');
    if (!in_array($location, $valid, true)) {
        return null;
    }

    $base_args = array(
        'post_type'      => 'trb-picks-ad',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'     => 'ad_location',
                'value'   => $location,
                'compare' => '=',
            ),
        ),
    );

    // Try category-specific first (exact match only — exclude child categories).
    if ($category_id) {
        $cat_args = $base_args;
        $cat_args['tax_query'] = array(
            array(
                'taxonomy'         => 'category',
                'field'            => 'term_id',
                'terms'            => array((int) $category_id),
                'include_children' => false,
            ),
        );
        $posts = get_posts($cat_args);
        if (!empty($posts)) {
            $ad = trb_picks_ad_to_array($posts[array_rand($posts)]);
            if ($ad) {
                return $ad;
            }
        }
    }

    // Fallback: any ad for this location.
    $posts = get_posts($base_args);
    if (empty($posts)) {
        return null;
    }
    shuffle($posts);
    foreach ($posts as $post) {
        $ad = trb_picks_ad_to_array($post);
        if ($ad) {
            return $ad;
        }
    }
    return null;
}

/**
 * Convert a trb-picks-ad post to the { image, link } array expected by trb_render_offer_ad().
 * Returns null if the post has no featured image.
 *
 * @param WP_Post $post
 * @return array|null
 */
function trb_picks_ad_to_array($post)
{
    $image_id = (int) get_post_thumbnail_id($post->ID);
    if (!$image_id) {
        return null;
    }
    $link = function_exists('get_field') ? (string) get_field('ad_url', $post->ID) : '';
    return array('image' => $image_id, 'link' => $link);
}

/**
 * Render the HTML for a trb-picks-ad at the given location and category.
 * Returns '' if no matching ad is found.
 *
 * @param int    $category_id
 * @param string $location    grid | top_sidebar | bottom_sidebar | above_result | below_result
 * @param string $size        Image size passed to wp_get_attachment_image().
 * @param string $wrap_class  CSS class(es) for the wrapper div.
 * @return string
 */
function trb_render_picks_ad($category_id, $location, $size = 'medium', $wrap_class = 'offer-filter-ad')
{
    $ad = trb_get_picks_ad((int) $category_id, $location);
    if (!$ad) {
        return '';
    }
    return trb_render_offer_ad($ad['image'], $ad['link'], $size, $wrap_class);
}

/* -------------------------------------------------------------------------- */
/* Query + render results                                                     */
/* -------------------------------------------------------------------------- */

/**
 * Normalise filter arguments from a raw request-style array.
 *
 * @param array $raw Usually $_GET or the AJAX payload.
 * @return array Clean args: search, category, tax (slug => int[] term ids), sort, paged.
 */
function trb_offer_filter_parse_request($raw)
{
    $tax = array();
    $raw_tax = isset($raw['of_tax']) && is_array($raw['of_tax']) ? $raw['of_tax'] : array();
    foreach (trb_offer_filter_taxonomies() as $slug => $cfg) {
        if (!empty($raw_tax[$slug])) {
            $terms = is_array($raw_tax[$slug]) ? $raw_tax[$slug] : explode(',', (string) $raw_tax[$slug]);
            $terms = array_values(array_filter(array_map('absint', $terms)));
            if ($terms) {
                $tax[$slug] = $terms;
            }
        }
    }

    $sort_keys = array_keys(trb_offer_filter_sort_options());

    // Category: an explicit ?of_cat=ID wins; otherwise fall back to the pretty
    // /{page}/{category-slug}/ URL captured into the of_cat_slug query var.
    $category      = isset($raw['of_cat']) ? absint($raw['of_cat']) : 0;
    $cat_from_slug = false;
    if (!$category) {
        $cat_slug = get_query_var('of_cat_slug');
        if ($cat_slug) {
            $term = get_term_by('slug', sanitize_title($cat_slug), 'category');
            if ($term && !is_wp_error($term)) {
                $category      = (int) $term->term_id;
                $cat_from_slug = true;
            }
        }
    }

    return array(
        'search'        => isset($raw['of_s']) ? sanitize_text_field(wp_unslash($raw['of_s'])) : '',
        'category'      => $category,
        'cat_from_slug' => $cat_from_slug,
        'tax'           => $tax,
        'sort'          => (isset($raw['of_sort']) && in_array($raw['of_sort'], $sort_keys, true)) ? $raw['of_sort'] : 'date_desc',
        'paged'         => isset($raw['of_paged']) ? max(1, absint($raw['of_paged'])) : 1,
    );
}

/**
 * Build the WP_Query, render the cards grid, and return its parts.
 *
 * @param array $args     Parsed filter args (see trb_offer_filter_parse_request()).
 * @param array $settings Section settings: per_page (int), grid_ads (array of [image, link]).
 * @return array { string grid, string pagination, string count, int total }
 */
function trb_offer_filter_get_results($args, $settings = array())
{
    $per_page = max(1, absint($settings['per_page'] ?? 15));
    $grid_ad  = isset($settings['grid_ad']) && is_array($settings['grid_ad']) ? $settings['grid_ad'] : null;

    $sort_options = trb_offer_filter_sort_options();
    $sort = $sort_options[$args['sort']] ?? $sort_options['date_desc'];

    $query_args = array(
        'post_type'      => 'offer-items',
        'post_status'    => 'publish',
        'posts_per_page' => $per_page,
        'paged'          => $args['paged'],
        'orderby'        => $sort['orderby'],
        'order'          => $sort['order'],
        's'              => $args['search'],
    );

    // Category (standard taxonomy) + custom taxonomy filters.
    $tax_query = array();
    if (!empty($args['category'])) {
        $tax_query[] = array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => array($args['category']),
        );
    }
    foreach ($args['tax'] as $slug => $term_ids) {
        $tax_query[] = array(
            'taxonomy' => $slug,
            'field'    => 'term_id',
            'terms'    => $term_ids,
            'operator' => 'IN',
        );
    }
    if (count($tax_query) > 1) {
        $tax_query['relation'] = 'AND';
    }
    if ($tax_query) {
        $query_args['tax_query'] = $tax_query;
    }

    $query = new WP_Query($query_args);

    // ---- Grid markup ----
    ob_start();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            echo trb_render_offer_card(get_the_ID(), array(
                'cta_text'      => 'Claim Discount',
                'show_discount' => true,
            ));
        }
        wp_reset_postdata();

        // Single grid ad pinned to the last cell of row 1 (css/page-builder.css).
        if ($grid_ad && !empty($grid_ad['image'])) {
            echo trb_render_offer_ad(
                $grid_ad['image'],
                $grid_ad['link'] ?? '',
                'medium',
                'product-widget--box offer-filter-ad offer-filter-ad--grid'
            );
        }
    } else {
        echo '<p class="offer-filter-empty">No offers match your filters. Try adjusting your search.</p>';
    }
    $grid = ob_get_clean();

    // ---- Count text ----
    // Show the range of results on the current page, e.g. "Displaying 16–30 of
    // 35 results", so pages beyond the first read correctly.
    $total     = (int) $query->found_posts;
    $displayed = (int) $query->post_count;
    if ($total > 0 && $displayed > 0) {
        $start = ($args['paged'] - 1) * $per_page + 1;
        $end   = $start + $displayed - 1;
        if ($start === $end) {
            $count = sprintf('Displaying %d of %d result%s', $start, $total, $total === 1 ? '' : 's');
        } else {
            $count = sprintf('Displaying %d–%d of %d results', $start, $end, $total);
        }
    } else {
        $count = 'No results found';
    }

    // ---- Pagination ----
    $pagination = trb_offer_filter_pagination($args['paged'], (int) $query->max_num_pages, $args);

    return array(
        'grid'       => $grid,
        'pagination' => $pagination,
        'count'      => $count,
        'total'      => $total,
    );
}

/**
 * Build AJAX-aware pagination. Links carry real ?of_paged URLs (so direct loads
 * and no-JS work) plus data-page (used by the AJAX handler).
 */
function trb_offer_filter_pagination($current, $max_pages, $args)
{
    if ($max_pages < 2) {
        return '';
    }
    $current = max(1, min($current, $max_pages));

    // Preserve current filter state in the link URLs. When the category came
    // from a pretty /{page}/{category-slug}/ URL it already lives in the path,
    // so we don't add a redundant ?of_cat= back onto the links.
    $base_query = array_filter(array(
        'of_s'    => $args['search'],
        'of_cat'  => empty($args['cat_from_slug']) ? ($args['category'] ?: null) : null,
        'of_sort' => $args['sort'] !== 'date_desc' ? $args['sort'] : null,
    ));
    if (!empty($args['tax'])) {
        $base_query['of_tax'] = $args['tax'];
    }

    $link = function ($page, $label, $class = '', $aria = '') use ($base_query) {
        $q = $base_query;
        if ($page > 1) {
            $q['of_paged'] = $page;
        }
        $url = esc_url(add_query_arg($q, remove_query_arg('of_paged')) . '#offer-filter');
        $cls = trim('offer-filter-page ' . $class);
        return '<a href="' . $url . '" class="' . esc_attr($cls) . '" data-page="' . esc_attr($page) . '"'
            . ($aria ? ' aria-label="' . esc_attr($aria) . '"' : '') . '>' . $label . '</a>';
    };

    // Windowed page list: first, last, and one page either side of the current,
    // with ellipses bridging the gaps (e.g. 1 … 4 5 6 … 12).
    $window = 1;
    $pages = array();
    for ($p = 1; $p <= $max_pages; $p++) {
        if ($p === 1 || $p === $max_pages || ($p >= $current - $window && $p <= $current + $window)) {
            $pages[] = $p;
        }
    }

    ob_start();
    echo '<nav class="offer-filter-pagination" aria-label="Offer results pages">';

    // Prev
    if ($current > 1) {
        echo $link($current - 1, '&lsaquo; Prev', 'offer-filter-page--prev', 'Previous page');
    } else {
        echo '<span class="offer-filter-page offer-filter-page--prev is-disabled">&lsaquo; Prev</span>';
    }

    // Numbered pages with ellipses.
    $prev_page = 0;
    foreach ($pages as $p) {
        if ($prev_page && $p - $prev_page > 1) {
            echo '<span class="offer-filter-page-ellipsis">…</span>';
        }
        if ($p === $current) {
            echo '<span class="offer-filter-page offer-filter-page--number is-current" aria-current="page">' . (int) $p . '</span>';
        } else {
            echo $link($p, (string) $p, 'offer-filter-page--number', 'Page ' . $p);
        }
        $prev_page = $p;
    }

    // Next
    if ($current < $max_pages) {
        echo $link($current + 1, 'Next &rsaquo;', 'offer-filter-page--next', 'Next page');
    } else {
        echo '<span class="offer-filter-page offer-filter-page--next is-disabled">Next &rsaquo;</span>';
    }

    echo '</nav>';
    return ob_get_clean();
}

/* -------------------------------------------------------------------------- */
/* AJAX                                                                        */
/* -------------------------------------------------------------------------- */

add_action('wp_ajax_trb_offer_filter', 'trb_offer_filter_ajax');
add_action('wp_ajax_nopriv_trb_offer_filter', 'trb_offer_filter_ajax');
function trb_offer_filter_ajax()
{
    check_ajax_referer('trb_offer_filter', 'nonce');

    $args        = trb_offer_filter_parse_request($_POST);
    $category_id = $args['category'];

    // Query all ad locations server-side so ads update on every category change.
    $grid_ad = trb_get_picks_ad($category_id, 'grid');

    $settings = array(
        'per_page' => isset($_POST['per_page']) ? absint($_POST['per_page']) : 15,
        'grid_ad'  => $grid_ad,
    );

    $results = trb_offer_filter_get_results($args, $settings);

    // Return rendered HTML for the non-grid ad locations so JS can update them.
    $results['top_sidebar_ad']  = trb_render_picks_ad($category_id, 'top_sidebar', 'medium', 'offer-filter-ad offer-filter-ad--sidebar');
    $results['bottom_sidebar_ad'] = trb_render_picks_ad($category_id, 'bottom_sidebar', 'medium', 'offer-filter-ad offer-filter-ad--sidebar');
    $results['above_ad']        = trb_render_picks_ad($category_id, 'above_result', 'large', 'offer-filter-ad offer-filter-ad--banner');
    $results['below_ad']        = trb_render_picks_ad($category_id, 'below_result', 'large', 'offer-filter-ad offer-filter-ad--banner');
    $results['has_grid_ad']     = $grid_ad !== null;

    wp_send_json_success($results);
}

/* -------------------------------------------------------------------------- */
/* Assets                                                                      */
/* -------------------------------------------------------------------------- */

/**
 * Register the front-end script. The section template enqueues it on demand so
 * it only loads on pages that actually use the Offer Filter section.
 */
add_action('wp_enqueue_scripts', 'trb_offer_filter_register_assets');
function trb_offer_filter_register_assets()
{
    $path = '/js/offer-filter.js';
    $abs  = get_stylesheet_directory() . $path;
    $ver  = file_exists($abs) ? filemtime($abs) : '1.0.0';

    wp_register_script('trb-offer-filter', get_stylesheet_directory_uri() . $path, array('jquery'), $ver, true);
    wp_localize_script('trb-offer-filter', 'TRB_OFFER_FILTER', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('trb_offer_filter'),
    ));
}

/* -------------------------------------------------------------------------- */
/* Pretty category URLs:  /{host-page-path}/{category-slug}/                  */
/* -------------------------------------------------------------------------- */

if (!defined('TRB_OFFER_FILTER_REWRITE_VERSION')) {
    // Bump to force a one-time rewrite-rule flush after deploying changes here.
    define('TRB_OFFER_FILTER_REWRITE_VERSION', '1.2.0');
}

/**
 * Categories shown in the filter sidebar: top-level categories that have at
 * least one published offer-item, with a per-offer count.
 *
 * Runs a query per term, so the result is cached; the cache is cleared whenever
 * offers, categories or builder pages change (see trb_offer_filter_clear_caches()).
 *
 * @return array[] List of array('term' => WP_Term, 'count' => int).
 */
function trb_offer_filter_get_categories()
{
    $cached = get_transient('trb_offer_filter_categories');
    if (is_array($cached)) {
        return $cached;
    }

    $list  = array();
    $terms = get_terms(array(
        'taxonomy'   => 'category',
        'parent'     => 0,
        'hide_empty' => false,
    ));
    if (!is_wp_error($terms)) {
        foreach ($terms as $term) {
            $c = new WP_Query(array(
                'post_type'      => 'offer-items',
                'post_status'    => 'publish',
                'posts_per_page' => 1,
                'fields'         => 'ids',
                'no_found_rows'  => false,
                'cat'            => $term->term_id,
            ));
            if ($c->found_posts > 0) {
                $list[] = array('term' => $term, 'count' => (int) $c->found_posts);
            }
        }
    }

    set_transient('trb_offer_filter_categories', $list, DAY_IN_SECONDS);
    return $list;
}

/**
 * Slugs of every category (any depth) attached to a published offer-item, PLUS
 * the ancestors of those categories. This is the set of slugs that can appear in
 * an offer card's category chip / "All … discounts" link (trb_offer_category_url())
 * or be used as a parent-category filter, so the pretty-URL rewrite rules are
 * built from this list to keep the two in sync — otherwise a link to
 * /{host}/{slug}/ has no matching rule and WordPress redirects it to the
 * article landing page.
 *
 * Cached; the transient is cleared in trb_offer_filter_clear_caches().
 *
 * @return array<int,string> term_id => slug
 */
function trb_offer_filter_get_offer_category_slugs()
{
    $cached = get_transient('trb_offer_filter_offer_cat_slugs');
    if (is_array($cached)) {
        return $cached;
    }

    $slugs     = array();
    $offer_ids = get_posts(array(
        'post_type'      => 'offer-items',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'no_found_rows'  => true,
    ));
    if (!empty($offer_ids)) {
        $terms = wp_get_object_terms($offer_ids, 'category');
        if (!is_wp_error($terms)) {
            foreach ($terms as $term) {
                // Include the term itself AND its ancestors. Filtering by a parent
                // category (WP_Query 'cat') includes offers from its child
                // categories, so a parent like "fertility" must get a rewrite rule
                // even when offers are only assigned to its subcategories —
                // otherwise /{host}/fertility/ has no rule and 404-redirects to
                // the article landing page.
                $branch = array_merge(
                    array((int) $term->term_id),
                    get_ancestors((int) $term->term_id, 'category')
                );
                foreach ($branch as $tid) {
                    $tid = (int) $tid;
                    if (isset($slugs[$tid])) {
                        continue;
                    }
                    $branch_term = ($tid === (int) $term->term_id) ? $term : get_term($tid, 'category');
                    if ($branch_term && !is_wp_error($branch_term)) {
                        $slug = sanitize_title($branch_term->slug);
                        if ($slug !== '') {
                            $slugs[$tid] = $slug;
                        }
                    }
                }
            }
        }
    }

    // Only cache a non-empty result. Caching an empty array (e.g. from a transient
    // query glitch) for a full day would lock out both the rewrite rule and the
    // request-filter safety net until the cache expired.
    if (!empty($slugs)) {
        set_transient('trb_offer_filter_offer_cat_slugs', $slugs, DAY_IN_SECONDS);
    }
    return $slugs;
}

/**
 * IDs of pages that render an Offer Filter section (Page Builder template + a
 * saved "offer_filter" section). Cached; see trb_offer_filter_clear_caches().
 *
 * @return int[]
 */
function trb_offer_filter_host_page_ids()
{
    // Treat an empty cached array as a miss and recompute: the old detection query
    // cached empty results for a day, so a previously-broken lookup must not stay
    // stuck until the transient expires.
    $cached = get_transient('trb_offer_filter_host_pages');
    if (is_array($cached) && !empty($cached)) {
        return $cached;
    }

    // Find every Page Builder page, then check its actual parsed sections for an
    // "offer_filter" section. We deliberately do NOT meta_query for the section
    // type: sections are stored as a native PHP serialized array
    // (s:4:"type";s:12:"offer_filter";), so a JSON-style LIKE '"type":"offer_filter"'
    // silently matches nothing once a page is saved in the current format —
    // trb_get_builder_sections() handles both the array and legacy JSON formats.
    $builder_ids = get_posts(array(
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'meta_query'     => array(
            array(
                'key'   => '_wp_page_template',
                'value' => 'page-template-builder.php',
            ),
        ),
    ));

    $ids = array();
    foreach ((array) $builder_ids as $pid) {
        $sections = function_exists('trb_get_builder_sections')
            ? trb_get_builder_sections($pid)
            : array();
        foreach ((array) $sections as $section) {
            if (is_array($section) && isset($section['type']) && $section['type'] === 'offer_filter') {
                $ids[] = (int) $pid;
                break;
            }
        }
    }

    // Only cache a positive result. Caching an empty array (e.g. before the page
    // exists, or a transient glitch) would suppress the rewrite rule + resolver for
    // a full day — the same lockout that broke the pretty category URLs before.
    if (!empty($ids)) {
        set_transient('trb_offer_filter_host_pages', $ids, DAY_IN_SECONDS);
    }
    return $ids;
}

/**
 * Whether the given page renders an Offer Filter section.
 */
function trb_offer_filter_is_host_page($post_id)
{
    return in_array((int) $post_id, trb_offer_filter_host_page_ids(), true);
}

/**
 * Whitelist the of_cat_slug query var so WordPress carries it through the query.
 */
add_filter('query_vars', 'trb_offer_filter_query_vars');
function trb_offer_filter_query_vars($vars)
{
    $vars[] = 'of_cat_slug';
    return $vars;
}

/**
 * Map  {host-page-path}/{category-slug}/  to the host page with the category
 * preselected. One rule per host page; the trailing segment is constrained to
 * the known offer-category slugs so genuine child pages are not hijacked.
 */
add_action('init', 'trb_offer_filter_add_rewrite_rules', 10);
function trb_offer_filter_add_rewrite_rules()
{
    $page_ids = trb_offer_filter_host_page_ids();
    if (empty($page_ids)) {
        return;
    }

    $slugs = array();
    foreach (trb_offer_filter_get_offer_category_slugs() as $slug) {
        if ($slug !== '') {
            $slugs[] = preg_quote($slug, '#');
        }
    }
    if (empty($slugs)) {
        return;
    }
    $slug_regex = implode('|', array_unique($slugs));

    foreach ($page_ids as $page_id) {
        $uri = trim((string) get_page_uri($page_id), '/');
        if ($uri === '') {
            continue;
        }
        add_rewrite_rule(
            '^' . preg_quote($uri, '#') . '/(' . $slug_regex . ')/?$',
            'index.php?pagename=' . $uri . '&of_cat_slug=$matches[1]',
            'top'
        );
    }
}

/**
 * Flush-independent resolver for the pretty /{host-page}/{category-slug}/ URLs.
 *
 * The rewrite rule above only takes effect once it has been flushed into the
 * stored `rewrite_rules` option. In practice that flush is fragile (it relies on
 * flush_rewrite_rules() running in the right context after deploy, and a stale
 * flush can lock itself out), and when it hasn't run WordPress treats the pretty
 * URL as a 404 and "guesses" it to the /{slug}/ article landing page.
 *
 * This filter resolves the same URL directly from the raw request path on every
 * request, so the pretty URLs work whether or not the rewrite rule was flushed.
 * We split the last segment off the requested path (e.g.
 * "trb-picks/discounts/fertility") and, when the prefix is a known host page and
 * the last segment is a known offer-category slug, rewrite the request to the
 * host page with of_cat_slug set.
 */
add_filter('request', 'trb_offer_filter_resolve_pretty_request');
function trb_offer_filter_resolve_pretty_request($query_vars)
{
    if (is_admin()) {
        return $query_vars;
    }
    // Already resolved (e.g. by a flushed rewrite rule).
    if (!empty($query_vars['of_cat_slug'])) {
        return $query_vars;
    }

    // Use the raw matched request path ($wp->request) as the source of truth — it
    // is reliable regardless of which rewrite rule (or none) matched, unlike the
    // parsed 'pagename', which differs between verbose and non-verbose page rules.
    $path = '';
    if (isset($GLOBALS['wp']) && isset($GLOBALS['wp']->request)) {
        $path = (string) $GLOBALS['wp']->request;
    }
    if ($path === '' && !empty($query_vars['pagename'])) {
        $path = (string) $query_vars['pagename'];
    }
    $path = trim($path, '/');
    if ($path === '' || strpos($path, '/') === false) {
        return $query_vars;
    }

    $slash  = strrpos($path, '/');
    $prefix = substr($path, 0, $slash);
    $last   = substr($path, $slash + 1);
    if ($prefix === '' || $last === '') {
        return $query_vars;
    }

    // The trailing segment must be a known offer-category slug (same whitelist as
    // the rewrite rule) so genuine child pages are not hijacked.
    $slugs = trb_offer_filter_get_offer_category_slugs();
    if (!in_array($last, $slugs, true)) {
        return $query_vars;
    }

    // The prefix must be one of the offer-filter host pages.
    $host_ids = trb_offer_filter_host_page_ids();
    foreach ($host_ids as $hid) {
        if (trim((string) get_page_uri($hid), '/') === $prefix) {
            // Drop anything WP guessed from the unmatched path, then resolve to the
            // host page with the category preselected.
            unset($query_vars['error'], $query_vars['name'], $query_vars['page'], $query_vars['attachment']);
            $query_vars['pagename']    = $prefix;
            $query_vars['of_cat_slug'] = $last;
            return $query_vars;
        }
    }

    return $query_vars;
}

/**
 * Keep WordPress from canonical-redirecting our pretty category URLs back to the
 * bare page permalink.
 */
add_filter('redirect_canonical', 'trb_offer_filter_allow_pretty_urls', 10, 2);
function trb_offer_filter_allow_pretty_urls($redirect_url, $requested_url)
{
    if (get_query_var('of_cat_slug')) {
        return false;
    }
    return $redirect_url;
}

/**
 * 301-redirect legacy ?of_cat=ID requests on a host page to the pretty
 * /{page}/{category-slug}/ URL, preserving any other filter params.
 */
add_action('template_redirect', 'trb_offer_filter_legacy_cat_redirect');
function trb_offer_filter_legacy_cat_redirect()
{
    if (is_admin() || wp_doing_ajax() || !is_page()) {
        return;
    }
    if (empty($_GET['of_cat']) || get_query_var('of_cat_slug')) {
        return;
    }
    $post_id = get_queried_object_id();
    if (!$post_id || !trb_offer_filter_is_host_page($post_id)) {
        return;
    }
    $term = get_term(absint($_GET['of_cat']), 'category');
    if (!$term || is_wp_error($term)) {
        return;
    }

    $target = trailingslashit(get_permalink($post_id)) . $term->slug . '/';
    $extra  = wp_unslash($_GET);
    unset($extra['of_cat']);
    if (!empty($extra)) {
        $target = add_query_arg($extra, $target);
    }

    wp_safe_redirect($target . '#offer-filter', 301);
    exit;
}

/**
 * Clear cached host-page / category data and flag the rewrite rules to be
 * flushed on the next request. Rules are (re)built at `init`, so we can't safely
 * flush during the same request that changed the underlying data.
 */
function trb_offer_filter_clear_caches()
{
    delete_transient('trb_offer_filter_categories');
    delete_transient('trb_offer_filter_offer_cat_slugs');
    delete_transient('trb_offer_filter_host_pages');
    update_option('trb_offer_filter_flush_needed', 1, false);
}
add_action('save_post_page', 'trb_offer_filter_clear_caches');
add_action('save_post_offer-items', 'trb_offer_filter_clear_caches');
add_action('created_category', 'trb_offer_filter_clear_caches');
add_action('edited_category', 'trb_offer_filter_clear_caches');
add_action('delete_category', 'trb_offer_filter_clear_caches');
add_action('after_switch_theme', 'trb_offer_filter_clear_caches');

/**
 * Flush rewrite rules once after this code is deployed (version bump) or after a
 * change flagged a flush. Runs after the rules are registered at init:10.
 *
 * The version is only recorded as "done" once our rules were actually registered
 * this request (host page + at least one offer category present). Otherwise a
 * flush that happened to run in a context with no host page / no categories would
 * lock in the version and permanently disable future retries, leaving the pretty
 * category URLs 404-redirecting to the article landing pages.
 */
add_action('init', 'trb_offer_filter_maybe_flush', 11);
function trb_offer_filter_maybe_flush()
{
    $needs_flush = get_option('trb_offer_filter_flush_needed')
        || get_option('trb_offer_filter_rewrite_version') !== TRB_OFFER_FILTER_REWRITE_VERSION;
    if (!$needs_flush) {
        return;
    }

    $rules_registered = !empty(trb_offer_filter_host_page_ids())
        && !empty(trb_offer_filter_get_offer_category_slugs());

    flush_rewrite_rules(false);
    delete_option('trb_offer_filter_flush_needed');

    if ($rules_registered) {
        update_option('trb_offer_filter_rewrite_version', TRB_OFFER_FILTER_REWRITE_VERSION, false);
    }
}
