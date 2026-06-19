<style>
    .cc-work-card { border-radius:16px; overflow:hidden; background:#fff; box-shadow:0 4px 20px rgba(121,74,255,.08); transition:transform .35s, box-shadow .35s; }
    .cc-work-card:hover { transform:translateY(-6px); box-shadow:0 12px 36px rgba(121,74,255,.18); }
    .cc-work-card .cc-img-wrap { position:relative; overflow:hidden; aspect-ratio:4/5; }
    .cc-work-card .cc-img-wrap img { width:100%; height:100%; object-fit:cover; transition:transform .5s ease; }
    .cc-work-card:hover .cc-img-wrap img { transform:scale(1.06); }
    .cc-work-card .cc-label { padding: 14px 16px; }
    .cc-works-swiper { padding:10px 4px 50px !important; }
    .cc-works-swiper .swiper-pagination-bullet { background:#794AFF; opacity:.3; width:8px; height:8px; }
    .cc-works-swiper .swiper-pagination-bullet-active { opacity:1; width:24px; border-radius:4px; }

    .cc-proj-nav {
        position: absolute;
        top: 0;
        bottom: 50px;
        display: flex;
        align-items: center;
        z-index: 10;
    }
    .cc-proj-nav-btn {
        width: 44px; height: 44px;
        background: #fff;
        border-radius: 50%;
        border: 1px solid rgba(121,74,255,.15);
        box-shadow: 0 4px 16px rgba(121,74,255,.15);
        color: #794AFF;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        transition: background .25s, color .25s;
        flex-shrink: 0;
    }
    .cc-proj-nav-btn:hover { background: #794AFF; color: #fff; }
    .cc-proj-nav-btn.swiper-button-disabled { opacity: .35; pointer-events: none; }
</style>

<section class="w-full bg-white md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-10 md:mb-14" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">{{ getTranslatedValue($cc_recent_creations, 'section_label') ?: 'OUR CREATIVE WORKS' }}</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                {!! getTranslatedValue($cc_recent_creations, 'section_title') ?: 'Some <span class="text-purple">Recent</span> Creations' !!}
            </h2>
        </div>

        <div class="relative">
            <div class="cc-proj-nav" style="left: -22px;">
                <button class="cc-proj-nav-btn cc-proj-prev" aria-label="Previous">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12H5M5 12L11 6M5 12L11 18" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>

            <div class="cc-proj-nav" style="right: -22px;">
                <button class="cc-proj-nav-btn cc-proj-next" aria-label="Next">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>

            <div class="cc-works-swiper swiper w-full">
                <div class="swiper-wrapper">
                    @php
                        $creationImgs   = $cc_recent_creations?->data_values['images'] ?? [];
                        $defaultImgs    = array_map(fn($n) => "frontend/assets/images/projects/{$n}.webp", range(1, 9));
                        $defaultLabels  = ['Product Ad Design','Social Media Post','Reel Editing','Brand Poster','Commercial Video','Thumbnail Design','Campaign Creative','Motion Graphic','Event Poster'];
                        $defaultTags    = ['Ad Creative','Graphic Design','Video','Brand Design','Motion','YouTube','Campaign','Animation','Print Design'];
                    @endphp

                    @for($i = 1; $i <= 9; $i++)
                    @php
                        $imgKey = "creation_{$i}";
                        $imgSrc = $creationImgs[$imgKey] ?? $defaultImgs[$i - 1];
                        $label  = $defaultLabels[$i - 1];
                        $tag    = $defaultTags[$i - 1];
                    @endphp
                    <div class="swiper-slide">
                        <div class="cc-work-card">
                            <div class="cc-img-wrap">
                                <img src="{{ asset($imgSrc) }}" alt="{{ $label }}" />
                                <span class="absolute top-3 left-3 text-[10px] font-bold text-white bg-purple/80 backdrop-blur-sm px-3 py-1 rounded-full uppercase tracking-wide">
                                    {{ $tag }}
                                </span>
                            </div>
                            <div class="cc-label">
                                <p class="font-bold text-main-black text-sm">{{ $label }}</p>
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
            new Swiper('.cc-works-swiper', {
                slidesPerView: 1.3,
                spaceBetween: 16,
                loop: true,
                pagination: { el: '.cc-works-swiper .swiper-pagination', clickable: true },
                navigation: {
                    nextEl: '.cc-proj-next',
                    prevEl: '.cc-proj-prev',
                },
                breakpoints: {
                    480:  { slidesPerView: 2,   spaceBetween: 18 },
                    768:  { slidesPerView: 3,   spaceBetween: 22 },
                    1024: { slidesPerView: 4,   spaceBetween: 24 },
                    1280: { slidesPerView: 5,   spaceBetween: 24 },
                },
            });
        }
    });
</script>
