<section class="w-full md:py-[100px] py-16 bg-white overflow-hidden">
    <div class="theme-container mx-auto">
        <div class="grid xl:grid-cols-2 grid-cols-1 gap-12 xl:gap-16 items-center">

            {{-- LEFT: phone mockup --}}
            <div class="relative flex justify-center items-center" data-aos="fade-right">
                {{-- glow behind --}}
                <div class="absolute size-80 rounded-full bg-purple/10 blur-3xl pointer-events-none"></div>

                {{-- phone frame --}}
                <div class="relative z-10">
                    <div class="relative mx-auto xl:w-[280px] w-[240px]"
                         style="background:#1a1432; border-radius:40px; padding:12px; box-shadow:0 40px 80px -10px rgba(121,74,255,0.4), 0 0 0 1px rgba(121,74,255,0.15);">
                        {{-- notch --}}
                        <div class="w-20 h-5 bg-[#0e0b20] rounded-full mx-auto mb-2"></div>
                        {{-- screen --}}
                        <div style="background:linear-gradient(160deg,#2d1b6b 0%,#1a1432 60%,#0e0b20 100%); border-radius:28px; overflow:hidden; aspect-ratio:9/16;">
                            <div class="p-4 space-y-3">
                                {{-- mock reel card --}}
                                <div class="bg-white/10 rounded-2xl p-3 border border-white/10">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="size-7 rounded-full bg-purple flex items-center justify-center text-white text-[9px] font-bold">CL</div>
                                        <div>
                                            <p class="text-white text-[9px] font-bold">CreativLab</p>
                                            <p class="text-white/50 text-[8px]">Brand Reel</p>
                                        </div>
                                    </div>
                                    <div class="bg-purple/30 rounded-xl h-24 flex items-center justify-center">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                    <div class="flex items-center justify-between mt-2">
                                        <div class="flex gap-2">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" stroke="#ff6b6b" stroke-width="1.5" fill="none"/></svg>
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke="white" stroke-width="1.5"/></svg>
                                        </div>
                                        <span class="text-[#BA4AFF] text-[9px] font-bold">2.4k views</span>
                                    </div>
                                </div>

                                {{-- mock graphic card --}}
                                <div class="bg-white/5 rounded-2xl p-3 border border-white/10">
                                    <p class="text-white/60 text-[8px] mb-1.5">Design Post — Instagram</p>
                                    <div class="bg-gradient-to-br from-purple/40 to-[#BA4AFF]/30 rounded-xl h-16 flex items-center justify-center">
                                        <span class="text-white text-[11px] font-bold">CreativLab™</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 mt-2">
                                        <div class="h-1 bg-purple rounded-full flex-1"></div>
                                        <span class="text-white/40 text-[7px]">Published</span>
                                    </div>
                                </div>

                                {{-- stats row --}}
                                <div class="grid grid-cols-3 gap-1.5">
                                    @foreach([['12.4k','Reach'],['840','Saves'],['94%','Rate']] as $s)
                                    <div class="bg-white/5 rounded-xl p-2 text-center">
                                        <p class="text-white font-bold text-[11px]">{{ $s[0] }}</p>
                                        <p class="text-white/50 text-[7px]">{{ $s[1] }}</p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- bottom home bar --}}
                        <div class="w-16 h-1 bg-white/20 rounded-full mx-auto mt-2"></div>
                    </div>
                </div>

                {{-- floating badge: content published --}}
                <div class="absolute xl:-right-8 right-0 top-12 bg-white rounded-2xl px-4 py-3 shadow-common border border-purple/10 z-20"
                     style="animation: ccFloat 4s ease-in-out infinite;">
                    <div class="flex items-center gap-2">
                        <div class="size-8 rounded-xl bg-green-400/15 flex items-center justify-center">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 6L9 17L4 12" stroke="#22C55E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <p class="text-[9px] text-paragraph leading-none">Content Live</p>
                            <p class="text-xs font-bold text-main-black">+12.4k Reach</p>
                        </div>
                    </div>
                </div>

                {{-- floating badge: brand approved --}}
                <div class="absolute xl:-left-6 left-0 bottom-16 bg-purple text-white rounded-2xl px-4 py-2.5 shadow-purple z-20"
                     style="animation: ccFloat 6s ease-in-out infinite reverse;">
                    <p class="text-[9px] opacity-80">Engagement</p>
                    <p class="text-sm font-bold">↑ 84.2%</p>
                </div>
            </div>

            {{-- RIGHT: feature list --}}
            <div data-aos="fade-left">
                <span class="inline-flex items-center gap-2 text-purple text-xs font-bold uppercase tracking-[0.2em] bg-[#EDE8FF] px-4 py-2 rounded-full mb-5">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="#794AFF"/></svg>
                    Creative Solutions
                </span>

                <h2 class="xl:text-[48px] md:text-[38px] text-[28px] font-bold text-main-black leading-[1.1] mb-5">
                    Turning Ideas Into<br>
                    <span class="text-purple">Visual Experiences</span>
                </h2>

                <p class="text-paragraph text-base leading-7 mb-8 xl:max-w-[460px]">
                    We don't just create content — we craft stories that resonate. From high-impact reels to scroll-stopping graphics, every piece is built to convert attention into action.
                </p>

                {{-- feature list --}}
                <ul class="space-y-4 mb-9">
                    @php
                        $features = [
                            ['title' => 'High-engagement content',       'desc' => 'Content designed to stop the scroll and spark interaction across every platform.'],
                            ['title' => 'Theme-focused creatives',       'desc' => 'Cohesive visual themes that match your brand voice and audience preferences.'],
                            ['title' => 'Platform-optimised designs',    'desc' => 'Formats and dimensions perfectly tailored for Instagram, Facebook, YouTube & more.'],
                            ['title' => 'Consistent brand identity',     'desc' => 'Every post, reel, and graphic stays true to your brand guidelines and colour palette.'],
                        ];
                    @endphp
                    @foreach($features as $f)
                    <li class="flex items-start gap-4">
                        <div class="size-6 rounded-full bg-purple flex-shrink-0 flex items-center justify-center mt-0.5 shadow-purple">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 6L9 17L4 12" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-main-black text-base leading-tight">{{ $f['title'] }}</p>
                            <p class="text-paragraph text-sm leading-6 mt-0.5">{{ $f['desc'] }}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <a href="{{ route('services') }}"
                   class="inline-flex items-center gap-2.5 text-purple font-bold text-base hover:gap-4 transition-all duration-300">
                    Learn More
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</section>
