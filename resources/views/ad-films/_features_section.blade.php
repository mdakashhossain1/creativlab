<section class="w-full md:py-[100px] py-16 bg-white overflow-hidden">
    <div class="theme-container mx-auto">
        <div class="grid xl:grid-cols-2 grid-cols-1 gap-12 xl:gap-16 items-center">

            {{-- LEFT: production image --}}
            <div class="relative flex justify-center items-center" data-aos="fade-right">
                <img src="{{ asset('frontend/assets/images/ad-film/ad-production.webp') }}"
                     alt="Ad Film Production"
                     class="w-full h-auto object-contain relative z-10">

                {{-- Story That Sells badge --}}
                <div class="absolute sm:bottom-16 bottom-10 left-0 z-20 bg-white rounded-full sm:px-5 px-3 sm:py-3 py-2 shadow-lg sm:flex hidden items-center gap-3"
                     style="box-shadow: 0 8px 24px rgba(0,0,0,0.12);">
                    <span class="size-7 sm:size-8 rounded-full bg-purple flex items-center justify-center flex-shrink-0">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="white"><path d="M8 5v14l11-7z"/></svg>
                    </span>
                    <p class="font-bold text-main-black sm:text-sm text-xs whitespace-nowrap">Story That Sells</p>
                </div>

                {{-- Avatar group --}}
                <div class="absolute sm:bottom-4 bottom-2 right-0 z-20 bg-white rounded-2xl sm:px-4 px-3 sm:py-2.5 py-1.5 shadow-lg sm:flex hidden items-center gap-2"
                     style="box-shadow: 0 8px 24px rgba(0,0,0,0.12);">
                    <img src="{{ asset('frontend/assets/images/ad-film/about-group.webp') }}"
                         alt="Team" style="height:28px; width:auto; object-fit:contain;">
                    <span class="sm:text-sm text-xs font-bold text-purple">+120</span>
                </div>
            </div>

            {{-- RIGHT: text + checklist --}}
            <div data-aos="fade-left">
                <span class="inline-flex items-center gap-2 text-purple text-xs font-bold uppercase tracking-[0.2em] bg-[#EDE8FF] px-4 py-2 rounded-full mb-5">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z" fill="#794AFF"/></svg>
                    Ad Film Production
                </span>

                <h2 class="xl:text-[44px] md:text-[36px] text-[26px] font-bold text-main-black leading-[1.12] mb-5">
                    Telling Your Brand<br>
                    Story Through<br>
                    <span class="text-purple">Powerful Visuals</span>
                </h2>

                <p class="text-paragraph text-base leading-7 mb-8 xl:max-w-[460px]">
                    We combine creativity, strategy, and high-end production to craft ad films that leave a lasting impression and drive real business results.
                </p>

                <div class="grid sm:grid-cols-2 gap-4 mb-9">
                    @php
                        $features = [
                            'Compelling storytelling',
                            'Cinematic quality',
                            'Strong brand impact',
                            'Better audience engagement',
                        ];
                    @endphp
                    @foreach($features as $f)
                    <div class="flex items-center gap-3">
                        <div class="size-6 rounded-full bg-purple flex-shrink-0 flex items-center justify-center">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 6L9 17L4 12" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <p class="font-semibold text-main-black text-sm">{{ $f }}</p>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('services') }}">
                    <div class="home-two-btn-bg py-3 group bg-purple border-purple">
                        <span class="text-base text-white group-hover:text-purple transition-all duration-300 font-semibold font-inter relative z-10">
                            Learn More
                        </span>
                        <span>{{ get_svg('home_cta_white') }}</span>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>
