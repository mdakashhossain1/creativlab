<style>
    .af-hero-bg { background: linear-gradient(135deg, #F4F1FF 0%, #EDE8FF 40%, #F8F6FF 100%); }
    @keyframes afFloat  { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    @keyframes afFloatR { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)}  }
    .af-float      { animation: afFloat  4.5s ease-in-out infinite; }
    .af-float-rev  { animation: afFloatR 5.5s ease-in-out infinite reverse; }
    .af-float-slow { animation: afFloat  7s   ease-in-out infinite; }
    .af-highlight {
        display:inline-block; position:relative;
        background: linear-gradient(135deg, #794AFF 0%, #BA4AFF 100%);
        -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
    }
    .af-highlight::after { content:''; position:absolute; left:0; right:0; bottom:-4px; height:3px; border-radius:2px; background:linear-gradient(90deg,#794AFF,#BA4AFF); }
</style>

<section class="af-hero-bg w-full xl:pt-[200px] pt-[110px] xl:pb-0 pb-16 overflow-hidden relative">
    <div class="absolute top-20 left-0 w-72 h-72 rounded-full bg-purple/5 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-10 w-96 h-96 rounded-full bg-[#BA4AFF]/6 blur-3xl pointer-events-none"></div>

    <div class="theme-container mx-auto">
        <div class="grid xl:grid-cols-2 grid-cols-1 items-center xl:gap-12 gap-12">

            {{-- LEFT: text --}}
            <div class="xl:pb-24 relative z-10" data-aos="fade-right">
                <div class="inline-flex items-center gap-2.5 bg-white border border-purple/15 rounded-full px-5 py-2.5 mb-6 shadow-sm">
                    <span class="flex size-2 relative">
                        <span class="animate-ping absolute inline-flex size-2 rounded-full bg-purple opacity-75"></span>
                        <span class="relative inline-flex size-2 rounded-full bg-purple"></span>
                    </span>
                    <span class="text-purple text-sm font-semibold tracking-wide">Ad Films Production House</span>
                </div>

                <h1 class="xl:text-[64px] md:text-[52px] text-[36px] font-bold text-main-black leading-[1.07] tracking-tight mb-6">
                    We Create <span class="af-highlight">Ad Films</span> That Inspire &amp; Drive Action
                </h1>

                <p class="text-paragraph font-medium text-base leading-7 mb-9 xl:max-w-[440px]">
                    Powerful storytelling. Cinematic visuals. Strategic messaging. We create ad films that connect, influence and convert.
                </p>

                <div class="flex flex-wrap items-center gap-5">
                    <a href="{{ route('contact-us') }}"
                       class="inline-flex items-center gap-3 bg-purple text-white font-bold text-sm uppercase tracking-widest px-9 py-4 rounded-full hover:bg-main-black transition-all duration-300 shadow-purple">
                        Start Your Project
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="{{ route('services') }}"
                       class="flex items-center gap-2 group text-main-black font-semibold hover:text-purple transition-colors duration-300">
                        <span class="size-10 rounded-full border-2 border-main-black group-hover:border-purple flex items-center justify-center transition-colors duration-300">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg>
                        </span>
                        <span class="border-b-2 border-main-black group-hover:border-purple pb-0.5 transition-colors duration-300">View Showreel</span>
                    </a>
                </div>
            </div>

            {{-- RIGHT: film set scene + floating pills --}}
            <div class="relative flex justify-center xl:justify-end items-center" data-aos="fade-left">
                <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(circle at 60% 50%, rgba(121,74,255,0.15) 0%, transparent 70%);"></div>

                {{-- film scene card --}}
                <div class="relative z-10 af-float xl:w-[440px] md:w-[380px] w-[300px]">
                    <div class="rounded-2xl overflow-hidden shadow-2xl" style="background:linear-gradient(135deg,#1a1432 0%,#2d1b6b 55%,#1a1432 100%); box-shadow:0 40px 80px -10px rgba(121,74,255,.4);">
                        <div class="relative xl:h-[320px] md:h-[280px] h-[230px] p-5">
                            {{-- spotlight glow --}}
                            <div class="absolute top-0 right-8 w-40 h-40 rounded-full bg-yellow-200/20 blur-2xl"></div>

                            {{-- clapperboard --}}
                            <div class="absolute top-6 left-6 bg-white rounded-lg p-3 shadow-lg rotate-[-6deg] w-32">
                                <div class="flex gap-0.5 mb-2">
                                    @for($i=0;$i<6;$i++)<div class="flex-1 h-2 {{ $i % 2 == 0 ? 'bg-main-black' : 'bg-white border border-main-black' }} -skew-x-12"></div>@endfor
                                </div>
                                <p class="text-[8px] font-bold text-main-black">DIRECTOR</p>
                                <div class="h-1 bg-gray-200 rounded-full w-full mt-1.5"></div>
                                <div class="h-1 bg-gray-200 rounded-full w-2/3 mt-1"></div>
                            </div>

                            {{-- camera --}}
                            <div class="absolute bottom-8 right-6 bg-[#0e0b20] rounded-xl p-4 border border-white/10 w-36">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="size-9 rounded-full bg-purple/30 border-2 border-purple flex items-center justify-center">
                                        <div class="size-4 rounded-full bg-purple"></div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-1">
                                            <span class="size-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                            <span class="text-red-400 text-[8px] font-bold">REC</span>
                                        </div>
                                        <div class="h-1 bg-white/20 rounded-full w-full mt-1"></div>
                                    </div>
                                </div>
                                <div class="bg-white/5 rounded-md p-1.5">
                                    <p class="text-white/60 text-[7px]">4K · 24fps</p>
                                </div>
                            </div>

                            {{-- spotlight --}}
                            <div class="absolute top-10 right-10">
                                <div class="size-12 rounded-full bg-gradient-to-br from-yellow-200 to-yellow-400 shadow-[0_0_30px_rgba(250,204,21,0.6)] flex items-center justify-center">
                                    <div class="size-6 rounded-full bg-yellow-100"></div>
                                </div>
                            </div>

                            {{-- play button center --}}
                            <div class="absolute inset-0 flex items-center justify-center">
                                <button class="size-16 rounded-full bg-white/90 backdrop-blur flex items-center justify-center shadow-xl hover:scale-110 transition-transform duration-300">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="#794AFF" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- floating pill: Creative Concept --}}
                <div class="absolute xl:left-0 left-0 xl:top-8 top-2 z-30 af-float-rev">
                    <div class="flex items-center gap-2 bg-purple rounded-full pl-2 pr-4 py-2 shadow-purple">
                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 18h6M10 22h4M12 2a7 7 0 00-4 12.7V17h8v-2.3A7 7 0 0012 2z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <span class="text-xs font-bold text-white">Creative Concept</span>
                    </div>
                </div>

                {{-- floating pill: Cinematic Production --}}
                <div class="absolute xl:left-2 left-0 xl:top-1/3 top-1/4 z-30 af-float">
                    <div class="flex items-center gap-2 bg-[#BA4AFF] rounded-full pl-2 pr-4 py-2 shadow-common">
                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2" y="2" width="20" height="20" rx="2.18" stroke="white" stroke-width="2"/><path d="M7 2v20M17 2v20M2 12h20M2 7h5M2 17h5M17 17h5M17 7h5" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>
                        </div>
                        <span class="text-xs font-bold text-white">Cinematic Production</span>
                    </div>
                </div>

                {{-- floating pill: Brand Storytelling --}}
                <div class="absolute xl:left-4 left-0 xl:bottom-12 bottom-6 z-30 af-float-slow">
                    <div class="flex items-center gap-2 bg-blue-sass rounded-full pl-2 pr-4 py-2 shadow-common">
                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 19.5A2.5 2.5 0 016.5 17H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <span class="text-xs font-bold text-white">Brand Storytelling</span>
                    </div>
                </div>

                {{-- floating pill: High-Quality Output --}}
                <div class="absolute xl:-right-2 right-0 xl:top-10 top-4 z-30 af-float-slow">
                    <div class="flex items-center gap-2 bg-orange rounded-full pl-2 pr-4 py-2 shadow-common">
                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="white" stroke-width="2" stroke-linejoin="round"/></svg>
                        </div>
                        <span class="text-xs font-bold text-white">High-Quality Output</span>
                    </div>
                </div>

                {{-- floating pill: Product Shoot --}}
                <div class="absolute xl:-right-4 right-0 xl:top-1/2 top-1/2 z-30 af-float-rev">
                    <div class="flex items-center gap-2 bg-white rounded-full pl-2 pr-4 py-2 shadow-common border border-purple/10">
                        <div class="size-7 rounded-full bg-[#EDE8FF] flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z" stroke="#794AFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="13" r="4" stroke="#794AFF" stroke-width="2"/></svg>
                        </div>
                        <span class="text-xs font-bold text-main-black">Product Shoot</span>
                    </div>
                </div>

                {{-- floating pill: Emotional Connect --}}
                <div class="absolute xl:-right-2 right-0 xl:bottom-16 bottom-8 z-30 af-float">
                    <div class="flex items-center gap-2 bg-[#F43F5E] rounded-full pl-2 pr-4 py-2 shadow-common">
                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" fill="white"/></svg>
                        </div>
                        <span class="text-xs font-bold text-white">Emotional Connect</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- brand logos strip --}}
        <div class="w-full border-t border-purple/10 mt-12 xl:mt-4 pt-8" data-aos="fade-up">
            <div class="flex flex-wrap items-center justify-between gap-8 opacity-70">
                @foreach(['Redshift','Air-Shift','AlphaWave','Active Corp','4S Degrees','9Portals'] as $brand)
                <div class="flex items-center gap-2">
                    <div class="size-7 rounded-md bg-purple/15 flex items-center justify-center">
                        <span class="size-3 rounded-sm bg-purple inline-block"></span>
                    </div>
                    <span class="text-main-black font-bold text-base">{{ $brand }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
