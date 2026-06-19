<style>
    .cc-portfolio-swiper .swiper-pagination-bullet { background: #794AFF; opacity: 0.3; width: 8px; height: 8px; }
    .cc-portfolio-swiper .swiper-pagination-bullet-active { opacity: 1; width: 24px; border-radius: 4px; }
    .cc-port-card { position: relative; border-radius: 16px; overflow: hidden; aspect-ratio: 3/4; cursor: pointer; }
    .cc-port-card img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .cc-port-card:hover img { transform: scale(1.07); }
    .cc-port-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(12,8,30,0.88) 0%, rgba(12,8,30,0.1) 55%, transparent 100%); }
    .cc-port-label { position: absolute; bottom: 0; left: 0; right: 0; padding: 20px 18px; }
</style>

<section class="w-full bg-[#F4F1FF] md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-12 md:mb-16">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">{{ getTranslatedValue($cc_portfolio, 'section_label') ?: 'OUR WORK' }}</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                {!! getTranslatedValue($cc_portfolio, 'section_title') ?: 'Creative <span class="text-purple">Portfolio</span>' !!}
            </h2>
        </div>

        <div class="cc-portfolio-swiper swiper w-full pb-12">
            <div class="swiper-wrapper">
                @php
                    $portImages  = $cc_portfolio?->data_values['images'] ?? [];
                    $defaultImgs = array_map(fn($n) => "frontend/assets/images/projects/{$n}.webp", range(1, 8));
                    $defaultTitles = ['Brand Reel Campaign','Foodie Social Media','Startup Brand Launch','Wellness Motion Series','Travel Reels Package','Fitness Campaign','Organic Brand Story','Urban Style Identity'];
                    $defaultTags   = ['Reels & Video','Graphic Design','Brand Identity','Motion Graphics','Content Strategy','Campaign Creatives','Social Media','UI/UX Creatives'];
                @endphp

                @for($i = 1; $i <= 8; $i++)
                @php
                    $imgKey = "item_{$i}_image";
                    $imgSrc = $portImages[$imgKey] ?? $defaultImgs[$i - 1];
                    $title  = getTranslatedValue($cc_portfolio, "item_{$i}_title") ?: $defaultTitles[$i - 1];
                    $tag    = getTranslatedValue($cc_portfolio, "item_{$i}_tag")   ?: $defaultTags[$i - 1];
                @endphp
                <div class="swiper-slide">
                    <div class="cc-port-card">
                        <img src="{{ asset($imgSrc) }}" alt="{{ $title }}" />
                        <div class="cc-port-overlay"></div>
                        <div class="cc-port-label">
                            <span class="inline-block text-[10px] font-semibold text-white/70 uppercase tracking-widest bg-white/10 px-3 py-1 rounded-full mb-2">
                                {{ $tag }}
                            </span>
                            <p class="text-white font-bold text-base leading-tight">{{ $title }}</p>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
            <div class="swiper-pagination mt-8"></div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Swiper !== 'undefined') {
            new Swiper('.cc-portfolio-swiper', {
                slidesPerView: 1.3,
                spaceBetween: 16,
                centeredSlides: false,
                loop: true,
                pagination: { el: '.cc-portfolio-swiper .swiper-pagination', clickable: true },
                breakpoints: {
                    480:  { slidesPerView: 2.2, spaceBetween: 18 },
                    768:  { slidesPerView: 3.2, spaceBetween: 22 },
                    1024: { slidesPerView: 4,   spaceBetween: 24 },
                    1280: { slidesPerView: 5,   spaceBetween: 24 },
                },
            });
        }
    });
</script>
