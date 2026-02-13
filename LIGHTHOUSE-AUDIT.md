# Lighthouse Audit — Ellievated Beauty Theme

**URL**: https://www.ellievatedbeauty.com
**Date**: 2026-02-12
**Lighthouse Version**: 12.6.0 (mobile emulation)

---

## Scores

| Category | Score |
|---|---|
| **Performance** | **67 / 100** |
| **Accessibility** | **96 / 100** |
| **Best Practices** | **100 / 100** |
| **SEO** | **92 / 100** |

## Core Web Vitals

| Metric | Value | Target | Status |
|---|---|---|---|
| FCP (First Contentful Paint) | 3.0s | < 1.8s | Needs improvement |
| LCP (Largest Contentful Paint) | 11.0s | < 2.5s | Poor |
| TBT (Total Blocking Time) | 30ms | < 200ms | Good |
| CLS (Cumulative Layout Shift) | 0 | < 0.1 | Good |
| Speed Index | 4.8s | < 3.4s | Needs improvement |

---

## Failing Audits (score = 0)

| Audit | Category | Impact |
|---|---|---|
| Largest Contentful Paint (11s) | Performance | Critical |
| Color contrast insufficient | Accessibility | Serious |
| Label-content name mismatch | Accessibility | Serious |
| Meta description missing | SEO | Medium |
| Inefficient cache lifetimes | Performance | High |
| Image delivery unoptimized | Performance | Critical |
| Render blocking resources | Performance | High |

---

## Issue Details & Fixes Applied

### 1. Image Delivery (CRITICAL) -- FIXED in v1.2.0

**Problem**: Two images massively oversized for their display dimensions.

| Image | Original Size | Original Dimensions | Display Size | Wasted |
|---|---|---|---|---|
| `headshot.jpeg` | 1,234 KB | 4640x6960 | ~720x1080 | ~1,170 KB |
| `d.jpg` | 391 KB | 1287x1931 | ~560x840 | ~305 KB |

**Fix applied**:
- Resized `headshot.jpeg` from 4640x6960 to 800x1200 (1,234 KB -> 152 KB, **87% reduction**)
- Resized `d.jpg` from 1287x1931 to 799x1200 (391 KB -> 134 KB, **66% reduction**)
- Updated `width`/`height` attributes in `front-page.php` to match new dimensions
- Originals backed up as `headshot-original.jpeg` and `d-original.jpg`

**Estimated LCP improvement**: ~7-8 seconds

### 2. Render Blocking Resources (HIGH) -- FIXED in v1.2.0

**Problem**: 13 render-blocking resources adding ~2,100ms to FCP/LCP.

Key blockers:
- Google Fonts CSS (817ms wasted)
- jQuery (356ms wasted)
- WooCommerce CSS (178ms wasted)
- Block library CSS (356ms wasted, 99.4% unused)

**Fixes applied**:
- Changed Google Fonts from render-blocking `wp_enqueue_style` to async loading via `preload` + `media="print"` + `onload` swap (`inc/theme-setup.php`)
- Dequeued `wp-block-library` and `wp-block-library-theme` CSS (99.4% unused, saves 14 KB)
- Dequeued `global-styles` CSS
- Dequeued WooCommerce CSS/JS on front page, contact, and services pages where not needed

### 3. Footer Color Contrast (SERIOUS) -- FIXED in v1.2.0

**Problem**: Footer text colors too dark against `#0e100d` / `#1a1c19` backgrounds.

| Element | Old Color | Contrast Ratio | Required |
|---|---|---|---|
| Footer nav links | `rgba(255,255,255,0.3)` → `#565856` | 2.66:1 | 4.5:1 |
| Social link text | `rgba(255,255,255,0.3)` → `#5f605e` | 2.71:1 | 4.5:1 |
| Copyright text | `rgba(255,255,255,0.2)` → `#3e403d` | 1.82:1 | 4.5:1 |

**Fix applied**: Changed all three to `rgba(255,255,255,0.6)` in `css/footer.css`. Against `#0e100d`, this produces approximately 7.5:1 contrast ratio, exceeding the 4.5:1 WCAG AA requirement.

### 4. Label-Content Name Mismatch (SERIOUS) -- FIXED in v1.2.0

**Problem**: Footer social links used visible text ("ig", "fb", "tk") that didn't match their `aria-label` values ("Instagram", "Facebook", "TikTok").

**Fix applied**: Replaced text abbreviations with SVG icons using the existing `ellievated_icon()` helper in `footer.php`. The `aria-label` now serves as the sole accessible name since SVGs are presentational.

### 5. Meta Description (SEO) -- ALREADY PRESENT

**Status**: The `ellievated_meta_tags()` function in `inc/theme-setup.php` already outputs `<meta name="description">` at priority 2 on `wp_head`. This was likely deployed after the Lighthouse audit was captured. No change needed.

### 6. Cache Lifetimes (HIGH) -- REQUIRES SERVER CONFIG

**Problem**: All JS files served with TTL=0 (no caching). Images have only 7-day cache.

| Resource Type | Current TTL | Recommended TTL |
|---|---|---|
| JS files (jQuery, theme, WooCommerce) | 0 (none) | 1 year (versioned) |
| CSS files | 7 days | 1 year (versioned) |
| Images | 7 days | 30 days minimum |

**Action needed**: Configure server-level caching via `.htaccess` or hosting panel:
```apache
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType text/css "access plus 1 year"
    ExpiresByType application/javascript "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 month"
    ExpiresByType image/png "access plus 1 month"
    ExpiresByType image/webp "access plus 1 month"
</IfModule>
```

---

## Unused CSS

| File | Transfer Size | Unused | % Unused |
|---|---|---|---|
| `wp-includes/css/dist/block-library/style.min.css` | 14,523 B | 14,437 B | 99.4% |

**Fix applied**: Dequeued `wp-block-library` and `wp-block-library-theme` in `ellievated_dequeue_unused_assets()`.

---

## DOM Size

| Metric | Value | Status |
|---|---|---|
| Total elements | 168 | Excellent |
| Max DOM depth | 9 | Good |
| Max children | 15 | Good |

No action needed.

---

## Changes Summary (v1.2.0)

### Files modified:
- `css/footer.css` -- Increased text opacity from 0.2-0.3 to 0.6 for contrast compliance
- `footer.php` -- Replaced text abbreviations with SVG icons for social links
- `front-page.php` -- Updated image width/height attributes to match resized images
- `inc/theme-setup.php` -- Version bump to 1.2.0, async Google Fonts loading, dequeue unused assets
- `images/headshot.jpeg` -- Resized from 4640x6960 to 800x1200 (87% smaller)
- `images/d.jpg` -- Resized from 1287x1931 to 799x1200 (66% smaller)

### Files added:
- `images/headshot-original.jpeg` -- Backup of original image
- `images/d-original.jpg` -- Backup of original image

### Estimated improvements:
- **LCP**: 11.0s -> ~3-4s (image optimization + reduced render blocking)
- **FCP**: 3.0s -> ~2s (async fonts + dequeued unused CSS)
- **Accessibility**: 96 -> 100 (contrast + aria fixes)
- **SEO**: 92 -> 100 (meta description already present)
- **Total page weight**: Reduced by ~1.3 MB (image optimization alone)

---

## Remaining Items

| Issue | Priority | Action Required |
|---|---|---|
| Cache headers (server config) | High | Configure `.htaccess` or hosting panel |
| Convert images to WebP/AVIF | Medium | Use `<picture>` element with fallbacks |
| jQuery render blocking | Low | WordPress core dependency, limited control |
| Mobile menu focus trap | Medium | Trap focus within open menu |
| Calendar widget accessibility | Medium | Add ARIA roles and keyboard nav |
| Social media URLs (brand handles) | Low | Update to actual profile URLs |

---

## Previous Rounds

### Round 1 (2026-02-12, v1.1.0)
- Added `loading="lazy"` + dimensions to images
- Fixed animation transitions from `all` to explicit `opacity, transform`
- Added skip-to-content link with focus styles
- Added FAQ `aria-expanded` + `aria-controls`
- Added meta description + Open Graph tags
- Added JSON-LD structured data (BeautySalon schema)
- Fixed heading hierarchy (h3 -> h2 for service cards)
- Fixed placeholder phone number
- Extracted inline CSS to external stylesheets

### Round 2 (2026-02-12, v1.2.0)
- Resized oversized images (headshot: 87% smaller, hero: 66% smaller)
- Async Google Fonts loading (preload + media swap)
- Dequeued unused block-library CSS (14 KB, 99.4% unused)
- Dequeued WooCommerce assets on non-shop pages
- Fixed footer color contrast (0.2-0.3 -> 0.6 opacity)
- Replaced social link text with SVG icons (aria-label mismatch fix)
