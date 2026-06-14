<style>
    .wd-projects-swiper .swiper-button-next,
    .wd-projects-swiper .swiper-button-prev {
        width: 44px; height: 44px; background:#fff; border-radius:50%;
        box-shadow:0 4px 16px rgba(121,74,255,.15); border:1px solid rgba(121,74,255,.12);
        color:#794AFF; transition:background .25s, color .25s;
    }
    .wd-projects-swiper .swiper-button-next::after,
    .wd-projects-swiper .swiper-button-prev::after { font-size:13px; font-weight:700; }
    .wd-projects-swiper .swiper-button-next:hover,
    .wd-projects-swiper .swiper-button-prev:hover { background:#794AFF; color:#fff; }
    .wd-proj-card { border-radius:16px; overflow:hidden; background:#fff; box-shadow:0 4px 20px rgba(121,74,255,.08); transition:transform .35s, box-shadow .35s; }
    .wd-proj-card:hover { transform:translateY(-6px); box-shadow:0 12px 36px rgba(121,74,255,.18); }
    .wd-proj-card .wd-img-wrap { position:relative; overflow:hidden; aspect-ratio:4/3; }
    .wd-proj-card .wd-img-wrap img { width:100%; height:100%; object-fit:cover; transition:transform .5s ease; }
    .wd-proj-card:hover .wd-img-wrap img { transform:scale(1.06); }
    .wd-projects-swiper { padding:10px 4px 50px !important; }
    .wd-projects-swiper .swiper-pagination-bullet { background:#794AFF; opacity:.3; width:8px; height:8px; }
    .wd-projects-swiper .swiper-pagination-bullet-active { opacity:1; width:24px; border-radius:4px; }
</style>

<section class="w-full bg-white md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-10 md:mb-14" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">OUR RECENT PROJECTS</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                Some <span class="text-purple">Recent</span> Projects
            </h2>
        </div>

        <div class="relative">
            <div class="wd-projects-swiper swiper w-full">
                <div class="swiper-wrapper">
                    @php
                        $projects = [
                            ['img' => 'frontend/assets/images/projects/1.webp', 'title' => 'FinEdge — Finance Website',   'tags' => ['Finance','WordPress']],
                            ['img' => 'frontend/assets/images/projects/2.webp', 'title' => 'Trendrix — E-commerce Store',  'tags' => ['E-commerce','Shopify']],
                            ['img' => 'frontend/assets/images/projects/3.webp', 'title' => 'Saasify — SaaS Landing Page',  'tags' => ['SaaS','Laravel']],
                            ['img' => 'frontend/assets/images/projects/4.webp', 'title' => 'Archiva — Architecture Website','tags' => ['Portfolio','Webflow']],
                            ['img' => 'frontend/assets/images/projects/5.webp', 'title' => 'Foodist — Restaurant Website',  'tags' => ['Restaurant','Custom']],
                            ['img' => 'frontend/assets/images/projects/6.webp', 'title' => 'NovaShop — Online Store',       'tags' => ['E-commerce','React']],
                            ['img' => 'frontend/assets/images/projects/7.webp', 'title' => 'GreenLeaf — Eco Brand',         'tags' => ['Business','WordPress']],
                            ['img' => 'frontend/assets/images/projects/8.webp', 'title' => 'UrbanFit — Fitness Platform',   'tags' => ['Web App','Laravel']],
                        ];
                    @endphp

                    @foreach($projects as $p)
                    <div class="swiper-slide">
                        <div class="wd-proj-card">
                            <div class="wd-img-wrap">
                                <img src="{{ asset($p['img']) }}" alt="{{ $p['title'] }}" />
                            </div>
                            <div class="p-5">
                                <p class="font-bold text-main-black text-base mb-2.5">{{ $p['title'] }}</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($p['tags'] as $tag)
                                    <span class="text-[10px] font-semibold text-purple bg-[#EDE8FF] px-3 py-1 rounded-full">{{ $tag }}</span>
                                    @endforeach
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
            new Swiper('.wd-projects-swiper', {
                slidesPerView: 1.2,
                spaceBetween: 16,
                loop: true,
                pagination: { el: '.wd-projects-swiper .swiper-pagination', clickable: true },
                navigation: {
                    nextEl: '.wd-projects-swiper .swiper-button-next',
                    prevEl: '.wd-projects-swiper .swiper-button-prev',
                },
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
