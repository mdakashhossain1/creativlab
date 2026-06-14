<style>
    @keyframes wdCtaFloat  { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    @keyframes wdCtaFloatR { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)}  }
    .wd-cta-float     { animation: wdCtaFloat  4.5s ease-in-out infinite; }
    .wd-cta-float-rev { animation: wdCtaFloatR 5.5s ease-in-out infinite reverse; }
</style>

<section class="w-full md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="relative w-full rounded-[24px] overflow-hidden" style="background: linear-gradient(120deg, #EDE8FF 0%, #F4F1FF 50%, #E4DCFF 100%);">

            {{-- decorative circles --}}
            <div class="absolute -top-10 -left-10 size-48 rounded-full bg-purple/10 pointer-events-none"></div>
            <div class="absolute -bottom-8 left-1/3 size-32 rounded-full bg-purple/8 pointer-events-none"></div>
            <div class="absolute top-4 right-1/4 size-16 rounded-full bg-[#BA4AFF]/10 pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between px-8 md:px-16 xl:px-20 py-14 md:py-0 md:min-h-[380px]">

                {{-- Left: text --}}
                <div class="md:max-w-[480px] w-full md:py-16 text-center md:text-left" data-aos="fade-right">
                    <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-4 block">GET STARTED TODAY</span>
                    <h2 class="xl:text-[48px] md:text-[38px] text-[28px] font-bold text-main-black leading-tight mb-4">
                        Ready to Build<br>Your <span class="text-purple">Online Presence?</span>
                    </h2>
                    <p class="text-paragraph text-base leading-7 mb-8">
                        Let's create a website that represents your brand and helps your business grow digitally.
                    </p>
                    <div class="flex flex-wrap gap-4 md:justify-start justify-center">
                        <a href="{{ route('contact-us') }}"
                           class="inline-flex items-center gap-2.5 bg-purple text-white font-bold text-sm uppercase tracking-wider px-8 py-4 rounded-full hover:bg-main-black transition-all duration-300 shadow-purple">
                            Build Your Website
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a href="{{ route('services') }}"
                           class="inline-flex items-center gap-2 text-main-black font-semibold text-sm hover:text-purple transition-colors duration-300 px-2">
                            View Services
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Right: device mockups --}}
                <div class="relative md:self-end self-center mt-8 md:mt-0 flex-shrink-0 flex items-end justify-center" data-aos="fade-left">
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-72 h-72 rounded-full bg-purple/20 blur-2xl pointer-events-none"></div>

                    {{-- laptop --}}
                    <div class="relative z-10 wd-cta-float xl:w-[320px] md:w-[260px] w-[230px]">
                        <div style="background:#1a1432; border-radius:12px; padding:7px; box-shadow:0 30px 60px -10px rgba(121,74,255,.4);">
                            <div style="background:linear-gradient(135deg,#2d1b6b,#1a1432); border-radius:7px; overflow:hidden;" class="xl:h-[185px] md:h-[150px] h-[135px]">
                                <div class="flex items-center gap-1.5 px-3 py-2 bg-black/30">
                                    <span class="size-1.5 rounded-full bg-red-400"></span>
                                    <span class="size-1.5 rounded-full bg-yellow-400"></span>
                                    <span class="size-1.5 rounded-full bg-green-400"></span>
                                </div>
                                <div class="p-3">
                                    <p class="text-white font-bold text-xs mb-2">Let's Build Something Great Together</p>
                                    <div class="bg-purple/40 rounded-lg h-20 flex items-center justify-center">
                                        <span class="text-white/80 text-[10px] font-semibold">creativlab.dev</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h-2 bg-[#16122a] rounded-b-lg mx-8"></div>
                    </div>

                    {{-- phone --}}
                    <div class="absolute xl:-right-6 right-0 bottom-2 z-20 xl:w-[90px] w-[68px]">
                        <div style="background:#1a1432; border-radius:14px; padding:4px; box-shadow:0 25px 50px -10px rgba(121,74,255,.45);">
                            <div class="w-6 h-1 bg-[#0e0b20] rounded-full mx-auto mb-1"></div>
                            <div style="background:linear-gradient(160deg,#2d1b6b,#1a1432); border-radius:11px; overflow:hidden; aspect-ratio:9/18;">
                                <div class="p-1.5 space-y-1.5">
                                    <div class="bg-purple/40 rounded-md h-12"></div>
                                    <div class="h-1 bg-white/20 rounded-full w-full"></div>
                                    <div class="h-1 bg-white/20 rounded-full w-2/3"></div>
                                    <div class="bg-white/10 rounded-md h-6"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- floating badge --}}
                    <div class="absolute xl:-left-6 left-0 top-4 bg-white rounded-2xl px-4 py-2.5 shadow-card border border-purple/10 z-30 wd-cta-float-rev">
                        <div class="flex items-center gap-2">
                            <div class="size-7 rounded-full bg-green-400/20 flex items-center justify-center">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 6L9 17L4 12" stroke="#22C55E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                            <div>
                                <p class="text-[9px] text-paragraph leading-none">Project</p>
                                <p class="text-xs font-bold text-main-black">Delivered</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
