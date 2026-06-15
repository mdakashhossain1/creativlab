<section class="w-full md:py-[100px] py-16 bg-white overflow-hidden">
    <div class="theme-container mx-auto">
        <div class="grid xl:grid-cols-2 grid-cols-1 gap-12 xl:gap-16 items-center">

            {{-- LEFT: image --}}
            <div class="relative flex justify-center items-center" data-aos="fade-right">
                <img src="{{ asset('frontend/assets/images/creative-content/turning.webp') }}"
                     alt="Creative Solutions"
                     class="w-full h-auto object-contain mix-blend-multiply" />
            </div>

            {{-- RIGHT: feature list --}}
            <div data-aos="fade-left">
                <span class="inline-flex items-center gap-2 text-purple text-xs font-bold uppercase tracking-[0.2em] bg-[#EDE8FF] px-4 py-2 rounded-full mb-5">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="#794AFF"/></svg>
                    Creative Solutions
                </span>

                <h2 class="xl:text-[48px] md:text-[38px] text-[28px] font-bold text-main-black leading-[1.1] mb-5">
                    Turning Ideas Into<br>
                    <span class="text-purple">Visual Experiences</span>
                </h2>

                <p class="text-paragraph text-base leading-7 mb-8 xl:max-w-[460px]">
                    We don't just create content — we craft stories that resonate. From high-impact reels to scroll-stopping graphics, every piece is built to convert attention into action.
                </p>

                {{-- feature list --}}
                <ul class="space-y-4 mb-9">
                    @php
                        $features = [
                            ['title' => 'High-engagement content',       'desc' => 'Content designed to stop the scroll and spark interaction across every platform.'],
                            ['title' => 'Theme-focused creatives',       'desc' => 'Cohesive visual themes that match your brand voice and audience preferences.'],
                            ['title' => 'Platform-optimised designs',    'desc' => 'Formats and dimensions perfectly tailored for Instagram, Facebook, YouTube & more.'],
                            ['title' => 'Consistent brand identity',     'desc' => 'Every post, reel, and graphic stays true to your brand guidelines and colour palette.'],
                        ];
                    @endphp
                    @foreach($features as $f)
                    <li class="flex items-start gap-4">
                        <div class="size-6 rounded-full bg-purple flex-shrink-0 flex items-center justify-center mt-0.5 shadow-purple">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 6L9 17L4 12" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-main-black text-base leading-tight">{{ $f['title'] }}</p>
                            <p class="text-paragraph text-sm leading-6 mt-0.5">{{ $f['desc'] }}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <a href="{{ route('services') }}"
                   class="inline-flex items-center gap-2.5 text-purple font-bold text-base hover:gap-4 transition-all duration-300">
                    Learn More
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</section>
