<section class="w-full md:py-[100px] py-16 bg-white overflow-hidden">
    <div class="theme-container mx-auto">
        <div class="grid xl:grid-cols-2 grid-cols-1 gap-12 xl:gap-16 items-center">

            {{-- LEFT: desktop + phone mockup --}}
            <div class="relative flex justify-center items-center" data-aos="fade-right">
                <div class="absolute size-80 rounded-full bg-purple/10 blur-3xl pointer-events-none"></div>

                {{-- desktop monitor --}}
                <div class="relative z-10 xl:w-[380px] w-[300px]">
                    <div style="background:#1a1432; border-radius:14px; padding:8px; box-shadow:0 40px 80px -10px rgba(121,74,255,.35), 0 0 0 1px rgba(121,74,255,.15);">
                        <div style="background:linear-gradient(135deg,#2d1b6b,#1a1432); border-radius:8px; overflow:hidden;" class="xl:h-[230px] h-[185px]">
                            <div class="flex items-center gap-1.5 px-3 py-2 bg-black/30">
                                <span class="size-2 rounded-full bg-red-400"></span>
                                <span class="size-2 rounded-full bg-yellow-400"></span>
                                <span class="size-2 rounded-full bg-green-400"></span>
                            </div>
                            <div class="p-4">
                                <p class="text-white font-bold text-sm mb-3">Building Digital Experiences That Grow Brands</p>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="bg-white/10 rounded-lg p-2.5">
                                        <div class="h-1.5 bg-purple/60 rounded-full mb-1.5 w-full"></div>
                                        <div class="h-1.5 bg-white/20 rounded-full mb-1.5 w-3/4"></div>
                                        <div class="h-1.5 bg-white/20 rounded-full w-1/2"></div>
                                    </div>
                                    <div class="bg-purple/30 rounded-lg p-2.5 flex items-center justify-center">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 18l6-6-6-6M8 6l-6 6 6 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- monitor stand --}}
                    <div class="h-4 w-16 bg-[#1a1432] mx-auto"></div>
                    <div class="h-1.5 w-28 bg-[#16122a] rounded-full mx-auto"></div>
                </div>

                {{-- phone overlapping --}}
                <div class="absolute xl:-right-2 right-0 bottom-0 z-20 xl:w-[100px] w-[78px]">
                    <div style="background:#1a1432; border-radius:16px; padding:5px; box-shadow:0 30px 60px -10px rgba(121,74,255,.4);">
                        <div class="w-7 h-1.5 bg-[#0e0b20] rounded-full mx-auto mb-1"></div>
                        <div style="background:linear-gradient(160deg,#2d1b6b,#1a1432); border-radius:12px; overflow:hidden; aspect-ratio:9/18;">
                            <div class="p-2 space-y-1.5">
                                <div class="bg-white/10 rounded-md h-10 flex items-center justify-center">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                                <div class="h-1 bg-white/20 rounded-full w-full"></div>
                                <div class="h-1 bg-white/20 rounded-full w-2/3"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- floating badge --}}
                <div class="absolute xl:-left-6 left-0 top-10 bg-white rounded-2xl px-4 py-3 shadow-common border border-purple/10 z-30"
                     style="animation: wdFloat 4s ease-in-out infinite;">
                    <div class="flex items-center gap-2">
                        <div class="size-8 rounded-xl bg-green-400/15 flex items-center justify-center">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 6L9 17L4 12" stroke="#22C55E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <p class="text-[9px] text-paragraph leading-none">Site Launched</p>
                            <p class="text-xs font-bold text-main-black">100% Live</p>
                        </div>
                    </div>
                </div>

                {{-- floating badge: performance --}}
                <div class="absolute xl:-left-4 left-0 bottom-12 bg-purple text-white rounded-2xl px-4 py-2.5 shadow-purple z-30"
                     style="animation: wdFloat 6s ease-in-out infinite reverse;">
                    <p class="text-[9px] opacity-80">Page Speed</p>
                    <p class="text-sm font-bold">98 / 100</p>
                </div>
            </div>

            {{-- RIGHT: text + checklist --}}
            <div data-aos="fade-left">
                <span class="inline-flex items-center gap-2 text-purple text-xs font-bold uppercase tracking-[0.2em] bg-[#EDE8FF] px-4 py-2 rounded-full mb-5">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 18l6-6-6-6M8 6l-6 6 6 6" stroke="#794AFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Web Solutions
                </span>

                <h2 class="xl:text-[48px] md:text-[38px] text-[28px] font-bold text-main-black leading-[1.1] mb-5">
                    Building<br>Digital Experiences<br>
                    <span class="text-purple">That Convert</span>
                </h2>

                <p class="text-paragraph text-base leading-7 mb-8 xl:max-w-[460px]">
                    From business websites to custom platforms, we create digital experiences that combine modern design, smooth functionality, and user-focused performance.
                </p>

                <ul class="space-y-4 mb-9">
                    @php
                        $features = [
                            ['title' => 'Mobile-responsive layouts',  'desc' => 'Pixel-perfect designs that look stunning on every screen size and device.'],
                            ['title' => 'SEO-optimised structure',    'desc' => 'Clean, search-friendly code that helps your site rank higher on Google.'],
                            ['title' => 'Fast loading performance',    'desc' => 'Optimised assets and caching for lightning-fast page load speeds.'],
                            ['title' => 'Modern UI/UX experience',     'desc' => 'Intuitive interfaces that keep visitors engaged and convert them into customers.'],
                        ];
                    @endphp
                    @foreach($features as $f)
                    <li class="flex items-start gap-4">
                        <div class="size-6 rounded-full bg-purple flex-shrink-0 flex items-center justify-center mt-0.5 shadow-purple">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 6L9 17L4 12" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
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
