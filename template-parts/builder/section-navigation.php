<?php
/**
 * Builder section: Navigation.
 * Expects $section (array) in scope.
 *
 * "source" picks the menu links source:
 *   menu   — render a WordPress menu (Appearance → Menus) chosen via "menu".
 *   manual — render the "links" repeater of { label, link }.
 * Legacy sections (no "source") fall back to a menu if one is set, else the links.
 */

$title  = trim($section['title'] ?? '');
$logo_id = absint($section['logo'] ?? 0);
$logo_link = trim($section['logo_link'] ?? '');
$source = $section['source'] ?? 'menu';
$menu_id = absint($section['menu'] ?? 0);

$links = isset($section['links']) && is_array($section['links']) ? $section['links'] : array();
// Keep only rows that have a label.
$links = array_values(array_filter($links, function ($row) {
    return is_array($row) && trim($row['label'] ?? '') !== '';
}));

$menu_classes = 'p-0 d-flex align-items-center justify-content-center m-0 gap-3 gap-lg-5';

// Build the menu markup.
$menu_html = '';
if ($source !== 'manual' && $menu_id) {
    $menu_html = wp_nav_menu(array(
        'menu'        => $menu_id,
        'container'   => false,
        'menu_class'  => $menu_classes,
        'items_wrap'  => '<ul class="%2$s">%3$s</ul>',
        'depth'       => 1,
        'fallback_cb' => false,
        'echo'        => false,
    ));
}

// Manual links are also the fallback when no menu output was produced.
$links_html = '';
if (($source === 'manual' || trim((string) $menu_html) === '') && !empty($links)) {
    ob_start();
    ?>
    <ul class="<?php echo esc_attr($menu_classes); ?>">
        <?php foreach ($links as $link) :
            $label = trim($link['label'] ?? '');
            $href = trim($link['link'] ?? '');
            if ($href === '') {
                $href = '#';
            }
            ?>
            <li><a class="text-white" href="<?php echo esc_url($href); ?>"><?php echo esc_html($label); ?></a></li>
        <?php endforeach; ?>
    </ul>
    <?php
    $links_html = ob_get_clean();
}

$nav_html = trim((string) $menu_html) !== '' ? $menu_html : $links_html;

if ($title === '' && !$logo_id && trim((string) $nav_html) === '') {
    return;
}
?>
<section class="trb-picks-nav trb-bg-accent-2">
    <div class="container">
        <div class="row g-3 align-items-center justify-content-between">
            <div class="col-auto col-lg-3">
                <?php if ($logo_id || $title !== '') : ?>
                    <a class="trb-picks-nav-title"<?php echo $logo_link !== '' ? ' href="' . esc_url($logo_link) . '"' : ''; ?>>
                        <?php if ($logo_id) : ?>
                            <?php echo wp_get_attachment_image($logo_id, 'medium', false, array('alt' => $title, 'class' => 'trb-picks-nav-logo')); ?>
                        <?php else : ?>
                            <?php echo esc_html($title); ?>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="col-auto col-lg-3 text-center">
                <?php if (trim((string) $nav_html) !== '') : ?>
                    <nav class="trb-picks-nav-menu">
                        <?php echo $nav_html; ?>
                    </nav>
                <?php endif; ?>
            </div>
            <div class="col-12 col-lg-3"></div>
        </div>
    </div>
</section>
