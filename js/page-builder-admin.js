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
        if ($field.data('trb-image-init')) {
            return;
        }
        $field.data('trb-image-init', true);

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

    function getFieldValue($card, ctrlName) {
        var $ctrl = $card.find('> .trb-builder-card-body [name$="[' + ctrlName + ']"]').filter('select, input').first();
        if ($ctrl.is(':checkbox')) {
            return $ctrl.is(':checked') ? ($ctrl.val() || '1') : '';
        }
        return $ctrl.length ? String($ctrl.val()) : '';
    }

    function applyConditional($card) {
        $card.find('> .trb-builder-card-body > .trb-builder-field[data-show-when-field], > .trb-builder-card-body > .trb-builder-field[data-hide-when-field]').each(function () {
            var $f = $(this);
            var visible = true;

            if ($f.data('show-when-field')) {
                visible = getFieldValue($card, $f.data('show-when-field')) === String($f.data('show-when-value'));
            }

            if (visible && $f.data('hide-when-field')) {
                if (getFieldValue($card, $f.data('hide-when-field')) === String($f.data('hide-when-value'))) {
                    visible = false;
                }
            }

            $f.toggle(visible);
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

        // Bind any media-picker fields inside the row (e.g. image sub-fields on a
        // newly added ad row), which bindCard's initial pass can't reach.
        $row.find('.trb-builder-image-field').each(function () {
            bindImageField($(this));
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

        $card.find('> .trb-builder-card-header .trb-builder-duplicate').on('click', function () {
            duplicateCard($card);
        });

        $card.find('.trb-builder-image-field').each(function () {
            bindImageField($(this));
        });

        $card.find('.trb-builder-repeater').each(function () {
            bindRepeater($(this));
        });

        initSearchSelects($card.find('.trb-builder-postselect, .trb-builder-termselect'));
        bindConditional($card);
        bindSummary($card);
    }

    /* -------------------------------------------------------------- duplicate card */

    // Push current field values into attributes so a DOM clone keeps them.
    function freezeValues($scope) {
        $scope.find('input').each(function () {
            if (this.type === 'checkbox' || this.type === 'radio') {
                if (this.checked) {
                    this.setAttribute('checked', 'checked');
                } else {
                    this.removeAttribute('checked');
                }
            } else {
                this.setAttribute('value', this.value);
            }
        });
        $scope.find('textarea').each(function () {
            this.textContent = this.value;
        });
        $scope.find('select').each(function () {
            $(this.options).each(function () {
                if (this.selected) {
                    this.setAttribute('selected', 'selected');
                } else {
                    this.removeAttribute('selected');
                }
            });
        });
    }

    function duplicateCard($card) {
        freezeValues($card);

        var $clone = $card.clone();

        // Strip any select2 / selectWoo rendering so it re-initialises cleanly.
        $clone.find('.select2-container').remove();
        $clone.find('select')
            .removeClass('select2-hidden-accessible')
            .removeAttr('data-select2-id aria-hidden tabindex style');
        $clone.find('option[data-select2-id]').removeAttr('data-select2-id');

        // Work out the original index from the hidden "type" input and re-key everything.
        var oldName = $clone.find('> .trb-builder-card-body > input[name$="[type]"]').attr('name') || '';
        var match = oldName.match(/^trb_builder\[(.+?)\]\[type\]$/);
        if (!match) {
            return;
        }
        var oldPrefix = 'trb_builder[' + match[1] + ']';
        var newIndex = 'new-' + uid();
        var newPrefix = 'trb_builder[' + newIndex + ']';

        $clone.find('[name]').each(function () {
            this.setAttribute('name', this.getAttribute('name').split(oldPrefix).join(newPrefix));
        });
        // Keep label/input ids unique so labels keep focusing the right field.
        $clone.find('[id]').each(function () {
            this.id = this.id + '-' + newIndex;
        });
        $clone.find('label[for]').each(function () {
            this.setAttribute('for', this.getAttribute('for') + '-' + newIndex);
        });
        // Repeater row templates live inside <template> (inert to find) — fix by hand.
        $clone.find('.trb-builder-repeater-tmpl').each(function () {
            this.innerHTML = this.innerHTML.split(oldPrefix).join(newPrefix);
        });

        $clone.removeClass('is-collapsed');
        $clone.find('> .trb-builder-card-body').show();

        $card.after($clone);
        bindCard($clone);

        $('html, body').animate({ scrollTop: $clone.offset().top - 60 }, 200);
    }

    /* ------------------------------------------------------------------ add section */

    function addSection(type) {
        var $tmpl = $('#trb-tmpl-' + type);
        if (!$tmpl.length) {
            return;
        }

        var html = $tmpl.html().split('__INDEX__').join('new-' + uid());
        var $card = $('<div>').html($.trim(html)).children('.trb-builder-card').first();

        $('#trb-builder-sections').append($card);
        $('.trb-builder-empty').remove();
        bindCard($card);

        $('html, body').animate({ scrollTop: $card.offset().top - 60 }, 200);
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

        var $addBtn = $('#trb-builder-add');
        var $addMenu = $('#trb-builder-add-menu');

        $addBtn.on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var show = $addMenu.prop('hidden');
            $addMenu.prop('hidden', !show);
            $addBtn.attr('aria-expanded', show ? 'true' : 'false');
        });

        $addMenu.on('click', '.trb-builder-add-option', function (e) {
            e.preventDefault();
            addSection($(this).data('type'));
            $addMenu.prop('hidden', true);
            $addBtn.attr('aria-expanded', 'false');
        });

        // Close the menu when clicking elsewhere.
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.trb-builder-toolbar').length) {
                $addMenu.prop('hidden', true);
                $addBtn.attr('aria-expanded', 'false');
            }
        });
    });
})(jQuery);
