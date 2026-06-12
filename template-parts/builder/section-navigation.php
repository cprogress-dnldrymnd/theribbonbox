<?php
/**
 * Builder section: Navigation.
 * Expects $section (array) in scope. "links" is a repeater of { label, link }.
 */

$title = trim($section['title'] ?? '');
$links = isset($section['links']) && is_array($section['links']) ? $section['links'] : array();

// Keep only rows that have a label.
$links = array_values(array_filter($links, function ($row) {
    return is_array($row) && trim($row['label'] ?? '') !== '';
}));

if ($title === '' && empty($links)) {
    return;
}
?>
<section class="trb-picks-nav trb-bg-accent-2">
    <div class="container">
        <div class="row g-3 align-items-center">
            <div class="col-lg-3">
                <?php if ($title !== '') : ?>
                    <a class="trb-picks-nav-title"><?php echo esc_html($title); ?></a>
                <?php endif; ?>
            </div>
            <div class="col-lg-6 text-center">
                <nav class="trb-picks-nav-menu">
                    <ul class="p-0 d-flex align-items-center justify-content-center m-0 gap-3 gap-lg-5">
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
                </nav>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</section>
