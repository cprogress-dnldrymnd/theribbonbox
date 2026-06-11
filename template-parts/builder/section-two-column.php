<?php
/**
 * Builder section: Two Column Content.
 * Expects $section (array) in scope.
 */

$anchor_id = $section['anchor_id'] ?? '';
$heading = $section['heading'] ?? '';
$subheading = $section['subheading'] ?? '';
$description = $section['description'] ?? '';
$image_id = absint($section['image'] ?? 0);
$image_position = ($section['image_position'] ?? 'left') === 'right' ? 'right' : 'left';

// Default heading/text color is wine, but let a chosen Text Color (applied on the
// section wrapper) cascade through by dropping the explicit class when one is set.
$text_color_class = !empty($section['text_color']) ? '' : 'trb-wine-color';

$image_html = $image_id ? wp_get_attachment_image($image_id, 'large') : '';
?>
<section class="two--columns"<?php echo $anchor_id ? ' id="' . esc_attr($anchor_id) . '"' : ''; ?>>
    <div class="container">
        <div class="inner">
            <?php if ($heading) : ?>
                <h2 class="<?php echo esc_attr(trim($text_color_class . ' large-heading mb-5')); ?>"><?php echo esc_html($heading); ?></h2>
            <?php endif; ?>
            <div class="row g-3 g-lg-5">
                <?php if ($image_position === 'left') : ?>
                    <div class="col-lg-7">
                        <div class="image-box"><?php echo $image_html; ?></div>
                    </div>
                    <div class="col-lg-5">
                        <?php if ($subheading) : ?><h3 class="<?php echo esc_attr($text_color_class); ?>"><?php echo esc_html($subheading); ?></h3><?php endif; ?>
                        <?php if ($description) : ?><div class="desc <?php echo esc_attr($text_color_class); ?>"><?php echo wpautop(wp_kses_post($description)); ?></div><?php endif; ?>
                    </div>
                <?php else : ?>
                    <div class="col-lg-5 order-lg-2">
                        <div class="image-box"><?php echo $image_html; ?></div>
                    </div>
                    <div class="col-lg-7 order-lg-1">
                        <?php if ($subheading) : ?><h3 class="<?php echo esc_attr($text_color_class); ?>"><?php echo esc_html($subheading); ?></h3><?php endif; ?>
                        <?php if ($description) : ?><div class="desc <?php echo esc_attr($text_color_class); ?>"><?php echo wpautop(wp_kses_post($description)); ?></div><?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
