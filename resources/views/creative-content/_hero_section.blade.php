<style>
@keyframes ccFloat  { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    @keyframes ccFloatR { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)}  }
    @keyframes ccPulseRing { 0%{transform:scale(1);opacity:.6} 100%{transform:scale(1.6);opacity:0} }
    .cc-float      { animation: ccFloat  4.5s ease-in-out infinite; }
    .cc-float-rev  { animation: ccFloatR 5.5s ease-in-out infinite reverse; }
    .cc-float-slow { animation: ccFloat  7s   ease-in-out infinite; }
    .cc-stat-badge {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 6px 24px rgba(121,74,255,0.15);
        padding: 12px 16px;
        border: 1px solid rgba(121,74,255,0.08);
    }
    @keyframes popIn { 0%{opacity:0;transform:scale(0)} 70%{opacity:1;transform:scale(1.1)} 100%{opacity:1;transform:scale(1)} }
    .pop-card { animation: popIn 0.5s cubic-bezier(0.34,1.56,0.64,1) both; transform-origin: center; }
    .pop-d1{animation-delay:.1s} .pop-d2{animation-delay:.25s} .pop-d3{animation-delay:.4s}
    .pop-d4{animation-delay:.55s} .pop-d5{animation-delay:.7s}
</style>

<section class="w-full xl:pt-[200px] pt-[110px] xl:pb-0 pb-16 overflow-hidden relative">
    <div class="win-grid w-full h-full absolute left-0 top-0" id="win-grid"></div>

    <div class="theme-container mx-auto relative z-10">
        <div class="grid xl:grid-cols-2 grid-cols-1 items-center xl:gap-16 gap-12">

            {{-- LEFT: text --}}
            <div class="xl:pb-24 relative z-10" data-aos="fade-right">
                {{-- badge --}}
                <div class="inline-flex items-center gap-2.5 bg-white border border-purple/15 rounded-full px-5 py-2.5 mb-6 shadow-sm">
                    <span class="flex size-2">
                        <span class="animate-ping absolute inline-flex size-2 rounded-full bg-purple opacity-75"></span>
                        <span class="relative inline-flex size-2 rounded-full bg-purple"></span>
                    </span>
                    <span class="text-purple text-sm font-semibold tracking-wide">Creative Content Studio</span>
                </div>

                <h1 class="text-4xl md:text-65 text-main-black mb-[35px] pointer-events-auto custom-heading md:text-left" style="font-weight: 400 !important;">
                    We Create <span>Creative</span> Content That Stands Out
                </h1>

                <div class="px-6 py-[14px] bg-white border-l-2 border-blue-sass mb-[35px] xl:w-full md:w-[500px]">
                    <p class="text-ptwo text-paragraph">
                        We help startups, local businesses, and brands build a strong online presence. High-quality reels, graphics, motion visuals, and brand content crafted to capture attention and build engagement.
                    </p>
                </div>

                <div class="flex space-x-[30px] items-center pointer-events-auto">
                    <a href="{{ route('contact-us') }}">
                        <div class="home-two-btn-bg py-3 group bg-purple border-purple">
                            <span class="text-base text-white group-hover:text-purple transition-all duration-300 font-semibold font-inter relative z-10">
                                Book Your Meeting
                            </span>
                            <span>{{ get_svg('home_cta_white') }}</span>
                        </div>
                    </a>
                    <a href="{{ route('services') }}">
                        <div class="flex items-center gap-2 group">
                            <p class="mb-[1px] font-medium text-main-black leading-5 font-inter border-b border-main-black before:block before:pb-[1px] before:border-purple before:font-medium before:text-purple before:leading-5 before:font-inter before:border-b before:content-['View_Our_Work'] before:absolute before:-bottom-[1px] before:transition-all before:duration-300 before:w-0 hover:before:w-full before:overflow-hidden before:h-[21px] relative">
                                View Our Work
                            </p>
                            <span>{{ get_svg('arrow2') }}</span>
                        </div>
                    </a>
                </div>

                {{-- trust strip --}}
                <div class="flex items-center gap-4 mt-10">
                    <div class="flex -space-x-2">
                        @foreach(['#794AFF','#BA4AFF','#FF7E5F','#22C55E'] as $c)
                        <div class="size-9 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold" style="background:{{ $c }}">C</div>
                        @endforeach
                    </div>
                    <div>
                        <p class="text-xs font-bold text-main-black">50+ Happy Brands</p>
                        <div class="flex gap-0.5 mt-0.5">
                            @for($i=0;$i<5;$i++)
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="#F59E0B" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            @endfor
                        </div>
                    </div>
                    <span class="text-xs text-paragraph font-medium pl-2 border-l border-gray-200">Trusted by growing brands across India</span>
                </div>
            </div>

            {{-- RIGHT: device mockup + floating badges --}}
            <div class="relative flex justify-center xl:justify-end items-center" data-aos="fade-left">
                {{-- laptop image --}}
                <div class="relative z-10 cc-float w-full xl:scale-110 xl:translate-x-4">
                    <img src="{{ asset('frontend/assets/images/creative-content/laptop-hero.png') }}"
                         alt="Creative Content Studio"
                         class="w-full h-auto object-contain" />
                </div>

                {{-- Floating badge: Views --}}
                <div class="absolute xl:-left-6 left-0 xl:top-12 top-4 z-20 cc-float-rev min-w-[148px]">
                <div class="cc-stat-badge pop-card pop-d1">
                    <div class="flex items-center gap-2 mb-1.5">
                        <div class="size-7 rounded-lg bg-[#EDE8FF] flex items-center justify-center">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 12C2 12 5.5 5 12 5C18.5 5 22 12 22 12C22 12 18.5 19 12 19C5.5 19 2 12 2 12Z" stroke="#794AFF" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="12" r="3" stroke="#794AFF" stroke-width="1.8"/></svg>
                        </div>
                        <p class="text-xs text-paragraph font-medium">Total Reach</p>
                    </div>
                    <p class="text-xl font-bold text-main-black">1.26M</p>
                    <svg width="110" height="28" viewBox="0 0 110 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 24 C14 24 18 10 28 8 C38 6 44 18 54 14 C64 10 70 3 88 6 C100 8 105 4 110 2" stroke="#794AFF" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                        <path d="M0 24 C14 24 18 10 28 8 C38 6 44 18 54 14 C64 10 70 3 88 6 C100 8 105 4 110 2 L110 28 L0 28Z" fill="#794AFF" opacity="0.08"/>
                    </svg>
                </div>
                </div>

                {{-- Floating badge: Growth --}}
                <div class="absolute xl:-right-4 right-0 xl:top-8 top-4 z-20 cc-float-slow min-w-[130px]">
                <div class="cc-stat-badge pop-card pop-d2">
                    <div class="flex items-center gap-1.5 mb-1">
                        <span class="size-2 rounded-full bg-green-400 inline-block"></span>
                        <p class="text-xs text-paragraph font-medium">Growth Rate</p>
                    </div>
                    <p class="text-xl font-bold text-main-black">+34.12%</p>
                    <svg class="mt-1" width="90" height="24" viewBox="0 0 90 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 20 C10 20 18 12 28 8 C38 4 48 16 58 10 C68 4 78 2 90 4" stroke="#22C55E" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                    </svg>
                </div>
                </div>

                {{-- Floating pill: Engagement --}}
                <div class="absolute left-1/2 -translate-x-1/2 xl:bottom-4 bottom-2 z-20 cc-float">
                    <div class="bg-purple text-white px-5 py-2.5 rounded-full shadow-purple flex items-center gap-2 pop-card pop-d3">
                        <p class="text-sm font-bold">84.2%</p>
                        <p class="text-[10px] opacity-80">Engagement Rate</p>
                    </div>
                </div>

                {{-- Floating card: subscribers --}}
                <div class="absolute xl:-right-6 right-0 xl:bottom-20 bottom-10 z-20 cc-float-rev min-w-[120px]">
                <div class="cc-stat-badge pop-card pop-d4">
                    <div class="flex items-center gap-1.5 mb-1">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 11c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 3-1.34 3-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" fill="#F59E0B"/></svg>
                        <p class="text-xs text-paragraph font-medium">Followers</p>
                    </div>
                    <p class="text-xl font-bold text-main-black">48.6k</p>
                </div>
                </div>

                {{-- CreativLab badge --}}
                <div class="absolute xl:left-4 left-4 xl:bottom-28 bottom-10 z-20 cc-float-slow">
                    <div class="flex items-center gap-2.5 bg-white rounded-2xl px-4 py-2.5 shadow-common border border-purple/10 pop-card pop-d5">
                        <div class="size-9 rounded-full bg-purple flex items-center justify-center flex-shrink-0 overflow-hidden">
                            <img src="{{ asset($general_setting?->favicon) }}" alt="CreativLab" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <p class="text-xs font-bold text-main-black leading-tight">CreativLab</p>
                            <p class="text-[10px] text-paragraph">Content Studio</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
