---
created: 2026-06-13T00:30:00+05:30
title: Remove All Old Multi-Theme Code (Full Audit)
area: general
files:
  - app/Http/Controllers/Admin/FrontEndManagementController.php:19-25
  - app/Http/Controllers/HomeController.php:74,80
  - app/Providers/AppServiceProvider.php:64-67,133-134
  - Modules/GlobalSetting/App/Http/Controllers/GlobalSettingController.php:158,179,199
  - Modules/GlobalSetting/resources/views/index.blade.php:176-213,2465,2503
  - Modules/Listing/Http/Controllers/ListingController.php:46,65,72,142,147,156,161,200,280-281
  - Modules/Listing/Http/Requests/ListingRequest.php:30,34,38,56,60,64
  - Modules/Listing/Resources/views/create.blade.php:115,125
  - Modules/Listing/Resources/views/edit.blade.php:164,178,188,193,249
  - Modules/Project/App/Http/Controllers/ProjectController.php:81,91,192,202,273-282
  - Modules/Project/resources/views/edit.blade.php:108,134
  - Modules/Partner/App/Http/Controllers/PartnerController.php:39,43,47
  - Modules/Partner/Resources/views/create.blade.php:86,113
  - Modules/Partner/Resources/views/edit.blade.php:88,113
  - resources/views/admin/frontend-management/index.blade.php:26,38-41
  - resources/views/admin/settings.json:28,208,389,486,495,505,557,600,609-759,1033,1065,1078,1307
  - resources/views/about_us.blade.php:396
  - resources/views/services.blade.php:82
  - resources/views/service_detail.blade.php:155
---

## Problem

Project originally had 8+ themes (theme_1 through theme_8, plus named themes: digital_marketing, seo_agency, creative_agency, ai_software, business_consulting, it_business, saas, all_theme). All themes have been removed — the project now runs a single primary theme (digital_marketing / template_1). However, old theme-conditional code remains across 18+ files causing:

- Frontend Section admin page was blank (selected_theme was 'ai_software', no matching entry)
- Admin forms show fields for themes that no longer exist (it_business_icon, theme_2_thumbnail, theme_5_thumbnail, etc.)
- AppServiceProvider loads theme_5 / theme_seven data on every request unnecessarily
- settings.json still defines ~40+ old section keys (theme_two_*, theme_four_*, theme_six_*, theme_seven_*, theme_eight_*, home_5_*)
- DB columns exist for old themes: listings.theme_2_thumbnail_image, listings.theme_5_thumbnail_image, listings.it_business_icon, projects.theme_2_thumb_image, projects.theme_3_thumb_image

## Solution

Work through in priority order:

### Priority 1 — Breaks every page load
- [ ] `app/Providers/AppServiceProvider.php` — Remove `home_5_hero_section`, `theme_5_cta_section`, `theme_5_testimonial_section` getContent calls and view shares (lines 64-67, 133-134)
- [ ] `app/Http/Controllers/HomeController.php` — Remove theme_5/theme_seven content loads (lines 74, 80)

### Priority 2 — Breaks admin Frontend Section page
- [ ] `app/Http/Controllers/Admin/FrontEndManagementController.php` — Remove `theme_wise_sections` array, simplify to always show `template_1_*` sections directly
- [ ] `resources/views/admin/frontend-management/index.blade.php` — Remove `all_theme`/`theme_wise_sections` conditionals, always show sections

### Priority 3 — Module controllers with dead theme logic
- [ ] `Modules/GlobalSetting/App/Http/Controllers/GlobalSettingController.php` — Remove `business_consulting`/`it_business` logo conditionals (lines 158, 179, 199)
- [ ] `Modules/Listing/Http/Controllers/ListingController.php` — Remove theme_2, theme_5, it_business image save/update/delete logic
- [ ] `Modules/Listing/Http/Requests/ListingRequest.php` — Remove all theme conditionals from validation
- [ ] `Modules/Project/App/Http/Controllers/ProjectController.php` — Remove theme_2/theme_3 thumb image logic
- [ ] `Modules/Partner/App/Http/Controllers/PartnerController.php` — Remove creative_agency/ai_software/it_business checks

### Priority 4 — Admin blade views
- [ ] `Modules/GlobalSetting/resources/views/index.blade.php` — Remove theme selector dropdown (lines 176-213), remove home_five_logo/home_six_logo/home_six_footer_logo sections (lines 2465-2578)
- [ ] `Modules/Listing/Resources/views/create.blade.php` — Remove it_business conditional block
- [ ] `Modules/Listing/Resources/views/edit.blade.php` — Remove theme_2/theme_5/it_business image fields
- [ ] `Modules/Partner/Resources/views/create.blade.php` — Remove ai_software/it_business conditionals
- [ ] `Modules/Partner/Resources/views/edit.blade.php` — Remove ai_software/it_business conditionals
- [ ] `Modules/Project/resources/views/edit.blade.php` — Remove theme_2/theme_3 image display

### Priority 5 — Frontend blade views
- [ ] `resources/views/about_us.blade.php:396` — Move testimonial_red SVG out of theme/ subfolder to direct path
- [ ] `resources/views/services.blade.php:82` — Replace `theme_5_thumbnail_image` with primary thumb field
- [ ] `resources/views/service_detail.blade.php:155` — Same as above

### Priority 6 — settings.json cleanup
- [ ] `resources/views/admin/settings.json` — Delete all keys prefixed with: theme_two_*, theme_four_*, theme_5_*, theme_six_*, theme_seven_*, theme_eight_*, home_5_hero_section

### Priority 7 — DB columns (low risk, keep for now or migrate)
- [ ] OPTIONAL: Create migration to drop listings.theme_2_thumbnail_image, listings.theme_5_thumbnail_image, listings.it_business_icon
- [ ] OPTIONAL: Create migration to drop projects.theme_2_thumb_image, projects.theme_3_thumb_image

## Notes

- `selected_theme` DB value was manually set to `digital_marketing` on 2026-06-13 to fix blank Frontend Section page
- `theme/theme_7/svg/testimonial_red.blade.php` was created (copied from backup) on 2026-06-13 — should eventually be moved to non-theme path
- Do NOT touch `template_1_*` settings.json keys — those are the active primary theme sections
