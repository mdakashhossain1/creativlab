<style>
    .af-projects-swiper .swiper-button-next,
    .af-projects-swiper .swiper-button-prev {
        width: 44px; height: 44px; background:#fff; border-radius:50%;
        box-shadow:0 4px 16px rgba(121,74,255,.15); border:1px solid rgba(121,74,255,.12);
        color:#794AFF; transition:background .25s, color .25s;
    }
    .af-projects-swiper .swiper-button-next::after,
    .af-projects-swiper .swiper-button-prev::after { font-size:13px; font-weight:700; }
    .af-projects-swiper .swiper-button-next:hover,
    .af-projects-swiper .swiper-button-prev:hover { background:#794AFF; color:#fff; }
    .af-proj-card { border-radius:16px; overflow:hidden; background:#fff; box-shadow:0 4px 20px rgba(121,74,255,.08); transition:transform .35s, box-shadow .35s; }
    .af-proj-card:hover { transform:translateY(-6px); box-shadow:0 12px 36px rgba(121,74,255,.18); }
    .af-proj-card .af-img-wrap { position:relative; overflow:hidden; aspect-ratio:4/3; }
    .af-proj-card .af-img-wrap img { width:100%; height:100%; object-fit:cover; transition:transform .5s ease; }
    .af-proj-card:hover .af-img-wrap img { transform:scale(1.06); }
    .af-img-overlay { position:absolute; inset:0; background:linear-gradient(to top, rgba(12,8,30,0.6) 0%, rgba(12,8,30,0.1) 55%, transparent 100%); }
    .af-play-btn { position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); width:56px; height:56px; border-radius:50%; background:rgba(255,255,255,.92); display:flex; align-items:center; justify-content:center; box-shadow:0 8px 24px rgba(0,0,0,.25); transition:transform .3s; }
    .af-proj-card:hover .af-play-btn { transform:translate(-50%,-50%) scale(1.12); }
    .af-projects-swiper { padding:10px 4px 50px !important; }
    .af-projects-swiper .swiper-pagination-bullet { background:#794AFF; opacity:.3; width:8px; height:8px; }
    .af-projects-swiper .swiper-pagination-bullet-active { opacity:1; width:24px; border-radius:4px; }
</style>

<section class="w-full bg-white md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-10 md:mb-14" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">OUR WORK</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                Recent <span class="text-purple">Ad Film</span> Projects
            </h2>
        </div>

        <div class="relative">
            <div class="af-projects-swiper swiper w-full">
                <div class="swiper-wrapper">
                    @php
                        $projects = [
                            ['img' => 'frontend/assets/images/projects/1.webp', 'title' => 'Glowverse Skincare',  'tag' => 'Brand Film'],
                            ['img' => 'frontend/assets/images/projects/2.webp', 'title' => 'UrbanBite Bites',     'tag' => 'Product Ad Film'],
                            ['img' => 'frontend/assets/images/projects/3.webp', 'title' => 'TasteBud Restaurant', 'tag' => 'Promotional Film'],
                            ['img' => 'frontend/assets/images/projects/4.webp', 'title' => 'BuildCraft Cement',   'tag' => 'Commercial Film'],
                            ['img' => 'frontend/assets/images/projects/5.webp', 'title' => 'EduSmart Learning',   'tag' => 'Brand Film'],
                            ['img' => 'frontend/assets/images/projects/6.webp', 'title' => 'NovaTech Gadgets',    'tag' => 'Product Ad Film'],
                            ['img' => 'frontend/assets/images/projects/7.webp', 'title' => 'GreenLeaf Organics',  'tag' => 'Brand Film'],
                            ['img' => 'frontend/assets/images/projects/8.webp', 'title' => 'FitZone Gym',         'tag' => 'Promotional Film'],
                        ];
                    @endphp

                    @foreach($projects as $p)
                    <div class="swiper-slide">
                        <div class="af-proj-card">
                            <div class="af-img-wrap">
                                <img src="{{ asset($p['img']) }}" alt="{{ $p['title'] }}" />
                                <div class="af-img-overlay"></div>
                                <span class="absolute top-3 left-3 text-[10px] font-bold text-white bg-purple/80 backdrop-blur-sm px-3 py-1 rounded-full uppercase tracking-wide">{{ $p['tag'] }}</span>
                                <button class="af-play-btn">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#794AFF" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg>
                                </button>
                            </div>
                            <div class="p-5">
                                <p class="font-bold text-main-black text-base mb-1">{{ $p['title'] }}</p>
                                <p class="text-purple text-xs font-semibold">{{ $p['tag'] }}</p>
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
            new Swiper('.af-projects-swiper', {
                slidesPerView: 1.2,
                spaceBetween: 16,
                loop: true,
                pagination: { el: '.af-projects-swiper .swiper-pagination', clickable: true },
                navigation: {
                    nextEl: '.af-projects-swiper .swiper-button-next',
                    prevEl: '.af-projects-swiper .swiper-button-prev',
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
