<section class="w-full bg-[#F4F1FF] md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-14 md:mb-20" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">OUR PROCESS</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                Our Proven <span class="text-purple">SEO Process</span>
            </h2>
        </div>

        <div class="relative">
            {{-- connector line (desktop) --}}
            <div class="xl:block hidden absolute top-[52px] left-[calc(12.5%+28px)] right-[calc(12.5%+28px)] h-[2px]"
                 style="background: repeating-linear-gradient(90deg, #794AFF 0px, #794AFF 12px, transparent 12px, transparent 24px);"></div>

            <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-10 xl:gap-6">
                @php
                    $steps = [
                        [
                            'color' => 'bg-purple',
                            'icon'  => '<circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="1.8"/><path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>',
                            'title' => 'Research & Analysis',
                            'desc'  => 'We analyze your website, competitors and keywords.',
                        ],
                        [
                            'color' => 'bg-[#BA4AFF]',
                            'icon'  => '<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 2v6h6M9 13h6M9 17h4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
                            'title' => 'Strategy Planning',
                            'desc'  => 'We create a custom SEO strategy for your business.',
                        ],
                        [
                            'color' => 'bg-[#FF7E40]',
                            'icon'  => '<path d="M16 18l6-6-6-6M8 6l-6 6 6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
                            'title' => 'Optimization & Implementation',
                            'desc'  => 'We optimise your website and implement SEO techniques.',
                        ],
                        [
                            'color' => 'bg-blue-sass',
                            'icon'  => '<path d="M22 12h-4l-3 9L9 3l-3 9H2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
                            'title' => 'Tracking & Growth',
                            'desc'  => 'We monitor results and continuously improve rankings.',
                        ],
                    ];
                @endphp

                @foreach($steps as $step)
                <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="size-[104px] rounded-full {{ $step['color'] }} flex items-center justify-center mb-8 relative z-10 shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-white">
                            {!! $step['icon'] !!}
                        </svg>
                    </div>
                    <h3 class="font-bold text-main-black text-lg mb-2.5">{{ $step['title'] }}</h3>
                    <p class="text-paragraph text-sm leading-6 xl:max-w-[200px]">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
