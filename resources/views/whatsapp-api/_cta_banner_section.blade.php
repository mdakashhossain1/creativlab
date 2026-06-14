<style>
    @keyframes waCtaFloat  { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    .wa-cta-float     { animation: waCtaFloat 4.5s ease-in-out infinite; }
    .wa-cta-float-rev { animation: waCtaFloat 5.5s ease-in-out infinite reverse; }
</style>

<section class="w-full md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="relative w-full rounded-[24px] overflow-hidden" style="background: linear-gradient(120deg, #794AFF 0%, #8B5CF6 50%, #BA4AFF 100%);">

            {{-- decorative circles --}}
            <div class="absolute -top-10 -left-10 size-48 rounded-full bg-white/10 pointer-events-none"></div>
            <div class="absolute -bottom-8 right-1/4 size-32 rounded-full bg-white/8 pointer-events-none"></div>
            <div class="absolute top-6 left-1/2 size-20 rounded-full bg-[#25D366]/20 pointer-events-none"></div>

            <div class="relative z-10 grid xl:grid-cols-2 grid-cols-1 items-center gap-10 px-8 md:px-14 xl:px-16 py-12 md:py-14">

                {{-- Left: heading + WhatsApp logo --}}
                <div data-aos="fade-right">
                    <div class="flex items-start gap-5">
                        {{-- WhatsApp logo --}}
                        <div class="relative flex-shrink-0 wa-cta-float">
                            <div class="size-20 rounded-3xl bg-[#25D366] flex items-center justify-center shadow-2xl">
                                <svg width="42" height="42" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38c1.45.79 3.08 1.21 4.79 1.21 5.46 0 9.91-4.45 9.91-9.91C21.95 6.45 17.5 2 12.04 2zm5.8 14.04c-.24.68-1.42 1.31-1.97 1.36-.5.05-1.13.07-1.83-.11-.42-.13-.96-.31-1.65-.61-2.9-1.25-4.79-4.17-4.94-4.36-.14-.19-1.18-1.57-1.18-3 0-1.43.75-2.13 1.02-2.42.27-.29.58-.36.78-.36.19 0 .39 0 .56.01.18.01.42-.07.66.5.24.59.82 2.04.89 2.18.07.15.12.32.02.51-.09.19-.14.31-.27.48-.14.16-.29.36-.41.49-.14.14-.28.29-.12.57.16.27.71 1.17 1.52 1.9 1.05.93 1.93 1.22 2.2 1.36.27.14.43.12.59-.07.16-.19.68-.79.86-1.06.18-.27.36-.22.61-.13.25.09 1.58.75 1.85.88.27.14.45.21.51.32.07.11.07.62-.17 1.29z"/></svg>
                            </div>
                        </div>
                        <div>
                            <h2 class="xl:text-[40px] md:text-[34px] text-[26px] font-bold text-white leading-tight mb-3">
                                Ready to <span class="text-[#7DFFB0]">Automate</span><br>Customer Communication?
                            </h2>
                            <p class="text-white/80 text-base leading-7 mb-5 xl:max-w-[420px]">
                                Let us help you build a smart WhatsApp automation system that improves engagement, support &amp; sales.
                            </p>
                            <div class="flex flex-wrap gap-3">
                                <div class="inline-flex items-center gap-2 bg-white/15 rounded-full px-4 py-2">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 6l-9.5 9.5-5-5L1 18" stroke="#7DFFB0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M17 6h6v6" stroke="#7DFFB0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    <span class="text-white text-xs font-semibold">More Engagement</span>
                                </div>
                                <div class="inline-flex items-center gap-2 bg-white/15 rounded-full px-4 py-2">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 6l-9.5 9.5-5-5L1 18" stroke="#7DFFB0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M17 6h6v6" stroke="#7DFFB0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    <span class="text-white text-xs font-semibold">Higher Conversion</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: consultation card --}}
                <div data-aos="fade-left">
                    <div class="bg-white rounded-2xl p-7 md:p-8 shadow-2xl">
                        <h3 class="font-bold text-main-black text-xl mb-2">Book your free consultation</h3>
                        <p class="text-paragraph text-sm leading-6 mb-6">Let's discuss how we can help your business grow with WhatsApp.</p>
                        <a href="{{ route('contact-us') }}"
                           class="inline-flex items-center gap-2.5 bg-[#25D366] text-white font-bold text-sm uppercase tracking-wider px-7 py-4 rounded-full hover:bg-[#128C7E] transition-all duration-300 w-full justify-center"
                           style="box-shadow:0 8px 24px rgba(37,211,102,.3);">
                            Book Free Consultation
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
