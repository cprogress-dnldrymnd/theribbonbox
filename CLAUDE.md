# CLAUDE.md

Guidance for working in this repo. See also [README.md](README.md) (theme overview)
and [DEVNOTES.md](DEVNOTES.md) (per-device handoff log, newest on top).

## What this is

`lighttheme` — the custom WordPress theme for [The Ribbon Box](https://theribbonbox.com/),
a fertility-focused content site with a WooCommerce shop, a BuddyPress
community/forum, and a B2B partner section. The repo is the theme directory itself
(deployed via FTP — see "Deployment" below), not a full WordPress install.

Standard WP theme layout: top-level `*.php` templates (`header.php`, `footer.php`,
`homepage.php`, `single*`, `page-template-*.php`, `woocommerce.php`/`woocommerce/`),
with logic split into `functions/` (included from `functions.php`), front-end assets
in `js/`, `css/`, `sass/`, and reusable markup in `template-parts/`, `sections/`,
`components/`.

## Build / dev

- No JS build step; JS files are included directly (some are hand-minified, e.g.
  `js/javascript3.js` is `js/TO-DELETE/javascript1.js` after minification).
- SASS is the only build step. Source: `sass/trb.scss` → compiled output: `css/trb.css`.
  ```
  npm run sass:watch    # dev, with sourcemaps, watches for changes
  npm run sass:debug    # one-off compile with sourcemaps
  npm run sass:release  # minified production build
  ```
- `sass/trb.scss` is just a list of `@import`s organized into `base/`, `components/`,
  `elements/`, `layout/`, `regions/`, `sections/`, `unique/`.
- No automated test suite (`npm test` is a stub).

## Structure

- `functions.php` — theme bootstrap; sets up theme support, defines icon/logo SVGs, and
  `include`s everything under `functions/`. Also registers global scripts/styles
  (jQuery, Splide, Swiper, Bootstrap, `includes/_additional.{css,js}`).
- `functions/` — one file per feature area, each `include`d from `functions.php`:
  - `page-builder.php` — the **TRB Page Builder** (see below).
  - `offer-filter.php` — offer search/filter grid + AJAX handler + shared
    `trb_render_offer_card()` used by both the offer slider and the offer filter grid.
    Custom "offer-items" taxonomies live in `custom-taxonomies.php`.
  - `blog.php`, `blog_listing.php`, `blog_posts_home.php`, `load_cate_posts.php` —
    blog listing / category post queries; `blog.php` has the
    `blog_filter_load_function()` AJAX handler.
  - `home.php` — home page "load more" AJAX handler (`home_page_load_function`).
  - `custom-post-types.php`, `custom-taxonomies.php` — CPTs/taxonomies (many commented
    out / disabled — check before assuming a CPT is active).
  - `b2b-content.php`, `b2b-discounts.php`, `landing-page-header.php` — B2B partner
    section (`is_b2b_page()` / `is_b2b_user()` / `user_get_partner()` in `functions.php`).
  - `commerce.php`, `products.php`, `hide-shippen-when-free.php` — WooCommerce helpers.
  - `core.php` — session start, `set_trb_message()` flash messages, misc setup.
  - `ARCHIVED.php` — not included; dead code kept for reference.
- `page-template-trb-picks.php` — separate "TRB Picks" page template (own inline
  `<style>` block defining `--trb-*` color vars and layout helpers), built from
  `sections/*.php` parts (`navigation`, `page-title`, `category-navigation`,
  `product-tabs`, `product-tabs-2`, `two-columns`, `two-columns-2`) — not part of the
  Page Builder.
- `template-parts/` — Page Builder section markup lives in `template-parts/builder/`
  (see below); other subdirs (`header`, `footer`, `navigation`, `page`, `post`) hold
  header/footer/navigation/post partials. `components/` holds post/pagination
  components.
- `shortcodes/` — `[blog_filter]` (see "Listing pages"), expert list, member login button.
- `woocommerce/` — WooCommerce template overrides (theme root `woocommerce.php` is the
  WooCommerce Classic-theme integration entry point).
- `buddypress/` — BuddyPress/community template overrides.
- `header*.php` / `footer*.php` — multiple variants exist (`-v2`, `-community`, `-old`,
  `copy`); check which is actually wired up in `header.php`/`footer.php`/page templates
  before editing — older variants may be unused leftovers.
- `js/` — `javascript3.js` (main minified JS), `home-js.php` (`#loadHome` infinite
  scroll on the home page), `index-load-more.js` (infinite scroll elsewhere, calls
  `blog_filter_load_function()`), plus vendor libs (Splide, Slick, Swiper via CDN,
  Flexslider, Lity, Fancybox).
- `css/` — compiled `trb.css` (+ map) from SASS, plus standalone `page-builder.css`,
  `page-builder-admin.css`, `style-login.css`.

## Listing pages

Large listing pages (e.g. `/fertility`) are built with the `[blog_filter]` shortcode,
e.g. `[blog_filter format='post-page' add_ad='Yes' categoryid='1164']`.
"Load more" / infinite scroll:
- Home page: `$('#loadHome')` in `js/home-js.php` → `home_page_load_function()`
  (`functions/home.php`).
- Other pages: `js/index-load-more.js` → `blog_filter_load_function()`
  (`functions/blog.php`).

## TRB Page Builder

A lightweight, ACF-free section builder for the "Page Builder" page template
(`page-template-builder.php`). Sections (type + fields) are stored as ordered JSON in
post meta.

- Core: [functions/page-builder.php](functions/page-builder.php) — section registry is
  `trb_builder_section_types()`; assets are cache-busted via `TRB_BUILDER_VERSION`
  (constant near top of the file, currently `1.3.0`) with a `filemtime()` fallback for
  local edits.
- Section markup: [template-parts/builder/](template-parts/builder/) — one
  `section-*.php` per section type (hero, category-nav, divider, promo-banner,
  richtext, two-column, offer-filter, offer-slider).
- Admin UI: `js/page-builder-admin.js`, `css/page-builder-admin.css`.
- Front-end styles: [css/page-builder.css](css/page-builder.css).

### Offer filter / offer slider

- [functions/offer-filter.php](functions/offer-filter.php) — query + AJAX, grid ads,
  pagination, slug-based category URLs, shared `trb_render_offer_card()`. The card's
  category chip links via `trb_offer_category_url()` to the offer-filter page
  (`trb_offer_filter_host_page_ids()`) filtered by that category, falling back to the
  standard category archive; the offer title is rendered with `wp_kses()` against a
  small inline-formatting whitelist (`i`, `em`, `b`, `strong`, `span[class]`, `br`).
- [js/offer-filter.js](js/offer-filter.js) — filter drawer + category navigation. When
  the drawer is open it hides `#header-main-site` (the current header id — older
  `#header-v2` is no longer used here).
- [js/offer-copy-code.js](js/offer-copy-code.js) — copy-discount-code button on cards.
- Offer cards live in `.offer-filter-grid` (filter) and `.offer-slider` (slider); card
  layout/alignment is tuned in `css/page-builder.css`. Filter-grid cards pin the
  product code box + "Claim Discount" CTA to the card bottom (`margin-top: auto`) and
  force square product images (`aspect-ratio: 1/1`, no border/shadow); on large screens
  (`>=1200px`) the filter grid shows 4 columns; on mobile, filter cards lay out image +
  content side-by-side (`.product-widget--box { flex-direction: row }`). Hover states
  underline the card title/category and fill bordered "...DISCOUNTS" buttons. A
  `max-width: 767px` block in `css/page-builder.css` scales down offer-card text/badges
  and the filter-drawer typography (client feedback: cards/drawer were "too big" /
  "MASSIVE" on mobile). The grid ad (`.offer-filter-ad--grid`, rendered last in the
  DOM) is explicitly placed into the last column of row 1 on desktop via
  `grid-column`/`grid-row`; the `max-width: 767px` block resets that placement to
  `auto` so it falls back to its natural (last) position in the single-column mobile
  layout.

## Conventions / gotchas

- Bump `TRB_BUILDER_VERSION` in `functions/page-builder.php` when Page Builder
  CSS/JS changes need to bust caches (the `filemtime()` fallback covers most local
  edits, but bump it for clarity on releases).
- `DEVNOTES.md` is a running, newest-first handoff log used for cross-device work —
  check it for the latest in-progress focus area, and add an entry when handing off
  non-trivial work.
- Commit messages in this repo are largely uninformative (`"all"`); rely on `git diff`
  / file inspection rather than commit history for context.
- The repo root contains some stray/junk files from past edits (e.g.
  `---improved-popup.php`, `trb-customize.backup.sub-check ul {`, `archive-forum.phpx`,
  `test.html`) — don't assume these are live templates; verify via `functions.php` /
  page templates before relying on or editing them.
- `error_log`, `php_errorlog`, and `node_modules/` are committed to the repo (large,
  noisy) — avoid `grep`/`find` across the whole tree without excluding these.

## Deployment

Deploy is FTP-based (`.ftp-deploy-sync-state.json`, `.ftpquota` present) — there is no
CI/build pipeline beyond the local SASS compile. Compile `css/trb.css` before deploying
if SASS sources changed.
