/*-----------------------------------------------------------------------------------*/
/* Offer Items — Search & Filter (front end)
/*
/* AJAX-driven search / sort / category / taxonomy filtering, reset and pagination for
/* the Offer Filter builder section. Keeps the browser URL in sync so results are
/* shareable / bookmarkable and the back button works. Initial state is rendered
/* server-side from the URL, so this only enhances an already-working page.
/*-----------------------------------------------------------------------------------*/

(function ($) {
    'use strict';

    if (typeof TRB_OFFER_FILTER === 'undefined') {
        return;
    }

    function init($root) {
        var config = $root.data('config') || {};
        var perPage = config.perPage || 15;
        var gridAds = config.gridAds || [];
        // Base path for pretty category URLs, e.g. "/offers/". Category filtering
        // pushes /offers/{slug}/ to the address bar instead of ?of_cat=ID.
        var baseUrl = config.baseUrl || window.location.pathname;

        var $form = $root.find('.offer-filter-form');
        var $search = $root.find('.offer-filter-search-input');
        var $sort = $root.find('.offer-filter-sort-select');
        var $count = $root.find('.offer-filter-count');
        var $gridInner = $root.find('.offer-filter-grid-inner');
        var $pagination = $root.find('.offer-filter-pagination-wrap');
        var $loading = $root.find('.offer-filter-loading');
        var $sidebar = $root.find('.offer-filter-sidebar');
        var $overlay = $root.find('.offer-filter-overlay');

        var $activeCat = $root.find('.offer-filter-cat.is-active');
        var activeCategory = parseInt($activeCat.data('cat'), 10) || 0;
        var activeCategorySlug = $activeCat.attr('data-cat-slug') || '';
        var currentPage = 1;
        var searchTimer = null;
        var xhr = null;

        /* ---------------------------------------------------- gather state */

        function collectTax() {
            var tax = {};
            $root.find('.offer-filter-tax').each(function () {
                var slug = $(this).data('taxonomy');
                var vals = [];
                $(this).find('input[type=checkbox]:checked').each(function () {
                    vals.push($(this).val());
                });
                if (vals.length) {
                    tax[slug] = vals;
                }
            });
            return tax;
        }

        function collectState(page) {
            return {
                search: $.trim($search.val()),
                category: activeCategory,
                categorySlug: activeCategorySlug,
                sort: $sort.val() || 'date_desc',
                tax: collectTax(),
                paged: page || 1
            };
        }

        /* ---------------------------------------------------- URL syncing */

        // Everything except the category lives in the query string; the category
        // is carried by the path (/{base}/{slug}/), so it's not added here.
        function stateToParams(state) {
            var params = {};
            if (state.search) { params.of_s = state.search; }
            if (state.sort && state.sort !== 'date_desc') { params.of_sort = state.sort; }
            if (state.paged > 1) { params.of_paged = state.paged; }
            $.each(state.tax, function (slug, vals) {
                $.each(vals, function (i, v) {
                    params['of_tax[' + slug + '][]'] = params['of_tax[' + slug + '][]'] || [];
                    params['of_tax[' + slug + '][]'].push(v);
                });
            });
            return params;
        }

        function pushUrl(state) {
            if (!window.history || !window.history.pushState) {
                return;
            }
            var path = baseUrl;
            if (state.category && state.categorySlug) {
                path += state.categorySlug + '/';
            }
            var parts = [];
            $.each(stateToParams(state), function (key, val) {
                if ($.isArray(val)) {
                    $.each(val, function (i, v) {
                        parts.push(encodeURIComponent(key) + '=' + encodeURIComponent(v));
                    });
                } else {
                    parts.push(encodeURIComponent(key) + '=' + encodeURIComponent(val));
                }
            });
            var qs = parts.length ? '?' + parts.join('&') : '';
            window.history.pushState({ offerFilter: true }, '', path + qs + '#offer-filter');
        }

        /* ---------------------------------------------------- fetch */

        function fetch(page, updateUrl) {
            var state = collectState(page);
            currentPage = state.paged;

            var data = {
                action: 'trb_offer_filter',
                nonce: TRB_OFFER_FILTER.nonce,
                per_page: perPage,
                of_s: state.search,
                of_cat: state.category,
                of_sort: state.sort,
                of_paged: state.paged,
                of_tax: state.tax,
                grid_ads: gridAds
            };

            if (xhr) { xhr.abort(); }
            $loading.prop('hidden', false);
            $root.addClass('is-loading');

            xhr = $.post(TRB_OFFER_FILTER.ajaxurl, data, function (resp) {
                if (!resp || !resp.success) {
                    return;
                }
                $gridInner.html(resp.data.grid);
                $pagination.html(resp.data.pagination);
                $count.text(resp.data.count);
                if (updateUrl !== false) {
                    pushUrl(state);
                }
            }).always(function () {
                $loading.prop('hidden', true);
                $root.removeClass('is-loading');
                xhr = null;
            });
        }

        /* ---------------------------------------------------- mobile drawer */

        function openDrawer() {
            $sidebar.addClass('is-open');
            $overlay.prop('hidden', false);
            $('body').addClass('offer-filter-drawer-open');
        }

        function closeDrawer() {
            $sidebar.removeClass('is-open');
            $overlay.prop('hidden', true);
            $('body').removeClass('offer-filter-drawer-open');
        }

        $root.on('click', '.offer-filter-mobile-toggle', openDrawer);
        $root.on('click', '.offer-filter-mobile-close', closeDrawer);
        $overlay.on('click', closeDrawer);

        // Mobile "Search" button: run the filter now and close the drawer.
        $root.on('click', '.offer-filter-apply', function () {
            clearTimeout(searchTimer);
            fetch(1);
            closeDrawer();
        });

        $(document).on('keydown', function (e) {
            if (e.key === 'Escape') { closeDrawer(); }
        });

        /* ---------------------------------------------------- events */

        // Search (debounced).
        $search.on('input', function () {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(function () { fetch(1); }, 400);
        });

        // Sort.
        $sort.on('change', function () { fetch(1); });

        // Category links (single-select toggle).
        $root.on('click', '.offer-filter-cat', function (e) {
            e.preventDefault();
            var $cat = $(this);
            var cat = parseInt($cat.data('cat'), 10) || 0;
            if (activeCategory === cat) {
                activeCategory = 0;
                activeCategorySlug = '';
            } else {
                activeCategory = cat;
                activeCategorySlug = $cat.attr('data-cat-slug') || '';
            }
            $root.find('.offer-filter-cat').removeClass('is-active');
            if (activeCategory) {
                $cat.addClass('is-active');
            }
            fetch(1);
        });

        // Taxonomy checkboxes.
        $root.on('change', '.offer-filter-tax input[type=checkbox]', function () {
            fetch(1);
        });

        // Accordion toggles.
        $root.on('click', '.offer-filter-tax-toggle', function () {
            $(this).closest('.offer-filter-tax').toggleClass('is-open');
        });

        // Reset.
        $root.on('click', '.offer-filter-reset', function () {
            $search.val('');
            $sort.val('date_desc');
            activeCategory = 0;
            activeCategorySlug = '';
            $root.find('.offer-filter-cat').removeClass('is-active');
            $root.find('.offer-filter-tax input[type=checkbox]').prop('checked', false);
            fetch(1);
        });

        // Pagination (delegated; links also work without JS).
        $root.on('click', '.offer-filter-pagination a[data-page]', function (e) {
            e.preventDefault();
            var page = parseInt($(this).data('page'), 10) || 1;
            fetch(page);
            $('html, body').animate({ scrollTop: $root.offset().top - 80 }, 300);
        });

        // Back / forward button: re-render from the URL.
        $(window).on('popstate', function () {
            syncFromUrl();
            fetch(currentPage, false);
        });

        /* ---------------------------------------------------- read URL -> form */

        function syncFromUrl() {
            var params = new URLSearchParams(window.location.search);

            $search.val(params.get('of_s') || '');
            $sort.val(params.get('of_sort') || 'date_desc');

            // Category lives in the path: {baseUrl}{slug}/. Fall back to a legacy
            // ?of_cat=ID query param for old links.
            activeCategory = 0;
            activeCategorySlug = '';
            var path = window.location.pathname;
            if (baseUrl && path.indexOf(baseUrl) === 0) {
                var rest = path.slice(baseUrl.length).replace(/^\/+|\/+$/g, '');
                var slug = rest ? rest.split('/')[0] : '';
                if (slug) {
                    var $bySlug = $root.find('.offer-filter-cat[data-cat-slug="' + slug + '"]');
                    if ($bySlug.length) {
                        activeCategory = parseInt($bySlug.data('cat'), 10) || 0;
                        activeCategorySlug = slug;
                    }
                }
            }
            if (!activeCategory) {
                var legacy = parseInt(params.get('of_cat'), 10) || 0;
                if (legacy) {
                    activeCategory = legacy;
                    activeCategorySlug = $root.find('.offer-filter-cat[data-cat="' + legacy + '"]').attr('data-cat-slug') || '';
                }
            }

            $root.find('.offer-filter-cat').removeClass('is-active');
            if (activeCategory) {
                $root.find('.offer-filter-cat[data-cat="' + activeCategory + '"]').addClass('is-active');
            }

            $root.find('.offer-filter-tax input[type=checkbox]').prop('checked', false);
            params.forEach(function (value, key) {
                var m = key.match(/^of_tax\[([^\]]+)\]/);
                if (m) {
                    $root.find('.offer-filter-tax[data-taxonomy="' + m[1] + '"] input[value="' + value + '"]').prop('checked', true);
                }
            });

            currentPage = parseInt(params.get('of_paged'), 10) || 1;
        }
    }

    $(function () {
        $('.offer-filter').each(function () {
            init($(this));
        });
    });

})(jQuery);
