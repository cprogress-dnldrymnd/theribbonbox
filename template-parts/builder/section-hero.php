<?php
/**
 * Builder section: Hero / Page Title.
 * Expects $section (array) in scope.
 */

$heading = $section['heading'] ?? '';
$description = $section['description'] ?? '';
$show_breadcrumbs = !empty($section['show_breadcrumbs']);

if (!$heading && !$description && !$show_breadcrumbs) {
    return;
}
?>
<section class="page-title">
    <div class="container">
        <div class="inner mx-auto text-center">
            <?php if ($show_breadcrumbs && function_exists('woocommerce_breadcrumb')) : ?>
                <div class="breadcrumbs-v2">
                    <?php woocommerce_breadcrumb(); ?>
                </div>
            <?php endif; ?>
            <?php if ($heading) : ?>
                <h1 class="trb-wine-color"><?php echo wp_kses_post($heading); ?></h1>
            <?php endif; ?>
            <?php if ($description) : ?>
                <div class="desc trb-wine-color">
                    <?php echo wpautop(wp_kses_post($description)); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
