<style>
    @keyframes wdFloatA { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    @keyframes wdFloatB { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }
    .wd-float-a { animation: wdFloatA 4.5s ease-in-out infinite; }
    .wd-float-b { animation: wdFloatB 5.5s ease-in-out infinite reverse; }

    .wd-cta-img { width: 580px; height: 580px; }

    @media (max-width: 1024px) {
        .wd-cta-img { width: 460px; height: 460px; }
    }
    @media (max-width: 767px) {
        .wd-cta-img-wrap { width: 100%; }
        .wd-cta-img { width: 100%; height: auto; max-width: 420px; }
        .wd-cta-card { display: none !important; }
    }
    @media (max-width: 480px) {
        .wd-cta-img { max-width: 300px; }
    }
</style>

<section class="w-full md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="relative w-full rounded-[24px] overflow-hidden" style="background: linear-gradient(120deg, #EDE8FF 0%, #F4F1FF 50%, #E4DCFF 100%);">

            {{-- decorative circles --}}
            <div class="absolute -top-10 -left-10 size-48 rounded-full bg-purple/10 pointer-events-none"></div>
            <div class="absolute -bottom-8 left-1/3 size-32 rounded-full bg-purple/8 pointer-events-none"></div>
            <div class="absolute top-4 right-1/4 size-16 rounded-full bg-[#BA4AFF]/10 pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between px-8 md:px-16 xl:px-20 py-14 md:py-0 md:min-h-[380px]">

                {{-- Left: text --}}
                <div class="md:max-w-[480px] w-full md:py-16 text-center md:text-left" data-aos="fade-right">
                    <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-4 block">GET STARTED TODAY</span>
                    <h2 class="xl:text-[48px] md:text-[38px] text-[28px] font-bold text-main-black leading-tight mb-4">
                        Ready to Build<br>Your <span class="text-purple">Online Presence?</span>
                    </h2>
                    <p class="text-paragraph text-base leading-7 mb-8">
                        Let's create a website that represents your brand and helps your business grow digitally.
                    </p>
                    <div class="flex flex-wrap gap-4 md:justify-start justify-center">
                        <a href="{{ route('contact-us') }}"
                           class="inline-flex items-center gap-2.5 bg-purple text-white font-bold text-sm uppercase tracking-wider px-8 py-4 rounded-full hover:bg-main-black transition-all duration-300 shadow-purple">
                            Build Your Website
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

                {{-- Right: bottom image --}}
                <div class="wd-cta-img-wrap relative md:self-center self-center mt-8 md:mt-0 flex-shrink-0 flex items-center justify-center" data-aos="fade-left">
                    <img src="{{ asset('frontend/assets/images/web-delopmnet/bottom-image.webp') }}"
                         alt="Web Development"
                         class="wd-cta-img"
                         style="object-fit:contain; object-position:center; display:block;">

                    {{-- Internet / Globe card (top-left) --}}
                    <div class="wd-cta-card wd-float-b absolute left-0 top-16 z-20 bg-white rounded-2xl px-4 py-3 flex items-center gap-3"
                         style="box-shadow:0 8px 28px rgba(121,74,255,0.18); border:1px solid rgba(121,74,255,0.12);">
                        <span class="size-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#EDE8FF;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#794AFF" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>
                            </svg>
                        </span>
                        <div>
                            <p style="font-size:9px; color:#6B7280; margin:0; line-height:1.2;">Web Presence</p>
                            <p style="font-size:12px; font-weight:700; color:#111827; margin:0; white-space:nowrap;">Live & Online</p>
                        </div>
                    </div>

                    {{-- Code card (bottom-right) --}}
                    <div class="wd-cta-card wd-float-a absolute right-0 bottom-20 z-20 bg-white rounded-2xl px-4 py-3 flex items-center gap-3"
                         style="box-shadow:0 8px 28px rgba(121,74,255,0.18); border:1px solid rgba(121,74,255,0.12);">
                        <span class="size-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#EDE8FF;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#794AFF" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="16 18 22 12 16 6"/>
                                <polyline points="8 6 2 12 8 18"/>
                            </svg>
                        </span>
                        <div>
                            <p style="font-size:9px; color:#6B7280; margin:0; line-height:1.2;">Clean Code</p>
                            <p style="font-size:12px; font-weight:700; color:#111827; margin:0; white-space:nowrap;">Built to Scale</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
