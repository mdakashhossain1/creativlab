<section class="w-full md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="relative w-full rounded-[24px] overflow-hidden" style="background: linear-gradient(120deg, #EDE8FF 0%, #F4F1FF 50%, #E4DCFF 100%);">

            {{-- Decorative circles --}}
            <div class="absolute -top-10 -left-10 size-48 rounded-full bg-purple/10 pointer-events-none"></div>
            <div class="absolute -bottom-8 left-1/3 size-32 rounded-full bg-purple/8 pointer-events-none"></div>
            <div class="absolute top-4 right-1/4 size-16 rounded-full bg-[#BA4AFF]/10 pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between px-8 md:px-16 xl:px-20 py-14 md:py-0 md:min-h-[360px]">

                {{-- Left: text --}}
                <div class="md:max-w-[500px] w-full md:py-16 text-center md:text-left" data-aos="fade-right">
                    <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-4 block">GET STARTED TODAY</span>
                    <h2 class="xl:text-[48px] md:text-[38px] text-[30px] font-bold text-main-black leading-tight mb-4">
                        Ready to <span class="text-purple">Grow Your Brand?</span>
                    </h2>
                    <p class="text-paragraph text-base leading-7 mb-8">
                        Let's turn your ideas into impactful digital experiences that drive real results for your business.
                    </p>
                    <div class="flex flex-wrap gap-4 md:justify-start justify-center">
                        <a href="{{ route('contact-us') }}"
                           class="inline-flex items-center gap-2.5 bg-purple text-white font-bold text-sm uppercase tracking-wider px-8 py-4 rounded-full hover:bg-main-black transition-all duration-300 shadow-purple">
                            Start Your Project
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

                {{-- Right: character image --}}
                <div class="relative md:self-end self-center mt-8 md:mt-0 flex-shrink-0" data-aos="fade-left">
                    {{-- Glow circle behind character --}}
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-64 h-64 rounded-full bg-purple/20 blur-2xl pointer-events-none"></div>
                    <img src="{{ asset('frontend/assets/images/cta-person.png') }}"
                         alt="CreativLab"
                         class="relative z-10 xl:h-[340px] md:h-[280px] h-[220px] object-contain object-bottom drop-shadow-2xl" />

                    {{-- Floating badge --}}
                    <div class="absolute top-6 -left-6 bg-white rounded-2xl px-4 py-3 shadow-card border border-purple/10 z-20"
                         style="animation: floatY 4s ease-in-out infinite;">
                        <div class="flex items-center gap-2">
                            <div class="size-8 rounded-full bg-green-400/20 flex items-center justify-center">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 6L9 17L4 12" stroke="#22C55E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] text-paragraph leading-none">Campaign Live</p>
                                <p class="text-xs font-bold text-main-black">+2.4k Reach</p>
                            </div>
                        </div>
                    </div>

                    {{-- Floating stat --}}
                    <div class="absolute bottom-12 -right-4 bg-purple text-white rounded-2xl px-4 py-2.5 shadow-purple z-20"
                         style="animation: floatY 5s ease-in-out infinite reverse;">
                        <p class="text-[10px] opacity-80">ROI Growth</p>
                        <p class="text-sm font-bold">↑ 34.12%</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
