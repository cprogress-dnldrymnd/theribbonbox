# CLAUDE.md

Guidance for working in this repo. See also [README.md](README.md) (theme overview)
and [DEVNOTES.md](DEVNOTES.md) (per-device handoff log, newest on top).

## What this is

`lighttheme` — the custom WordPress theme for [The Ribbon Box](https://theribbonbox.com/),
a fertility-focused content site with a WooCommerce shop, a BuddyPress
community/forum, and a B2B partner section. The repo is the theme directory itself
(deployed via cPanel Git Version Control — see "Deployment" below), not a full WordPress install.

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
(`page-template-builder.php`). Sections (type + fields) are stored as a native PHP
array in post meta (WordPress serializes it automatically).

- Core: [functions/page-builder.php](functions/page-builder.php) — section registry is
  `trb_builder_section_types()`; assets are cache-busted via `TRB_BUILDER_VERSION`
  (constant near top of the file, currently `1.7.2`) with a `filemtime()` fallback for
  local edits.
- Section markup: [template-parts/builder/](template-parts/builder/) — one
  `section-*.php` per section type (hero, category-nav, divider, promo-banner,
  richtext, two-column, offer-filter, offer-slider, navigation). The section file is
  resolved as `template-parts/builder/section-{$file_slug}.php`.
- `navigation` section ([section-navigation.php](template-parts/builder/section-navigation.php))
  renders a title (or logo) plus a menu as a horizontal bar (`.trb-picks-nav`), styled in
  `css/page-builder.css` using the `--trb-wine` / `--trb-petal` color vars shared with
  the trb-picks page template. An optional `logo` image field, when set, renders via
  `wp_get_attachment_image()` (`.trb-picks-nav-logo`) in place of the title text in the
  `.trb-picks-nav-title` slot — `css/page-builder.css` hides nav `img`s generally but
  opts the logo back in (`max-height: 50px`). An optional `logo_link` text field, when
  set, makes the title/logo slot a link (`esc_url()`) to that URL. A `source` select
  (`menu` default / `manual`) chooses between a WordPress menu (`menu` field,
  `term_select` on the `nav_menu` taxonomy, rendered via `wp_nav_menu()`) or a
  `repeater` of manual `{label, link}` links; admin-side `show_when: {field, value}`
  toggles which field is shown. Legacy sections saved before `source` existed fall back
  to the menu if set, else the manual links. The `term_select` admin control supports
  an optional `placeholder` to override the default "Select a category" text.
- Admin UI: `js/page-builder-admin.js`, `css/page-builder-admin.css`. Each section
  card's fields render inside a `.trb-builder-card-fields` grid
  (`trb_render_section_card()` in `functions/page-builder.php`) — a 2-column layout
  that collapses to 1 column at `<=960px`; wide controls (`textarea`, `image`,
  `repeater`, `post_select` field types) span the full row via
  `grid-column: 1 / -1`. Conditional `show_when`/`hide_when` field toggling
  (`applyConditional`/`bindConditional` in `js/page-builder-admin.js`) scopes its
  selectors to `> .trb-builder-card-body > .trb-builder-card-fields > .trb-builder-field`.
  Below the fields grid, each card renders two `.trb-builder-design` blocks ("Colors
  (optional)" and "Spacing (optional)"); CSS groups them into one visual "options"
  zone — only the first gets the top divider/spacing, the second
  (`.trb-builder-design + .trb-builder-design`) sits flush beneath it.
- Front-end styles: [css/page-builder.css](css/page-builder.css).

### Offer filter / offer slider

- [functions/offer-filter.php](functions/offer-filter.php) — query + AJAX, grid ads,
  pagination, slug-based category URLs, shared `trb_render_offer_card()`. The card's
  category chip links via `trb_offer_category_url()` to the offer-filter page
  (`trb_offer_filter_host_page_ids()`) filtered by that category.
  `trb_offer_filter_host_page_ids()` finds host pages by fetching all pages using the
  Builder template and parsing their sections via `trb_get_builder_sections()` — **not**
  a meta_query LIKE on the section type, because sections are stored as PHP serialized
  arrays and a JSON-style LIKE (`'"type":"offer_filter"'`) silently matches nothing once
  a page has been saved in the current format. Like the slug cache, the host-page
  transient is only written when the result is non-empty. The pretty
  `/{host-page}/{category-slug}/` URLs are served by rewrite rules
  (`trb_offer_filter_add_rewrite_rules()`) whose slug whitelist comes from
  `trb_offer_filter_get_offer_category_slugs()` — **every** category (any depth,
  not just the top-level sidebar categories from `trb_offer_filter_get_categories()`)
  attached to a published offer, **plus all their ancestors** (via `get_ancestors()`).
  Ancestors are included because filtering by a parent category (`WP_Query 'cat'`)
  returns child-category offers, so parent slugs like `/fertility/` need rewrite rules
  even when offers are only assigned to subcategories. The slug list is cached via
  `set_transient()` for one day, but only when non-empty — caching an empty result
  (e.g. from a transient query glitch) would suppress both the rewrite rule and the
  request-filter resolver for the full TTL. The chip URL and the rewrite
  whitelist must stay built from this same set: if a slug has no rule, WordPress
  404-redirects it to the article landing page (`/{slug}/`). `trb_offer_category_url()`
  only emits the pretty URL for a whitelisted slug, otherwise falling back to the
  unfiltered discounts hub (and, if there's no host page at all, the category archive).
  Bump `TRB_OFFER_FILTER_REWRITE_VERSION` to force a rewrite flush when this changes.
  `trb_offer_filter_maybe_flush()` only records the version as "done" when rules were
  actually registered that request (host page exists + at least one offer category
  present) — a flush in a bare context won't permanently lock in the version and block
  future retries. Because that flush is inherently fragile (the pretty URLs 404-redirect
  to `/{slug}/` whenever the rewrite rule isn't in the stored `rewrite_rules` option),
  `trb_offer_filter_resolve_pretty_request()` (a `request` filter) resolves the same
  `/{host-page}/{slug}/` → `pagename` + `of_cat_slug` mapping directly from the parsed
  query vars on every front-end request, so the pretty URLs work even when the rewrite
  rule was never flushed. `trb_offer_filter_host_page_ids()` detects the host page(s) by
  loading each Page Builder page's parsed sections via `trb_get_builder_sections()` and
  checking for an `offer_filter` section — it must NOT use a meta `LIKE '"type":"offer_filter"'`,
  since sections are stored as a native PHP serialized array (not JSON), so that
  JSON-style match silently returns nothing once a page is saved and breaks the whole
  feature (empty host list → no rewrite rule, no resolver match → pretty URLs
  404-redirect to the article page). It also ignores/avoids caching an empty result so a
  transient miss can't get stuck for the cache TTL. The offer title is rendered with
  `wp_kses()` against a
  small inline-formatting whitelist (`i`, `em`, `b`, `strong`, `span[class]`, `br`).
  Card badges (`offer-badge--featured` from the ACF `featured` flag, plus
  `offer-badge--lifestyle offer-badge--{slug}` per `lifestyle` term) are capped at two
  per card via `array_slice()`, with "Featured" taking priority since it's added first.
- [js/offer-filter.js](js/offer-filter.js) — filter drawer + category navigation. When
  the drawer is open it hides `#header-main-site` (the current header id — older
  `#header-v2` is no longer used here). To keep the grid always ending on a complete
  row, `getColumns()` reads the resolved `grid-template-columns` track count from
  `.offer-filter-grid-inner`, and `rowFilledPerPage()` rounds the section's `per_page`
  up to the next multiple of that column count, accounting for the grid ad slot
  (`hasGridAd` boolean from the PHP config / AJAX response). AJAX fetches request this
  row-filled count instead of the raw `per_page`; a `reqId` counter discards stale
  responses, and a deep-linked `of_paged` past the resulting last page is clamped and
  re-fetched. A debounced `resize` handler re-fetches when the column count changes
  (e.g. crossing a breakpoint), and on init the page re-fetches if the server-rendered
  `per_page` doesn't match the row-filled count. After each AJAX fetch the JS swaps the
  HTML of `.offer-filter-ad-top-sidebar-wrap`, `.offer-filter-ad-bottom-sidebar-wrap`,
  `.offer-filter-ad-above-wrap`, and `.offer-filter-ad-below-wrap` from the server
  response so all ad slots update on every category change.
- [js/offer-copy-code.js](js/offer-copy-code.js) — copy-discount-code button on cards.
- Offer cards live in `.offer-filter-grid` (filter) and `.offer-slider` (slider); card
  layout/alignment is tuned in `css/page-builder.css`. Filter-grid cards pin the
  "Claim Discount" CTA (`.product-widget--cta`, `margin-top: auto`) to the card
  bottom; when a product code box precedes it, `.product-code + .product-widget--cta`
  hugs the code box (`margin-top: 12px`) instead. Cards also force square product
  images (`aspect-ratio: 1/1`, no border/shadow); on large screens
  (`>=1200px`) the filter grid shows 4 columns; on mobile, filter cards lay out image +
  content side-by-side (`.product-widget--box { flex-direction: row }`). Hover states
  underline the card title/category and fill bordered "...DISCOUNTS" buttons. A
  `max-width: 767px` block in `css/page-builder.css` scales down offer-card text/badges
  and the filter-drawer typography (client feedback: cards/drawer were "too big" /
  "MASSIVE" on mobile). The grid ad (`.offer-filter-ad--grid`, rendered last in the
  DOM, on every paginated page) is explicitly placed into the last column of row 1 on
  desktop via `grid-column`/`grid-row`; the `max-width: 767px` block resets that
  placement to `auto` so it falls back to its natural (last) position in the
  single-column mobile layout.
- "Sponsored" tags (`.offer-filter-sponsored`, absolutely positioned top-right) mark
  paid placements. All ads come from the `trb-picks-ad` CPT: each post has an ACF
  `ad_location` field (`grid` | `top_sidebar` | `bottom_sidebar` | `above_result` | `below_result`), an
  `ad_url` field, and a featured image. Three helpers in `offer-filter.php` handle
  selection and rendering: `trb_get_picks_ad($category_id, $location, $allow_fallback = true)`
  picks one random ad (category-specific exact match first — `tax_query` with
  `include_children: false`, so child-category pages don't bleed into parent ads —
  then, when `$allow_fallback` is true, falls back to any published ad for that
  location), `trb_picks_ad_to_array()` converts a post to `{image, link}`, and
  `trb_render_picks_ad()` renders the final HTML via `trb_render_offer_ad()`. The
  result grid / sidebar / banner ads use the default `$allow_fallback = true`, so a
  category with no ad of its own still shows a random ad from another category. The
  AJAX handler queries all four locations server-side and returns `top_sidebar_ad`,
  `bottom_sidebar_ad`, `above_ad`, `below_ad`, `has_grid_ad` in the response so ads
  change with each category filter. The offer-slider, by contrast, calls
  `trb_get_picks_ad($term_id, 'grid', false)` — fallback disabled — so the slider ad
  is **only ever** that category's own ad and a category with no ad shows no slider ad
  (rather than a random unrelated one). Both rely on an ancestor with
  `position: relative` (`.offer-filter-ad`, or `.offer-slider .product-widget-image`)
  for anchoring.
- Filter-drawer taxonomy checkboxes (`section-offer-filter.php`) use a custom-styled
  box: the native `<input type="checkbox">` is visually hidden
  (`.offer-filter-check input { display: none }`), with a sibling
  `<span class="offer-filter-box" aria-hidden="true">` rendering the visible
  box/checkmark via `:checked + .offer-filter-box` and a
  `<span class="offer-filter-check-label">` for the term name, dimmed via `opacity`
  until `:checked ~ .offer-filter-check-label`.
- The filter drawer's `.offer-filter-apply` ("Search") button
  (`section-offer-filter.php`, after the reset button) is mobile-only
  (`display: none`, shown via `display: block` in the `max-width: 767px` block in
  `css/page-builder.css`); `js/offer-filter.js` runs the filter immediately
  (clearing the debounce `searchTimer` and calling `fetch(1)`) and closes the drawer
  on click.

## Conventions / gotchas

- Bump `TRB_BUILDER_VERSION` in `functions/page-builder.php` when Page Builder
  CSS/JS changes need to bust caches (the `filemtime()` fallback covers most local
  edits, but bump it for clarity on releases).
- Page Builder sections are stored as a native PHP array in post meta (WordPress
  serializes it via `maybe_serialize()` automatically). `trb_get_builder_sections()`
  handles both the current array format and a legacy JSON-string format for backward
  compatibility. Do not wrap the value in `wp_json_encode()` / `wp_slash()` — passing
  a plain array to `update_post_meta()` is correct.
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

Deploy via **cPanel Git Version Control → "Update from Remote"** (a server-side `git pull`
into the theme directory). `git push` alone does NOT update the live site — the cPanel
step must be run explicitly for each push. After pulling, also purge LiteSpeed Cache +
OPcache, since the server can keep running stale PHP after the pull.

(`.ftp-deploy-sync-state.json` / `.ftpquota` are present from an old FTP workflow — they
are not part of the current deploy process.)

No CI/build pipeline beyond the local SASS compile. Compile `css/trb.css` before deploying
if SASS sources changed.
