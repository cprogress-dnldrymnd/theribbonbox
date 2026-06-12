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
    $cat_name = !empty($cats) ? $cats[0]->name : '';

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
                <div class="product-cat"><?php echo esc_html($cat_name); ?></div>
            <?php endif; ?>
            <h3 class="product-name"><a href="<?php echo esc_url($url); ?>"<?php echo $target; ?>><?php echo esc_html(get_the_title($offer_id)); ?></a></h3>
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
    $grid_ads = isset($settings['grid_ads']) && is_array($settings['grid_ads']) ? $settings['grid_ads'] : array();

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

        // Grid ads sit at the end of the grid, on the first page only.
        if ((int) $args['paged'] === 1) {
            foreach ($grid_ads as $ad) {
                if (empty($ad['image'])) {
                    continue;
                }
                echo trb_render_offer_ad(
                    $ad['image'],
                    $ad['link'] ?? '',
                    'medium',
                    'product-widget--box offer-filter-ad offer-filter-ad--grid'
                );
            }
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

    $args = trb_offer_filter_parse_request($_POST);
    $settings = array(
        'per_page' => isset($_POST['per_page']) ? absint($_POST['per_page']) : 15,
        'grid_ads' => array(),
    );
    if (!empty($_POST['grid_ads']) && is_array($_POST['grid_ads'])) {
        foreach ($_POST['grid_ads'] as $ad) {
            $settings['grid_ads'][] = array(
                'image' => absint($ad['image'] ?? 0),
                'link'  => esc_url_raw($ad['link'] ?? ''),
            );
        }
    }

    wp_send_json_success(trb_offer_filter_get_results($args, $settings));
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
    define('TRB_OFFER_FILTER_REWRITE_VERSION', '1.0.0');
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
 * IDs of pages that render an Offer Filter section (Page Builder template + a
 * saved "offer_filter" section). Cached; see trb_offer_filter_clear_caches().
 *
 * @return int[]
 */
function trb_offer_filter_host_page_ids()
{
    $cached = get_transient('trb_offer_filter_host_pages');
    if (is_array($cached)) {
        return $cached;
    }

    $ids = get_posts(array(
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'   => '_wp_page_template',
                'value' => 'page-template-builder.php',
            ),
            array(
                'key'     => '_trb_page_builder_sections',
                'value'   => '"type":"offer_filter"',
                'compare' => 'LIKE',
            ),
        ),
    ));

    $ids = array_map('intval', (array) $ids);
    set_transient('trb_offer_filter_host_pages', $ids, DAY_IN_SECONDS);
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
    foreach (trb_offer_filter_get_categories() as $row) {
        $slug = sanitize_title($row['term']->slug);
        if ($slug !== '') {
            $slugs[] = preg_quote($slug, '#');
        }
    }
    if (empty($slugs)) {
        return;
    }
    $slug_regex = implode('|', $slugs);

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
 */
add_action('init', 'trb_offer_filter_maybe_flush', 11);
function trb_offer_filter_maybe_flush()
{
    $needs_flush = get_option('trb_offer_filter_flush_needed')
        || get_option('trb_offer_filter_rewrite_version') !== TRB_OFFER_FILTER_REWRITE_VERSION;
    if ($needs_flush) {
        flush_rewrite_rules(false);
        delete_option('trb_offer_filter_flush_needed');
        update_option('trb_offer_filter_rewrite_version', TRB_OFFER_FILTER_REWRITE_VERSION, false);
    }
}
