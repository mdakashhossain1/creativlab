<style>
    .seo-results-swiper .swiper-button-next,
    .seo-results-swiper .swiper-button-prev {
        width: 44px; height: 44px; background:#fff; border-radius:50%;
        box-shadow:0 4px 16px rgba(121,74,255,.15); border:1px solid rgba(121,74,255,.12);
        color:#794AFF; transition:background .25s, color .25s;
    }
    .seo-results-swiper .swiper-button-next::after,
    .seo-results-swiper .swiper-button-prev::after { font-size:13px; font-weight:700; }
    .seo-results-swiper .swiper-button-next:hover,
    .seo-results-swiper .swiper-button-prev:hover { background:#794AFF; color:#fff; }
    .seo-result-card { border-radius:16px; overflow:hidden; background:#fff; box-shadow:0 4px 20px rgba(121,74,255,.08); transition:transform .35s, box-shadow .35s; }
    .seo-result-card:hover { transform:translateY(-6px); box-shadow:0 12px 36px rgba(121,74,255,.18); }
    .seo-result-card .seo-img-wrap { position:relative; overflow:hidden; aspect-ratio:16/10; }
    .seo-result-card .seo-img-wrap img { width:100%; height:100%; object-fit:cover; transition:transform .5s ease; }
    .seo-result-card:hover .seo-img-wrap img { transform:scale(1.06); }
    .seo-img-overlay { position:absolute; inset:0; background:linear-gradient(to top, rgba(12,8,30,0.55) 0%, transparent 60%); }
    .seo-results-swiper { padding:10px 4px 50px !important; }
    .seo-results-swiper .swiper-pagination-bullet { background:#794AFF; opacity:.3; width:8px; height:8px; }
    .seo-results-swiper .swiper-pagination-bullet-active { opacity:1; width:24px; border-radius:4px; }
</style>

<section class="w-full bg-white md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-10 md:mb-14" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">OUR SUCCESS STORIES</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                SEO Results <span class="text-purple">That Speak</span>
            </h2>
        </div>

        <div class="relative">
            <div class="seo-results-swiper swiper w-full">
                <div class="swiper-wrapper">
                    @php
                        $results = [
                            ['img' => 'frontend/assets/images/projects/1.webp', 'title' => 'FinEdge Finance',    'tag' => 'Finance',    's1v' => '+152%', 's1l' => 'Organic Traffic', 's2v' => '+85%',  's2l' => 'Keyword Rankings'],
                            ['img' => 'frontend/assets/images/projects/2.webp', 'title' => 'Urbanic Interiors', 'tag' => 'Interior',   's1v' => '+210%', 's1l' => 'Organic Traffic', 's2v' => '+120%', 's2l' => 'Leads Generated'],
                            ['img' => 'frontend/assets/images/projects/3.webp', 'title' => 'FitLife Gym',       'tag' => 'Health & Fitness', 's1v' => '+190%', 's1l' => 'Organic Traffic', 's2v' => '+90%',  's2l' => 'Membership Signups'],
                            ['img' => 'frontend/assets/images/projects/4.webp', 'title' => 'EduSmart Academy',  'tag' => 'Education',  's1v' => '+165%', 's1l' => 'Organic Traffic', 's2v' => '+75%',  's2l' => 'Course Enrollments'],
                            ['img' => 'frontend/assets/images/projects/5.webp', 'title' => 'TasteBite Restaurant', 'tag' => 'Restaurant', 's1v' => '+200%', 's1l' => 'Organic Traffic', 's2v' => '+110%', 's2l' => 'Online Orders'],
                            ['img' => 'frontend/assets/images/projects/6.webp', 'title' => 'NovaShop Retail',   'tag' => 'E-commerce', 's1v' => '+245%', 's1l' => 'Organic Traffic', 's2v' => '+130%', 's2l' => 'Sales Growth'],
                            ['img' => 'frontend/assets/images/projects/7.webp', 'title' => 'GreenLeaf Wellness', 'tag' => 'Wellness',  's1v' => '+178%', 's1l' => 'Organic Traffic', 's2v' => '+95%',  's2l' => 'Keyword Rankings'],
                            ['img' => 'frontend/assets/images/projects/8.webp', 'title' => 'TravelMate Tours',  'tag' => 'Travel',     's1v' => '+225%', 's1l' => 'Organic Traffic', 's2v' => '+105%', 's2l' => 'Bookings'],
                        ];
                    @endphp

                    @foreach($results as $r)
                    <div class="swiper-slide">
                        <div class="seo-result-card">
                            <div class="seo-img-wrap">
                                <img src="{{ asset($r['img']) }}" alt="{{ $r['title'] }}" />
                                <div class="seo-img-overlay"></div>
                                <span class="absolute top-3 left-3 text-[10px] font-bold text-white bg-purple/80 backdrop-blur-sm px-3 py-1 rounded-full uppercase tracking-wide">{{ $r['tag'] }}</span>
                            </div>
                            <div class="p-5">
                                <p class="font-bold text-main-black text-base mb-3">{{ $r['title'] }}</p>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="bg-[#EDFBF1] rounded-xl p-3 text-center">
                                        <p class="text-green-600 font-bold text-lg leading-none">{{ $r['s1v'] }}</p>
                                        <p class="text-paragraph text-[10px] mt-1">{{ $r['s1l'] }}</p>
                                    </div>
                                    <div class="bg-[#EDE8FF] rounded-xl p-3 text-center">
                                        <p class="text-purple font-bold text-lg leading-none">{{ $r['s2v'] }}</p>
                                        <p class="text-paragraph text-[10px] mt-1">{{ $r['s2l'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
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
                    nextEl: '.seo-results-swiper .swiper-button-next',
                    prevEl: '.seo-results-swiper .swiper-button-prev',
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
