<?php
/**
 * Builder section: Category Jump Navigation.
 * Expects $section (array) in scope. "links" is a repeater of { label, anchor }.
 */

$links = isset($section['links']) && is_array($section['links']) ? $section['links'] : array();

// Keep only rows that have a label.
$links = array_values(array_filter($links, function ($row) {
    return is_array($row) && !empty(trim($row['label'] ?? ''));
}));

if (empty($links)) {
    return;
}
?>
<section class="category-navigation">
    <div class="container">
        <div class="inner">
            <div class="category-navigation-holder mx-auto">
                <div class="row g-3">
                    <?php foreach ($links as $link) :
                        $label = trim($link['label'] ?? '');
                        $anchor = trim($link['anchor'] ?? '');
                        if ($anchor === '') {
                            $anchor = '#';
                        }
                        ?>
                        <div class="col-6 col-md-4 col-lg">
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
