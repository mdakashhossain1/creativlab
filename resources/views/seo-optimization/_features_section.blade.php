<section class="w-full md:py-[100px] py-16 bg-white overflow-hidden">
    <div class="theme-container mx-auto">
        <div class="grid xl:grid-cols-2 grid-cols-1 gap-12 xl:gap-16 items-center">

            {{-- LEFT: seo-solutions image --}}
            <div class="relative flex justify-center items-center" data-aos="fade-right">
                <img src="{{ asset('frontend/assets/images/seo-optimization/seo-solutions.webp') }}"
                     alt="SEO Solutions"
                     class="w-full h-auto object-contain"
                     style="border-radius: 32px;">
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
                        <div class="size-6 rounded-full bg-purple flex-shrink-0 flex items-center justify-center">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 6L9 17L4 12" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <p class="font-semibold text-main-black text-sm">{{ $f }}</p>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('contact-us') }}"
                   class="inline-flex items-center gap-2.5 bg-purple text-white font-bold text-sm uppercase tracking-wider px-8 py-4 rounded-full hover:bg-main-black transition-all duration-300">
                    Get Free SEO Audit
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</section>
