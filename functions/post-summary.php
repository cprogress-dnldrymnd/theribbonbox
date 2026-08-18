<?php

add_action('acf/include_field_types', 'trb_register_summary_item_field_type');
function trb_register_summary_item_field_type()
{
    if (!class_exists('acf_field')) {
        return;
    }

    class acf_field_trb_repeater_text extends acf_field
    {
        public function initialize()
        {
            $this->name = 'trb_repeater_text';
            $this->label = 'Repeater Text';
            $this->category = 'basic';
        }

        public function render_field($field)
        {
            $texts = trb_normalize_summary_items($field['value'] ?? array());
            if (empty($texts)) {
                $texts[] = '';
            }
            $name = $field['name'];
            ?>
            <div class="trb-summary-repeater">
                <div class="trb-summary-repeater__rows">
                    <?php foreach ($texts as $text) : ?>
                        <div class="trb-summary-repeater__row">
                            <textarea class="trb-summary-repeater__input" name="<?php echo esc_attr($name); ?>[]" rows="2"><?php echo esc_textarea($text); ?></textarea>
                            <button type="button" class="button trb-summary-repeater__remove">Remove</button>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="button button-secondary trb-summary-repeater__add">Add summary item</button>
            </div>
            <?php
        }

        public function input_admin_enqueue_scripts()
        {
            $css = '
                .trb-summary-repeater__rows{display:flex;flex-direction:column;gap:8px;margin-bottom:8px}
                .trb-summary-repeater__row{display:flex;align-items:flex-start;gap:8px}
                .trb-summary-repeater__input{flex:1;width:100%;min-height:52px}
            ';
            wp_register_style('trb-summary-repeater', false);
            wp_enqueue_style('trb-summary-repeater');
            wp_add_inline_style('trb-summary-repeater', $css);

            $js = <<<'JS'
            (function(){
                document.addEventListener('click', function(e){
                    var addBtn = e.target.closest('.trb-summary-repeater__add');
                    if (addBtn) {
                        var wrap = addBtn.closest('.trb-summary-repeater');
                        var rows = wrap.querySelector('.trb-summary-repeater__rows');
                        var row = rows.querySelector('.trb-summary-repeater__row');
                        if (!row) { return; }
                        var clone = row.cloneNode(true);
                        var input = clone.querySelector('textarea');
                        if (input) { input.value = ''; }
                        rows.appendChild(clone);
                        if (input) { input.focus(); }
                        return;
                    }
                    var removeBtn = e.target.closest('.trb-summary-repeater__remove');
                    if (removeBtn) {
                        var row = removeBtn.closest('.trb-summary-repeater__row');
                        var rows = row && row.parentElement;
                        if (!row || !rows) { return; }
                        if (rows.children.length > 1) {
                            row.remove();
                        } else {
                            var input = row.querySelector('textarea');
                            if (input) { input.value = ''; }
                        }
                    }
                });
            })();
            JS;
            wp_register_script('trb-summary-repeater', '', array(), false, true);
            wp_enqueue_script('trb-summary-repeater');
            wp_add_inline_script('trb-summary-repeater', $js);
        }

        public function load_value($value, $post_id, $field)
        {
            return trb_normalize_summary_items($value);
        }

        public function update_value($value, $post_id, $field)
        {
            $rows = array();
            foreach (trb_normalize_summary_items($value) as $text) {
                $rows[] = array('text' => $text);
            }
            return $rows;
        }

        public function format_value($value, $post_id, $field)
        {
            $rows = array();
            foreach (trb_normalize_summary_items($value) as $text) {
                $rows[] = array('text' => $text);
            }
            return $rows;
        }
    }

    new acf_field_trb_repeater_text();
}

function trb_normalize_summary_items($value)
{
    if (!is_array($value)) {
        return array();
    }

    $texts = array();
    foreach ($value as $row) {
        if (is_array($row)) {
            $text = isset($row['text']) ? $row['text'] : '';
        } else {
            $text = $row;
        }
        $text = trim((string) $text);
        if ($text !== '') {
            $texts[] = $text;
        }
    }

    return $texts;
}

add_action('acf/include_fields', 'trb_register_post_summary_fields');
function trb_register_post_summary_fields()
{
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_trb_post_summary',
        'title' => 'Post Summary',
        'fields' => array(
            array(
                'key' => 'field_trb_summary_heading',
                'label' => 'Heading',
                'name' => 'summary_heading',
                'type' => 'text',
                'instructions' => 'Shown at the top of the summary block.',
            ),
            array(
                'key' => 'field_trb_summary_description',
                'label' => 'Description',
                'name' => 'summary_description',
                'type' => 'textarea',
                'rows' => 3,
                'instructions' => 'Optional intro text under the heading.',
            ),
            array(
                'key' => 'field_trb_summary_items',
                'label' => 'Summary Items',
                'name' => 'summary_items',
                'type' => 'trb_repeater_text',
                'instructions' => 'Add each takeaway as a separate row.',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ),
            ),
        ),
        'position' => 'acf_after_title',
        'style' => 'default',
        'active' => true,
    ));
}

function trb_render_post_summary($post_id = null)
{
    if (!function_exists('get_field')) {
        return;
    }

    $post_id = $post_id ?: get_the_ID();
    $heading = get_field('summary_heading', $post_id);
    $description = get_field('summary_description', $post_id);
    $items = get_field('summary_items', $post_id);

    $has_items = is_array($items) && !empty($items);
    if (!$heading && !$description && !$has_items) {
        return;
    }

    echo '<div class="post-summary">';

    if ($heading) {
        echo '<h2 class="post-summary__heading">' . esc_html($heading) . '</h2>';
    }

    if ($description) {
        echo '<p class="post-summary__description">' . nl2br(esc_html($description)) . '</p>';
    }

    if ($has_items) {
        echo '<ol class="post-summary__list">';
        $n = 1;
        foreach ($items as $row) {
            $text = isset($row['text']) ? trim((string) $row['text']) : '';
            if ($text === '') {
                continue;
            }
            echo '<li class="post-summary__item">';
            echo '<span class="post-summary__badge" aria-hidden="true">' . esc_html((string) $n) . '</span>';
            echo '<p class="post-summary__text">' . nl2br(esc_html($text)) . '</p>';
            echo '</li>';
            $n++;
        }
        echo '</ol>';
    }

    echo '</div>';
}
