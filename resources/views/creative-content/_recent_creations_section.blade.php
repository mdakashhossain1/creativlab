<style>
    .cc-works-swiper .swiper-button-next,
    .cc-works-swiper .swiper-button-prev {
        width: 44px;
        height: 44px;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 4px 16px rgba(121,74,255,0.15);
        border: 1px solid rgba(121,74,255,0.12);
        color: #794AFF;
        transition: background .25s, color .25s;
    }
    .cc-works-swiper .swiper-button-next::after,
    .cc-works-swiper .swiper-button-prev::after { font-size: 13px; font-weight: 700; }
    .cc-works-swiper .swiper-button-next:hover,
    .cc-works-swiper .swiper-button-prev:hover { background: #794AFF; color: #fff; }
    .cc-work-card { border-radius: 16px; overflow: hidden; background: #fff; box-shadow: 0 4px 20px rgba(121,74,255,0.08); transition: transform .35s, box-shadow .35s; }
    .cc-work-card:hover { transform: translateY(-6px); box-shadow: 0 12px 36px rgba(121,74,255,0.18); }
    .cc-work-card .cc-img-wrap { position: relative; overflow: hidden; aspect-ratio: 4/5; }
    .cc-work-card .cc-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease; }
    .cc-work-card:hover .cc-img-wrap img { transform: scale(1.06); }
    .cc-work-card .cc-label { padding: 14px 16px; }
    .cc-works-swiper { padding: 10px 4px 50px !important; }
    .cc-works-swiper .swiper-pagination-bullet { background: #794AFF; opacity: 0.3; width: 8px; height: 8px; }
    .cc-works-swiper .swiper-pagination-bullet-active { opacity: 1; width: 24px; border-radius: 4px; }
</style>

<section class="w-full bg-[#F4F1FF] md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-10 md:mb-14" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">OUR CREATIVE WORKS</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                Some <span class="text-purple">Recent</span> Creations
            </h2>
        </div>

        <div class="relative">
            <div class="cc-works-swiper swiper w-full">
                <div class="swiper-wrapper">
                    @php
                        $creations = [
                            ['img' => 'frontend/assets/images/projects/1.webp', 'label' => 'Product Ad Design',  'tag' => 'Ad Creative'],
                            ['img' => 'frontend/assets/images/projects/2.webp', 'label' => 'Social Media Post',  'tag' => 'Graphic Design'],
                            ['img' => 'frontend/assets/images/projects/3.webp', 'label' => 'Reel Editing',       'tag' => 'Video'],
                            ['img' => 'frontend/assets/images/projects/4.webp', 'label' => 'Brand Poster',       'tag' => 'Brand Design'],
                            ['img' => 'frontend/assets/images/projects/5.webp', 'label' => 'Commercial Video',   'tag' => 'Motion'],
                            ['img' => 'frontend/assets/images/projects/6.webp', 'label' => 'Thumbnail Design',   'tag' => 'YouTube'],
                            ['img' => 'frontend/assets/images/projects/7.webp', 'label' => 'Campaign Creative',  'tag' => 'Campaign'],
                            ['img' => 'frontend/assets/images/projects/8.webp', 'label' => 'Motion Graphic',     'tag' => 'Animation'],
                            ['img' => 'frontend/assets/images/projects/9.webp', 'label' => 'Event Poster',       'tag' => 'Print Design'],
                        ];
                    @endphp

                    @foreach($creations as $c)
                    <div class="swiper-slide">
                        <div class="cc-work-card">
                            <div class="cc-img-wrap">
                                <img src="{{ asset($c['img']) }}" alt="{{ $c['label'] }}" />
                                {{-- tag badge on image --}}
                                <span class="absolute top-3 left-3 text-[10px] font-bold text-white bg-purple/80 backdrop-blur-sm px-3 py-1 rounded-full uppercase tracking-wide">
                                    {{ $c['tag'] }}
                                </span>
                            </div>
                            <div class="cc-label">
                                <p class="font-bold text-main-black text-sm">{{ $c['label'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- pagination dots --}}
                <div class="swiper-pagination"></div>

                {{-- nav buttons --}}
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
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
                    nextEl: '.cc-works-swiper .swiper-button-next',
                    prevEl: '.cc-works-swiper .swiper-button-prev',
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
