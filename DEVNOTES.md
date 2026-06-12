# Dev Notes / Handoff

Running log of changes per device so work can continue across machines.
Newest entries on top.

---

## 2026-06-12 — Windows device

Focus: **offer filter / offer slider cards** in the TRB Page Builder.

Files touched:
- `css/page-builder.css`
- `functions/page-builder.php`

What changed:
- **Offer card layout polish (`.offer-slider`)**
  - Tightened spacing on `.product-name` (`margin-bottom: 0`) and badges
    (`.offer-badges` now `margin-block: 10px`, image holder gets `margin-bottom: 1rem`).
- **Card bottom alignment (`.offer-filter-grid`)**
  - Product code box now pushed to the bottom of the card with `margin-top: auto`
    so the code box + "Claim Discount" CTA line up across cards of differing height.
  - `.product-widget--box` set to `height: auto`.
  - Product image links forced square via `aspect-ratio: 1/1; display:block; width:100%`.
- **Mobile fix** — offer filter cards now lay out image + content side-by-side
  (`.product-widget--box { flex-direction: row }`) instead of stacking the image
  on top. Removed the old fixed `height:140px; object-fit:cover` image rule.
- **Drawer fix** — open offer-filter drawer now hides `#header-main-site`
  (was targeting the old `#header-v2` id).
- Slug-based category URLs added for the offer filter (commit `89115d0`).
- Bumped `TRB_BUILDER_VERSION` 1.2.4 → 1.2.9 (cache-busts the builder assets).

Status: working tree committed and pushed to `origin/main`.

Next / open items:
- Verify the new card alignment + mobile side-by-side layout on a real device.
