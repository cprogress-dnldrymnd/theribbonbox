<?php
if ( ! defined( 'TRB_BUILDER_VERSION' ) ) {
    define( 'TRB_BUILDER_VERSION', '1.5.7' );
}
/*-----------------------------------------------------------------------------------*/
/* TRB Page Builder
/* A lightweight, ACF-free section builder for the "Page Builder" page template.
/* Stores an ordered list of sections (type + fields) as JSON in post meta.
/*-----------------------------------------------------------------------------------*/

/**
 * Registry of available section types and their editable fields.
 *
 * Field schema keys:
 *   type       text | textarea | checkbox | select | number | image | post_select | term_select | repeater
 *   label      Field label shown to the editor.
 *   help       Optional helper text shown under the field.
 *   rows       (textarea) number of rows.
 *   options    (select) value => label map.
 *   default    Default value.
 *   allow_html (text/textarea) keep safe HTML instead of stripping it.
 *   post_type  (post_select) which post type to list.
 *   taxonomy   (term_select) which taxonomy to list.
 *   sub_fields (repeater) nested field schema.
 *   button     (repeater) "Add" button label.
 *   summary    If true, the field's value is shown in the collapsed card header.
 *   show_when  array('field' => slug, 'value' => x) — only show this field when another
 *              field in the same section equals the given value.
 *   hide_when  array('field' => slug, 'value' => x) — hide this field when another
 *              field in the same section equals the given value (overrides show_when).
 */
function trb_builder_section_types()
{
    return array(
        'hero' => array(
            'label' => 'Hero / Page Title',
            'fields' => array(
                'heading' => array(
                    'type' => 'textarea',
                    'label' => 'Heading',
                    'rows' => 2,
                    'allow_html' => true,
                    'summary' => true,
                    'help' => 'Basic HTML allowed, e.g. <i>italic</i>.',
                ),
                'description' => array(
                    'type' => 'textarea',
                    'label' => 'Description',
                    'rows' => 3,
                    'allow_html' => true,
                ),
                'show_breadcrumbs' => array(
                    'type' => 'checkbox',
                    'label' => 'Show breadcrumbs',
                ),
            ),
        ),
        'category_nav' => array(
            'label' => 'Category Jump Navigation',
            'fields' => array(
                'links' => array(
                    'type' => 'repeater',
                    'label' => 'Jump Links',
                    'button' => 'Add Link',
                    'sub_fields' => array(
                        'label' => array('type' => 'text', 'label' => 'Label'),
                        'anchor' => array('type' => 'text', 'label' => 'Anchor (e.g. #section-id)'),
                    ),
                ),
            ),
        ),
        'navigation' => array(
            'label' => 'Navigation',
            'fields' => array(
                'title' => array(
                    'type' => 'text',
                    'label' => 'Title',
                    'default' => 'TRB Picks',
                    'summary' => true,
                ),
                'logo' => array(
                    'type' => 'image',
                    'label' => 'Logo Image (optional)',
                    'help' => 'Shown in place of the title text.',
                ),
                'logo_link' => array(
                    'type' => 'text',
                    'label' => 'Logo / Title Link (optional)',
                    'help' => 'URL the logo or title links to, e.g. /trb-picks.',
                ),
                'source' => array(
                    'type' => 'select',
                    'label' => 'Menu Links Source',
                    'options' => array(
                        'menu' => 'WordPress Menu',
                        'manual' => 'Manual Links',
                    ),
                    'default' => 'menu',
                ),
                'menu' => array(
                    'type' => 'term_select',
                    'label' => 'WordPress Menu',
                    'taxonomy' => 'nav_menu',
                    'placeholder' => 'Select a menu',
                    'help' => 'Pick a menu created under Appearance → Menus.',
                    'show_when' => array('field' => 'source', 'value' => 'menu'),
                ),
                'links' => array(
                    'type' => 'repeater',
                    'label' => 'Menu Links',
                    'button' => 'Add Link',
                    'sub_fields' => array(
                        'label' => array('type' => 'text', 'label' => 'Label'),
                        'link' => array('type' => 'text', 'label' => 'Link (URL)'),
                    ),
                    'show_when' => array('field' => 'source', 'value' => 'manual'),
                ),
            ),
        ),
        'two_column' => array(
            'label' => 'Two Column Content',
            'fields' => array(
                'anchor_id' => array(
                    'type' => 'text',
                    'label' => 'Anchor ID (optional, no #, used by jump links)',
                ),
                'heading' => array(
                    'type' => 'text',
                    'label' => 'Large Heading',
                    'summary' => true,
                ),
                'subheading' => array(
                    'type' => 'text',
                    'label' => 'Sub Heading',
                ),
                'description' => array(
                    'type' => 'textarea',
                    'label' => 'Description',
                    'rows' => 4,
                    'allow_html' => true,
                ),
                'image' => array(
                    'type' => 'image',
                    'label' => 'Image',
                ),
                'image_position' => array(
                    'type' => 'select',
                    'label' => 'Image Position',
                    'options' => array(
                        'left' => 'Left',
                        'right' => 'Right',
                    ),
                    'default' => 'left',
                ),
            ),
        ),
        'promo_banner' => array(
            'label' => 'Promo Banner (Image + Button)',
            'fields' => array(
                'anchor_id' => array(
                    'type' => 'text',
                    'label' => 'Anchor ID (optional, no #, used by jump links)',
                ),
                'eyebrow' => array(
                    'type' => 'text',
                    'label' => 'Eyebrow Text (optional)',
                    'help' => 'Small label shown above the heading, e.g. "Partner with TRB".',
                ),
                'heading' => array(
                    'type' => 'text',
                    'label' => 'Heading',
                    'summary' => true,
                ),
                'description' => array(
                    'type' => 'textarea',
                    'label' => 'Description',
                    'rows' => 4,
                    'allow_html' => true,
                ),
                'image' => array(
                    'type' => 'image',
                    'label' => 'Image',
                ),
                'image_position' => array(
                    'type' => 'select',
                    'label' => 'Image Position',
                    'options' => array(
                        'left' => 'Left',
                        'right' => 'Right',
                    ),
                    'default' => 'left',
                ),
                'box_bg_color' => array(
                    'type' => 'select',
                    'label' => 'Content Box Background Color',
                    'options' => trb_builder_color_options(false),
                    'default' => 'wine',
                ),
                'box_text_color' => array(
                    'type' => 'select',
                    'label' => 'Content Box Text Color',
                    'options' => trb_builder_color_options(false),
                    'default' => 'petal',
                ),
                'button_text' => array(
                    'type' => 'text',
                    'label' => 'Button Text (optional)',
                ),
                'button_link' => array(
                    'type' => 'text',
                    'label' => 'Button Link',
                ),
                'button_bg_color' => array(
                    'type' => 'select',
                    'label' => 'Button Background Color',
                    'options' => trb_builder_color_options(false),
                    'default' => 'coral',
                ),
                'button_text_color' => array(
                    'type' => 'select',
                    'label' => 'Button Text Color',
                    'options' => trb_builder_color_options(false),
                    'default' => 'white',
                ),
            ),
        ),
        'offer_slider' => array(
            'label' => 'Offer Slider',
            'fields' => array(
                'title' => array(
                    'type' => 'text',
                    'label' => 'Section Title (optional)',
                    'allow_html' => true,
                    'summary' => true,
                ),
                'featured_only' => array(
                    'type' => 'checkbox',
                    'label' => 'Show featured offers only',
                    'help' => 'Only include offers whose "Featured" field is on. When enabled, the choices below are hidden and offers are pulled from all featured items (limited by "Number of offers to show").',
                ),
                'source_mode' => array(
                    'type' => 'select',
                    'label' => 'Choose offers by',
                    'options' => array(
                        'manual' => 'Picking offers manually',
                        'category' => 'Category',
                    ),
                    'default' => 'manual',
                    'hide_when' => array('field' => 'featured_only', 'value' => '1'),
                ),
                'manual_items' => array(
                    'type' => 'post_select',
                    'label' => 'Select Offers',
                    'post_type' => 'offer-items',
                    'help' => 'Search by name. Slides appear in the order shown here.',
                    'show_when' => array('field' => 'source_mode', 'value' => 'manual'),
                    'hide_when' => array('field' => 'featured_only', 'value' => '1'),
                ),
                'category' => array(
                    'type' => 'term_select',
                    'label' => 'Offer Category',
                    'taxonomy' => 'category',
                    'show_when' => array('field' => 'source_mode', 'value' => 'category'),
                    'hide_when' => array('field' => 'featured_only', 'value' => '1'),
                ),
                'count' => array(
                    'type' => 'number',
                    'label' => 'Number of offers to show',
                    'default' => 8,
                ),
                'first_image' => array(
                    'type' => 'image',
                    'label' => 'Ad Image (optional)',
                    'help' => 'Shown as the first slide before the offers. Displays a "Sponsored" tag.',
                ),
                'first_image_link' => array(
                    'type' => 'text',
                    'label' => 'Ad Image Link (optional)',
                    'help' => 'Where the ad image links to.',
                ),
                'buttons' => array(
                    'type' => 'repeater',
                    'label' => 'Buttons (optional)',
                    'button' => 'Add Button',
                    'sub_fields' => array(
                        'text' => array('type' => 'text', 'label' => 'Button Text'),
                        'link' => array('type' => 'text', 'label' => 'Button Link'),
                    ),
                ),
                'decorative_bar' => array(
                    'type' => 'checkbox',
                    'label' => 'Show decorative background bar above',
                ),
                'decor_color' => array(
                    'type' => 'select',
                    'label' => 'Decorative Bar Color',
                    'options' => trb_builder_color_options(false),
                    'default' => 'wine',
                    'show_when' => array('field' => 'decorative_bar', 'value' => '1'),
                ),
            ),
        ),
        'offer_filter' => array(
            'label' => 'Offer Items — Search & Filter',
            'fields' => array(
                'title' => array(
                    'type' => 'text',
                    'label' => 'Section Title (optional)',
                    'allow_html' => true,
                    'summary' => true,
                ),
                'description' => array(
                    'type' => 'textarea',
                    'label' => 'Intro Text (optional)',
                    'rows' => 3,
                    'allow_html' => true,
                ),
                'per_page' => array(
                    'type' => 'number',
                    'label' => 'Results per page',
                    'default' => 15,
                ),
                'top_banner' => array(
                    'type' => 'image',
                    'label' => 'Top Banner Ad (optional)',
                    'help' => 'Wide sponsored image shown above the results grid.',
                ),
                'top_banner_link' => array(
                    'type' => 'text',
                    'label' => 'Top Banner Link (optional)',
                ),
                'bottom_banner' => array(
                    'type' => 'image',
                    'label' => 'Bottom Banner Ad (optional)',
                    'help' => 'Wide sponsored image shown below the results grid.',
                ),
                'bottom_banner_link' => array(
                    'type' => 'text',
                    'label' => 'Bottom Banner Link (optional)',
                ),
                'sidebar_ads' => array(
                    'type' => 'repeater',
                    'label' => 'Sidebar Sponsored Images',
                    'button' => 'Add Sidebar Ad',
                    'help' => 'Up to two images shown in the filter sidebar.',
                    'sub_fields' => array(
                        'image' => array('type' => 'image', 'label' => 'Image'),
                        'link'  => array('type' => 'text', 'label' => 'Link (optional)'),
                    ),
                ),
                'grid_ads' => array(
                    'type' => 'repeater',
                    'label' => 'In-Grid Sponsored Images',
                    'button' => 'Add Grid Ad',
                    'help' => 'Sponsored cards spread evenly through the results grid.',
                    'sub_fields' => array(
                        'image' => array('type' => 'image', 'label' => 'Image'),
                        'link'  => array('type' => 'text', 'label' => 'Link (optional)'),
                    ),
                ),
            ),
        ),
        'divider' => array(
            'label' => 'Divider',
            'fields' => array(),
        ),
        'richtext' => array(
            'label' => 'Custom Text / HTML',
            'fields' => array(
                'content' => array(
                    'type' => 'textarea',
                    'label' => 'Content (HTML allowed)',
                    'rows' => 6,
                    'allow_html' => true,
                    'summary' => true,
                ),
            ),
        ),
    );
}

/**
 * Available colors — keys map to CSS custom properties (--trb-{key}) defined in
 * css/page-builder.css :root, so editors choose from the theme palette.
 */
function trb_builder_color_options($include_none = true)
{
    $colors = array(
        'green' => 'Green',
        'wine' => 'Wine',
        'coral' => 'Coral',
        'petal' => 'Petal',
        'white' => 'White',
        'black' => 'Black',
        'mint' => 'Mint',
        'forest' => 'Forest Green',
    );
    if ($include_none) {
        $colors = array('' => '— None —') + $colors;
    }
    return $colors;
}

/**
 * Color fields shared by every section (background + text color).
 */
function trb_builder_color_fields()
{
    $colors = trb_builder_color_options();
    return array(
        'bg_color' => array(
            'type' => 'select',
            'label' => 'Background Color',
            'options' => $colors,
            'default' => '',
        ),
        'text_color' => array(
            'type' => 'select',
            'label' => 'Text Color',
            'options' => $colors,
            'default' => '',
        ),
    );
}

/**
 * Spacing preset options (label) keyed by slug; values map to rem in CSS below.
 */
function trb_builder_spacing_options()
{
    return array(
        '' => 'Default',
        'none' => 'None',
        'small' => 'Small',
        'medium' => 'Medium',
        'large' => 'Large',
        'xlarge' => 'Extra Large',
    );
}

/**
 * Spacing fields shared by every section (margins + paddings).
 */
function trb_builder_spacing_fields()
{
    $opts = trb_builder_spacing_options();
    return array(
        'margin_top' => array('type' => 'select', 'label' => 'Margin Top', 'options' => $opts, 'default' => ''),
        'margin_bottom' => array('type' => 'select', 'label' => 'Margin Bottom', 'options' => $opts, 'default' => ''),
        'padding_top' => array('type' => 'select', 'label' => 'Padding Top', 'options' => $opts, 'default' => ''),
        'padding_bottom' => array('type' => 'select', 'label' => 'Padding Bottom', 'options' => $opts, 'default' => ''),
    );
}

/**
 * All common (color + spacing) fields — used by the save handler.
 */
function trb_builder_common_fields()
{
    return array_merge(trb_builder_color_fields(), trb_builder_spacing_fields());
}

/**
 * Map a color slug to its CSS value (a theme custom property).
 */
function trb_builder_color_css($slug)
{
    $options = trb_builder_color_options();
    if ($slug === '' || !isset($options[$slug])) {
        return '';
    }
    return 'var(--trb-' . $slug . ')';
}

/**
 * Get the saved, sanitized list of builder sections for a post.
 */
function trb_get_builder_sections($post_id)
{
    $raw = get_post_meta($post_id, '_trb_page_builder_sections', true);
    if (!$raw) {
        return array();
    }
    $sections = json_decode($raw, true);
    return is_array($sections) ? $sections : array();
}

/**
 * Render a single input control (no label / wrapper) for a field.
 */
function trb_render_control($field_def, $name, $id, $value)
{
    switch ($field_def['type']) {
        case 'textarea':
            ?>
            <textarea id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" rows="<?php echo esc_attr($field_def['rows'] ?? 3); ?>" class="widefat"><?php echo esc_textarea($value); ?></textarea>
            <?php
            break;

        case 'select':
            ?>
            <select id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" class="trb-builder-select">
                <?php foreach ($field_def['options'] as $opt_value => $opt_label) : ?>
                    <option value="<?php echo esc_attr($opt_value); ?>" <?php selected($value, $opt_value); ?>><?php echo esc_html($opt_label); ?></option>
                <?php endforeach; ?>
            </select>
            <?php
            break;

        case 'number':
            $num = ($value === '' || $value === null) ? ($field_def['default'] ?? '') : $value;
            ?>
            <input type="number" min="1" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($num); ?>" class="small-text">
            <?php
            break;

        case 'image':
            $attachment_id = absint($value);
            ?>
            <div class="trb-builder-image-field">
                <div class="trb-builder-image-preview"><?php if ($attachment_id) {
                    echo wp_get_attachment_image($attachment_id, 'medium');
                } ?></div>
                <input type="hidden" class="trb-builder-image-id" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($attachment_id); ?>">
                <button type="button" class="button trb-builder-image-select">Select Image</button>
                <button type="button" class="button trb-builder-image-remove" <?php echo $attachment_id ? '' : 'style="display:none;"'; ?>>Remove</button>
            </div>
            <?php
            break;

        case 'post_select':
            $selected = is_array($value) ? array_map('absint', $value) : array_filter(array_map('absint', explode(',', (string) $value)));
            $posts = get_posts(array(
                'post_type' => $field_def['post_type'] ?? 'post',
                'numberposts' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
                'post_status' => 'publish',
            ));
            // Keep manually-selected items in their saved order, then append the rest.
            $ordered = array();
            foreach ($selected as $sel_id) {
                foreach ($posts as $p) {
                    if ((int) $p->ID === (int) $sel_id) {
                        $ordered[$sel_id] = $p;
                    }
                }
            }
            foreach ($posts as $p) {
                if (!isset($ordered[$p->ID])) {
                    $ordered[$p->ID] = $p;
                }
            }
            ?>
            <select multiple class="trb-builder-postselect widefat" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>[]" data-placeholder="Search and select offers…">
                <?php foreach ($ordered as $p) : ?>
                    <option value="<?php echo esc_attr($p->ID); ?>" <?php selected(in_array((int) $p->ID, $selected, true)); ?>><?php echo esc_html($p->post_title); ?></option>
                <?php endforeach; ?>
            </select>
            <?php
            break;

        case 'term_select':
            $terms = get_terms(array(
                'taxonomy' => $field_def['taxonomy'] ?? 'category',
                'hide_empty' => false,
            ));
            $placeholder = !empty($field_def['placeholder']) ? $field_def['placeholder'] : 'Select a category';
            ?>
            <select class="trb-builder-termselect" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" data-placeholder="<?php echo esc_attr($placeholder); ?>…">
                <option value="">— <?php echo esc_html($placeholder); ?> —</option>
                <?php if (!is_wp_error($terms)) :
                    foreach ($terms as $t) : ?>
                        <option value="<?php echo esc_attr($t->term_id); ?>" <?php selected((int) $value, (int) $t->term_id); ?>><?php echo esc_html($t->name); ?></option>
                    <?php endforeach;
                endif; ?>
            </select>
            <?php
            break;

        default: // text
            ?>
            <input type="text" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>" class="widefat">
            <?php
    }
}

/**
 * Render one repeater row.
 */
function trb_render_repeater_row($field_key, $field_def, $index, $subindex, $row_values = array())
{
    $prefix = "trb_builder[{$index}][{$field_key}][{$subindex}]";
    ?>
    <div class="trb-builder-repeater-row">
        <span class="trb-builder-repeater-drag dashicons dashicons-menu" title="Drag to reorder"></span>
        <div class="trb-builder-repeater-cols">
            <?php foreach ($field_def['sub_fields'] as $sub_key => $sub_def) :
                $sub_id = 'trb-rb-' . $field_key . '-' . $index . '-' . $subindex . '-' . $sub_key;
                $sub_name = $prefix . "[{$sub_key}]";
                $sub_value = array_key_exists($sub_key, $row_values) ? $row_values[$sub_key] : ($sub_def['default'] ?? '');
                ?>
                <label class="trb-builder-repeater-col">
                    <span><?php echo esc_html($sub_def['label']); ?></span>
                    <?php trb_render_control($sub_def, $sub_name, $sub_id, $sub_value); ?>
                </label>
            <?php endforeach; ?>
        </div>
        <button type="button" class="trb-builder-repeater-remove" title="Remove" aria-label="Remove">&times;</button>
    </div>
    <?php
}

/**
 * Render a full field (label + wrapper + control) inside a section card.
 */
function trb_render_section_field($field_key, $field_def, $index, $values = array())
{
    $field_id = 'trb-builder-' . $index . '-' . $field_key;
    $field_name = "trb_builder[{$index}][{$field_key}]";
    $value = array_key_exists($field_key, $values) ? $values[$field_key] : ($field_def['default'] ?? '');

    $wrapper_classes = 'trb-builder-field trb-builder-field-' . $field_def['type'];
    $show_attrs = '';
    if (!empty($field_def['show_when'])) {
        $show_attrs = ' data-show-when-field="' . esc_attr($field_def['show_when']['field']) . '" data-show-when-value="' . esc_attr($field_def['show_when']['value']) . '"';
    }
    if (!empty($field_def['hide_when'])) {
        $show_attrs .= ' data-hide-when-field="' . esc_attr($field_def['hide_when']['field']) . '" data-hide-when-value="' . esc_attr($field_def['hide_when']['value']) . '"';
    }
    ?>
    <div class="<?php echo esc_attr($wrapper_classes); ?>"<?php echo $show_attrs; ?>>
        <?php if ($field_def['type'] === 'checkbox') : ?>
            <label class="trb-builder-checkbox-label">
                <input type="checkbox" id="<?php echo esc_attr($field_id); ?>" name="<?php echo esc_attr($field_name); ?>" value="1" <?php checked(!empty($value)); ?>>
                <?php echo esc_html($field_def['label']); ?>
            </label>

        <?php elseif ($field_def['type'] === 'repeater') :
            $rows = is_array($value) ? $value : array(); ?>
            <label class="trb-builder-field-label"><?php echo esc_html($field_def['label']); ?></label>
            <div class="trb-builder-repeater" data-field="<?php echo esc_attr($field_key); ?>">
                <div class="trb-builder-repeater-rows">
                    <?php foreach ($rows as $sub_i => $row_values) : ?>
                        <?php trb_render_repeater_row($field_key, $field_def, $index, $sub_i, (array) $row_values); ?>
                    <?php endforeach; ?>
                </div>
                <template class="trb-builder-repeater-tmpl"><?php trb_render_repeater_row($field_key, $field_def, $index, '__SUBINDEX__', array()); ?></template>
                <button type="button" class="button trb-builder-repeater-add"><?php echo esc_html($field_def['button'] ?? 'Add Row'); ?></button>
            </div>

        <?php else : ?>
            <label class="trb-builder-field-label" for="<?php echo esc_attr($field_id); ?>"><?php echo esc_html($field_def['label']); ?></label>
            <?php
            if (!empty($field_def['summary'])) {
                // mark the summary control after render via a wrapper data attribute
                echo '<span class="trb-builder-summary-src" style="display:contents;">';
            }
            trb_render_control($field_def, $field_name, $field_id, $value);
            if (!empty($field_def['summary'])) {
                echo '</span>';
            }
            ?>
        <?php endif; ?>

        <?php if (!empty($field_def['help'])) : ?>
            <span class="description trb-builder-help"><?php echo wp_kses_post($field_def['help']); ?></span>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Render a single section "card" in the admin meta box.
 *
 * @param string $type   Section type slug.
 * @param mixed  $index  Array index (int for existing sections, '__INDEX__' for JS templates).
 * @param array  $values Saved field values for this section.
 */
function trb_render_section_card($type, $index, $values = array(), $collapsed = false)
{
    $types = trb_builder_section_types();
    if (!isset($types[$type])) {
        return;
    }
    $def = $types[$type];
    $card_classes = 'trb-builder-card' . ($collapsed ? ' is-collapsed' : '');
    ?>
    <div class="<?php echo esc_attr($card_classes); ?>" data-type="<?php echo esc_attr($type); ?>">
        <div class="trb-builder-card-header">
            <span class="trb-builder-drag dashicons dashicons-menu" title="Drag to reorder"></span>
            <strong class="trb-builder-card-title"><?php echo esc_html($def['label']); ?></strong>
            <span class="trb-builder-card-summary"></span>
            <span class="trb-builder-card-actions">
                <button type="button" class="button-link trb-builder-duplicate" aria-label="Duplicate section" title="Duplicate"><span class="dashicons dashicons-admin-page"></span></button>
                <button type="button" class="button-link trb-builder-toggle" aria-label="Collapse / expand" title="Collapse / expand"><span class="dashicons dashicons-arrow-up-alt2"></span></button>
                <button type="button" class="button-link trb-builder-remove" aria-label="Remove section" title="Remove"><span class="dashicons dashicons-trash"></span></button>
            </span>
        </div>
        <div class="trb-builder-card-body">
            <input type="hidden" name="trb_builder[<?php echo esc_attr($index); ?>][type]" value="<?php echo esc_attr($type); ?>">
            <?php if (empty($def['fields'])) : ?>
                <p class="description">No content options for this section.</p>
            <?php endif; ?>
            <?php foreach ($def['fields'] as $field_key => $field_def) : ?>
                <?php trb_render_section_field($field_key, $field_def, $index, $values); ?>
            <?php endforeach; ?>

            <div class="trb-builder-design">
                <span class="trb-builder-design-title">Colors (optional)</span>
                <div class="trb-builder-design-fields">
                    <?php foreach (trb_builder_color_fields() as $field_key => $field_def) : ?>
                        <?php trb_render_section_field($field_key, $field_def, $index, $values); ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="trb-builder-design">
                <span class="trb-builder-design-title">Spacing (optional)</span>
                <div class="trb-builder-design-fields">
                    <?php foreach (trb_builder_spacing_fields() as $field_key => $field_def) : ?>
                        <?php trb_render_section_field($field_key, $field_def, $index, $values); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Render the "Page Builder" meta box.
 */
function trb_render_page_builder_metabox($post)
{
    $sections = trb_get_builder_sections($post->ID);
    $types = trb_builder_section_types();
    wp_nonce_field('trb_page_builder_save', 'trb_page_builder_nonce');
    ?>
    <div id="trb-builder">
        <p class="description trb-builder-intro">
            Build the page by adding sections below and dragging them into order. These render on the front end only when the
            <strong>Page Builder</strong> template is selected (Page Attributes &rarr; Template).
        </p>
        <div id="trb-builder-sections">
            <?php foreach ($sections as $index => $section) :
                $type = $section['type'] ?? '';
                if (!isset($types[$type])) {
                    continue;
                }
                trb_render_section_card($type, $index, $section, true);
            endforeach; ?>
        </div>
        <?php if (empty($sections)) : ?>
            <p class="trb-builder-empty">No sections yet. Click <strong>+ Add Section</strong> and pick a section type.</p>
        <?php endif; ?>
        <div class="trb-builder-toolbar">
            <button type="button" class="button button-primary button-hero" id="trb-builder-add" aria-expanded="false">+ Add Section</button>
            <div class="trb-builder-add-menu" id="trb-builder-add-menu" hidden>
                <?php foreach ($types as $slug => $def) : ?>
                    <button type="button" class="trb-builder-add-option" data-type="<?php echo esc_attr($slug); ?>"><?php echo esc_html($def['label']); ?></button>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="trb-builder-templates" style="display:none;">
            <?php foreach ($types as $slug => $def) : ?>
                <script type="text/html" id="trb-tmpl-<?php echo esc_attr($slug); ?>">
                    <?php trb_render_section_card($slug, '__INDEX__', array()); ?>
                </script>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}

add_action('add_meta_boxes', 'trb_add_page_builder_metabox');
function trb_add_page_builder_metabox()
{
    add_meta_box(
        'trb_page_builder',
        'Page Builder',
        'trb_render_page_builder_metabox',
        'page',
        'normal',
        'high'
    );
}

/**
 * Sanitize a single scalar value against its field definition.
 */
function trb_sanitize_scalar($field_def, $raw)
{
    $allow = !empty($field_def['allow_html']);
    switch ($field_def['type']) {
        case 'textarea':
            return $allow ? wp_kses_post($raw) : sanitize_textarea_field($raw);
        case 'checkbox':
            return !empty($raw) ? 1 : 0;
        case 'image':
            return absint($raw);
        case 'number':
            return max(1, absint($raw));
        case 'term_select':
            return absint($raw);
        case 'select':
            $options = array_keys($field_def['options'] ?? array());
            return in_array($raw, $options, true) ? $raw : ($field_def['default'] ?? ($options[0] ?? ''));
        default:
            return $allow ? wp_kses_post($raw) : sanitize_text_field($raw);
    }
}

/**
 * Save handler — sanitizes posted sections and stores them as JSON.
 */
add_action('save_post_page', 'trb_save_page_builder_sections');
function trb_save_page_builder_sections($post_id)
{
    if (!isset($_POST['trb_page_builder_nonce']) || !wp_verify_nonce($_POST['trb_page_builder_nonce'], 'trb_page_builder_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_page', $post_id)) {
        return;
    }

    $types = trb_builder_section_types();
    $raw_sections = (isset($_POST['trb_builder']) && is_array($_POST['trb_builder'])) ? wp_unslash($_POST['trb_builder']) : array();
    $sanitized = array();

    foreach ($raw_sections as $raw_section) {
        $type = isset($raw_section['type']) ? sanitize_key($raw_section['type']) : '';
        if (!isset($types[$type])) {
            continue;
        }

        $clean = array('type' => $type);

        $fields = array_merge($types[$type]['fields'], trb_builder_common_fields());

        foreach ($fields as $field_key => $field_def) {
            $raw_value = $raw_section[$field_key] ?? '';

            if ($field_def['type'] === 'post_select') {
                $ids = is_array($raw_value) ? $raw_value : array();
                $clean[$field_key] = array_values(array_filter(array_map('absint', $ids)));
                continue;
            }

            if ($field_def['type'] === 'repeater') {
                $rows = is_array($raw_value) ? $raw_value : array();
                $clean_rows = array();
                foreach ($rows as $row) {
                    if (!is_array($row)) {
                        continue;
                    }
                    $clean_row = array();
                    $has_content = false;
                    foreach ($field_def['sub_fields'] as $sub_key => $sub_def) {
                        $sub_raw = $row[$sub_key] ?? '';
                        $clean_val = trb_sanitize_scalar($sub_def, $sub_raw);
                        if ($clean_val !== '' && $clean_val !== 0) {
                            $has_content = true;
                        }
                        $clean_row[$sub_key] = $clean_val;
                    }
                    if ($has_content) {
                        $clean_rows[] = $clean_row;
                    }
                }
                $clean[$field_key] = $clean_rows;
                continue;
            }

            $clean[$field_key] = trb_sanitize_scalar($field_def, $raw_value);
        }

        $sanitized[] = $clean;
    }

    update_post_meta($post_id, '_trb_page_builder_sections', wp_json_encode($sanitized));
}

/**
 * Render all builder sections for a post on the front end.
 */
function trb_render_builder_sections($post_id)
{
    $sections = trb_get_builder_sections($post_id);
    $types = trb_builder_section_types();

    foreach ($sections as $section_index => $section) {
        $type = $section['type'] ?? '';
        if (!isset($types[$type])) {
            continue;
        }
        // Section type slugs use underscores; partial filenames use hyphens.
        $file_slug = str_replace('_', '-', $type);
        $template = get_theme_file_path("template-parts/builder/section-{$file_slug}.php");
        if (!file_exists($template)) {
            continue;
        }

        // Capture the section markup so we can skip empty sections and wrap it
        // with optional background / text colors chosen by the editor.
        ob_start();
        include $template;
        $html = ob_get_clean();

        if (trim($html) === '') {
            continue;
        }

        $bg = trb_builder_color_css($section['bg_color'] ?? '');
        $text = trb_builder_color_css($section['text_color'] ?? '');

        $spacing_slugs = array('none', 'small', 'medium', 'large', 'xlarge');
        $spacing_classes = array();
        foreach (array('margin_top' => 'mt', 'margin_bottom' => 'mb', 'padding_top' => 'pt', 'padding_bottom' => 'pb') as $field => $prefix) {
            $slug = $section[$field] ?? '';
            if (in_array($slug, $spacing_slugs, true)) {
                $spacing_classes[] = 'trb-' . $prefix . '-' . $slug;
            }
        }

        if ($bg === '' && $text === '' && empty($spacing_classes)) {
            echo $html;
            continue;
        }

        $styles = array();
        if ($bg !== '') {
            $styles[] = 'background-color: ' . $bg;
        }
        if ($text !== '') {
            $styles[] = 'color: ' . $text;
        }

        $classes = array('trb-section-design');
        if ($bg !== '') {
            $classes[] = 'has-bg';
        }
        if ($text !== '') {
            $classes[] = 'has-text';
        }
        $classes = array_merge($classes, $spacing_classes);

        $style_attr = !empty($styles) ? ' style="' . esc_attr(implode('; ', $styles)) . '"' : '';

        echo '<div class="' . esc_attr(implode(' ', $classes)) . '"' . $style_attr . '>';
        echo $html;
        echo '</div>';
    }
}

/**
 * Front-end assets — only loaded on pages using the Page Builder template.
 * Validates file existence before utilizing filemtime() to prevent cache-busting failure.
 */
add_action('wp_enqueue_scripts', 'trb_builder_frontend_assets');
function trb_builder_frontend_assets()
{
    if (!is_page_template('page-template-builder.php')) {
        return;
    }
    
    $path = '/css/page-builder.css';
    $absolute_path = get_stylesheet_directory() . $path;

    // Resolve dynamic cache-busting version or fallback to defined constant
    $version = file_exists( $absolute_path ) ? filemtime( $absolute_path ) : TRB_BUILDER_VERSION;

    wp_enqueue_style('trb-page-builder', get_stylesheet_directory_uri() . $path, array(), $version);

    // Copy-to-clipboard for offer discount codes (slider + filter grid cards).
    $copy_path = '/js/offer-copy-code.js';
    $copy_abs  = get_stylesheet_directory() . $copy_path;
    $copy_ver  = file_exists($copy_abs) ? filemtime($copy_abs) : TRB_BUILDER_VERSION;
    wp_enqueue_script('trb-offer-copy-code', get_stylesheet_directory_uri() . $copy_path, array(), $copy_ver, true);
}

/**
 * Admin assets — only loaded on the page edit screen.
 * Validates file existence before utilizing filemtime() to prevent cache-busting failure.
 */
add_action('admin_enqueue_scripts', 'trb_builder_admin_assets', 20);
function trb_builder_admin_assets($hook)
{
    if (!in_array($hook, array('post.php', 'post-new.php'), true)) {
        return;
    }
    $screen = get_current_screen();
    if (!$screen || $screen->post_type !== 'page') {
        return;
    }

    wp_enqueue_media();
    wp_enqueue_script('jquery-ui-sortable');

    // Searchable multi-select (provided by WooCommerce). Fall back gracefully if absent.
    $select_deps = array('jquery');
    if (wp_script_is('selectWoo', 'registered')) {
        wp_enqueue_script('selectWoo');
        wp_enqueue_style('select2');
        $select_deps[] = 'selectWoo';
    } elseif (wp_script_is('select2', 'registered')) {
        wp_enqueue_script('select2');
        wp_enqueue_style('select2');
        $select_deps[] = 'select2';
    }

    $css_path = '/css/page-builder-admin.css';
    $js_path = '/js/page-builder-admin.js';
    
    $absolute_css_path = get_stylesheet_directory() . $css_path;
    $absolute_js_path  = get_stylesheet_directory() . $js_path;

    // Resolve dynamic cache-busting versions or fallback to defined constant
    $css_version = file_exists( $absolute_css_path ) ? filemtime( $absolute_css_path ) : TRB_BUILDER_VERSION;
    $js_version  = file_exists( $absolute_js_path ) ? filemtime( $absolute_js_path ) : TRB_BUILDER_VERSION;

    wp_enqueue_style('trb-page-builder-admin', get_stylesheet_directory_uri() . $css_path, array(), $css_version);
    wp_enqueue_script('trb-page-builder-admin', get_stylesheet_directory_uri() . $js_path, array_merge(array('jquery', 'jquery-ui-sortable'), array_slice($select_deps, 1)), $js_version, true);
}
