<style>
    @keyframes premFloat  { 0%,100%{transform:translateY(0)}  50%{transform:translateY(-10px)} }
    @keyframes premFloatR { 0%,100%{transform:translateY(0)}  50%{transform:translateY(-8px)}  }
    .prem-float      { animation: premFloat  4s ease-in-out infinite; }
    .prem-float-slow { animation: premFloat  6s ease-in-out infinite; }
    .prem-float-rev  { animation: premFloatR 5s ease-in-out infinite reverse; }
</style>

<section class="w-full bg-white md:py-[100px] py-16 overflow-hidden">
    <div class="theme-container mx-auto">
        <div class="grid xl:grid-cols-2 grid-cols-1 items-center gap-12 xl:gap-0">

            {{-- LEFT: text --}}
            <div data-aos="fade-right">
                <h2 class="xl:text-[54px] md:text-[44px] text-[32px] font-bold text-main-black leading-[1.1] mb-5">
                    Ready to Make<br>
                    Your Brand Look <span class="text-purple">Premium?</span>
                </h2>
                <p class="text-paragraph text-base leading-7 mb-9 xl:max-w-[460px]">
                    Let's create content that connects, converts and leaves a lasting impression on your audience. High-quality creatives, delivered consistently.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('contact-us') }}"
                       class="inline-flex items-center gap-2.5 bg-purple text-white font-bold text-sm uppercase tracking-wider px-8 py-4 rounded-full hover:bg-main-black transition-all duration-300 shadow-purple">
                        Get Started Now
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="{{ route('services') }}"
                       class="inline-flex items-center gap-2 border border-purple/20 text-purple font-semibold text-sm px-8 py-4 rounded-full hover:bg-purple hover:text-white transition-all duration-300">
                        View Services
                    </a>
                </div>
            </div>

            {{-- RIGHT: character with floating badges --}}
            <div class="relative flex justify-center xl:justify-end items-end" data-aos="fade-left">
                {{-- glow behind character --}}
                <div class="absolute bottom-0 left-1/2 -translate-x-1/2 xl:w-96 w-72 xl:h-96 h-72 rounded-full bg-purple/12 blur-3xl pointer-events-none"></div>

                {{-- 3D character placeholder (uses cta-person.png — same cool character) --}}
                <div class="relative z-10 prem-float">
                    <img src="{{ asset('frontend/assets/images/cta-person.png') }}"
                         alt="CreativLab Character"
                         class="xl:h-[420px] md:h-[350px] h-[270px] object-contain object-bottom drop-shadow-2xl" />
                </div>

                {{-- floating badge: heart / likes --}}
                <div class="absolute xl:left-4 left-0 xl:top-16 top-8 z-20 prem-float-rev">
                    <div class="flex items-center gap-2.5 bg-white rounded-2xl px-4 py-3 shadow-common border border-purple/10">
                        <div class="size-9 rounded-xl bg-rose-50 flex items-center justify-center flex-shrink-0">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" fill="#F43F5E" stroke="#F43F5E" stroke-width="0.5"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] text-paragraph leading-none mb-0.5">Content Loved</p>
                            <p class="text-sm font-bold text-main-black">+12.4k Likes</p>
                        </div>
                    </div>
                </div>

                {{-- floating badge: bar chart / performance --}}
                <div class="absolute xl:-right-4 right-0 xl:top-20 top-10 z-20 prem-float-slow">
                    <div class="bg-purple text-white rounded-2xl px-4 py-3 shadow-purple min-w-[130px]">
                        <div class="flex items-center gap-1.5 mb-1.5">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 20V10M12 20V4M6 20v-6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <p class="text-[10px] font-semibold opacity-80">Performance</p>
                        </div>
                        <p class="text-lg font-bold leading-none">↑ 84.2%</p>
                        <p class="text-[10px] opacity-70 mt-0.5">Engagement Rate</p>
                    </div>
                </div>

                {{-- floating badge: reel views --}}
                <div class="absolute xl:right-10 right-4 xl:bottom-28 bottom-16 z-20 prem-float-rev">
                    <div class="flex items-center gap-2.5 bg-white rounded-2xl px-4 py-3 shadow-common border border-purple/10">
                        <div class="size-9 rounded-xl bg-[#EDE8FF] flex items-center justify-center flex-shrink-0">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="#794AFF" stroke-width="1.8"/><circle cx="12" cy="12" r="3" stroke="#794AFF" stroke-width="1.8"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] text-paragraph leading-none mb-0.5">Reel Views</p>
                            <p class="text-sm font-bold text-main-black">2.4M Views</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
