<?php
/**
 * Builder section: Promo Banner (Image + Button).
 * Expects $section (array) in scope.
 */

$anchor_id = $section['anchor_id'] ?? '';
$eyebrow = $section['eyebrow'] ?? '';
$heading = $section['heading'] ?? '';
$description = $section['description'] ?? '';
$image_id = absint($section['image'] ?? 0);
$image_position = ($section['image_position'] ?? 'left') === 'right' ? 'right' : 'left';
$button_text = $section['button_text'] ?? '';
$button_link = $section['button_link'] ?? '';

$image_html = $image_id ? wp_get_attachment_image($image_id, 'large') : '';

if (!$heading && !$description && !$image_html && !$button_text) {
    return;
}

$box_bg = trb_builder_color_css($section['box_bg_color'] ?? 'wine');
$box_text = trb_builder_color_css($section['box_text_color'] ?? 'petal');
$box_style = trim(
    ($box_bg !== '' ? 'background-color: ' . $box_bg . '; ' : '') .
    ($box_text !== '' ? 'color: ' . $box_text . ';' : '')
);

$btn_bg = trb_builder_color_css($section['button_bg_color'] ?? 'coral');
$btn_text = trb_builder_color_css($section['button_text_color'] ?? 'white');
$btn_style = trim(
    ($btn_bg !== '' ? 'background-color: ' . $btn_bg . '; ' : '') .
    ($btn_text !== '' ? 'color: ' . $btn_text . ';' : '')
);

ob_start();
?>
<div class="promo-banner-box rounded h-100"<?php echo $box_style ? ' style="' . esc_attr($box_style) . '"' : ''; ?>>
    <?php if ($eyebrow) : ?>
        <div class="promo-banner-eyebrow text-uppercase"><?php echo esc_html($eyebrow); ?></div>
    <?php endif; ?>
    <?php if ($heading) : ?>
        <h2 class="promo-banner-heading"><?php echo esc_html($heading); ?></h2>
    <?php endif; ?>
    <?php if ($description) : ?>
        <div class="desc"><?php echo wpautop(wp_kses_post($description)); ?></div>
    <?php endif; ?>
    <?php if ($button_text) : ?>
        <div class="promo-banner-button-box">
            <a class="promo-banner-button" href="<?php echo esc_url($button_link ?: '#'); ?>"<?php echo $btn_style ? ' style="' . esc_attr($btn_style) . '"' : ''; ?>><?php echo esc_html($button_text); ?></a>
        </div>
    <?php endif; ?>
</div>
<?php
$content_box = ob_get_clean();
?>
<section class="two--columns promo-banner"<?php echo $anchor_id ? ' id="' . esc_attr($anchor_id) . '"' : ''; ?>>
    <div class="container">
        <div class="inner">
            <div class="row g-3 g-lg-3 align-items-stretch">
                <?php if ($image_position === 'left') : ?>
                    <div class="col-lg-7">
                        <div class="image-box rounded h-100"><?php echo $image_html; ?></div>
                    </div>
                    <div class="col-lg-5">
                        <?php echo $content_box; ?>
                    </div>
                <?php else : ?>
                    <div class="col-lg-5 order-lg-2">
                        <div class="image-box rounded h-100"><?php echo $image_html; ?></div>
                    </div>
                    <div class="col-lg-7 order-lg-1">
                        <?php echo $content_box; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
