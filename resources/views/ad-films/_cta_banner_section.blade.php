<style>
    @keyframes afCtaFloat  { 0%,100%{transform:translateX(-50%) translateY(0)} 50%{transform:translateX(-50%) translateY(-10px)} }
    @keyframes afCtaFloatR { 0%,100%{transform:translateX(-50%) translateY(0)} 50%{transform:translateX(-50%) translateY(-8px)}  }
    .af-cta-float     { animation: afCtaFloat  4.5s ease-in-out infinite; }
    .af-cta-float-rev { animation: afCtaFloatR 5.5s ease-in-out infinite reverse; }

    .af-cta-img { width: 460px; height: 460px; }
    .af-cam-icon { width: 44px; height: 44px; }
    .af-cam-label { font-size: 12px; }

    @media (max-width: 1024px) {
        .af-cta-img { width: 360px; height: 360px; }
    }
    @media (max-width: 767px) {
        .af-cta-img-wrap { width: 100%; }
        .af-cta-img { width: 100%; height: auto; max-width: 380px; }
        .af-cam-card { padding: 8px 12px !important; gap: 8px !important; border-radius: 12px !important; }
        .af-cam-icon { width: 34px !important; height: 34px !important; }
        .af-cam-label { font-size: 11px !important; }
    }
    @media (max-width: 480px) {
        .af-cta-img { max-width: 280px; }
        .af-cam-card { padding: 6px 10px !important; gap: 6px !important; }
        .af-cam-icon { width: 28px !important; height: 28px !important; }
    }
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
                    <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-4 block">{{ getTranslatedValue($af_cta, 'section_label') ?: 'GET STARTED TODAY' }}</span>
                    <h2 class="xl:text-[44px] md:text-[36px] text-[26px] font-bold text-main-black leading-tight mb-4">
                        {!! getTranslatedValue($af_cta, 'heading') ?: 'Ready to Create an<br><span class="text-purple">Ad Film</span> That Drives Results?' !!}
                    </h2>
                    <p class="text-paragraph text-base leading-7 mb-8">
                        {{ getTranslatedValue($af_cta, 'description') ?: "Let's create a powerful story that connects with your audience and takes your brand to the next level." }}
                    </p>
                    <div class="flex flex-wrap gap-4 md:justify-start justify-center">
                        <a href="{{ getTranslatedValue($af_cta, 'button_1_url') ?: route('contact-us') }}"
                           class="inline-flex items-center gap-2.5 bg-purple text-white font-bold text-sm uppercase tracking-wider px-8 py-4 rounded-full hover:bg-main-black transition-all duration-300 shadow-purple">
                            {{ getTranslatedValue($af_cta, 'button_1_text') ?: 'Get Free Consultation' }}
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a href="{{ getTranslatedValue($af_cta, 'button_2_url') ?: route('services') }}"
                           class="inline-flex items-center gap-2 text-main-black font-semibold text-sm hover:text-purple transition-colors duration-300 px-2">
                            {{ getTranslatedValue($af_cta, 'button_2_text') ?: 'View Showreel' }}
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Right: footer image --}}
                <div class="af-cta-img-wrap relative md:self-end self-center mt-8 md:mt-0 flex-shrink-0 flex items-end justify-center" data-aos="fade-left">
                    <img src="{{ asset('frontend/assets/images/ad-film/bottom-footer.webp') }}"
                         alt="Ad Film"
                         class="af-cta-img"
                         style="object-fit:contain; object-position:bottom; display:block;">
                    {{-- floating video camera card — hovers above the image --}}
                    <div class="af-cta-float-rev af-cam-card" style="position:absolute; top:20px; left:50%; transform:translateX(-50%); z-index:20; display:inline-flex; align-items:center; gap:10px; background:rgba(255,255,255,0.95); border-radius:14px; padding:10px 16px; box-shadow:0 8px 28px rgba(121,74,255,0.18); border:1px solid rgba(121,74,255,0.12); white-space:nowrap;">
                        {{-- corner brackets --}}
                        <span style="position:absolute;top:5px;left:5px;width:10px;height:10px;border-top:2px solid #794AFF;border-left:2px solid #794AFF;border-radius:2px 0 0 0;"></span>
                        <span style="position:absolute;top:5px;right:5px;width:10px;height:10px;border-top:2px solid #794AFF;border-right:2px solid #794AFF;border-radius:0 2px 0 0;"></span>
                        <span style="position:absolute;bottom:5px;left:5px;width:10px;height:10px;border-bottom:2px solid #794AFF;border-left:2px solid #794AFF;border-radius:0 0 0 2px;"></span>
                        <span style="position:absolute;bottom:5px;right:5px;width:10px;height:10px;border-bottom:2px solid #794AFF;border-right:2px solid #794AFF;border-radius:0 0 2px 0;"></span>
                        <img src="{{ asset('frontend/assets/images/ad-film/video-camera.png') }}"
                             alt="Video Camera"
                             class="af-cam-icon"
                             style="object-fit:contain; display:block;">
                        <div>
                            <p style="font-size:9px; color:#6B7280; margin:0; line-height:1;">Now Filming</p>
                            <p class="af-cam-label" style="font-weight:700; color:#111827; margin:0;">4K Ad Film</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
