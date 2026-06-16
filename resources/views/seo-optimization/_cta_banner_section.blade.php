<style>
    .seo-cta-img { width: 620px; height: auto; }

    @media (max-width: 1024px) {
        .seo-cta-img { width: 480px; height: auto; }
    }
    @media (max-width: 767px) {
        .seo-cta-img-wrap { width: 100%; justify-content: center; }
        .seo-cta-img { height: auto; width: 100%; max-width: 320px; }
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
                    <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-4 block">GET STARTED TODAY</span>
                    <h2 class="xl:text-[48px] md:text-[38px] text-[28px] font-bold text-main-black leading-tight mb-4">
                        Ready to Rank Higher &amp;<br><span class="text-purple">Grow Your Business?</span>
                    </h2>
                    <p class="text-paragraph text-base leading-7 mb-8">
                        Let's build an SEO strategy that brings more traffic, leads and long-term growth.
                    </p>
                    <div class="flex flex-wrap gap-4 md:justify-start justify-center">
                        <a href="{{ route('contact-us') }}"
                           class="inline-flex items-center gap-2.5 bg-purple text-white font-bold text-sm uppercase tracking-wider px-8 py-4 rounded-full hover:bg-main-black transition-all duration-300 shadow-purple">
                            Get Free SEO Audit
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
                <div class="seo-cta-img-wrap relative md:self-center self-center mt-8 md:mt-0 flex-shrink-0 flex items-center justify-center" data-aos="fade-left">
                    <img src="{{ asset('frontend/assets/images/seo-optimization/bottom.webp') }}"
                         alt="SEO Growth"
                         class="seo-cta-img"
                         style="object-fit:contain; object-position:center; display:block;">
                </div>
            </div>
        </div>
    </div>
</section>
