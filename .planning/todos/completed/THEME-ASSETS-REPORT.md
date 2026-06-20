# Theme JS/CSS Architecture Report

**Project:** creativlab / landing-new  
**Date:** 2026-06-11

---

## Summary

All 7 themes share **one global asset pipeline** — there are no per-theme CSS or JS controllers. Theme differentiation is achieved entirely through **Tailwind utility classes** applied directly in each theme's Blade templates.

---

## Asset Pipeline Architecture

### Build Tool

**Vite** (`vite.config.js`) compiles three entry points:

| Entry Point | Output | Purpose |
|---|---|---|
| `resources/css/app.css` | compiled into `output.css` | Tailwind base + shared component classes |
| `resources/sass/app.scss` | compiled via SCSS | Supplemental styles |
| `resources/js/app.js` | compiled JS bundle | Vue.js + shared JS behaviour |

---

## CSS: What Every Theme Loads

Every theme's `index.blade.php` loads **identical CSS** in `<head>`:

```html
<!-- 3rd-party libraries -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/swiper-bundle.min.css') }}" />
<link rel="stylesheet" href="{{ asset('frontend/assets/css/aos.css') }}" />

<!-- Vite-compiled Tailwind CSS (input.css → output.css) -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- Manual override layer (post-Tailwind) -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('frontend/assets/custom.css') }}" />

<!-- Toastr notifications -->
<link rel="stylesheet" href="{{ asset('global/toastr/toastr.min.css') }}" />
```

**No theme gets its own CSS file.** Theme visual differences come from:
- Different Tailwind class combinations in each theme's Blade
- Different `<body>` class names (e.g. `home-one`, `home-four`) that CSS can target
- CSS custom properties / color variables in `style.css`

---

## JS: What Every Theme Loads

Every theme's `index.blade.php` loads **identical JS** at the bottom of `<body>`:

```html
<script src="{{ asset('global/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('global/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/lottie.js') }}"></script>
<script src="{{ asset('frontend/assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/parallax.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/aos.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins.js') }}"></script>
<script src="{{ asset('frontend/assets/js/main.js') }}"></script>
```

Theme 1 also loads:
```html
<script src="{{ asset('frontend/assets/js/gsap.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/ScrollTrigger.min.js') }}"></script>
```

### Theme-Specific Inline JS

Each theme's `index.blade.php` contains **inline `<script>` blocks** at the bottom for:
- Currency switcher form targeting (each theme uses different CSS selector IDs)
- Language switcher form targeting
- Theme-specific Swiper slider configs (e.g. Theme 4 has a dual auto-scroll testimonial slider)
- Theme-specific interactive features (e.g. Theme 4 has a YouTube video modal)

---

## File Locations

### Shared Frontend Assets

```
public/
└── frontend/
    └── assets/
        ├── css/
        │   ├── output.css          ← Vite-compiled Tailwind (DO NOT edit manually)
        │   ├── style.css           ← Manual override CSS (safe to edit)
        │   ├── aos.css             ← Animate On Scroll library
        │   └── swiper-bundle.min.css ← Swiper slider
        └── js/
            ├── main.js             ← Primary custom JS (menus, interactions)
            ├── plugins.js          ← JS plugin initialisations
            ├── swiper-bundle.min.js
            ├── aos.js
            ├── gsap.min.js         ← Animation (used by theme_1)
            ├── ScrollTrigger.min.js ← GSAP plugin (used by theme_1)
            ├── parallax.min.js
            └── lottie.js           ← Lottie animations
```

### Theme Blade Views

```
resources/views/theme/
├── theme_1/    ← Digital Marketing  (9 section partials + index.blade.php)
├── theme_2/    ← SEO Agency         (8 section partials + index.blade.php)
├── theme_3/    ← Creative Agency    (9 section partials + index.blade.php)
├── theme_4/    ← AI Software        (7 section partials + index.blade.php)
├── theme_5/    ← Business Consulting (10 section partials + index.blade.php)
├── theme_7/    ← IT Business        (9 section partials + index.blade.php)
└── theme_8/    ← SaaS               (9 section partials + index.blade.php)
```

> **Note:** theme_6 does not exist as a Blade directory — it was skipped in the numbering.

---

## Theme Section Breakdown

| Theme | Style Name | `<body>` class | Sections |
|---|---|---|---|
| theme_1 | Digital Marketing | `home-one` | hero, partner, about, fun-fact, service, working-process, testimonial, blog, CTA |
| theme_2 | SEO Agency | `home-two` | hero, features, about, services/case-study, testimonial, FAQ, contact, CTA |
| theme_3 | Creative Agency | `home-three` | hero, about, pricing, CTA, testimonial, case-study, services, team, blog |
| theme_4 | AI Software | `home-four bg-[#0a0118]` | hero, features, what-we-do, pricing, FAQ, testimonial, CTA |
| theme_5 | Business Consulting | `home-five` | hero, about, provide, counter, testimonial, blog, CTA, partner, team, success-story |
| theme_7 | IT Business | `home-seven` | hero, about, services, working-process, project, benefits, testimonial, FAQ, CTA |
| theme_8 | SaaS | `home-eight` | hero, partner, core-features(×2), feature-service, why-use-us(×2), video, FAQ |

---

## How Themes Are Switched

1. Admin sets active theme via **Global Settings** → stored in `global_settings` table with key `selected_theme`
2. `FrontEndManagementController` reads `$selected_theme` and passes it to the view
3. The home route controller renders the matching `theme/theme_X/index.blade.php`
4. Section visibility (show/hide, order) is controlled per-page via the `manage_sections` table

---

## Where to Edit Styles

| Goal | File to Edit |
|---|---|
| Add/change shared styles across all themes | `public/frontend/assets/css/style.css` |
| Add Tailwind component utilities | `resources/css/app.css` → run `npm run build` |
| Theme-specific visual tweak | Edit CSS class in the theme's `index.blade.php` or section partial |
| Add theme-specific JS behaviour | Add inline `<script>` block in `theme/theme_X/index.blade.php` |
| Add shared JS across all themes | `public/frontend/assets/js/main.js` or `plugins.js` |

---

## Key Observations

1. **No per-theme CSS files** — 100% of theme differentiation is Tailwind utility classes in Blade
2. **No per-theme JS files** — per-theme behaviour lives as inline scripts in each `index.blade.php`
3. **`style.css` is the safe override layer** — always loaded after Tailwind, won't be wiped by `npm run build`
4. **`output.css` is auto-generated** — never edit it manually; changes are lost on next build
5. **Vite entry = `resources/css/app.css`** — this is compiled into `output.css` via Tailwind JIT
6. **GSAP is only loaded by theme_1** — other themes use CSS transitions and Swiper instead

---

## Theme 1 (Digital Marketing) Detailed Code & Class Reference

### 1. File Structure & Mapping
* **Controller Context**: Renders `theme.theme_1.index` (located in `resources/views/theme/theme_1/`) when `$theme == 'theme_five'` is selected in global settings (Admin Panel), or as the default fallback view.
* **Main Entry View**: [index.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/resources/views/theme/theme_1/index.blade.php)
* **HTML Body Class**: `<body class="home-one relative">`

---

### 2. Section Breakdown & Class Inventory

#### A. Main Shell & Navigation (in [index.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/resources/views/theme/theme_1/index.blade.php))
* **Scope**: Wraps header, footer, mobile-nav overlays, and general lottie/gsap scroll wrapper containers.
* **Class & ID Reference**:
  * `.h1-header-sticky`, `.h1-header-sticky-qs` (Header wrapper classes defining fixed positions and offsets)
  * `.h1-top-bar` (Top bar container displaying welcome text and links)
  * `.light-version-logo` (Displays main brand logo)
  * `.m-nav-dropdown` (Navigation trigger for mobile dropdown menus)
  * `.mobile-sub-nav` (Mobile menu dropdown containing sublinks)
  * `.cartCount`, `.wishlist_count`, `.cart_btn` (Shopping and wishlist badges and triggers)
  * `.home-two-btn-bg` (Shared theme button layout animation class)

#### B. Hero Section (in [_hero_section.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/resources/views/theme/theme_1/_hero_section.blade.php))
* **Scope**: Hero banner displaying main headings, descriptions, rotating graphic, and animated backgrounds.
* **Class & ID Reference**:
  * `#home-one-hero` (Section container ID)
  * `.hero-one-section-wrapper` (Defines background gradients, heights, and overflow behavior)
  * `#win-grid`, `.win-grid` (Interactive window grids overlaid on the hero section)
  * `.article-area` (Left block holding text articles, ratings, and call-to-actions)
  * `.shadow-style-one` (Box-shadow helper for badge graphics)
  * `.custom-heading` (Custom styling rule for theme headings)
  * `.btn-gradient` (Main button gradient color overlay)
  * `.hero-sub-text` (Secondary text helper class)
  * `.hero-banner` (Right-side illustration block)
  * `.moving-h2-hero-main-img` (Keyframe anim class that shifts the main graphic horizontally)
  * `.rotating_circle`, `.rotating_text` (Circles that spin continuously via CSS keyframes)

#### C. Partner Section (in [_partner_section.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/resources/views/theme/theme_1/_partner_section.blade.php))
* **Scope**: Displays client/partner logos in an infinite horizontal loop.
* **Class & ID Reference**:
  * `.partner-wrapper` (Main padding container)
  * `.partner_slider` (Swiper slider container class)
  * `.swiper-container`, `.swiper-wrapper`, `.swiper-slide` (Standard Swiper structure elements)

#### D. About Section (in [_about_section.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/resources/views/theme/theme_1/_about_section.blade.php))
* **Scope**: Split presentation containing brand highlights, growth charts, features list, and images.
* **Class & ID Reference**:
  * `#home-one-about` (Section wrapper ID)
  * `.home-one-about-wrapper` (Outer block padding helper)
  * `.about-thumbnil-area` (Left column wrapper housing background shapes and main images)
  * `#about-shape-mouse-anim` (Wrapper for cursor parallax animation)
  * `.layer` (Parallax relative layout layers)
  * `.thumbnil-wrapper` (Container for helper SVGs)
  * `.thumbnil-main` (Wraps the primary about feature image)
  * `#home-one-about-mouse-anim` (Container for about mouse animation layers)
  * `.bg-purple`, `.text-pone`, `.shadow-small`, `.shadow-purple` (Styling utilities applied to graphic badges)
  * `.about-article-area` (Right column holding textual context)
  * `.section-title-top-tag` (Header pill displaying uppercase subheadings)
  * `.text-paragraph` (Standard secondary typography color helper)
  * `.home-two-btn-bg` (Interactive animated action buttons)

#### E. Fun Fact Section (in [_our_fun_fact_section.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/resources/views/theme/theme_1/_our_fun_fact_section.blade.php))
* **Scope**: Statistical counter block showcasing company figures (clients, projects, years active).
* **Class & ID Reference**:
  * `#home-one-our-fun-fact` (Section ID)
  * `.fan-fact-section-wrapper` (Wraps grids and counter stats)
  * `.counter-wrapper` (A grid mapping individual numeric cells)
  * `.single-counter` (Holds single number and label block)
  * `.custom-border-right` (Border-line separator dividing columns)
  * `.counter-val` (Numerical target targetted by JS counter script)

#### F. Service Section (in [_service_section.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/resources/views/theme/theme_1/_service_section.blade.php))
* **Scope**: Grid of service cards showcasing expertise.
* **Class & ID Reference**:
  * `#home-one-service` (Section ID)
  * `.service-section-wrapper` (Main section structure wrapper)
  * `.service-top-area` (Title area)
  * `.service-bottom-card-area` (Responsive grid container)
  * `.service-card` (Individually styled card items)
  * `.service-icon-wrapper` (Circular helper surrounding SVGs)
  * `.service-card-title`, `.service-card-desc` (Subheadings and descriptions)
  * `.right-arrow` (Icon suffix signaling interactivity)

#### G. Working Process Section (in [_wroking_process_section.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/resources/views/theme/theme_1/_wroking_process_section.blade.php))
* **Scope**: Dynamic step-by-step roadmap indicating how projects are delivered.
* **Class & ID Reference**:
  * `#home-one-working-process` (Section ID)
  * `.working-process-section-wrapper` (Wraps process title and columns)
  * `.working-process-main-title` (Header article wraps)
  * `.working-process-bottom-card` (Process card container wrapper)
  * `.working-card` (Holds single step information)
  * `.working-card-number` (Stylized background text representing numbers)
  * `.card-article` (Nested column holding data)
  * `.card-title`, `.card-desc` (Titles and explanations)
  * `.pointer-img` (Arrow guides pointing to the next card)

#### H. Testimonial Section (in [_testimonial_section.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/resources/views/theme/theme_1/_testimonial_section.blade.php))
* **Scope**: Swiper-based testimonials displaying user reviews.
* **Class & ID Reference**:
  * `#home-one-testimonial` (Section ID)
  * `.testimoial-section-wrapper` (Section shell container)
  * `.testimonial-left-area` (Holds title elements and pagination buttons)
  * `.h1-story-pagination-v2` (Target class custom style rules apply to swiper pagination)
  * `.testimonial-right-slider` (Wraps swiper slider elements)
  * `.story-card` (Client opinion message cards)
  * `.story-card-title`, `.story-card-desc` (Testimonial subject details)
  * `.client-info`, `.client-avatar`, `.client-name`, `.client-designation` (Author layout metadata)

#### I. Blog Section (in [_blog_section.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/resources/views/theme/theme_1/_blog_section.blade.php))
* **Scope**: List of recent news and articles with timestamps and details.
* **Class & ID Reference**:
  * `#home-one-blog` (Section ID)
  * `.blog-section-wrapper` (Outer block padding helper)
  * `.blog-top-area` (Title section holding sub-titles and headings)
  * `.blog-bottom-card-area` (Responsive grids)
  * `.blog-card` (Wraps individual articles)
  * `.blog-img` (Container holding thumbnail graphics)
  * `.blog-date` (Badge holding publication dates)
  * `.blog-meta` (Author and comment indicators)
  * `.blog-card-title` (Article header links)

#### J. CTA Section (in [_cta_section.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/resources/views/theme/theme_1/_cta_section.blade.php))
* **Scope**: Bottom consultation box encouraging contact.
* **Class & ID Reference**:
  * `#consultation` (Section container ID)
  * `.consultation-section-wrapper` (Outer bounds padding helper)
  * `.consaltaion-mouse-move-anim` (Container for interactive consultation parallax graphics)

---

### 3. JavaScript Behaviors
* **Libraries Loaded**:
  * `gsap.min.js`, `ScrollTrigger.min.js` (GSAP animation engine)
  * `aos.js` (Animate On Scroll)
  * `swiper-bundle.min.js` (Testimonial and partner carousel controls)
  * `parallax.min.js` (Parallax layers initialization)
* **Custom Functions**:
  * `.m-nav-dropdown` event listener toggling class `.active` on mobile sub-navigation menus.
  * Form targeting triggers for currency switching (`#currency_switcher_form_home_one`) and language translation selection (`#language_switcher_form_home`).

