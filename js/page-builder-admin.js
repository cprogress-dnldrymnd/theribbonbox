/*-----------------------------------------------------------------------------------*/
/* TRB Page Builder — admin meta box repeater UI
/*-----------------------------------------------------------------------------------*/

(function ($) {
    'use strict';

    var counter = Date.now();

    function uid() {
        counter += 1;
        return counter;
    }

    /* ------------------------------------------------------------------ helpers */

    function initSearchSelects($els) {
        $els.each(function () {
            var $s = $(this);
            if ($s.data('trb-select-init')) {
                return;
            }
            $s.data('trb-select-init', true);
            var opts = { width: '100%' };
            if ($s.data('placeholder')) {
                opts.placeholder = $s.data('placeholder');
                opts.allowClear = !$s.prop('multiple');
            }
            if (typeof $.fn.selectWoo === 'function') {
                $s.selectWoo(opts);
            } else if (typeof $.fn.select2 === 'function') {
                $s.select2(opts);
            }
        });
    }

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

            frame = wp.media({ title: 'Select Image', multiple: false });

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

    /* ----------------------------------------------------------- conditional fields */

    function applyConditional($card) {
        $card.find('> .trb-builder-card-body > .trb-builder-field[data-show-when-field]').each(function () {
            var $f = $(this);
            var ctrlName = $f.data('show-when-field');
            var want = String($f.data('show-when-value'));
            var $ctrl = $card.find('> .trb-builder-card-body [name$="[' + ctrlName + ']"]').filter('select, input').first();
            var val = $ctrl.length ? String($ctrl.val()) : '';
            $f.toggle(val === want);
        });
    }

    function bindConditional($card) {
        $card.find('> .trb-builder-card-body > .trb-builder-field select, > .trb-builder-card-body > .trb-builder-field input').on('change.trbcond', function () {
            applyConditional($card);
        });
        applyConditional($card);
    }

    /* ------------------------------------------------------------------- repeater */

    function bindRepeaterRow($row) {
        $row.find('> .trb-builder-repeater-remove').on('click', function () {
            $row.remove();
        });
    }

    function bindRepeater($repeater) {
        var $rows = $repeater.find('> .trb-builder-repeater-rows');

        $rows.find('> .trb-builder-repeater-row').each(function () {
            bindRepeaterRow($(this));
        });

        if ($rows.sortable) {
            $rows.sortable({ handle: '.trb-builder-repeater-drag', axis: 'y', items: '> .trb-builder-repeater-row' });
        }

        $repeater.find('> .trb-builder-repeater-add').on('click', function (e) {
            e.preventDefault();
            var tmpl = $repeater.find('> .trb-builder-repeater-tmpl')[0];
            if (!tmpl) {
                return;
            }
            var html = (tmpl.innerHTML || '').split('__SUBINDEX__').join('r' + uid());
            var $row = $('<div>').html($.trim(html)).children('.trb-builder-repeater-row').first();
            $rows.append($row);
            bindRepeaterRow($row);
        });
    }

    /* ---------------------------------------------------------------- card summary */

    function bindSummary($card) {
        var $src = $card.find('> .trb-builder-card-body .trb-builder-summary-src').find('input, textarea').first();
        var $out = $card.find('> .trb-builder-card-header .trb-builder-card-summary');
        if (!$src.length) {
            return;
        }
        function update() {
            var v = $.trim(($src.val() || '').replace(/<[^>]*>/g, ' ')).replace(/\s+/g, ' ');
            if (v.length > 60) {
                v = v.slice(0, 60) + '…';
            }
            $out.text(v ? '— ' + v : '');
        }
        $src.on('input change', update);
        update();
    }

    /* ------------------------------------------------------------------- bind card */

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

        $card.find('> .trb-builder-card-body > .trb-builder-field-repeater .trb-builder-repeater').each(function () {
            bindRepeater($(this));
        });

        initSearchSelects($card.find('.trb-builder-postselect, .trb-builder-termselect'));
        bindConditional($card);
        bindSummary($card);
    }

    /* ----------------------------------------------------------------------- ready */

    $(function () {
        var $list = $('#trb-builder-sections');

        $list.find('> .trb-builder-card').each(function () {
            bindCard($(this));
        });

        $list.sortable({
            handle: '.trb-builder-drag',
            axis: 'y',
            placeholder: 'trb-builder-card-placeholder',
            items: '> .trb-builder-card'
        });

        $('#trb-builder-add').on('click', function (e) {
            e.preventDefault();

            var type = $('#trb-builder-add-type').val();
            var $tmpl = $('#trb-tmpl-' + type);

            if (!$tmpl.length) {
                return;
            }

            var html = $tmpl.html().split('__INDEX__').join('new-' + uid());
            var $card = $('<div>').html($.trim(html)).children('.trb-builder-card').first();

            $list.append($card);
            $('.trb-builder-empty').remove();
            bindCard($card);

            $('html, body').animate({ scrollTop: $card.offset().top - 60 }, 200);
        });
    });
})(jQuery);
