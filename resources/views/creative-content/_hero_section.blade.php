<style>
    .cc-hero-bg { background: linear-gradient(135deg, #F4F1FF 0%, #EDE8FF 40%, #F8F6FF 100%); }
    .cc-device-glow { background: radial-gradient(circle at 60% 50%, rgba(121,74,255,0.18) 0%, transparent 70%); }
    @keyframes ccFloat  { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    @keyframes ccFloatR { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)}  }
    @keyframes ccPulseRing { 0%{transform:scale(1);opacity:.6} 100%{transform:scale(1.6);opacity:0} }
    .cc-float      { animation: ccFloat  4.5s ease-in-out infinite; }
    .cc-float-rev  { animation: ccFloatR 5.5s ease-in-out infinite reverse; }
    .cc-float-slow { animation: ccFloat  7s   ease-in-out infinite; }
    .stands-highlight {
        display: inline-block;
        background: linear-gradient(135deg, #794AFF 0%, #BA4AFF 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
    }
    .stands-highlight::after {
        content: '';
        position: absolute;
        left: 0; right: 0; bottom: -4px;
        height: 3px;
        border-radius: 2px;
        background: linear-gradient(90deg, #794AFF, #BA4AFF);
    }
    .cc-device-frame {
        background: #1a1432;
        border-radius: 20px;
        padding: 10px;
        box-shadow: 0 40px 80px -10px rgba(121,74,255,0.35), 0 0 0 1px rgba(121,74,255,0.2);
    }
    .cc-device-inner {
        background: #0e0b20;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
    }
    .cc-stat-badge {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 6px 24px rgba(121,74,255,0.15);
        padding: 12px 16px;
        border: 1px solid rgba(121,74,255,0.08);
    }
</style>

<section class="cc-hero-bg w-full xl:pt-[200px] pt-[110px] xl:pb-0 pb-16 overflow-hidden relative">
    {{-- decorative blobs --}}
    <div class="absolute top-20 left-0 w-72 h-72 rounded-full bg-purple/5 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-10 w-96 h-96 rounded-full bg-[#BA4AFF]/6 blur-3xl pointer-events-none"></div>

    <div class="theme-container mx-auto">
        <div class="grid xl:grid-cols-2 grid-cols-1 items-center xl:gap-16 gap-12">

            {{-- LEFT: text --}}
            <div class="xl:pb-24" data-aos="fade-right">
                {{-- badge --}}
                <div class="inline-flex items-center gap-2.5 bg-white border border-purple/15 rounded-full px-5 py-2.5 mb-6 shadow-sm">
                    <span class="flex size-2">
                        <span class="animate-ping absolute inline-flex size-2 rounded-full bg-purple opacity-75"></span>
                        <span class="relative inline-flex size-2 rounded-full bg-purple"></span>
                    </span>
                    <span class="text-purple text-sm font-semibold tracking-wide">Creative Content Studio</span>
                </div>

                <h1 class="xl:text-[64px] md:text-[52px] text-[36px] font-bold text-main-black leading-[1.07] tracking-tight mb-6">
                    We Create Creative Content That
                    <span class="stands-highlight">Stands</span> Out
                </h1>

                <p class="text-paragraph font-medium text-base leading-7 mb-9 xl:max-w-[440px]">
                    We help startups, local businesses, and brands build a strong online presence. High-quality reels, graphics, motion visuals, and brand content crafted to capture attention and build engagement.
                </p>

                <div class="flex flex-wrap items-center gap-5">
                    <a href="{{ route('contact-us') }}"
                       class="inline-flex items-center gap-3 bg-[#101828] text-white font-bold text-sm uppercase tracking-widest px-9 py-4 rounded-full hover:bg-purple transition-all duration-300">
                        Book Your Meeting
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="{{ route('services') }}"
                       class="flex items-center gap-2 group text-main-black font-semibold hover:text-purple transition-colors duration-300">
                        <span class="border-b-2 border-main-black group-hover:border-purple pb-0.5 transition-colors duration-300">View Our Work</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>

                {{-- trust strip --}}
                <div class="flex items-center gap-4 mt-10">
                    <div class="flex -space-x-2">
                        @foreach(['#794AFF','#BA4AFF','#FF7E5F','#22C55E'] as $c)
                        <div class="size-9 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold" style="background:{{ $c }}">C</div>
                        @endforeach
                    </div>
                    <div>
                        <p class="text-xs font-bold text-main-black">50+ Happy Brands</p>
                        <div class="flex gap-0.5 mt-0.5">
                            @for($i=0;$i<5;$i++)
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="#F59E0B" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            @endfor
                        </div>
                    </div>
                    <span class="text-xs text-paragraph font-medium pl-2 border-l border-gray-200">Trusted by growing brands across India</span>
                </div>
            </div>

            {{-- RIGHT: device mockup + floating badges --}}
            <div class="relative flex justify-center xl:justify-end items-end" data-aos="fade-left">
                {{-- glow --}}
                <div class="absolute inset-0 cc-device-glow pointer-events-none rounded-3xl"></div>

                {{-- laptop frame --}}
                <div class="relative z-10 cc-float xl:w-[460px] md:w-[380px] w-[300px]">
                    <div class="cc-device-frame">
                        {{-- screen area --}}
                        <div class="cc-device-inner xl:h-[280px] md:h-[230px] h-[180px]">
                            {{-- creative content display inside screen --}}
                            <div class="w-full h-full relative overflow-hidden" style="background: linear-gradient(135deg, #1a1432 0%, #2d1b6b 50%, #1a1432 100%);">
                                {{-- grid overlay --}}
                                <div class="absolute inset-0 opacity-10" style="background-image: repeating-linear-gradient(0deg,rgba(255,255,255,.3) 0,rgba(255,255,255,.3) 1px,transparent 1px,transparent 40px),repeating-linear-gradient(90deg,rgba(255,255,255,.3) 0,rgba(255,255,255,.3) 1px,transparent 1px,transparent 40px);"></div>

                                {{-- mock content cards --}}
                                <div class="absolute top-4 left-4 bg-white/10 backdrop-blur-sm border border-white/10 rounded-xl p-3 w-36">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="size-6 rounded-full bg-purple flex items-center justify-center text-white text-[8px] font-bold">CL</div>
                                        <span class="text-white text-[9px] font-semibold">Reel — Live</span>
                                    </div>
                                    <div class="h-1.5 bg-purple/60 rounded-full mb-1.5 w-full"></div>
                                    <div class="h-1.5 bg-white/20 rounded-full mb-1.5 w-3/4"></div>
                                    <div class="h-1.5 bg-white/20 rounded-full w-1/2"></div>
                                    <div class="mt-2 flex gap-1">
                                        <div class="bg-purple/80 text-white text-[7px] font-bold px-2 py-0.5 rounded-full">+2.4k views</div>
                                    </div>
                                </div>

                                <div class="absolute top-4 right-4 bg-white/10 backdrop-blur-sm border border-white/10 rounded-xl p-3 w-28">
                                    <p class="text-white/60 text-[8px] mb-1.5">Engagement</p>
                                    <p class="text-white font-bold text-base leading-none">84.2%</p>
                                    <svg class="mt-2 w-full" height="24" viewBox="0 0 80 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 20 C10 20 15 8 24 6 C33 4 38 14 46 10 C54 6 60 2 80 4" stroke="#22C55E" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                                    </svg>
                                </div>

                                <div class="absolute bottom-4 left-4 right-4 bg-white/5 border border-white/10 rounded-xl px-3 py-2 flex items-center gap-3">
                                    <div class="size-8 rounded-lg bg-purple/80 flex items-center justify-center flex-shrink-0">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M8 6.82v10.36c0 .79.87 1.27 1.54.84l8.14-5.18c.62-.39.62-1.29 0-1.69L9.54 5.98C8.87 5.55 8 6.03 8 6.82z"/></svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-white text-[9px] font-semibold truncate">Brand Reel — Summer Campaign</p>
                                        <div class="h-1 bg-white/10 rounded-full mt-1.5 relative">
                                            <div class="h-full w-2/3 bg-purple rounded-full"></div>
                                        </div>
                                    </div>
                                    <span class="text-white/50 text-[8px]">0:32</span>
                                </div>
                            </div>
                        </div>
                        {{-- laptop base --}}
                        <div class="h-3 bg-[#1a1432]/60 rounded-b-lg mt-1 mx-4"></div>
                    </div>
                    {{-- laptop foot --}}
                    <div class="h-3 bg-[#16122a] rounded-b-xl mx-6 shadow-lg"></div>
                </div>

                {{-- Floating badge: Views --}}
                <div class="cc-stat-badge absolute xl:-left-6 left-0 xl:top-12 top-4 z-20 cc-float-rev min-w-[148px]">
                    <div class="flex items-center gap-2 mb-1.5">
                        <div class="size-7 rounded-lg bg-[#EDE8FF] flex items-center justify-center">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 12C2 12 5.5 5 12 5C18.5 5 22 12 22 12C22 12 18.5 19 12 19C5.5 19 2 12 2 12Z" stroke="#794AFF" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="12" r="3" stroke="#794AFF" stroke-width="1.8"/></svg>
                        </div>
                        <p class="text-xs text-paragraph font-medium">Total Reach</p>
                    </div>
                    <p class="text-xl font-bold text-main-black">1.26M</p>
                    <svg width="110" height="28" viewBox="0 0 110 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 24 C14 24 18 10 28 8 C38 6 44 18 54 14 C64 10 70 3 88 6 C100 8 105 4 110 2" stroke="#794AFF" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                        <path d="M0 24 C14 24 18 10 28 8 C38 6 44 18 54 14 C64 10 70 3 88 6 C100 8 105 4 110 2 L110 28 L0 28Z" fill="#794AFF" opacity="0.08"/>
                    </svg>
                </div>

                {{-- Floating badge: Growth --}}
                <div class="cc-stat-badge absolute xl:-right-4 right-0 xl:top-8 top-4 z-20 cc-float-slow min-w-[130px]">
                    <div class="flex items-center gap-1.5 mb-1">
                        <span class="size-2 rounded-full bg-green-400 inline-block"></span>
                        <p class="text-xs text-paragraph font-medium">Growth Rate</p>
                    </div>
                    <p class="text-xl font-bold text-main-black">+34.12%</p>
                    <svg class="mt-1" width="90" height="24" viewBox="0 0 90 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 20 C10 20 18 12 28 8 C38 4 48 16 58 10 C68 4 78 2 90 4" stroke="#22C55E" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                    </svg>
                </div>

                {{-- Floating pill: Engagement --}}
                <div class="absolute xl:-left-2 left-0 xl:top-1/2 top-[45%] z-20 cc-float">
                    <div class="bg-purple text-white px-4 py-2.5 rounded-full shadow-purple">
                        <p class="text-sm font-bold">84.2%</p>
                        <p class="text-[10px] opacity-80">Engagement</p>
                    </div>
                </div>

                {{-- Floating card: subscribers --}}
                <div class="cc-stat-badge absolute xl:-right-6 right-0 xl:bottom-20 bottom-10 z-20 cc-float-rev min-w-[120px]">
                    <div class="flex items-center gap-1.5 mb-1">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 11c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 3-1.34 3-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" fill="#F59E0B"/></svg>
                        <p class="text-xs text-paragraph font-medium">Followers</p>
                    </div>
                    <p class="text-xl font-bold text-main-black">48.6k</p>
                </div>

                {{-- CreativLab badge --}}
                <div class="absolute xl:left-4 left-4 xl:bottom-28 bottom-10 z-20 cc-float-slow">
                    <div class="flex items-center gap-2.5 bg-white rounded-2xl px-4 py-2.5 shadow-common border border-purple/10">
                        <div class="size-9 rounded-full bg-purple flex items-center justify-center text-white font-bold text-sm flex-shrink-0">C</div>
                        <div>
                            <p class="text-xs font-bold text-main-black leading-tight">CreativLab</p>
                            <p class="text-[10px] text-paragraph">Content Studio</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
