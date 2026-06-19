<style>
    .wd-proj-card { border-radius:16px; overflow:hidden; background:#fff; box-shadow:0 4px 20px rgba(121,74,255,.08); transition:transform .35s, box-shadow .35s; }
    .wd-proj-card:hover { transform:translateY(-6px); box-shadow:0 12px 36px rgba(121,74,255,.18); }
    .wd-proj-card .wd-img-wrap { position:relative; overflow:hidden; aspect-ratio:4/3; }
    .wd-proj-card .wd-img-wrap img { width:100%; height:100%; object-fit:cover; transition:transform .5s ease; }
    .wd-proj-card:hover .wd-img-wrap img { transform:scale(1.06); }
    .wd-projects-swiper { padding:10px 4px 50px !important; }
    .wd-projects-swiper .swiper-pagination-bullet { background:#794AFF; opacity:.3; width:8px; height:8px; }
    .wd-projects-swiper .swiper-pagination-bullet-active { opacity:1; width:24px; border-radius:4px; }
    .wd-proj-nav { position:absolute; top:0; bottom:50px; display:flex; align-items:center; z-index:10; }
    .wd-proj-nav-btn { width:44px; height:44px; background:#fff; border-radius:50%; border:1px solid rgba(121,74,255,.15); box-shadow:0 4px 16px rgba(121,74,255,.15); color:#794AFF; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:background .25s, color .25s; flex-shrink:0; }
    .wd-proj-nav-btn:hover { background:#794AFF; color:#fff; }
    .wd-proj-nav-btn.swiper-button-disabled { opacity:.35; pointer-events:none; }
</style>

<section class="w-full bg-white md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-10 md:mb-14" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">{{ getTranslatedValue($wd_recent_projects, 'section_label') ?: 'OUR RECENT PROJECTS' }}</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                {!! getTranslatedValue($wd_recent_projects, 'section_title') ?: 'Some <span class="text-purple">Recent</span> Projects' !!}
            </h2>
        </div>

        <div class="relative">
            <div class="wd-proj-nav" style="left: -22px;">
                <button class="wd-proj-nav-btn wd-proj-prev" aria-label="Previous">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12H5M5 12L11 6M5 12L11 18" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <div class="wd-proj-nav" style="right: -22px;">
                <button class="wd-proj-nav-btn wd-proj-next" aria-label="Next">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>

            <div class="wd-projects-swiper swiper w-full">
                <div class="swiper-wrapper">
                    @php
                        $projImages  = $wd_recent_projects?->data_values['images'] ?? [];
                        $defaultImgs = array_map(fn($n) => "frontend/assets/images/projects/{$n}.webp", range(1, 8));
                        $defaultTitles = ['FinEdge — Finance Website','Trendrix — E-commerce Store','Saasify — SaaS Landing Page','Archiva — Architecture Website','Foodist — Restaurant Website','NovaShop — Online Store','GreenLeaf — Eco Brand','UrbanFit — Fitness Platform'];
                        $defaultTag1   = ['Finance','E-commerce','SaaS','Portfolio','Restaurant','E-commerce','Business','Web App'];
                        $defaultTag2   = ['WordPress','Shopify','Laravel','Webflow','Custom','React','WordPress','Laravel'];
                    @endphp

                    @for($i = 1; $i <= 8; $i++)
                    @php
                        $imgSrc = $projImages["project_{$i}_image"] ?? $defaultImgs[$i - 1];
                        $title  = getTranslatedValue($wd_recent_projects, "project_{$i}_title") ?: $defaultTitles[$i - 1];
                        $tag1   = getTranslatedValue($wd_recent_projects, "project_{$i}_tag_1") ?: $defaultTag1[$i - 1];
                        $tag2   = getTranslatedValue($wd_recent_projects, "project_{$i}_tag_2") ?: $defaultTag2[$i - 1];
                    @endphp
                    <div class="swiper-slide">
                        <div class="wd-proj-card">
                            <div class="wd-img-wrap">
                                <img src="{{ asset($imgSrc) }}" alt="{{ $title }}" />
                            </div>
                            <div class="p-5">
                                <p class="font-bold text-main-black text-base mb-2.5">{{ $title }}</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="text-[10px] font-semibold text-purple bg-[#EDE8FF] px-3 py-1 rounded-full">{{ $tag1 }}</span>
                                    <span class="text-[10px] font-semibold text-purple bg-[#EDE8FF] px-3 py-1 rounded-full">{{ $tag2 }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Swiper !== 'undefined') {
            new Swiper('.wd-projects-swiper', {
                slidesPerView: 1.2, spaceBetween: 16, loop: true,
                pagination: { el: '.wd-projects-swiper .swiper-pagination', clickable: true },
                navigation: { nextEl: '.wd-proj-next', prevEl: '.wd-proj-prev' },
                breakpoints: {
                    480:  { slidesPerView: 1.8, spaceBetween: 18 },
                    768:  { slidesPerView: 2.5, spaceBetween: 22 },
                    1024: { slidesPerView: 3,   spaceBetween: 24 },
                    1280: { slidesPerView: 4,   spaceBetween: 24 },
                },
            });
        }
    });
</script>
