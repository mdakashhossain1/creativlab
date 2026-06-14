<style>
    @keyframes afCtaFloat  { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    @keyframes afCtaFloatR { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)}  }
    .af-cta-float     { animation: afCtaFloat  4.5s ease-in-out infinite; }
    .af-cta-float-rev { animation: afCtaFloatR 5.5s ease-in-out infinite reverse; }
</style>

<section class="w-full md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="relative w-full rounded-[24px] overflow-hidden" style="background: linear-gradient(120deg, #EDE8FF 0%, #F4F1FF 50%, #E4DCFF 100%);">

            <div class="absolute -top-10 -left-10 size-48 rounded-full bg-purple/10 pointer-events-none"></div>
            <div class="absolute -bottom-8 left-1/3 size-32 rounded-full bg-purple/8 pointer-events-none"></div>
            <div class="absolute top-4 right-1/4 size-16 rounded-full bg-[#BA4AFF]/10 pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between px-8 md:px-16 xl:px-20 py-14 md:py-0 md:min-h-[380px]">

                {{-- Left: text --}}
                <div class="md:max-w-[480px] w-full md:py-16 text-center md:text-left" data-aos="fade-right">
                    <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-4 block">GET STARTED TODAY</span>
                    <h2 class="xl:text-[44px] md:text-[36px] text-[26px] font-bold text-main-black leading-tight mb-4">
                        Ready to Create an<br><span class="text-purple">Ad Film</span> That Drives Results?
                    </h2>
                    <p class="text-paragraph text-base leading-7 mb-8">
                        Let's create a powerful story that connects with your audience and takes your brand to the next level.
                    </p>
                    <div class="flex flex-wrap gap-4 md:justify-start justify-center">
                        <a href="{{ route('contact-us') }}"
                           class="inline-flex items-center gap-2.5 bg-purple text-white font-bold text-sm uppercase tracking-wider px-8 py-4 rounded-full hover:bg-main-black transition-all duration-300 shadow-purple">
                            Get Free Consultation
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a href="{{ route('services') }}"
                           class="inline-flex items-center gap-2 text-main-black font-semibold text-sm hover:text-purple transition-colors duration-300 px-2">
                            View Showreel
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Right: camera / film scene --}}
                <div class="relative md:self-end self-center mt-8 md:mt-0 flex-shrink-0 flex items-end justify-center" data-aos="fade-left">
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-72 h-72 rounded-full bg-purple/20 blur-2xl pointer-events-none"></div>

                    {{-- film scene card --}}
                    <div class="relative z-10 af-cta-float rounded-2xl overflow-hidden xl:w-[340px] md:w-[280px] w-[240px]"
                         style="background:linear-gradient(135deg,#1a1432,#2d1b6b); box-shadow:0 30px 60px -10px rgba(121,74,255,.4);">
                        <div class="relative xl:h-[210px] md:h-[175px] h-[155px] p-4">
                            <div class="absolute top-4 right-6 size-12 rounded-full bg-yellow-200/20 blur-xl"></div>

                            {{-- camera --}}
                            <div class="absolute bottom-4 right-4 bg-[#0e0b20] rounded-xl p-3 border border-white/10 w-28">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="size-8 rounded-full bg-purple/30 border-2 border-purple flex items-center justify-center">
                                        <div class="size-3.5 rounded-full bg-purple"></div>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <span class="size-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                        <span class="text-red-400 text-[7px] font-bold">REC</span>
                                    </div>
                                </div>
                                <div class="h-1 bg-white/20 rounded-full w-full"></div>
                            </div>

                            {{-- clapperboard --}}
                            <div class="absolute top-5 left-4 bg-white rounded-md p-2 shadow-lg rotate-[-6deg] w-20">
                                <div class="flex gap-0.5 mb-1">
                                    @for($i=0;$i<5;$i++)<div class="flex-1 h-1.5 {{ $i % 2 == 0 ? 'bg-main-black' : 'bg-white border border-main-black' }} -skew-x-12"></div>@endfor
                                </div>
                                <div class="h-1 bg-gray-200 rounded-full w-full"></div>
                            </div>

                            {{-- center play --}}
                            <div class="absolute inset-0 flex items-center justify-center">
                                <button class="size-14 rounded-full bg-white/90 backdrop-blur flex items-center justify-center shadow-xl">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#794AFF" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- floating play badge --}}
                    <div class="absolute xl:-right-4 right-0 top-6 bg-white rounded-2xl px-4 py-2.5 shadow-card border border-purple/10 z-30 af-cta-float-rev">
                        <div class="flex items-center gap-2">
                            <div class="size-7 rounded-full bg-[#EDE8FF] flex items-center justify-center">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="#794AFF" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                            <div>
                                <p class="text-[9px] text-paragraph leading-none">Now Playing</p>
                                <p class="text-xs font-bold text-main-black">Brand Film</p>
                            </div>
                        </div>
                    </div>

                    {{-- floating views badge --}}
                    <div class="absolute xl:-left-6 left-0 bottom-14 bg-purple text-white rounded-2xl px-4 py-2.5 shadow-purple z-30 af-cta-float">
                        <p class="text-[9px] opacity-80">Views</p>
                        <p class="text-sm font-bold">50M+</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
