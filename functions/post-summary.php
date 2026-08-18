<?php

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
                'type' => 'repeater',
                'instructions' => 'Add each takeaway as a separate row.',
                'layout' => 'table',
                'button_label' => 'Add summary item',
                'sub_fields' => array(
                    array(
                        'key' => 'field_trb_summary_item_text',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'textarea',
                        'rows' => 2,
                    ),
                ),
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
