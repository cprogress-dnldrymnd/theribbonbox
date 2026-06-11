<?php
/**
 * Builder section: Offer Slider.
 * Expects $section (array) and $section_index (int) in scope.
 *
 * Renders a Swiper carousel of "offer-items" posts, chosen either manually or by
 * category, with an optional custom first slide image, a title and optional buttons.
 * Reuses the .product-widget--* markup/classes so it matches the site product carousels.
 */

$title = $section['title'] ?? '';
$source_mode = $section['source_mode'] ?? 'manual';
$first_image = absint($section['first_image'] ?? 0);
$buttons = isset($section['buttons']) && is_array($section['buttons']) ? $section['buttons'] : array();
$decorative_bar = !empty($section['decorative_bar']);
$featured_only = !empty($section['featured_only']);

// When "featured only" is on, restrict to offers whose ACF "featured" field is true.
$featured_meta = $featured_only ? array(
    array('key' => 'featured', 'value' => '1', 'compare' => '='),
) : array();

// Resolve which offer-items to show.
if ($source_mode === 'category') {
    $term_id = absint($section['category'] ?? 0);
    $count = max(1, absint($section['count'] ?? 8));
    $query_args = array(
        'post_type' => 'offer-items',
        'posts_per_page' => $count,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    );
    if ($term_id) {
        $query_args['cat'] = $term_id;
    }
    if ($featured_meta) {
        $query_args['meta_query'] = $featured_meta;
    }
    $offers = get_posts($query_args);
} else {
    $ids = isset($section['manual_items']) && is_array($section['manual_items']) ? array_filter(array_map('absint', $section['manual_items'])) : array();
    $offers = array();
    if (!empty($ids)) {
        $query_args = array(
            'post_type' => 'offer-items',
            'post__in' => $ids,
            'orderby' => 'post__in',
            'posts_per_page' => count($ids),
            'post_status' => 'publish',
        );
        if ($featured_meta) {
            $query_args['meta_query'] = $featured_meta;
        }
        $offers = get_posts($query_args);
    }
}

// Nothing to show and no custom slide — skip the section entirely.
if (empty($offers) && !$first_image) {
    return;
}

$unique_id = 'trb-offer-slider-' . absint($section_index ?? 0) . '-' . wp_rand(1000, 9999);

$swiper_config = array(
    'loop' => false,
    'spaceBetween' => 20,
    'autoplay' => false,
    'observer' => true,
    'observeParents' => true,
    'breakpoints' => array(
        0 => array('slidesPerView' => 1.2),
        768 => array('slidesPerView' => 3),
        992 => array('slidesPerView' => 4),
    ),
);

$wrapper_classes = 'product-tabs offer-slider trb-mt-large trb-mb-medium';
$wrapper_style = '';
if ($decorative_bar) {
    $wrapper_classes .= ' trb-decor-bar';
    $decor_color = $section['decor_color'] ?? 'wine';
    if ($decor_color !== '') {
        $wrapper_style = ' style="--trb-decor-color: var(--trb-' . esc_attr($decor_color) . ');"';
    }
}
?>
<div class="<?php echo esc_attr($wrapper_classes); ?>"<?php echo $wrapper_style; ?>>
    <div class="container<?php echo $decorative_bar ? ' position-relative' : ''; ?>">
        <?php if ($title || !empty($buttons)) : ?>
            <div class="nav-tabs-holder">
                <div class="nav-tabs-holder-inner carousel-with-nav-width d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <?php if ($title) : ?>
                        <h3 class="offer-slider-title trb-wine-color mb-0"><?php echo wp_kses_post($title); ?></h3>
                    <?php else : ?>
                        <span></span>
                    <?php endif; ?>

                    <?php if (!empty($buttons)) : ?>
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
                    <?php if ($first_image) :
                        $first_image_url = wp_get_attachment_image_url($first_image, 'large'); ?>
                        <div class="product-widget--box product-widget-image swiper-slide">
                            <img src="<?php echo esc_url($first_image_url); ?>" alt="">
                        </div>
                    <?php endif; ?>

                    <?php foreach ($offers as $offer) :
                        $offer_id = $offer->ID;

                        // Link: external website_link (new tab) or the post permalink.
                        $website_link = function_exists('get_field') ? get_field('website_link', $offer_id) : '';
                        $url = $website_link ?: get_permalink($offer_id);
                        $target = $website_link ? ' target="_blank" rel="noopener"' : '';

                        // Image: featured image, else the ACF large image, else nothing.
                        $img_html = '';
                        if (has_post_thumbnail($offer_id)) {
                            $img_html = get_the_post_thumbnail($offer_id, 'medium');
                        } else {
                            $acf_img = function_exists('get_field') ? get_field('post_large_image', $offer_id) : '';
                            $acf_url = is_array($acf_img) ? ($acf_img['url'] ?? '') : $acf_img;
                            if ($acf_url) {
                                $img_html = '<img src="' . esc_url($acf_url) . '" alt="' . esc_attr(get_the_title($offer_id)) . '">';
                            }
                        }

                        $cats = get_the_category($offer_id);
                        $cat_name = !empty($cats) ? $cats[0]->name : '';

                        // ACF true/false flags shown as badges on the card.
                        $badges = array();
                        if (function_exists('get_field')) {
                            if (get_field('all_natural', $offer_id)) {
                                $badges[] = array('label' => 'All Natural', 'class' => 'offer-badge--natural');
                            }
                            if (get_field('eco_friendly', $offer_id)) {
                                $badges[] = array('label' => 'Eco Friendly', 'class' => 'offer-badge--eco');
                            }
                        }
                        ?>
                        <div class="product-widget--box">
                            <?php if ($img_html) : ?>
                                <div class="product-widget--image">
                                    <a href="<?php echo esc_url($url); ?>"<?php echo $target; ?>><?php echo $img_html; ?></a>
                                    <?php if (!empty($badges)) : ?>
                                        <div class="offer-badges">
                                            <?php foreach ($badges as $badge) : ?>
                                                <span class="offer-badge <?php echo esc_attr($badge['class']); ?>"><?php echo esc_html($badge['label']); ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="product-widget--content">
                                <?php if ($cat_name) : ?>
                                    <div class="product-cat trb-coral-color text-uppercase"><?php echo esc_html($cat_name); ?></div>
                                <?php endif; ?>
                                <h3 class="product-name"><a href="<?php echo esc_url($url); ?>"<?php echo $target; ?>><?php echo esc_html(get_the_title($offer_id)); ?></a></h3>
                                <div class="product-widget--cta"><a href="<?php echo esc_url($url); ?>"<?php echo $target; ?>>Visit Offer</a></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>

            <div id="<?php echo esc_attr($unique_id); ?>-next" class="swiper-button swiper-button-next-trb"><svg xmlns="http://www.w3.org/2000/svg" width="53" height="53" viewBox="0 0 53 53"><g transform="translate(-871 -4259)"><g transform="translate(871 4259)" fill="none" stroke="currentColor" stroke-width="1"><circle cx="26.5" cy="26.5" r="26.5" stroke="none"></circle><circle cx="26.5" cy="26.5" r="26" fill="none"></circle></g><path d="M4756.17,1529.5l12.3,12.3-12.3,12.3" transform="translate(-3862.67 2743.696)" fill="currentColor"></path></g></svg></div>
            <div id="<?php echo esc_attr($unique_id); ?>-prev" class="swiper-button swiper-button-prev-trb"><svg xmlns="http://www.w3.org/2000/svg" width="53" height="53" viewBox="0 0 53 53"><g transform="translate(924 4312) rotate(180)"><g transform="translate(871 4259)" fill="none" stroke="currentColor" stroke-width="1"><circle cx="26.5" cy="26.5" r="26.5" stroke="none"></circle><circle cx="26.5" cy="26.5" r="26" fill="none"></circle></g><path d="M4756.17,1529.5l12.3,12.3-12.3,12.3" transform="translate(-3862.67 2743.696)" fill="currentColor"></path></g></svg></div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function ($) {
        var targetId = '<?php echo esc_js($unique_id); ?>';
        var $outer = $('#' + targetId);

        if ($outer.hasClass('swiper-initialized') || $outer.hasClass('swiper')) {
            return;
        }

        $outer.addClass('swiper swiper--product-widget');
        $outer.find('.product-widget--inner').addClass('swiper-wrapper');
        $outer.find('.product-widget--box').addClass('swiper-slide');

        var swiperOptions = <?php echo wp_json_encode($swiper_config); ?>;
        swiperOptions.pagination = { el: '#' + targetId + ' .swiper-pagination', clickable: true };
        swiperOptions.navigation = { nextEl: '#' + targetId + '-next', prevEl: '#' + targetId + '-prev' };

        setTimeout(function () {
            new Swiper('#' + targetId, swiperOptions);
        }, 50);
    });
</script>
