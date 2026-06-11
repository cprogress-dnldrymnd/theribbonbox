<?php
/**
 * Builder section: Custom Text / HTML.
 * Expects $section (array) in scope.
 */

$content = $section['content'] ?? '';

if (trim($content) === '') {
    return;
}
?>
<div class="container trb-my-medium">
    <div class="trb-richtext">
        <?php echo wpautop(wp_kses_post($content)); ?>
    </div>
</div>
