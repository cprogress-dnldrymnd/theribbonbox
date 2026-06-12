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

    return array(
        'search'   => isset($raw['of_s']) ? sanitize_text_field(wp_unslash($raw['of_s'])) : '',
        'category' => isset($raw['of_cat']) ? absint($raw['of_cat']) : 0,
        'tax'      => $tax,
        'sort'     => (isset($raw['of_sort']) && in_array($raw['of_sort'], $sort_keys, true)) ? $raw['of_sort'] : 'date_desc',
        'paged'    => isset($raw['of_paged']) ? max(1, absint($raw['of_paged'])) : 1,
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

    // Preserve current filter state in the link URLs.
    $base_query = array_filter(array(
        'of_s'    => $args['search'],
        'of_cat'  => $args['category'] ?: null,
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
