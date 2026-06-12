# CLAUDE.md

Guidance for working in this repo. See also [README.md](README.md) (theme overview)
and [DEVNOTES.md](DEVNOTES.md) (per-device handoff log, newest on top).

## What this is

`lighttheme` — the custom WordPress theme for [The Ribbon Box](https://theribbonbox.com/).
Standard WP theme layout: top-level `*.php` templates (`header.php`, `footer.php`,
`homepage.php`, `single*`, `page-template-*.php`, `woocommerce/`), with logic split
into `functions/` (included from `functions.php`), front-end assets in `js/`,
`css/`, `sass/`, and reusable markup in `template-parts/` and `sections/`.

WooCommerce is in use (`woocommerce.php`, `woocommerce/`, `functions/commerce.php`,
`functions/products.php`).

## Listing pages

Large listing pages (e.g. `/fertility`) are built with the `[blog_filter]` shortcode,
e.g. `[blog_filter format='post-page' add_ad='Yes' categoryid='1164']`.
"Load more" / infinite scroll:
- Home page: `$('#loadHome')` in `js/home-js.php` → `functions.php->home_page_load_function()`.
- Other pages: `js/index-load-more.js` → `functions.php->blog_filter_load_function()`.

Main theme JS is the minified `js/javascript3.js` (source-ish: `js/TO-DELETE/javascript1.js`).

## TRB Page Builder

A lightweight, ACF-free section builder for the "Page Builder" page template.
Sections (type + fields) are stored as JSON in post meta.

- Core: [functions/page-builder.php](functions/page-builder.php) — section registry is
  `trb_builder_section_types()`; assets are cache-busted via `TRB_BUILDER_VERSION`
  (constant at top of the file) with a `filemtime()` fallback.
- Section markup: [template-parts/builder/](template-parts/builder/) — one
  `section-*.php` per section type (hero, category-nav, divider, promo-banner,
  richtext, two-column, offer-filter, offer-slider).
- Admin UI: `js/page-builder-admin.js`, `css/page-builder-admin.css`.
- Front-end styles: [css/page-builder.css](css/page-builder.css).

### Offer filter / offer slider

- [functions/offer-filter.php](functions/offer-filter.php) — query + AJAX, grid ads,
  pagination, slug-based category URLs.
- [js/offer-filter.js](js/offer-filter.js) — filter drawer + category navigation.
- [js/offer-copy-code.js](js/offer-copy-code.js) — copy-discount-code button on cards.
- Offer cards live in `.offer-filter-grid` (filter) and `.offer-slider` (slider);
  card layout/alignment is tuned in `css/page-builder.css`.

## Recent changes (this device — 2026-06-12)

Offer filter / offer slider card work (see DEVNOTES for full detail):
- Offer card layout polish on `.offer-slider` (spacing on `.product-name`,
  `.offer-badges`, image holder).
- Card bottom alignment in `.offer-filter-grid`: product code box + "Claim Discount"
  CTA pinned to card bottom via `margin-top:auto`; `.product-widget--box` height auto;
  product images forced square (`aspect-ratio:1/1`).
- Mobile fix: offer-filter cards lay out image + content side-by-side
  (`.product-widget--box { flex-direction: row }`) instead of stacking.
- Drawer fix: open offer-filter drawer hides `#header-main-site` (was old `#header-v2`).
- Slug-based category URLs added for the offer filter.
- `TRB_BUILDER_VERSION` bumped 1.2.4 → 1.2.9 to cache-bust builder assets.

## Conventions

- Bump `TRB_BUILDER_VERSION` in `functions/page-builder.php` when builder CSS/JS
  changes need to bust caches (the `filemtime()` fallback covers local edits).
- Keep `DEVNOTES.md` updated when handing off between machines (newest entry on top).
