<style>
    @keyframes wdFloat  { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    @keyframes wdFloatR { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)}  }
    .wd-float      { animation: wdFloat  4.5s ease-in-out infinite; }
    .wd-float-rev  { animation: wdFloatR 5.5s ease-in-out infinite reverse; }
    .wd-float-slow { animation: wdFloat  7s   ease-in-out infinite; }
    @keyframes popIn { 0%{opacity:0;transform:scale(0)} 70%{opacity:1;transform:scale(1.1)} 100%{opacity:1;transform:scale(1)} }
    .pop-card { animation: popIn 0.5s cubic-bezier(0.34,1.56,0.64,1) both; transform-origin: center; }
    .pop-d1{animation-delay:.1s} .pop-d2{animation-delay:.25s} .pop-d3{animation-delay:.4s}
    .pop-d4{animation-delay:.55s} .pop-d5{animation-delay:.7s} .pop-d6{animation-delay:.85s}

    .wd-hero-img { max-width: 115%; width: 115%; height: auto; display: block; }

    @media (max-width: 1279px) {
        .wd-hero-img { max-width: 100%; width: 100%; }
    }
</style>

<section id="home-one-hero">
<div class="hero-one-section-wrapper w-full xl:h-[905px] overflow-hidden relative">
    <div class="win-grid w-full h-full absolute left-0 top-0" id="win-grid"></div>

    <div class="theme-container mx-auto h-full relative z-10 pointer-events-none">
        <div class="w-full grid xl:grid-cols-2 grid-cols-1 gap-8 xl:gap-14 items-center xl:pt-[223px] pt-[130px] xl:pb-0 pb-10 h-full">

            {{-- LEFT: text --}}
            <div class="article-area pointer-events-auto xl:pb-24" data-aos="fade-right">
                <div class="inline-flex items-center gap-2.5 bg-white border border-purple/15 rounded-full px-5 py-2.5 mb-6 shadow-sm">
                    <span class="flex size-2 relative">
                        <span class="animate-ping absolute inline-flex size-2 rounded-full bg-purple opacity-75"></span>
                        <span class="relative inline-flex size-2 rounded-full bg-purple"></span>
                    </span>
                    <span class="text-purple text-sm font-semibold tracking-wide">{{ getTranslatedValue($wd_hero, 'badge_text') ?: 'Web Development Agency' }}</span>
                </div>

                <h1 class="text-4xl md:text-65 text-main-black mb-[35px] pointer-events-auto custom-heading md:text-left" style="font-weight: 400 !important;">
                    {!! getTranslatedValue($wd_hero, 'heading') ?: 'We Build <span>Modern</span> Websites That Drive Results' !!}
                </h1>

                <div class="px-6 py-[14px] bg-white border-l-2 border-blue-sass mb-[35px] xl:w-full md:w-[500px]">
                    <p class="text-ptwo text-paragraph">
                        {{ getTranslatedValue($wd_hero, 'description') ?: 'We design and develop high-performance websites that are fast, responsive, visually engaging, and built to grow your business online.' }}
                    </p>
                </div>

                <div class="flex space-x-[30px] items-center pointer-events-auto">
                    <a href="{{ getTranslatedValue($wd_hero, 'cta_button_1_url') ?: route('contact-us') }}">
                        <div class="home-two-btn-bg py-3 group bg-purple border-purple">
                            <span class="text-base text-white group-hover:text-purple transition-all duration-300 font-semibold font-inter relative z-10">
                                {{ getTranslatedValue($wd_hero, 'cta_button_1') ?: 'Start Your Project' }}
                            </span>
                            <span>{{ get_svg('home_cta_white') }}</span>
                        </div>
                    </a>
                    <a href="{{ getTranslatedValue($wd_hero, 'cta_button_2_url') ?: route('services') }}">
                        <div class="flex items-center gap-2 group">
                            <p class="mb-[1px] font-medium text-main-black leading-5 font-inter border-b border-main-black relative">
                                {{ getTranslatedValue($wd_hero, 'cta_button_2') ?: 'View Portfolio' }}
                            </p>
                            <span>{{ get_svg('arrow2') }}</span>
                        </div>
                    </a>
                </div>
            </div>

            {{-- RIGHT: hero image with floating pills --}}
            <div class="image-area relative h-full pointer-events-auto">
                <div class="xl:absolute relative 2xl:w-[752px] lg:w-[600px] w-full left-0 top-0 h-full">

                    @php
                        $pillDefaults = ['UI/UX Design','Responsive Design','E-Commerce','Custom Website','SEO Friendly','Fast Performance'];
                        $pillColors   = ['bg-white text-main-black border border-purple/10','bg-[#EC4899] text-white','bg-[#3B82F6] text-white','bg-orange text-white','bg-purple text-white','bg-[#F43F5E] text-white'];
                    @endphp

                    <div class="absolute xl:left-0 left-0 xl:top-8 top-2 z-30 wd-float-rev md:flex hidden">
                        <div class="flex items-center gap-2 {{ $pillColors[0] }} rounded-full rounded-br-none pl-2 pr-4 py-2 shadow-common pop-card pop-d1">
                            <div class="size-7 rounded-full bg-[#EDE8FF] flex items-center justify-center">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 19l7-7 3 3-7 7-3-3z" stroke="#794AFF" stroke-width="1.8"/><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z" stroke="#794AFF" stroke-width="1.8"/></svg>
                            </div>
                            <span class="text-xs font-bold">{{ getTranslatedValue($wd_hero, 'pill_1') ?: $pillDefaults[0] }}</span>
                        </div>
                    </div>

                    <div class="absolute xl:-left-8 left-2 xl:top-[38%] top-[35%] z-30 wd-float md:flex hidden">
                        <div class="flex items-center gap-2 bg-[#EC4899] rounded-full rounded-br-none pl-2 pr-4 py-2 shadow-common pop-card pop-d2">
                            <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2" y="4" width="13" height="11" rx="1.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><rect x="11" y="9" width="6" height="10" rx="1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M6 15h4" stroke="white" stroke-width="1.5" stroke-linecap="round"/></svg>
                            </div>
                            <span class="text-xs font-bold text-white">{{ getTranslatedValue($wd_hero, 'pill_2') ?: $pillDefaults[1] }}</span>
                        </div>
                    </div>

                    <div class="absolute xl:-left-4 left-0 xl:top-[68%] top-[65%] z-30 wd-float-slow md:flex hidden">
                        <div class="flex items-center gap-2 bg-[#3B82F6] rounded-full rounded-br-none pl-2 pr-4 py-2 shadow-common pop-card pop-d3">
                            <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4H6z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M3 6h18M16 10a4 4 0 01-8 0" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                            <span class="text-xs font-bold text-white">{{ getTranslatedValue($wd_hero, 'pill_3') ?: $pillDefaults[2] }}</span>
                        </div>
                    </div>

                    <div class="absolute xl:-right-2 right-0 xl:top-1/3 top-1/4 z-30 wd-float md:flex hidden">
                        <div class="flex items-center gap-2 bg-orange rounded-full rounded-bl-none pl-2 pr-4 py-2 shadow-common pop-card pop-d4">
                            <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 18l6-6-6-6M8 6l-6 6 6 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                            <span class="text-xs font-bold text-white">{{ getTranslatedValue($wd_hero, 'pill_4') ?: $pillDefaults[3] }}</span>
                        </div>
                    </div>

                    <div class="absolute xl:-right-4 right-0 xl:bottom-1/3 bottom-1/4 z-30 wd-float-slow md:flex hidden">
                        <div class="flex items-center gap-2 bg-purple rounded-full rounded-bl-none pl-2 pr-4 py-2 shadow-purple pop-card pop-d5">
                            <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="11" cy="11" r="8" stroke="white" stroke-width="2"/><path d="M21 21l-4.35-4.35" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>
                            </div>
                            <span class="text-xs font-bold text-white">{{ getTranslatedValue($wd_hero, 'pill_5') ?: $pillDefaults[4] }}</span>
                        </div>
                    </div>

                    <div class="absolute xl:right-8 right-4 xl:bottom-10 bottom-4 z-30 wd-float-rev md:flex hidden">
                        <div class="flex items-center gap-2 bg-[#F43F5E] rounded-full rounded-bl-none pl-2 pr-4 py-2 shadow-common pop-card pop-d6">
                            <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" fill="white"/></svg>
                            </div>
                            <span class="text-xs font-bold text-white">{{ getTranslatedValue($wd_hero, 'pill_6') ?: $pillDefaults[5] }}</span>
                        </div>
                    </div>

                    <div class="xl:absolute relative left-0 bottom-0 w-full z-10">
                        <div class="flex justify-center">
                            <img src="{{ asset('frontend/assets/images/web-delopmnet/hero-section.webp') }}"
                                 alt="Web Development"
                                 class="wd-hero-img">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
</section>
