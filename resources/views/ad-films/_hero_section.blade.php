<style>
    @keyframes afFloat  { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    @keyframes afFloatR { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)}  }
    .af-float      { animation: afFloat  4.5s ease-in-out infinite; }
    .af-float-rev  { animation: afFloatR 5.5s ease-in-out infinite reverse; }
    .af-float-slow { animation: afFloat  7s   ease-in-out infinite; }
    @keyframes popIn { 0%{opacity:0;transform:scale(0)} 70%{opacity:1;transform:scale(1.1)} 100%{opacity:1;transform:scale(1)} }
    .pop-card { animation: popIn 0.5s cubic-bezier(0.34,1.56,0.64,1) both; transform-origin: center; }
    .pop-d1{animation-delay:.1s} .pop-d2{animation-delay:.25s} .pop-d3{animation-delay:.4s}
    .pop-d4{animation-delay:.55s} .pop-d5{animation-delay:.7s} .pop-d6{animation-delay:.85s}
</style>

<section id="home-one-hero">
    <div class="hero-one-section-wrapper w-full xl:h-[905px] overflow-hidden relative">
        <div class="win-grid w-full h-full absolute left-0 top-0" id="win-grid"></div>

        <div class="theme-container mx-auto h-full relative z-10 pointer-events-none">
            <div class="w-full grid xl:grid-cols-2 grid-cols-1 2xl:gap-[130px] gap-14 items-center xl:pt-[223px] pt-[130px] h-full">

                {{-- LEFT: text --}}
                <div class="article-area pointer-events-auto">
                    <div class="inline-flex md:px-6 px-3 py-2.5 md:py-[14px] bg-white space-x-2.5 items-center rounded-full shadow-style-one mb-5">
                        <span>{{ get_svg('star') }}</span>
                        <span class="md:text-20 text-sm text-purple font-semibold">Ad Films Production House</span>
                    </div>

                    <h1 class="text-4xl md:text-65 text-main-black mb-[35px] custom-heading md:text-left" style="font-weight:400 !important;">
                        We Create <span>Ad Films</span> That <span>Inspire</span> &amp; Drive Action
                    </h1>

                    <div class="px-6 py-[14px] bg-white border-l-2 border-blue-sass mb-[35px] xl:w-full md:w-[500px]">
                        <p class="text-ptwo text-paragraph">
                            Powerful storytelling. Cinematic visuals. Strategic messaging. We create ad films that connect, influence and convert.
                        </p>
                    </div>

                    <div class="flex space-x-[30px] items-center">
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
                                <p class="mb-[1px] font-medium text-main-black leading-5 font-inter border-b border-main-black before:block before:pb-[1px] before:border-purple before:font-medium before:text-purple before:leading-5 before:font-inter before:border-b before:content-['Our_Services'] before:absolute before:-bottom-[1px] before:transition-all before:duration-300 before:w-0 hover:before:w-full before:overflow-hidden before:h-[21px] relative">
                                    Our Services
                                </p>
                                <span>{{ get_svg('arrow2') }}</span>
                            </div>
                        </a>
                    </div>
                </div>

                {{-- RIGHT: film scene + floating pills --}}
                <div class="image-area relative h-full pointer-events-auto">
                    <div class="xl:absolute relative 2xl:w-[752px] lg:w-[600px] w-full left-0 top-0 h-full">
                        <div class="xl:absolute relative left-0 bottom-0 w-full z-10 flex justify-center">

                            {{-- hero image with floating pills --}}
                            <div class="relative z-10 xl:mt-0 mt-8">
                                <img src="{{ asset('frontend/assets/images/ad-film/hero-adfilm.webp') }}"
                                     alt="Ad Films"
                                     style="max-width:100%; height:auto; display:block; object-fit:contain;">


                                {{-- floating pills — hidden on mobile, show md+ --}}
                                <div class="absolute xl:right-0 right-0 xl:-top-8 -top-8 z-30 af-float-rev md:flex hidden">
                                    <div class="flex items-center gap-2 bg-purple rounded-full rounded-bl-none pl-2 pr-4 py-2 shadow-purple pop-card pop-d1">
                                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none"><path d="M9 18h6M10 22h4M12 2a7 7 0 00-4 12.7V17h8v-2.3A7 7 0 0012 2z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </div>
                                        <span class="text-xs font-bold text-white">Creative Concept</span>
                                    </div>
                                </div>

                                <div class="absolute xl:-left-16 -left-4 xl:top-1/3 top-1/4 z-30 af-float md:flex hidden">
                                    <div class="flex items-center gap-2 bg-[#BA4AFF] rounded-full rounded-br-none pl-2 pr-4 py-2 shadow-common pop-card pop-d2">
                                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none"><rect x="2" y="2" width="20" height="20" rx="2.18" stroke="white" stroke-width="2"/><path d="M7 2v20M17 2v20M2 12h20M2 7h5M2 17h5M17 17h5M17 7h5" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>
                                        </div>
                                        <span class="text-xs font-bold text-white">Cinematic Production</span>
                                    </div>
                                </div>

                                <div class="absolute xl:-left-12 -left-2 xl:bottom-8 bottom-4 z-30 af-float-slow md:flex hidden">
                                    <div class="flex items-center gap-2 bg-blue-sass rounded-full rounded-br-none pl-2 pr-4 py-2 shadow-common pop-card pop-d3">
                                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none"><path d="M4 19.5A2.5 2.5 0 016.5 17H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </div>
                                        <span class="text-xs font-bold text-white">Brand Storytelling</span>
                                    </div>
                                </div>

                                <div class="absolute xl:-right-16 -right-4 xl:top-6 top-4 z-30 af-float-slow md:flex hidden">
                                    <div class="flex items-center gap-2 bg-orange rounded-full rounded-bl-none pl-2 pr-4 py-2 shadow-common pop-card pop-d4">
                                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="white" stroke-width="2" stroke-linejoin="round"/></svg>
                                        </div>
                                        <span class="text-xs font-bold text-white">High-Quality Output</span>
                                    </div>
                                </div>

                                <div class="absolute xl:-right-20 -right-4 xl:top-1/2 top-1/2 z-30 af-float-rev md:flex hidden">
                                    <div class="flex items-center gap-2 bg-white rounded-full rounded-bl-none pl-2 pr-4 py-2 shadow-common border border-purple/10 pop-card pop-d5">
                                        <div class="size-7 rounded-full bg-[#EDE8FF] flex items-center justify-center">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none"><path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z" stroke="#794AFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="13" r="4" stroke="#794AFF" stroke-width="2"/></svg>
                                        </div>
                                        <span class="text-xs font-bold text-main-black">Product Shoot</span>
                                    </div>
                                </div>

                                <div class="absolute xl:-right-14 -right-2 xl:bottom-12 bottom-6 z-30 af-float md:flex hidden">
                                    <div class="flex items-center gap-2 bg-[#F43F5E] rounded-full rounded-bl-none pl-2 pr-4 py-2 shadow-common pop-card pop-d6">
                                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" fill="white"/></svg>
                                        </div>
                                        <span class="text-xs font-bold text-white">Emotional Connect</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- shadow --}}
                        <div class="absolute left-0 bottom-0 w-full overflow-hidden">
                            <div class="flex justify-center">
                                {{ get_svg("heroshadow") }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
