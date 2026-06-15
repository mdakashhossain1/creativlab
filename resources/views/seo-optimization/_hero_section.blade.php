<style>
    .seo-hero-bg { background: linear-gradient(135deg, #F4F1FF 0%, #EDE8FF 40%, #F8F6FF 100%); }
    @keyframes seoFloat  { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    @keyframes seoFloatR { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)}  }
    .seo-float      { animation: seoFloat  4.5s ease-in-out infinite; }
    .seo-float-rev  { animation: seoFloatR 5.5s ease-in-out infinite reverse; }
    .seo-float-slow { animation: seoFloat  7s   ease-in-out infinite; }
    .seo-highlight {
        display:inline-block; position:relative;
        background: linear-gradient(135deg, #794AFF 0%, #BA4AFF 100%);
        -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
    }
    .seo-highlight::after { content:''; position:absolute; left:0; right:0; bottom:-4px; height:3px; border-radius:2px; background:linear-gradient(90deg,#794AFF,#BA4AFF); }
    .seo-device-frame { background:#1a1432; border-radius:16px; padding:8px; box-shadow:0 40px 80px -10px rgba(121,74,255,.35), 0 0 0 1px rgba(121,74,255,.2); }
    .seo-device-inner { background:#0e0b20; border-radius:10px; overflow:hidden; position:relative; }
</style>

<section class="seo-hero-bg w-full xl:pt-[200px] pt-[110px] xl:pb-0 pb-16 overflow-hidden relative">
    <div class="win-grid w-full h-full absolute left-0 top-0" id="win-grid"></div>
    <div class="absolute top-20 left-0 w-72 h-72 rounded-full bg-purple/5 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-10 w-96 h-96 rounded-full bg-[#BA4AFF]/6 blur-3xl pointer-events-none"></div>

    <div class="theme-container mx-auto">
        <div class="grid xl:grid-cols-2 grid-cols-1 items-center xl:gap-12 gap-12">

            {{-- LEFT: text --}}
            <div class="xl:pb-24 relative z-10" data-aos="fade-right">
                <div class="inline-flex md:px-6 px-3 py-2.5 md:py-[14px] bg-white space-x-2.5 items-center rounded-full shadow-style-one mb-5">
                    <span>{{ get_svg('star') }}</span>
                    <span class="md:text-20 text-sm text-purple font-semibold pointer-events-auto">SEO Optimization Agency</span>
                </div>

                <h1 class="text-4xl md:text-65 text-main-black mb-[35px] pointer-events-auto custom-heading md:text-left" style="font-weight: 400 !important;">
                    We Drive <span>SEO</span> That Ranks &amp; Generates Leads
                </h1>

                <div class="px-6 py-[14px] bg-white border-l-2 border-blue-sass mb-[35px] xl:w-full md:w-[500px]">
                    <p class="text-ptwo text-paragraph">
                        We optimize websites with proven SEO strategies that improve rankings, drive organic traffic, and grow your business.
                    </p>
                </div>

                <div class="flex space-x-[30px] items-center pointer-events-auto">
                    <a href="{{ route('contact-us') }}">
                        <div class="home-two-btn-bg py-3 group bg-purple border-purple">
                            <span class="text-base text-white group-hover:text-purple transition-all duration-300 font-semibold font-inter relative z-10">
                                Start Your Journey
                            </span>
                            <span>{{ get_svg('home_cta_white') }}</span>
                        </div>
                    </a>
                    <a href="{{ route('services') }}">
                        <div class="flex items-center gap-2 group">
                            <p class="mb-[1px] font-medium text-main-black leading-5 font-inter border-b border-main-black before:block before:pb-[1px] before:border-purple before:font-medium before:text-purple before:leading-5 before:font-inter before:border-b before:content-['View_Case_Studies'] before:absolute before:-bottom-[1px] before:transition-all before:duration-300 before:w-0 hover:before:w-full before:overflow-hidden before:h-[21px] relative">
                                View Case Studies
                            </p>
                            <span>{{ get_svg('arrow2') }}</span>
                        </div>
                    </a>
                </div>
            </div>

            {{-- RIGHT: device mockups + floating pills --}}
            <div class="relative flex justify-center xl:justify-end items-center" data-aos="fade-left">
                <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(circle at 60% 50%, rgba(121,74,255,0.15) 0%, transparent 70%);"></div>

                {{-- laptop with SEO Performance dashboard --}}
                <div class="relative z-10 seo-float xl:w-[440px] md:w-[360px] w-[280px]">
                    <div class="seo-device-frame">
                        <div class="seo-device-inner xl:h-[270px] md:h-[215px] h-[170px]">
                            <div class="w-full h-full relative" style="background:linear-gradient(135deg,#1a1432 0%,#2d1b6b 50%,#1a1432 100%);">
                                <div class="flex items-center justify-between px-3 py-2 bg-black/30">
                                    <span class="text-white text-[10px] font-bold">SEO Performance</span>
                                    <div class="flex gap-1.5">
                                        <span class="size-2 rounded-full bg-red-400"></span>
                                        <span class="size-2 rounded-full bg-yellow-400"></span>
                                        <span class="size-2 rounded-full bg-green-400"></span>
                                    </div>
                                </div>
                                <div class="p-3">
                                    {{-- top stats --}}
                                    <div class="grid grid-cols-3 gap-2 mb-2.5">
                                        <div class="bg-white/10 rounded-lg p-2">
                                            <p class="text-white font-bold text-sm leading-none">12,540</p>
                                            <p class="text-green-400 text-[8px] mt-0.5">↑ +12%</p>
                                        </div>
                                        <div class="bg-white/10 rounded-lg p-2">
                                            <p class="text-white font-bold text-sm leading-none">1,253</p>
                                            <p class="text-green-400 text-[8px] mt-0.5">↑ +8%</p>
                                        </div>
                                        <div class="bg-white/10 rounded-lg p-2">
                                            <p class="text-white font-bold text-sm leading-none">3,847</p>
                                            <p class="text-green-400 text-[8px] mt-0.5">↑ +24%</p>
                                        </div>
                                    </div>
                                    {{-- traffic chart --}}
                                    <div class="bg-white/10 rounded-lg p-2.5">
                                        <div class="flex items-center justify-between mb-1.5">
                                            <span class="text-white/60 text-[9px]">Traffic Overview</span>
                                            <span class="text-purple bg-purple/20 text-[8px] font-bold px-2 py-0.5 rounded-full">+52%</span>
                                        </div>
                                        <svg class="w-full" height="48" viewBox="0 0 240 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 44 C30 44 40 20 60 22 C85 24 95 34 120 26 C145 18 155 8 185 12 C210 15 222 6 240 3" stroke="#794AFF" stroke-width="2" fill="none" stroke-linecap="round"/>
                                            <path d="M0 44 C30 44 40 20 60 22 C85 24 95 34 120 26 C145 18 155 8 185 12 C210 15 222 6 240 3 L240 48 L0 48Z" fill="#794AFF" opacity="0.12"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h-2.5 bg-[#1a1432]/60 rounded-b-lg mt-1 mx-4"></div>
                    </div>
                    <div class="h-3 bg-[#16122a] rounded-b-xl mx-6 shadow-lg"></div>
                </div>

                {{-- phone with ranking --}}
                <div class="absolute xl:right-0 right-2 xl:bottom-6 bottom-2 z-20 seo-float-slow xl:w-[120px] w-[88px]">
                    <div style="background:#1a1432; border-radius:18px; padding:5px; box-shadow:0 30px 60px -10px rgba(121,74,255,.4);">
                        <div class="w-8 h-1.5 bg-[#0e0b20] rounded-full mx-auto mb-1"></div>
                        <div style="background:linear-gradient(160deg,#2d1b6b,#1a1432); border-radius:14px; overflow:hidden; aspect-ratio:9/18;">
                            <div class="p-2">
                                <p class="text-white text-[7px] font-bold mb-1.5">Keyword Ranking</p>
                                <div class="bg-white/10 rounded-md p-1.5 mb-1.5">
                                    <p class="text-white font-bold text-[11px] leading-none">#1</p>
                                    <p class="text-green-400 text-[6px] mt-0.5">Top Position</p>
                                </div>
                                <div class="space-y-1">
                                    <div class="flex items-center gap-1"><span class="size-1 rounded-full bg-purple"></span><div class="h-1 bg-white/20 rounded-full flex-1"></div></div>
                                    <div class="flex items-center gap-1"><span class="size-1 rounded-full bg-[#BA4AFF]"></span><div class="h-1 bg-white/20 rounded-full w-2/3"></div></div>
                                    <div class="flex items-center gap-1"><span class="size-1 rounded-full bg-green-400"></span><div class="h-1 bg-white/20 rounded-full w-1/2"></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- floating pill: Keyword Research --}}
                <div class="absolute xl:left-0 left-0 xl:top-8 top-2 z-30 seo-float-rev">
                    <div class="flex items-center gap-2 bg-purple rounded-full pl-2 pr-4 py-2 shadow-purple">
                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="11" cy="11" r="8" stroke="white" stroke-width="2"/><path d="M21 21l-4.35-4.35" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>
                        </div>
                        <span class="text-xs font-bold text-white">Keyword Research</span>
                    </div>
                </div>

                {{-- floating pill: On-Page SEO --}}
                <div class="absolute xl:left-2 left-0 xl:top-1/3 top-1/4 z-30 seo-float">
                    <div class="flex items-center gap-2 bg-orange rounded-full pl-2 pr-4 py-2 shadow-common">
                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 2v6h6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <span class="text-xs font-bold text-white">On-Page SEO</span>
                    </div>
                </div>

                {{-- floating pill: Link Building --}}
                <div class="absolute xl:-right-2 right-0 xl:top-12 top-6 z-30 seo-float-slow">
                    <div class="flex items-center gap-2 bg-white rounded-full pl-2 pr-4 py-2 shadow-common border border-purple/10">
                        <div class="size-7 rounded-full bg-[#EDE8FF] flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71" stroke="#794AFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71" stroke="#794AFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <span class="text-xs font-bold text-main-black">Link Building</span>
                    </div>
                </div>

                {{-- floating pill: Local SEO --}}
                <div class="absolute xl:-right-4 right-0 xl:top-1/2 top-1/2 z-30 seo-float-rev">
                    <div class="flex items-center gap-2 bg-[#BA4AFF] rounded-full pl-2 pr-4 py-2 shadow-common">
                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" stroke="white" stroke-width="2"/><circle cx="12" cy="10" r="3" stroke="white" stroke-width="2"/></svg>
                        </div>
                        <span class="text-xs font-bold text-white">Local SEO</span>
                    </div>
                </div>

                {{-- floating pill: Content SEO --}}
                <div class="absolute xl:-right-2 right-0 xl:bottom-16 bottom-8 z-30 seo-float">
                    <div class="flex items-center gap-2 bg-[#F43F5E] rounded-full pl-2 pr-4 py-2 shadow-common">
                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6h16M4 12h16M4 18h10" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>
                        </div>
                        <span class="text-xs font-bold text-white">Content SEO</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
