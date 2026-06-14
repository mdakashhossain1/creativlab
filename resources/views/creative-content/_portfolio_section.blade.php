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
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">OUR WORK</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                Creative <span class="text-purple">Portfolio</span>
            </h2>
        </div>

        <div class="cc-portfolio-swiper swiper w-full pb-12">
            <div class="swiper-wrapper">
                @php
                    $portfolio = [
                        ['img' => 'frontend/assets/images/projects/1.webp', 'title' => 'Brand Reel Campaign',     'tag' => 'Reels & Video'],
                        ['img' => 'frontend/assets/images/projects/2.webp', 'title' => 'Foodie Social Media',     'tag' => 'Graphic Design'],
                        ['img' => 'frontend/assets/images/projects/3.webp', 'title' => 'Startup Brand Launch',    'tag' => 'Brand Identity'],
                        ['img' => 'frontend/assets/images/projects/4.webp', 'title' => 'Wellness Motion Series',  'tag' => 'Motion Graphics'],
                        ['img' => 'frontend/assets/images/projects/5.webp', 'title' => 'Travel Reels Package',    'tag' => 'Content Strategy'],
                        ['img' => 'frontend/assets/images/projects/6.webp', 'title' => 'Fitness Campaign',        'tag' => 'Campaign Creatives'],
                        ['img' => 'frontend/assets/images/projects/7.webp', 'title' => 'Organic Brand Story',     'tag' => 'Social Media'],
                        ['img' => 'frontend/assets/images/projects/8.webp', 'title' => 'Urban Style Identity',    'tag' => 'UI/UX Creatives'],
                    ];
                @endphp

                @foreach($portfolio as $p)
                <div class="swiper-slide">
                    <div class="cc-port-card">
                        <img src="{{ asset($p['img']) }}" alt="{{ $p['title'] }}" />
                        <div class="cc-port-overlay"></div>
                        <div class="cc-port-label">
                            <span class="inline-block text-[10px] font-semibold text-white/70 uppercase tracking-widest bg-white/10 px-3 py-1 rounded-full mb-2">
                                {{ $p['tag'] }}
                            </span>
                            <p class="text-white font-bold text-base leading-tight">{{ $p['title'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
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
