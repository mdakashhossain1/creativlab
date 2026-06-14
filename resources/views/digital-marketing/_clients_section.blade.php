<style>
    .clients-swiper .swiper-pagination-bullet { background: #794AFF; opacity: 0.3; width: 8px; height: 8px; }
    .clients-swiper .swiper-pagination-bullet-active { opacity: 1; width: 24px; border-radius: 4px; }
    .client-card { position: relative; border-radius: 16px; overflow: hidden; aspect-ratio: 3/4; cursor: pointer; }
    .client-card img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .client-card:hover img { transform: scale(1.07); }
    .client-card-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(12,8,30,0.85) 0%, rgba(12,8,30,0.1) 60%, transparent 100%); }
    .client-card-label { position: absolute; bottom: 0; left: 0; right: 0; padding: 20px 18px; }
</style>

<section class="w-full bg-white md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-12 md:mb-16">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">OUR CLIENTS</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                Brands We've <span class="text-purple">Worked With</span>
            </h2>
        </div>

        {{-- Swiper --}}
        <div class="clients-swiper swiper w-full pb-12">
            <div class="swiper-wrapper">

                @php
                    $clientCards = [
                        ['img' => 'frontend/assets/images/projects/1.webp', 'title' => 'Awaken Your Sense',  'tag' => 'Brand Identity'],
                        ['img' => 'frontend/assets/images/projects/2.webp', 'title' => 'Delicious Food',     'tag' => 'Social Media'],
                        ['img' => 'frontend/assets/images/projects/3.webp', 'title' => 'Boost Your Brand',   'tag' => 'Performance Ads'],
                        ['img' => 'frontend/assets/images/projects/4.webp', 'title' => 'Grow Naturally',     'tag' => 'Content Strategy'],
                        ['img' => 'frontend/assets/images/projects/5.webp', 'title' => 'Explore The World',  'tag' => 'Campaign Design'],
                        ['img' => 'frontend/assets/images/projects/6.webp', 'title' => 'Stronger Everyday',  'tag' => 'Reels & Video'],
                        ['img' => 'frontend/assets/images/projects/7.webp', 'title' => 'Fresh & Organic',    'tag' => 'Graphic Design'],
                        ['img' => 'frontend/assets/images/projects/8.webp', 'title' => 'Urban Lifestyle',    'tag' => 'SEO & Growth'],
                    ];
                @endphp

                @foreach ($clientCards as $card)
                    <div class="swiper-slide">
                        <div class="client-card">
                            <img src="{{ asset($card['img']) }}" alt="{{ $card['title'] }}" />
                            <div class="client-card-overlay"></div>
                            <div class="client-card-label">
                                <span class="inline-block text-[10px] font-semibold text-white/70 uppercase tracking-widest bg-white/10 px-3 py-1 rounded-full mb-2">
                                    {{ $card['tag'] }}
                                </span>
                                <p class="text-white font-bold text-base leading-tight">{{ $card['title'] }}</p>
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
            new Swiper('.clients-swiper', {
                slidesPerView: 1.3,
                spaceBetween: 16,
                centeredSlides: false,
                loop: true,
                pagination: { el: '.clients-swiper .swiper-pagination', clickable: true },
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
