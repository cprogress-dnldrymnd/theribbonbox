<?php
/*-----------------------------------------------------------------------------------*/
/* TRB Page Builder
/* A lightweight, ACF-free section builder for the "Page Builder" page template.
/* Stores an ordered list of sections (type + fields) as JSON in post meta.
/*-----------------------------------------------------------------------------------*/

/**
 * Registry of available section types and their editable fields.
 */
function trb_builder_section_types()
{
    return array(
        'hero' => array(
            'label' => 'Hero / Page Title',
            'fields' => array(
                'heading' => array(
                    'type' => 'textarea',
                    'label' => 'Heading (HTML allowed, e.g. <i>italic</i>)',
                    'rows' => 2,
                    'allow_html' => true,
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
                    'type' => 'textarea',
                    'label' => 'Links — one per line as: Label | #anchor-id',
                    'rows' => 5,
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
                'style' => array(
                    'type' => 'select',
                    'label' => 'Background Style',
                    'options' => array(
                        'default' => 'Default (Light)',
                        'wine' => 'Dark (Wine)',
                    ),
                    'default' => 'default',
                ),
            ),
        ),
        'product_tabs' => array(
            'label' => 'Product Tabs',
            'fields' => array(
                'title' => array(
                    'type' => 'text',
                    'label' => 'Section Title (optional, HTML allowed)',
                    'allow_html' => true,
                ),
                'style' => array(
                    'type' => 'select',
                    'label' => 'Style',
                    'options' => array(
                        'default' => 'Default',
                        'light' => 'Light (on dark background)',
                    ),
                    'default' => 'default',
                ),
                'tabs' => array(
                    'type' => 'textarea',
                    'label' => 'Tabs — one per line as: Label | Product Widget ID',
                    'rows' => 5,
                ),
                'button_text' => array(
                    'type' => 'text',
                    'label' => 'Button Text',
                ),
                'button_link' => array(
                    'type' => 'text',
                    'label' => 'Button Link',
                ),
                'decorative_bar' => array(
                    'type' => 'checkbox',
                    'label' => 'Show decorative background bar above (use after a Wine two-column section)',
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
                ),
            ),
        ),
    );
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
 * Render a single section "card" in the admin meta box.
 *
 * @param string $type   Section type slug.
 * @param mixed  $index  Array index (int for existing sections, '__INDEX__' for JS templates).
 * @param array  $values Saved field values for this section.
 */
function trb_render_section_card($type, $index, $values = array())
{
    $types = trb_builder_section_types();
    if (!isset($types[$type])) {
        return;
    }
    $def = $types[$type];
    ?>
    <div class="trb-builder-card" data-type="<?php echo esc_attr($type); ?>">
        <div class="trb-builder-card-header">
            <span class="trb-builder-drag dashicons dashicons-move" title="Drag to reorder"></span>
            <strong class="trb-builder-card-title"><?php echo esc_html($def['label']); ?></strong>
            <span class="trb-builder-card-actions">
                <button type="button" class="button-link trb-builder-toggle">Toggle</button>
                <button type="button" class="button-link-delete trb-builder-remove">Remove</button>
            </span>
        </div>
        <div class="trb-builder-card-body">
            <input type="hidden" name="trb_builder[<?php echo esc_attr($index); ?>][type]" value="<?php echo esc_attr($type); ?>">
            <?php if (empty($def['fields'])) : ?>
                <p class="description">No options for this section.</p>
            <?php endif; ?>
            <?php foreach ($def['fields'] as $field_key => $field_def) :
                $field_id = 'trb-builder-' . $type . '-' . $index . '-' . $field_key;
                $field_name = "trb_builder[{$index}][{$field_key}]";
                $value = array_key_exists($field_key, $values) ? $values[$field_key] : ($field_def['default'] ?? '');
                ?>
                <p class="trb-builder-field trb-builder-field-<?php echo esc_attr($field_def['type']); ?>">
                    <?php if ($field_def['type'] === 'checkbox') : ?>
                        <label class="trb-builder-checkbox-label">
                            <input type="checkbox" id="<?php echo esc_attr($field_id); ?>" name="<?php echo esc_attr($field_name); ?>" value="1" <?php checked(!empty($value)); ?>>
                            <?php echo esc_html($field_def['label']); ?>
                        </label>
                    <?php else : ?>
                        <label for="<?php echo esc_attr($field_id); ?>"><?php echo esc_html($field_def['label']); ?></label>
                        <?php switch ($field_def['type']) :
                            case 'textarea': ?>
                                <textarea id="<?php echo esc_attr($field_id); ?>" name="<?php echo esc_attr($field_name); ?>" rows="<?php echo esc_attr($field_def['rows'] ?? 3); ?>" class="widefat"><?php echo esc_textarea($value); ?></textarea>
                                <?php break;
                            case 'select': ?>
                                <select id="<?php echo esc_attr($field_id); ?>" name="<?php echo esc_attr($field_name); ?>">
                                    <?php foreach ($field_def['options'] as $opt_value => $opt_label) : ?>
                                        <option value="<?php echo esc_attr($opt_value); ?>" <?php selected($value, $opt_value); ?>><?php echo esc_html($opt_label); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php break;
                            case 'image':
                                $attachment_id = absint($value);
                                ?>
                                <div class="trb-builder-image-field">
                                    <div class="trb-builder-image-preview"><?php if ($attachment_id) {
                                        echo wp_get_attachment_image($attachment_id, 'medium');
                                    } ?></div>
                                    <input type="hidden" class="trb-builder-image-id" id="<?php echo esc_attr($field_id); ?>" name="<?php echo esc_attr($field_name); ?>" value="<?php echo esc_attr($attachment_id); ?>">
                                    <button type="button" class="button trb-builder-image-select">Select Image</button>
                                    <button type="button" class="button trb-builder-image-remove" <?php echo $attachment_id ? '' : 'style="display:none;"'; ?>>Remove</button>
                                </div>
                                <?php break;
                            default: ?>
                                <input type="text" id="<?php echo esc_attr($field_id); ?>" name="<?php echo esc_attr($field_name); ?>" value="<?php echo esc_attr($value); ?>" class="widefat">
                        <?php endswitch; ?>
                    <?php endif; ?>
                </p>
            <?php endforeach; ?>
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
        <p class="description">
            These sections render on the front end only when the <strong>Page Builder</strong> page template is selected (Page Attributes &rarr; Template).
        </p>
        <div id="trb-builder-sections">
            <?php foreach ($sections as $index => $section) :
                $type = $section['type'] ?? '';
                if (!isset($types[$type])) {
                    continue;
                }
                trb_render_section_card($type, $index, $section);
            endforeach; ?>
        </div>
        <div class="trb-builder-toolbar">
            <select id="trb-builder-add-type">
                <?php foreach ($types as $slug => $def) : ?>
                    <option value="<?php echo esc_attr($slug); ?>"><?php echo esc_html($def['label']); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="button" class="button button-primary" id="trb-builder-add">Add Section</button>
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

        foreach ($types[$type]['fields'] as $field_key => $field_def) {
            $raw_value = $raw_section[$field_key] ?? '';

            $allow_html = !empty($field_def['allow_html']);

            switch ($field_def['type']) {
                case 'textarea':
                    $clean[$field_key] = $allow_html ? wp_kses_post($raw_value) : sanitize_textarea_field($raw_value);
                    break;
                case 'checkbox':
                    $clean[$field_key] = !empty($raw_value) ? 1 : 0;
                    break;
                case 'image':
                    $clean[$field_key] = absint($raw_value);
                    break;
                case 'select':
                    $options = array_keys($field_def['options'] ?? array());
                    $clean[$field_key] = in_array($raw_value, $options, true) ? $raw_value : ($field_def['default'] ?? ($options[0] ?? ''));
                    break;
                default:
                    $clean[$field_key] = $allow_html ? wp_kses_post($raw_value) : sanitize_text_field($raw_value);
            }
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
        $template = get_theme_file_path("template-parts/builder/section-{$type}.php");
        if (file_exists($template)) {
            include $template;
        }
    }
}

/**
 * Front-end assets — only loaded on pages using the Page Builder template.
 */
add_action('wp_enqueue_scripts', 'trb_builder_frontend_assets');
function trb_builder_frontend_assets()
{
    if (!is_page_template('page-template-builder.php')) {
        return;
    }
    $path = '/css/page-builder.css';
    wp_enqueue_style('trb-page-builder', get_stylesheet_directory_uri() . $path, array(), filemtime(get_stylesheet_directory() . $path));
}

/**
 * Admin assets — only loaded on the page edit screen.
 */
add_action('admin_enqueue_scripts', 'trb_builder_admin_assets');
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

    $css_path = '/css/page-builder-admin.css';
    $js_path = '/js/page-builder-admin.js';

    wp_enqueue_style('trb-page-builder-admin', get_stylesheet_directory_uri() . $css_path, array(), filemtime(get_stylesheet_directory() . $css_path));
    wp_enqueue_script('trb-page-builder-admin', get_stylesheet_directory_uri() . $js_path, array('jquery', 'jquery-ui-sortable'), filemtime(get_stylesheet_directory() . $js_path), true);
}
