<style>
    .hero-landing-bg { background: linear-gradient(135deg, #F4F1FF 0%, #EDE8FF 40%, #F8F6FF 100%); }
    .stat-card { background:#fff; border-radius:16px; box-shadow:0 8px 32px 0 rgba(121,74,255,.13); padding:14px 18px; }
    .btn-dark-pill { background:#101828; color:#fff; border-radius:50px; padding:16px 36px; font-weight:700; font-size:15px; letter-spacing:.06em; text-transform:uppercase; display:inline-flex; align-items:center; gap:10px; transition:background .3s; }
    .btn-dark-pill:hover { background:#794AFF; }
    @keyframes floatY { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    .float-anim      { animation: floatY 4s ease-in-out infinite; }
    .float-anim-slow { animation: floatY 6s ease-in-out infinite; }
    .float-anim-rev  { animation: floatY 5s ease-in-out infinite reverse; }
</style>

<section class="hero-landing-bg w-full xl:pt-[200px] pt-[110px] xl:pb-0 pb-16 overflow-hidden relative">
    <div class="theme-container mx-auto">
        <div class="grid xl:grid-cols-2 grid-cols-1 items-center xl:gap-0 gap-12">

            {{-- LEFT: text --}}
            <div class="xl:pb-24" data-aos="fade-right">
                <div class="inline-flex items-center gap-2 bg-white px-5 py-2.5 rounded-full shadow-sm mb-6 border border-purple/10">
                    <span class="size-2 rounded-full bg-purple inline-block animate-pulse"></span>
                    <span class="text-purple text-sm font-semibold">{{ getTranslatedValue($hero_content, 'subtitle') }}</span>
                </div>

                <h1 class="xl:text-[64px] md:text-[52px] text-[36px] font-bold text-main-black leading-[1.08] tracking-tight mb-6">
                    {!! strip_tags(clean(getTranslatedValue($hero_content, 'heading')), '<span>') !!}
                </h1>

                <p class="text-purple font-medium text-base leading-7 mb-9 xl:max-w-[430px]">
                    {{ getTranslatedValue($hero_content, 'description') }}
                </p>

                <div class="flex flex-wrap items-center gap-5">
                    <a href="{{ getTranslatedValue($hero_content,'left_button_url') }}" class="btn-dark-pill">
                        {{ getTranslatedValue($hero_content, 'left_button_text') }}
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="{{ getTranslatedValue($hero_content,'right_button_url') }}"
                       class="flex items-center gap-2 group text-main-black font-semibold hover:text-purple transition-colors duration-300">
                        <span class="border-b-2 border-main-black group-hover:border-purple pb-0.5 transition-colors duration-300">
                            {{ getTranslatedValue($hero_content,'right_button_text') }}
                        </span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- RIGHT: hero image + floating stat cards --}}
            <div class="relative flex justify-center xl:justify-end" data-aos="fade-left">
                <div class="absolute xl:right-0 right-1/2 xl:translate-x-0 translate-x-1/2 bottom-0 w-[480px] h-[480px] rounded-full bg-white/60 blur-sm"></div>

                <div class="relative z-10">
                    <img src="{{ asset(getImage($hero_content, 'hero_image')) }}"
                         alt="Digital Marketing"
                         class="xl:h-[580px] md:h-[420px] h-[300px] object-contain object-bottom drop-shadow-2xl" />
                </div>

                {{-- Stat Card 1: Performance Tracking / 1.26M --}}
                <div class="stat-card absolute xl:left-0 left-2 xl:top-16 top-4 z-20 float-anim min-w-[160px]">
                    <p class="text-xs text-paragraph font-medium mb-2">Performance Tracking</p>
                    <p class="text-xl font-bold text-main-black mb-1">1.26M</p>
                    <svg width="120" height="32" viewBox="0 0 120 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 28 C15 28 20 10 30 10 C40 10 45 22 55 18 C65 14 70 4 85 8 C100 12 108 6 120 2" stroke="#794AFF" stroke-width="2" fill="none" stroke-linecap="round"/>
                        <path d="M0 28 C15 28 20 10 30 10 C40 10 45 22 55 18 C65 14 70 4 85 8 C100 12 108 6 120 2 L120 32 L0 32Z" fill="url(#pg1)" opacity="0.15"/>
                        <defs><linearGradient id="pg1" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#794AFF"/><stop offset="100%" stop-color="#794AFF" stop-opacity="0"/></linearGradient></defs>
                    </svg>
                </div>

                {{-- Stat Card 2: 34.12% --}}
                <div class="stat-card absolute xl:-right-4 right-0 xl:top-12 top-4 z-20 float-anim-slow min-w-[140px]">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="size-2 rounded-full bg-green-400 inline-block"></span>
                        <p class="text-xs text-paragraph font-medium">Growth Rate</p>
                    </div>
                    <p class="text-xl font-bold text-main-black">34.12%</p>
                    <svg class="mt-1" width="100" height="28" viewBox="0 0 100 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 24 C12 24 18 14 28 10 C38 6 48 18 58 12 C68 6 78 2 100 4" stroke="#22C55E" stroke-width="2" fill="none" stroke-linecap="round"/>
                    </svg>
                </div>

                {{-- Stat Badge: 17.32% --}}
                <div class="absolute xl:-left-4 left-0 xl:top-1/2 top-[45%] z-20 float-anim-rev">
                    <div class="bg-purple text-white px-4 py-2.5 rounded-full shadow-purple">
                        <p class="text-sm font-bold">17.32 %</p>
                        <p class="text-[10px] opacity-80">Conversion</p>
                    </div>
                </div>

                {{-- Stat Card 3: 80k+ Revenue --}}
                <div class="stat-card absolute xl:-right-6 right-0 xl:bottom-20 bottom-8 z-20 float-anim min-w-[130px]">
                    <div class="flex items-center gap-1.5 mb-1">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="#F59E0B" stroke-width="2" fill="#F59E0B"/>
                        </svg>
                        <p class="text-xs text-paragraph font-medium">Revenue</p>
                    </div>
                    <p class="text-xl font-bold text-main-black">₹ 80k+</p>
                </div>

                {{-- CreativLab badge --}}
                <div class="absolute xl:left-4 left-4 xl:bottom-24 bottom-8 z-20 float-anim-slow">
                    <div class="flex items-center gap-2.5 bg-white rounded-2xl px-4 py-2.5 shadow-card border border-purple/10">
                        <div class="size-9 rounded-full bg-purple flex items-center justify-center text-white font-bold text-sm flex-shrink-0">C</div>
                        <div>
                            <p class="text-xs font-bold text-main-black leading-tight">CreativLab</p>
                            <p class="text-[10px] text-paragraph">Digital Agency</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
