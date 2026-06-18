<style>
    .seo-hero-bg { background: linear-gradient(135deg, #F4F1FF 0%, #EDE8FF 40%, #F8F6FF 100%); }
    @keyframes seoFloat  { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    @keyframes seoFloatR { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)}  }
    .seo-float      { animation: seoFloat  4.5s ease-in-out infinite; }
    .seo-float-rev  { animation: seoFloatR 5.5s ease-in-out infinite reverse; }
    .seo-float-slow { animation: seoFloat  7s   ease-in-out infinite; }
    @keyframes popIn { 0%{opacity:0;transform:scale(0)} 70%{opacity:1;transform:scale(1.1)} 100%{opacity:1;transform:scale(1)} }
    .pop-card { animation: popIn 0.5s cubic-bezier(0.34,1.56,0.64,1) both; transform-origin: center; }
    .pop-d1{animation-delay:.1s} .pop-d2{animation-delay:.25s} .pop-d3{animation-delay:.4s}
    .pop-d4{animation-delay:.55s} .pop-d5{animation-delay:.7s} .pop-d6{animation-delay:.85s}

    .seo-hero-img { max-width: 115%; width: 115%; height: auto; display: block; }
    @media (max-width: 1279px) {
        .seo-hero-img { max-width: 100%; width: 100%; }
    }
</style>

<section id="home-one-hero">
<div class="seo-hero-bg hero-one-section-wrapper w-full xl:h-[905px] overflow-hidden relative">
    <div class="win-grid w-full h-full absolute left-0 top-0" id="win-grid"></div>
    <div class="absolute top-20 left-0 w-72 h-72 rounded-full bg-purple/5 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-10 w-96 h-96 rounded-full bg-[#BA4AFF]/6 blur-3xl pointer-events-none"></div>

    <div class="theme-container mx-auto h-full relative z-10 pointer-events-none">
        <div class="w-full grid xl:grid-cols-2 grid-cols-1 gap-8 xl:gap-14 items-center xl:pt-[223px] pt-[130px] xl:pb-0 pb-10 h-full">

            {{-- LEFT: text --}}
            <div class="article-area pointer-events-auto xl:pb-24" data-aos="fade-right">
                <div class="inline-flex md:px-6 px-3 py-2.5 md:py-[14px] bg-white space-x-2.5 items-center rounded-full shadow-style-one mb-5">
                    <span>{{ get_svg('star') }}</span>
                    <span class="md:text-20 text-sm text-purple font-semibold">SEO Optimization Agency</span>
                </div>

                <h1 class="text-4xl md:text-65 text-main-black mb-[35px] custom-heading md:text-left" style="font-weight: 400 !important;">
                    We Drive <span>SEO</span> That Ranks &amp; Generates Leads
                </h1>

                <div class="px-6 py-[14px] bg-white border-l-2 border-blue-sass mb-[35px] xl:w-full md:w-[500px]">
                    <p class="text-ptwo text-paragraph">
                        We optimize websites with proven SEO strategies that improve rankings, drive organic traffic, and grow your business.
                    </p>
                </div>

                <div class="flex space-x-[30px] items-center">
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

            {{-- RIGHT: hero image --}}
            <div class="image-area relative h-full pointer-events-auto">
                <div class="xl:absolute relative 2xl:w-[752px] lg:w-[600px] w-full left-0 top-0 h-full">

                    {{-- floating pills — left side anchored from bottom to align with image --}}
                    <div class="absolute left-0 z-30 seo-float-rev md:flex hidden" style="bottom:42%;">
                        <div class="flex items-center gap-2 bg-purple rounded-full rounded-br-none pl-2 pr-4 py-2 shadow-purple pop-card pop-d1">
                            <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="11" cy="11" r="8" stroke="white" stroke-width="2"/><path d="M21 21l-4.35-4.35" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>
                            </div>
                            <span class="text-xs font-bold text-white">Keyword Research</span>
                        </div>
                    </div>

                    <div class="absolute left-2 z-30 seo-float md:flex hidden" style="bottom:22%;">
                        <div class="flex items-center gap-2 bg-orange rounded-full rounded-br-none pl-2 pr-4 py-2 shadow-common pop-card pop-d2">
                            <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 2v6h6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                            <span class="text-xs font-bold text-white">On-Page SEO</span>
                        </div>
                    </div>

                    <div class="absolute -left-4 z-30 seo-float-slow md:flex hidden" style="bottom:6%;">
                        <div class="flex items-center gap-2 bg-[#3B82F6] rounded-full rounded-br-none pl-2 pr-4 py-2 shadow-common pop-card pop-d3">
                            <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                            <span class="text-xs font-bold text-white">Link Building</span>
                        </div>
                    </div>

                    {{-- right side pills --}}
                    <div class="absolute -right-2 z-30 seo-float-slow md:flex hidden" style="bottom:55%;">
                        <div class="flex items-center gap-2 bg-white rounded-full rounded-bl-none pl-2 pr-4 py-2 shadow-common border border-purple/10 pop-card pop-d4">
                            <div class="size-7 rounded-full bg-[#EDE8FF] flex items-center justify-center">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" stroke="#794AFF" stroke-width="2"/><circle cx="12" cy="10" r="3" stroke="#794AFF" stroke-width="2"/></svg>
                            </div>
                            <span class="text-xs font-bold text-main-black">Local SEO</span>
                        </div>
                    </div>

                    <div class="absolute -right-4 z-30 seo-float-rev md:flex hidden" style="bottom:32%;">
                        <div class="flex items-center gap-2 bg-[#BA4AFF] rounded-full rounded-bl-none pl-2 pr-4 py-2 shadow-common pop-card pop-d5">
                            <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6h16M4 12h16M4 18h10" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>
                            </div>
                            <span class="text-xs font-bold text-white">Content SEO</span>
                        </div>
                    </div>

                    <div class="absolute -right-2 z-30 seo-float md:flex hidden" style="bottom:12%;">
                        <div class="flex items-center gap-2 bg-[#F43F5E] rounded-full rounded-bl-none pl-2 pr-4 py-2 shadow-common pop-card pop-d6">
                            <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" fill="white"/></svg>
                            </div>
                            <span class="text-xs font-bold text-white">Fast & Secure</span>
                        </div>
                    </div>

                    {{-- image anchored to bottom --}}
                    <div class="xl:absolute relative left-0 bottom-0 w-full z-10">
                        <div class="flex justify-center">
                            <img src="{{ asset('frontend/assets/images/seo-optimization/hero-laptop.webp') }}"
                                 alt="SEO Optimization"
                                 class="seo-hero-img">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
</section>
