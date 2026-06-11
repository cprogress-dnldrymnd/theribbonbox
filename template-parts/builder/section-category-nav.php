<?php
/**
 * Builder section: Category Jump Navigation.
 * Expects $section (array) in scope. Each line of "links" is "Label | #anchor-id".
 */

$links_raw = $section['links'] ?? '';
$lines = array_filter(array_map('trim', explode("\n", $links_raw)));

if (empty($lines)) {
    return;
}
?>
<section class="category-navigation">
    <div class="container">
        <div class="inner">
            <div class="category-navigation-holder mx-auto">
                <div class="row g-3">
                    <?php foreach ($lines as $line) :
                        $parts = array_map('trim', explode('|', $line, 2));
                        $label = $parts[0] ?? '';
                        $anchor = $parts[1] ?? '#';
                        if ($label === '') {
                            continue;
                        }
                        ?>
                        <div class="col">
                            <a href="<?php echo esc_attr($anchor); ?>" class="cat-nav-holder">
                                <span class="cat-decor trb-coral-color text-uppercase">JUMP TO</span>
                                <div class="cat-text trb-green-color"><?php echo esc_html($label); ?></div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
