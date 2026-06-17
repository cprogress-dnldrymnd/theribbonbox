<?php

/**
 * Builder section: Offer Slider.
 * Expects $section (array) and $section_index (int) in scope.
 *
 * Renders a Swiper carousel of "offer-items" posts, chosen either manually or by
 * category. The custom first slide image is now a dynamic repeater pulling from the 
 * "trb-picks-ad" post type based on the selected category.
 * Reuses the .product-widget--* markup/classes so it matches the site product carousels.
 */

$title          = $section['title'] ?? '';
$source_mode    = $section['source_mode'] ?? 'manual';
$buttons        = isset($section['buttons']) && is_array($section['buttons']) ? $section['buttons'] : array();
$decorative_bar = ! empty($section['decorative_bar']);
$featured_only  = ! empty($section['featured_only']);
$term_id        = absint($section['category'] ?? 0); // Extracted for broader scope usage

// When "featured only" is on, restrict to offers whose ACF "featured" field is true.
$featured_meta = $featured_only ? array(
    array('key' => 'featured', 'value' => '1', 'compare' => '='),
) : array();

// Resolve which offer-items to show.
if ($featured_only) {
    // "Featured only" overrides the manual/category choice entirely.
    $count  = max(1, absint($section['count'] ?? 8));
    $offers = get_posts(array(
        'post_type'      => 'offer-items',
        'posts_per_page' => $count,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
        'meta_query'     => $featured_meta,
    ));
} elseif ($source_mode === 'category') {
    $count      = max(1, absint($section['count'] ?? 8));
    $query_args = array(
        'post_type'      => 'offer-items',
        'posts_per_page' => $count,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    if ($term_id) {
        $query_args['cat'] = $term_id;
    }
    $offers = get_posts($query_args);
} else {
    $ids    = isset($section['manual_items']) && is_array($section['manual_items']) ? array_filter(array_map('absint', $section['manual_items'])) : array();
    $offers = array();
    if (! empty($ids)) {
        $offers = get_posts(array(
            'post_type'      => 'offer-items',
            'post__in'       => $ids,
            'orderby'        => 'post__in',
            'posts_per_page' => count($ids),
            'post_status'    => 'publish',
        ));
    }
}

/**
 * Retrieve current ads from the 'trb-picks-ad' post type.
 * Ads are filtered by the selected category to dynamically populate the repeater elements.
 */
$ad_query_args = array(
    'post_type'      => 'trb-picks-ad',
    'posts_per_page' => -1, // Fetch all applicable ads
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
);

// Apply category filter if one is set in the section configuration
if ($term_id) {
    $ad_query_args['cat'] = $term_id;
}

$trb_ads = get_posts($ad_query_args);

// Nothing to show and no ads available — skip the section entirely.
if (empty($offers) && empty($trb_ads)) {
    return;
}

$unique_id = 'trb-offer-slider-' . absint($section_index ?? 0) . '-' . wp_rand(1000, 9999);

$swiper_config = array(
    'loop'           => false,
    'spaceBetween'   => 20,
    'autoplay'       => false,
    'observer'       => true,
    'observeParents' => true,
    'breakpoints'    => array(
        0   => array('slidesPerView' => 1.2),
        768 => array('slidesPerView' => 3),
        992 => array('slidesPerView' => 4),
    ),
);

$wrapper_classes = 'product-tabs offer-slider';
$wrapper_style   = '';
if ($decorative_bar) {
    $wrapper_classes .= ' trb-decor-bar';
    $decor_color = $section['decor_color'] ?? 'wine';
    if ($decor_color !== '') {
        $wrapper_style = ' style="--trb-decor-color: var(--trb-' . esc_attr($decor_color) . ');"';
    }
}
?>
<div class="<?php echo esc_attr($wrapper_classes); ?>" <?php echo $wrapper_style; ?>>
    <div class="container<?php echo $decorative_bar ? ' position-relative' : ''; ?>">
        <?php if ($title || ! empty($buttons)) : ?>
            <div class="nav-tabs-holder">
                <div class="nav-tabs-holder-inner carousel-with-nav-width d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <?php if ($title) : ?>
                        <h3 class="offer-slider-title trb-wine-color mb-0"><?php echo wp_kses_post($title); ?></h3>
                    <?php else : ?>
                        <span></span>
                    <?php endif; ?>

                    <?php if (! empty($buttons)) : ?>
                        <div class="offer-slider-buttons d-flex flex-wrap gap-3">
                            <?php foreach ($buttons as $button) :
                                $btn_text = $button['text'] ?? '';
                                $btn_link = $button['link'] ?? '';
                                if ($btn_text === '') {
                                    continue;
                                } ?>
                                <div class="button-box button-box-v2 button-bordered">
                                    <a href="<?php echo esc_url($btn_link ?: '#'); ?>"><?php echo esc_html($btn_text); ?></a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="product-widget--holder style-2">
            <div class="product-widget--outer" id="<?php echo esc_attr($unique_id); ?>">
                <div class="product-widget--inner">

                    <?php
                    /**
                     * Loop through the retrieved 'trb-picks-ad' posts.
                     * Extracts 'first_image' and 'first_image_link' from each ad to populate the slider.
                     */
                    foreach ($trb_ads as $ad) :
                        // Retrieve custom fields, falling back to WP standard fields if missing
                        $ad_link     = function_exists('get_field') ? get_field('ad_url', $ad->ID) : '';
                        $ad_image_id = get_post_thumbnail_id($ad->ID);


                        $ad_image_url = $ad_image_id ? wp_get_attachment_image_url($ad_image_id, 'large') : '';

                        if ($ad_image_url) : ?>
                            <div class="product-widget--box product-widget-image swiper-slide">
                                <span class="offer-filter-sponsored">Sponsored</span>
                                <?php if ($ad_link) : ?>
                                    <a href="<?php echo esc_url($ad_link); ?>" target="_blank" rel="noopener nofollow">
                                        <img src="<?php echo esc_url($ad_image_url); ?>" alt="<?php echo esc_attr(get_the_title($ad->ID)); ?>">
                                    </a>
                                <?php else : ?>
                                    <img src="<?php echo esc_url($ad_image_url); ?>" alt="<?php echo esc_attr(get_the_title($ad->ID)); ?>">
                                <?php endif; ?>
                            </div>
                    <?php endif;
                    endforeach; ?>

                    <?php foreach ($offers as $offer) :
                        // Shared card markup (see functions/offer-filter.php).
                        if (function_exists('trb_render_offer_card')) {
                            echo trb_render_offer_card($offer->ID, array('cta_text' => 'Claim Discount'));
                        }
                    endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>

            <div id="<?php echo esc_attr($unique_id); ?>-next" class="swiper-button swiper-button-next-trb"><svg xmlns="http://www.w3.org/2000/svg" width="53" height="53" viewBox="0 0 53 53">
                    <g transform="translate(-871 -4259)">
                        <g transform="translate(871 4259)" fill="none" stroke="currentColor" stroke-width="1">
                            <circle cx="26.5" cy="26.5" r="26.5" stroke="none"></circle>
                            <circle cx="26.5" cy="26.5" r="26" fill="none"></circle>
                        </g>
                        <path d="M4756.17,1529.5l12.3,12.3-12.3,12.3" transform="translate(-3862.67 2743.696)" fill="currentColor"></path>
                    </g>
                </svg></div>
            <div id="<?php echo esc_attr($unique_id); ?>-prev" class="swiper-button swiper-button-prev-trb"><svg xmlns="http://www.w3.org/2000/svg" width="53" height="53" viewBox="0 0 53 53">
                    <g transform="translate(924 4312) rotate(180)">
                        <g transform="translate(871 4259)" fill="none" stroke="currentColor" stroke-width="1">
                            <circle cx="26.5" cy="26.5" r="26.5" stroke="none"></circle>
                            <circle cx="26.5" cy="26.5" r="26" fill="none"></circle>
                        </g>
                        <path d="M4756.17,1529.5l12.3,12.3-12.3,12.3" transform="translate(-3862.67 2743.696)" fill="currentColor"></path>
                    </g>
                </svg></div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        var targetId = '<?php echo esc_js($unique_id); ?>';
        var $outer = $('#' + targetId);

        if ($outer.hasClass('swiper-initialized') || $outer.hasClass('swiper')) {
            return;
        }

        $outer.addClass('swiper swiper--product-widget');
        $outer.find('.product-widget--inner').addClass('swiper-wrapper');
        $outer.find('.product-widget--box').addClass('swiper-slide');

        var swiperOptions = <?php echo wp_json_encode($swiper_config); ?>;
        swiperOptions.pagination = {
            el: '#' + targetId + ' .swiper-pagination',
            clickable: true
        };
        swiperOptions.navigation = {
            nextEl: '#' + targetId + '-next',
            prevEl: '#' + targetId + '-prev'
        };

        setTimeout(function() {
            new Swiper('#' + targetId, swiperOptions);
        }, 50);
    });
</script>