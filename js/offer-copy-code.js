/**
 * Copy-to-clipboard for offer discount codes.
 *
 * Delegated on the document so it works for both the Offer Slider and the Offer
 * Filter grid, and survives the grid's AJAX re-renders. The clicked button gets
 * an `.is-copied` class (reset after a moment) which the CSS uses to swap the
 * copy icon for a "Copied!" confirmation.
 */
(function () {
    'use strict';

    function flag(btn) {
        btn.classList.add('is-copied');
        window.setTimeout(function () {
            btn.classList.remove('is-copied');
        }, 1500);
    }

    function legacyCopy(text, btn) {
        var ta = document.createElement('textarea');
        ta.value = text;
        ta.setAttribute('readonly', '');
        ta.style.position = 'fixed';
        ta.style.opacity = '0';
        document.body.appendChild(ta);
        ta.select();
        try {
            document.execCommand('copy');
        } catch (e) { /* no-op */ }
        document.body.removeChild(ta);
        flag(btn);
    }

    document.addEventListener('click', function (e) {
        var btn = e.target.closest ? e.target.closest('.product-code-copy') : null;
        if (!btn) {
            return;
        }
        e.preventDefault();

        var code = btn.getAttribute('data-code') || '';
        if (!code) {
            return;
        }

        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(code).then(function () {
                flag(btn);
            }).catch(function () {
                legacyCopy(code, btn);
            });
        } else {
            legacyCopy(code, btn);
        }
    });
})();
