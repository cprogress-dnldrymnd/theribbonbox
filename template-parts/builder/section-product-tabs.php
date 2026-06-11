<?php
/**
 * Builder section: Product Tabs.
 * Expects $section (array) and $section_index (int) in scope.
 * Each line of "tabs" is "Label | Product Widget ID".
 */

$title = $section['title'] ?? '';
$is_light = ($section['style'] ?? 'default') === 'light';
$button_text = $section['button_text'] ?? '';
$button_link = $section['button_link'] ?? '';
$decorative_bar = !empty($section['decorative_bar']);

$lines = array_filter(array_map('trim', explode("\n", $section['tabs'] ?? '')));
$tabs = array();
foreach ($lines as $line) {
    $parts = array_map('trim', explode('|', $line, 2));
    $label = $parts[0] ?? '';
    if ($label === '') {
        continue;
    }
    $tabs[] = array(
        'label' => $label,
        'widget_id' => $parts[1] ?? '',
    );
}

if (empty($tabs)) {
    return;
}

$unique = 'trb-pt-' . absint($section_index ?? 0);

$wrapper_classes = 'product-tabs trb-mt-large trb-mb-medium';
if ($is_light) {
    $wrapper_classes .= ' product-tabs--light position-relative';
}
if ($decorative_bar) {
    $wrapper_classes .= ' trb-decor-bar';
}
?>
<div class="<?php echo esc_attr($wrapper_classes); ?>">
    <div class="container<?php echo $decorative_bar ? ' position-relative' : ''; ?>">
        <div class="nav-tabs-holder">
            <?php if ($title) : ?>
                <h3 class="trb-wine-color mb-4"><?php echo wp_kses_post($title); ?></h3>
            <?php endif; ?>

            <div class="nav-tabs-holder-inner carousel-with-nav-width d-flex align-items-center justify-content-between gap-3">
                <ul class="nav nav-tabs gap-2 gap-lg-5" id="<?php echo esc_attr($unique); ?>" role="tablist">
                    <?php foreach ($tabs as $i => $tab) :
                        $tab_id = $unique . '-pane-' . $i;
                        $active = $i === 0;
                        ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link<?php echo $active ? ' active' : ''; ?>" id="<?php echo esc_attr($tab_id); ?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo esc_attr($tab_id); ?>" type="button" role="tab" aria-controls="<?php echo esc_attr($tab_id); ?>" aria-selected="<?php echo $active ? 'true' : 'false'; ?>"><?php echo esc_html($tab['label']); ?></button>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php if ($button_text) : ?>
                    <div class="button-box button-box-v2 button-bordered">
                        <a href="<?php echo esc_url($button_link ?: '#'); ?>"><?php echo esc_html($button_text); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="tab-content" id="<?php echo esc_attr($unique); ?>-content">
            <?php foreach ($tabs as $i => $tab) :
                $tab_id = $unique . '-pane-' . $i;
                $active = $i === 0;
                ?>
                <div class="tab-pane fade<?php echo $active ? ' show active' : ''; ?>" id="<?php echo esc_attr($tab_id); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr($tab_id); ?>-tab">
                    <?php if ($tab['widget_id'] !== '') : ?>
                        <?php echo do_shortcode('[product_widget id="' . esc_attr($tab['widget_id']) . '"]'); ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
