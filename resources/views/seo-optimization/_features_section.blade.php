<section class="w-full md:py-[100px] py-16 bg-white overflow-hidden">
    <div class="theme-container mx-auto">
        <div class="grid xl:grid-cols-2 grid-cols-1 gap-12 xl:gap-16 items-center">

            {{-- LEFT: Google ranking mockup --}}
            <div class="relative flex justify-center items-center" data-aos="fade-right">
                <div class="absolute size-80 rounded-full bg-purple/10 blur-3xl pointer-events-none"></div>

                {{-- browser card --}}
                <div class="relative z-10 bg-white rounded-2xl shadow-common border border-purple/8 xl:w-[400px] w-[300px] overflow-hidden">
                    {{-- browser bar --}}
                    <div class="flex items-center gap-2 px-4 py-3 bg-[#F4F1FF] border-b border-purple/8">
                        <span class="size-2.5 rounded-full bg-red-400"></span>
                        <span class="size-2.5 rounded-full bg-yellow-400"></span>
                        <span class="size-2.5 rounded-full bg-green-400"></span>
                        <div class="ml-2 flex-1 bg-white rounded-full px-3 py-1 text-[9px] text-paragraph">https://yourwebsite.com</div>
                    </div>
                    <div class="p-5">
                        {{-- google search bar --}}
                        <div class="flex items-center gap-2 border border-purple/15 rounded-full px-4 py-2.5 mb-4">
                            <span class="font-bold text-base"><span class="text-[#4285F4]">G</span><span class="text-[#EA4335]">o</span><span class="text-[#FBBC05]">o</span><span class="text-[#4285F4]">g</span><span class="text-[#34A853]">l</span><span class="text-[#EA4335]">e</span></span>
                            <span class="text-paragraph text-xs flex-1">seo services</span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="11" cy="11" r="8" stroke="#794AFF" stroke-width="2"/><path d="M21 21l-4.35-4.35" stroke="#794AFF" stroke-width="2" stroke-linecap="round"/></svg>
                        </div>
                        {{-- #1 rank result --}}
                        <div class="bg-[#EDE8FF] rounded-xl p-3.5 mb-3 relative">
                            <span class="absolute -top-2 -right-2 bg-purple text-white text-[10px] font-bold px-2.5 py-1 rounded-full">#1 Rank</span>
                            <p class="text-purple font-bold text-sm mb-1">Your Website</p>
                            <p class="text-paragraph text-[10px] mb-1.5">https://yourwebsite.com</p>
                            <div class="h-1.5 bg-purple/20 rounded-full w-full mb-1"></div>
                            <div class="h-1.5 bg-purple/20 rounded-full w-3/4"></div>
                        </div>
                        {{-- ranking growth chart --}}
                        <div class="bg-[#FAFAFA] rounded-xl p-3">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-paragraph text-[10px] font-semibold">Organic Traffic</span>
                                <div class="flex items-center gap-1.5">
                                    <span class="text-main-black font-bold text-sm">12,540</span>
                                    <span class="text-green-500 text-[10px] font-bold">+65.8%</span>
                                </div>
                            </div>
                            <svg class="w-full" height="40" viewBox="0 0 240 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 36 C30 36 40 26 60 24 C85 22 95 18 120 16 C145 14 155 9 185 7 C210 5 222 4 240 2" stroke="#22C55E" stroke-width="2" fill="none" stroke-linecap="round"/>
                                <path d="M0 36 C30 36 40 26 60 24 C85 22 95 18 120 16 C145 14 155 9 185 7 C210 5 222 4 240 2 L240 40 L0 40Z" fill="#22C55E" opacity="0.1"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- floating badge: #1 Google Ranking --}}
                <div class="absolute xl:-right-6 right-0 bottom-10 bg-white rounded-2xl px-4 py-3 shadow-common border border-purple/10 z-20"
                     style="animation: seoFloat 4s ease-in-out infinite;">
                    <div class="flex items-center gap-2">
                        <div class="size-9 rounded-xl bg-[#EDE8FF] flex items-center justify-center">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" fill="#794AFF"/></svg>
                        </div>
                        <div>
                            <p class="text-[9px] text-paragraph leading-none">Achieved</p>
                            <p class="text-xs font-bold text-main-black">#1 Google Ranking</p>
                        </div>
                    </div>
                </div>

                {{-- floating badge: traffic --}}
                <div class="absolute xl:-left-4 left-0 top-12 bg-purple text-white rounded-2xl px-4 py-2.5 shadow-purple z-20"
                     style="animation: seoFloat 6s ease-in-out infinite reverse;">
                    <p class="text-[9px] opacity-80">Organic Growth</p>
                    <p class="text-sm font-bold">↑ 65.8%</p>
                </div>
            </div>

            {{-- RIGHT: text + checklist --}}
            <div data-aos="fade-left">
                <span class="inline-flex items-center gap-2 text-purple text-xs font-bold uppercase tracking-[0.2em] bg-[#EDE8FF] px-4 py-2 rounded-full mb-5">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="11" cy="11" r="8" stroke="#794AFF" stroke-width="2.2"/><path d="M21 21l-4.35-4.35" stroke="#794AFF" stroke-width="2.2" stroke-linecap="round"/></svg>
                    SEO Solutions
                </span>

                <h2 class="xl:text-[44px] md:text-[36px] text-[26px] font-bold text-main-black leading-[1.12] mb-5">
                    Boost Rankings.<br>
                    Increase Traffic.<br>
                    <span class="text-purple">Grow Your Business.</span>
                </h2>

                <p class="text-paragraph text-base leading-7 mb-8 xl:max-w-[460px]">
                    Our data-driven SEO strategies help your website rank higher, attract qualified visitors, and deliver the right audience consistently.
                </p>

                <div class="grid sm:grid-cols-2 gap-4 mb-9">
                    @php
                        $features = [
                            'Highest search rankings',
                            'Quality organic traffic',
                            'Better user experience',
                            'Long-term sustainable growth',
                        ];
                    @endphp
                    @foreach($features as $f)
                    <div class="flex items-center gap-3">
                        <div class="size-6 rounded-full bg-purple flex-shrink-0 flex items-center justify-center shadow-purple">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 6L9 17L4 12" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <p class="font-semibold text-main-black text-sm">{{ $f }}</p>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('contact-us') }}"
                   class="inline-flex items-center gap-2.5 bg-purple text-white font-bold text-sm uppercase tracking-wider px-8 py-4 rounded-full hover:bg-main-black transition-all duration-300 shadow-purple">
                    Get Free SEO Audit
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</section>
