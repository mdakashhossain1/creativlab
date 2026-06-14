<section class="w-full bg-[#F4F1FF] md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-14 md:mb-20" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">OUR PROCESS</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                How We <span class="text-purple">Build Websites</span>
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
                            'title' => 'Research & Planning',
                            'desc'  => 'We understand your business, goals and target audience to plan the best strategy.',
                        ],
                        [
                            'color' => 'bg-[#BA4AFF]',
                            'icon'  => '<rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M3 9h18M9 21V9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>',
                            'title' => 'UI/UX Design',
                            'desc'  => 'We create modern, clean and user-friendly designs that represent your brand.',
                        ],
                        [
                            'color' => 'bg-[#FF7E40]',
                            'icon'  => '<path d="M16 18l6-6-6-6M8 6l-6 6 6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
                            'title' => 'Development & Testing',
                            'desc'  => 'We build fast, secure and responsive websites and test every functionality.',
                        ],
                        [
                            'color' => 'bg-blue-sass',
                            'icon'  => '<path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
                            'title' => 'Launch & Optimization',
                            'desc'  => 'We launch your website and optimise it for performance, speed and SEO.',
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
