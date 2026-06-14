<section class="w-full md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="relative w-full rounded-[24px] overflow-hidden" style="background: linear-gradient(120deg, #1a1432 0%, #2d1b6b 50%, #1a1432 100%);">

            {{-- decorative circles --}}
            <div class="absolute -top-10 -left-10 size-48 rounded-full bg-purple/20 pointer-events-none"></div>
            <div class="absolute -bottom-8 left-1/3 size-32 rounded-full bg-[#BA4AFF]/15 pointer-events-none"></div>
            <div class="absolute top-4 right-1/4 size-20 rounded-full bg-purple/10 pointer-events-none"></div>

            {{-- grid texture --}}
            <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: repeating-linear-gradient(0deg,rgba(255,255,255,1) 0,rgba(255,255,255,1) 1px,transparent 1px,transparent 50px),repeating-linear-gradient(90deg,rgba(255,255,255,1) 0,rgba(255,255,255,1) 1px,transparent 1px,transparent 50px);"></div>

            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between px-8 md:px-16 xl:px-20 py-14 md:py-0 md:min-h-[380px]">

                {{-- Left: text --}}
                <div class="md:max-w-[520px] w-full md:py-16 text-center md:text-left" data-aos="fade-right">
                    <span class="text-[#BA4AFF] text-xs font-bold uppercase tracking-[0.2em] mb-4 block">GET STARTED TODAY</span>
                    <h2 class="xl:text-[48px] md:text-[38px] text-[28px] font-bold text-white leading-tight mb-4">
                        Ready to Create <span class="text-[#BA4AFF]">Content That Converts?</span>
                    </h2>
                    <p class="text-white/70 text-base leading-7 mb-8">
                        Let's build a content strategy that puts your brand in front of the right audience and keeps them coming back for more.
                    </p>
                    <div class="flex flex-wrap gap-4 md:justify-start justify-center">
                        <a href="{{ route('contact-us') }}"
                           class="inline-flex items-center gap-2.5 bg-purple text-white font-bold text-sm uppercase tracking-wider px-8 py-4 rounded-full hover:bg-white hover:text-purple transition-all duration-300 shadow-purple">
                            Start Creating
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a href="{{ route('services') }}"
                           class="inline-flex items-center gap-2 text-white/80 font-semibold text-sm hover:text-white transition-colors duration-300 px-2">
                            View Services
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Right: creative visual --}}
                <div class="relative md:self-end self-center mt-8 md:mt-0 flex-shrink-0" data-aos="fade-left">
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-64 h-64 rounded-full bg-purple/30 blur-2xl pointer-events-none"></div>

                    {{-- stacked creative cards visual --}}
                    <div class="relative xl:w-[340px] md:w-[280px] w-[240px] xl:h-[320px] md:h-[260px] h-[220px]">
                        {{-- back card --}}
                        <div class="absolute xl:top-0 top-2 xl:right-0 right-2 xl:w-[200px] w-[160px] xl:h-[140px] h-[110px] bg-[#BA4AFF]/20 border border-[#BA4AFF]/30 backdrop-blur-sm rounded-2xl rotate-6 flex items-center justify-center">
                            <span class="text-white/60 text-xs font-bold">Campaign Draft</span>
                        </div>

                        {{-- mid card --}}
                        <div class="absolute xl:top-10 top-8 xl:right-6 right-4 xl:w-[200px] w-[160px] xl:h-[140px] h-[110px] bg-purple/30 border border-purple/40 backdrop-blur-sm rounded-2xl rotate-2 flex items-center justify-center">
                            <div class="text-center">
                                <p class="text-white/70 text-xs mb-1">Reel</p>
                                <p class="text-white font-bold text-sm">Summer Collection</p>
                            </div>
                        </div>

                        {{-- front card --}}
                        <div class="absolute xl:top-20 top-14 right-0 xl:w-[220px] w-[180px] xl:h-[180px] h-[145px] bg-white/10 border border-white/20 backdrop-blur-md rounded-2xl p-4 flex flex-col justify-between">
                            <div class="flex items-center gap-2">
                                <div class="size-7 rounded-full bg-purple flex items-center justify-center text-white text-[9px] font-bold">CL</div>
                                <div>
                                    <p class="text-white text-[9px] font-bold">Content Published</p>
                                    <p class="text-white/50 text-[8px]">Just now</p>
                                </div>
                                <div class="ml-auto size-2 rounded-full bg-green-400 animate-pulse"></div>
                            </div>
                            <div>
                                <div class="h-1 bg-white/10 rounded-full mb-1.5">
                                    <div class="h-full w-3/4 bg-purple rounded-full"></div>
                                </div>
                                <div class="flex justify-between text-[8px] text-white/50">
                                    <span>Engagement</span>
                                    <span class="text-green-400 font-bold">↑ 84.2%</span>
                                </div>
                            </div>
                            <div class="flex gap-1.5">
                                <div class="flex-1 bg-white/5 rounded-lg py-1.5 text-center">
                                    <p class="text-white text-[9px] font-bold">12.4k</p>
                                    <p class="text-white/40 text-[7px]">Reach</p>
                                </div>
                                <div class="flex-1 bg-white/5 rounded-lg py-1.5 text-center">
                                    <p class="text-white text-[9px] font-bold">840</p>
                                    <p class="text-white/40 text-[7px]">Saves</p>
                                </div>
                                <div class="flex-1 bg-purple/50 rounded-lg py-1.5 text-center">
                                    <p class="text-white text-[9px] font-bold">2.4k</p>
                                    <p class="text-white/70 text-[7px]">Views</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- floating badge --}}
                    <div class="absolute xl:-left-8 left-0 xl:top-1/3 top-1/4 bg-white rounded-2xl px-4 py-3 shadow-card border border-purple/10 z-20"
                         style="animation: ccFloat 4s ease-in-out infinite;">
                        <div class="flex items-center gap-2">
                            <div class="size-8 rounded-full bg-[#BA4AFF]/15 flex items-center justify-center">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="#BA4AFF"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[9px] text-paragraph leading-none">Client Rating</p>
                                <p class="text-xs font-bold text-main-black">5.0 / 5.0 ★</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
