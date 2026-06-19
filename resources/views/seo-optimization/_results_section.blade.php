<style>
    .seo-result-card { border-radius:16px; overflow:hidden; background:#fff; box-shadow:0 4px 20px rgba(121,74,255,.08); transition:transform .35s, box-shadow .35s; }
    .seo-result-card:hover { transform:translateY(-6px); box-shadow:0 12px 36px rgba(121,74,255,.18); }
    .seo-result-card .seo-img-wrap { position:relative; overflow:hidden; aspect-ratio:16/10; }
    .seo-result-card .seo-img-wrap img { width:100%; height:100%; object-fit:cover; transition:transform .5s ease; }
    .seo-result-card:hover .seo-img-wrap img { transform:scale(1.06); }
    .seo-img-overlay { position:absolute; inset:0; background:linear-gradient(to top, rgba(12,8,30,0.55) 0%, transparent 60%); }
    .seo-results-swiper { padding:10px 4px 50px !important; }
    .seo-results-swiper .swiper-pagination-bullet { background:#794AFF; opacity:.3; width:8px; height:8px; }
    .seo-results-swiper .swiper-pagination-bullet-active { opacity:1; width:24px; border-radius:4px; }

    .seo-proj-nav {
        position: absolute;
        top: 0;
        bottom: 50px;
        display: flex;
        align-items: center;
        z-index: 10;
    }
    .seo-proj-nav-btn {
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
    .seo-proj-nav-btn:hover { background: #794AFF; color: #fff; }
    .seo-proj-nav-btn.swiper-button-disabled { opacity: .35; pointer-events: none; }
</style>

<section class="w-full bg-white md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-10 md:mb-14" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">{{ getTranslatedValue($seo_results, 'section_label') ?: 'OUR SUCCESS STORIES' }}</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                {!! getTranslatedValue($seo_results, 'section_title') ?: 'SEO Results <span class="text-purple">That Speak</span>' !!}
            </h2>
        </div>

        <div class="relative">
            {{-- prev button outside swiper, centered on slides --}}
            <div class="seo-proj-nav" style="left: -22px;">
                <button class="seo-proj-nav-btn seo-proj-prev" aria-label="Previous">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12H5M5 12L11 6M5 12L11 18" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>

            {{-- next button outside swiper, centered on slides --}}
            <div class="seo-proj-nav" style="right: -22px;">
                <button class="seo-proj-nav-btn seo-proj-next" aria-label="Next">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>

            <div class="seo-results-swiper swiper w-full">
                <div class="swiper-wrapper">
                    @php
                        $seoResultImgs    = $seo_results?->data_values['images'] ?? [];
                        $seoResDefTitles  = ['FinEdge Finance','Urbanic Interiors','FitLife Gym','EduSmart Academy','TasteBite Restaurant','NovaShop Retail','GreenLeaf Wellness','TravelMate Tours'];
                        $seoResDefTags    = ['Finance','Interior','Health & Fitness','Education','Restaurant','E-commerce','Wellness','Travel'];
                        $seoResDefS1v     = ['+152%','+210%','+190%','+165%','+200%','+245%','+178%','+225%'];
                        $seoResDefS2v     = ['+85%','+120%','+90%','+75%','+110%','+130%','+95%','+105%'];
                    @endphp

                    @for($i = 1; $i <= 8; $i++)
                    @php
                        $imgSrc = $seoResultImgs["result_{$i}_image"] ?? "frontend/assets/images/projects/{$i}.webp";
                        $rTitle = getTranslatedValue($seo_results, "result_{$i}_title") ?: $seoResDefTitles[$i - 1];
                        $rTag   = getTranslatedValue($seo_results, "result_{$i}_tag")   ?: $seoResDefTags[$i - 1];
                        $s1v    = getTranslatedValue($seo_results, "result_{$i}_stat1_value") ?: $seoResDefS1v[$i - 1];
                        $s1l    = getTranslatedValue($seo_results, "result_{$i}_stat1_label") ?: 'Organic Traffic';
                        $s2v    = getTranslatedValue($seo_results, "result_{$i}_stat2_value") ?: $seoResDefS2v[$i - 1];
                        $s2l    = getTranslatedValue($seo_results, "result_{$i}_stat2_label") ?: 'Growth';
                    @endphp
                    <div class="swiper-slide">
                        <div class="seo-result-card">
                            <div class="seo-img-wrap">
                                <img src="{{ asset($imgSrc) }}" alt="{{ $rTitle }}" />
                                <div class="seo-img-overlay"></div>
                                <span class="absolute top-3 left-3 text-[10px] font-bold text-white bg-purple/80 backdrop-blur-sm px-3 py-1 rounded-full uppercase tracking-wide">{{ $rTag }}</span>
                            </div>
                            <div class="p-5">
                                <p class="font-bold text-main-black text-base mb-3">{{ $rTitle }}</p>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="bg-[#EDFBF1] rounded-xl p-3 text-center">
                                        <p class="text-green-600 font-bold text-lg leading-none">{{ $s1v }}</p>
                                        <p class="text-paragraph text-[10px] mt-1">{{ $s1l }}</p>
                                    </div>
                                    <div class="bg-[#EDE8FF] rounded-xl p-3 text-center">
                                        <p class="text-purple font-bold text-lg leading-none">{{ $s2v }}</p>
                                        <p class="text-paragraph text-[10px] mt-1">{{ $s2l }}</p>
                                    </div>
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
            new Swiper('.seo-results-swiper', {
                slidesPerView: 1.1,
                spaceBetween: 16,
                loop: true,
                pagination: { el: '.seo-results-swiper .swiper-pagination', clickable: true },
                navigation: {
                    nextEl: '.seo-proj-next',
                    prevEl: '.seo-proj-prev',
                },
                breakpoints: {
                    480:  { slidesPerView: 1.6, spaceBetween: 18 },
                    768:  { slidesPerView: 2.4, spaceBetween: 22 },
                    1024: { slidesPerView: 3,   spaceBetween: 24 },
                    1280: { slidesPerView: 4,   spaceBetween: 24 },
                },
            });
        }
    });
</script>
