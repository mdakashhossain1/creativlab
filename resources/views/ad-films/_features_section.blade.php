<section class="w-full md:py-[100px] py-16 bg-white overflow-hidden">
    <div class="theme-container mx-auto">
        <div class="grid xl:grid-cols-2 grid-cols-1 gap-12 xl:gap-16 items-center">

            {{-- LEFT: video story mockup --}}
            <div class="relative flex justify-center items-center" data-aos="fade-right">
                <div class="absolute size-80 rounded-full bg-purple/10 blur-3xl pointer-events-none"></div>

                {{-- video card --}}
                <div class="relative z-10 rounded-2xl overflow-hidden shadow-common border border-purple/8 xl:w-[400px] w-[300px]"
                     style="background:linear-gradient(135deg,#1a1432,#2d1b6b);">
                    <div class="relative xl:h-[300px] h-[240px] p-5">
                        <div class="absolute top-6 right-8 size-16 rounded-full bg-yellow-200/20 blur-2xl"></div>

                        {{-- director chair --}}
                        <div class="absolute bottom-6 left-6 bg-[#0e0b20] rounded-xl p-3 border border-white/10 w-28">
                            <div class="h-12 bg-purple/30 rounded-md mb-2 flex items-center justify-center">
                                <span class="text-white/50 text-[8px] font-bold">DIRECTOR</span>
                            </div>
                            <div class="h-1 bg-white/20 rounded-full w-full mb-1"></div>
                            <div class="h-1 bg-white/20 rounded-full w-2/3"></div>
                        </div>

                        {{-- clapperboard --}}
                        <div class="absolute top-6 right-6 bg-white rounded-lg p-2.5 shadow-lg rotate-6 w-24">
                            <div class="flex gap-0.5 mb-1.5">
                                @for($i=0;$i<5;$i++)<div class="flex-1 h-1.5 {{ $i % 2 == 0 ? 'bg-main-black' : 'bg-white border border-main-black' }} -skew-x-12"></div>@endfor
                            </div>
                            <div class="h-1 bg-gray-200 rounded-full w-full"></div>
                        </div>

                        {{-- center play --}}
                        <div class="absolute inset-0 flex items-center justify-center">
                            <button class="size-16 rounded-full bg-white/90 backdrop-blur flex items-center justify-center shadow-xl hover:scale-110 transition-transform duration-300">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="#794AFF" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg>
                            </button>
                        </div>
                    </div>

                    {{-- bottom bar: Story That Sells --}}
                    <div class="bg-white p-4 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <span class="size-9 rounded-full bg-purple flex items-center justify-center">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg>
                            </span>
                            <p class="font-bold text-main-black text-sm">Story That Sells</p>
                        </div>
                        <div class="flex items-center">
                            <div class="flex -space-x-2">
                                @foreach(['#794AFF','#BA4AFF','#FF7E40','#22C55E'] as $c)
                                <div class="size-7 rounded-full border-2 border-white flex items-center justify-center text-white text-[8px] font-bold" style="background:{{ $c }}">C</div>
                                @endforeach
                            </div>
                            <span class="text-[10px] font-bold text-purple ml-1.5">+50</span>
                        </div>
                    </div>
                </div>

                {{-- floating badge: views --}}
                <div class="absolute xl:-left-4 left-0 top-10 bg-purple text-white rounded-2xl px-4 py-2.5 shadow-purple z-20"
                     style="animation: afFloat 6s ease-in-out infinite reverse;">
                    <p class="text-[9px] opacity-80">Total Views</p>
                    <p class="text-sm font-bold">50M+</p>
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
                        <div class="size-6 rounded-full bg-purple flex-shrink-0 flex items-center justify-center shadow-purple">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 6L9 17L4 12" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <p class="font-semibold text-main-black text-sm">{{ $f }}</p>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('services') }}"
                   class="inline-flex items-center gap-2.5 bg-purple text-white font-bold text-sm uppercase tracking-wider px-8 py-4 rounded-full hover:bg-main-black transition-all duration-300 shadow-purple">
                    Learn More
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</section>
