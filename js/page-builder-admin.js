/*-----------------------------------------------------------------------------------*/
/* TRB Page Builder — admin meta box repeater UI
/*-----------------------------------------------------------------------------------*/

(function ($) {
    'use strict';

    var counter = Date.now();

    function bindImageField($field) {
        var $select = $field.find('.trb-builder-image-select');
        var $remove = $field.find('.trb-builder-image-remove');
        var $input = $field.find('.trb-builder-image-id');
        var $preview = $field.find('.trb-builder-image-preview');
        var frame;

        $select.on('click', function (e) {
            e.preventDefault();

            if (frame) {
                frame.open();
                return;
            }

            frame = wp.media({
                title: 'Select Image',
                multiple: false
            });

            frame.on('select', function () {
                var attachment = frame.state().get('selection').first().toJSON();
                var url = attachment.url;

                if (attachment.sizes) {
                    if (attachment.sizes.medium) {
                        url = attachment.sizes.medium.url;
                    } else if (attachment.sizes.thumbnail) {
                        url = attachment.sizes.thumbnail.url;
                    }
                }

                $input.val(attachment.id);
                $preview.html('<img src="' + url + '" alt="">');
                $remove.show();
            });

            frame.open();
        });

        $remove.on('click', function (e) {
            e.preventDefault();
            $input.val('');
            $preview.html('');
            $(this).hide();
        });
    }

    function bindCard($card) {
        $card.find('> .trb-builder-card-header .trb-builder-toggle').on('click', function () {
            $card.find('> .trb-builder-card-body').slideToggle(150);
            $card.toggleClass('is-collapsed');
        });

        $card.find('> .trb-builder-card-header .trb-builder-remove').on('click', function () {
            if (window.confirm('Remove this section?')) {
                $card.remove();
            }
        });

        $card.find('.trb-builder-image-field').each(function () {
            bindImageField($(this));
        });
    }

    $(function () {
        var $list = $('#trb-builder-sections');

        $list.find('> .trb-builder-card').each(function () {
            bindCard($(this));
        });

        $list.sortable({
            handle: '.trb-builder-drag',
            axis: 'y',
            placeholder: 'trb-builder-card-placeholder'
        });

        $('#trb-builder-add').on('click', function (e) {
            e.preventDefault();

            var type = $('#trb-builder-add-type').val();
            var $tmpl = $('#trb-tmpl-' + type);

            if (!$tmpl.length) {
                return;
            }

            counter += 1;

            var html = $tmpl.html().split('__INDEX__').join('new-' + counter);
            var $card = $($.parseHTML($.trim(html)));

            $list.append($card);
            bindCard($card);
        });
    });
})(jQuery);
