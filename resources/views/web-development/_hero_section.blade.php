<style>
    @keyframes wdFloat  { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    @keyframes wdFloatR { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)}  }
    .wd-float      { animation: wdFloat  4.5s ease-in-out infinite; }
    .wd-float-rev  { animation: wdFloatR 5.5s ease-in-out infinite reverse; }
    .wd-float-slow { animation: wdFloat  7s   ease-in-out infinite; }
    .wd-pill-btn { box-shadow:0 8px 24px rgba(121,74,255,.15); }
    .wd-device-frame { background:#1a1432; border-radius:16px; padding:8px; box-shadow:0 40px 80px -10px rgba(121,74,255,.35), 0 0 0 1px rgba(121,74,255,.2); }
    .wd-device-inner { background:#0e0b20; border-radius:10px; overflow:hidden; position:relative; }
</style>

<section class="w-full xl:pt-[200px] pt-[110px] xl:pb-0 pb-16 overflow-hidden relative">
    <div class="win-grid w-full h-full absolute left-0 top-0" id="win-grid"></div>

    <div class="theme-container mx-auto relative z-10">
        <div class="grid xl:grid-cols-2 grid-cols-1 items-center xl:gap-12 gap-12">

            {{-- LEFT: text --}}
            <div class="xl:pb-24 relative z-10" data-aos="fade-right">
                <div class="inline-flex items-center gap-2.5 bg-white border border-purple/15 rounded-full px-5 py-2.5 mb-6 shadow-sm">
                    <span class="flex size-2 relative">
                        <span class="animate-ping absolute inline-flex size-2 rounded-full bg-purple opacity-75"></span>
                        <span class="relative inline-flex size-2 rounded-full bg-purple"></span>
                    </span>
                    <span class="text-purple text-sm font-semibold tracking-wide">Web Development Agency</span>
                </div>

                <h1 class="text-4xl md:text-65 text-main-black mb-[35px] pointer-events-auto custom-heading md:text-left" style="font-weight: 400 !important;">
                    We Build <span>Modern</span> Websites That Drive Results
                </h1>

                <div class="px-6 py-[14px] bg-white border-l-2 border-blue-sass mb-[35px] xl:w-full md:w-[500px]">
                    <p class="text-ptwo text-paragraph">
                        We design and develop high-performance websites that are fast, responsive, visually engaging, and built to grow your business online.
                    </p>
                </div>

                <div class="flex space-x-[30px] items-center pointer-events-auto">
                    <a href="{{ route('contact-us') }}">
                        <div class="home-two-btn-bg py-3 group bg-purple border-purple">
                            <span class="text-base text-white group-hover:text-purple transition-all duration-300 font-semibold font-inter relative z-10">
                                Start Your Project
                            </span>
                            <span>{{ get_svg('home_cta_white') }}</span>
                        </div>
                    </a>
                    <a href="{{ route('services') }}">
                        <div class="flex items-center gap-2 group">
                            <p class="mb-[1px] font-medium text-main-black leading-5 font-inter border-b border-main-black before:block before:pb-[1px] before:border-purple before:font-medium before:text-purple before:leading-5 before:font-inter before:border-b before:content-['View_Portfolio'] before:absolute before:-bottom-[1px] before:transition-all before:duration-300 before:w-0 hover:before:w-full before:overflow-hidden before:h-[21px] relative">
                                View Portfolio
                            </p>
                            <span>{{ get_svg('arrow2') }}</span>
                        </div>
                    </a>
                </div>
            </div>

            {{-- RIGHT: device mockups + floating buttons --}}
            <div class="relative flex justify-center xl:justify-end items-center" data-aos="fade-left">
                <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(circle at 60% 50%, rgba(121,74,255,0.15) 0%, transparent 70%);"></div>

                {{-- laptop --}}
                <div class="relative z-10 wd-float xl:w-[440px] md:w-[360px] w-[280px]">
                    <div class="wd-device-frame">
                        <div class="wd-device-inner xl:h-[260px] md:h-[210px] h-[165px]">
                            <div class="w-full h-full relative" style="background:linear-gradient(135deg,#1a1432 0%,#2d1b6b 50%,#1a1432 100%);">
                                {{-- browser bar --}}
                                <div class="flex items-center gap-1.5 px-3 py-2 bg-black/30">
                                    <span class="size-2 rounded-full bg-red-400"></span>
                                    <span class="size-2 rounded-full bg-yellow-400"></span>
                                    <span class="size-2 rounded-full bg-green-400"></span>
                                    <div class="ml-2 h-3 flex-1 max-w-[120px] bg-white/10 rounded-full"></div>
                                </div>
                                {{-- dashboard content --}}
                                <div class="p-3">
                                    <p class="text-white font-bold text-sm mb-2">Grow Your Business Faster With Digital Power</p>
                                    <div class="bg-white/10 rounded-lg p-2.5 border border-white/10">
                                        <div class="flex items-center justify-between mb-1.5">
                                            <span class="text-white/60 text-[9px]">Revenue</span>
                                            <span class="text-green-400 text-[9px] font-bold">↑ 12,540</span>
                                        </div>
                                        <svg class="w-full" height="40" viewBox="0 0 200 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 36 C25 36 35 12 50 14 C70 16 80 28 100 22 C120 16 130 6 155 10 C175 13 185 8 200 4" stroke="#794AFF" stroke-width="2" fill="none" stroke-linecap="round"/>
                                            <path d="M0 36 C25 36 35 12 50 14 C70 16 80 28 100 22 C120 16 130 6 155 10 C175 13 185 8 200 4 L200 40 L0 40Z" fill="#794AFF" opacity="0.12"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h-2.5 bg-[#1a1432]/60 rounded-b-lg mt-1 mx-4"></div>
                    </div>
                    <div class="h-3 bg-[#16122a] rounded-b-xl mx-6 shadow-lg"></div>
                </div>

                {{-- phone overlapping --}}
                <div class="absolute xl:right-0 right-2 xl:bottom-6 bottom-2 z-20 wd-float-slow xl:w-[120px] w-[88px]">
                    <div style="background:#1a1432; border-radius:18px; padding:5px; box-shadow:0 30px 60px -10px rgba(121,74,255,.4);">
                        <div class="w-8 h-1.5 bg-[#0e0b20] rounded-full mx-auto mb-1"></div>
                        <div style="background:linear-gradient(160deg,#2d1b6b,#1a1432); border-radius:14px; overflow:hidden; aspect-ratio:9/18;">
                            <div class="p-2">
                                <p class="text-white text-[7px] font-bold mb-1.5">Grow Your Business</p>
                                <div class="bg-white/10 rounded-md p-1.5 mb-1.5">
                                    <p class="text-white font-bold text-[10px] leading-none">₹24,650</p>
                                    <svg class="mt-1 w-full" height="16" viewBox="0 0 60 16" fill="none"><path d="M0 13 C8 13 12 4 20 5 C28 6 34 10 42 7 C50 4 54 2 60 3" stroke="#22C55E" stroke-width="1.5" fill="none"/></svg>
                                </div>
                                <div class="space-y-1">
                                    <div class="h-1 bg-white/20 rounded-full w-full"></div>
                                    <div class="h-1 bg-white/20 rounded-full w-2/3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- floating pill: UI/UX Design --}}
                <div class="absolute xl:left-0 left-0 xl:top-8 top-2 z-30 wd-float-rev">
                    <div class="flex items-center gap-2 bg-white rounded-full pl-2 pr-4 py-2 shadow-common border border-purple/10">
                        <div class="size-7 rounded-full bg-[#EDE8FF] flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 19l7-7 3 3-7 7-3-3z" stroke="#794AFF" stroke-width="1.8"/><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z" stroke="#794AFF" stroke-width="1.8"/></svg>
                        </div>
                        <span class="text-xs font-bold text-main-black">UI/UX Design</span>
                    </div>
                </div>

                {{-- floating pill: Responsive Design --}}
                <div class="absolute xl:-left-8 left-2 xl:top-[38%] top-[35%] z-30 wd-float">
                    <div class="flex items-center gap-2 bg-[#EC4899] rounded-full pl-2 pr-4 py-2 shadow-common">
                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="2" y="4" width="13" height="11" rx="1.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <rect x="11" y="9" width="6" height="10" rx="1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6 15h4" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-white">Responsive Design</span>
                    </div>
                </div>

                {{-- floating pill: E-Commerce --}}
                <div class="absolute xl:-left-4 left-0 xl:top-[68%] top-[65%] z-30 wd-float-slow">
                    <div class="flex items-center gap-2 bg-[#3B82F6] rounded-full pl-2 pr-4 py-2 shadow-common">
                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4H6z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M3 6h18M16 10a4 4 0 0 1-8 0" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-white">E-Commerce</span>
                    </div>
                </div>

                {{-- floating pill: Custom Website --}}
                <div class="absolute xl:-right-2 right-0 xl:top-1/3 top-1/4 z-30 wd-float">
                    <div class="flex items-center gap-2 bg-orange rounded-full pl-2 pr-4 py-2 shadow-common">
                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 18l6-6-6-6M8 6l-6 6 6 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <span class="text-xs font-bold text-white">Custom Website</span>
                    </div>
                </div>

                {{-- floating pill: SEO Friendly --}}
                <div class="absolute xl:-right-4 right-0 xl:bottom-1/3 bottom-1/4 z-30 wd-float-slow">
                    <div class="flex items-center gap-2 bg-purple rounded-full pl-2 pr-4 py-2 shadow-purple">
                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="11" cy="11" r="8" stroke="white" stroke-width="2"/><path d="M21 21l-4.35-4.35" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>
                        </div>
                        <span class="text-xs font-bold text-white">SEO Friendly</span>
                    </div>
                </div>

                {{-- floating pill: Fast Performance --}}
                <div class="absolute xl:right-8 right-4 xl:bottom-10 bottom-4 z-30 wd-float-rev">
                    <div class="flex items-center gap-2 bg-[#F43F5E] rounded-full pl-2 pr-4 py-2 shadow-common">
                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" fill="white"/></svg>
                        </div>
                        <span class="text-xs font-bold text-white">Fast Performance</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
