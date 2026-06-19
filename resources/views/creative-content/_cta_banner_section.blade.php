<section data-aos="fade-up" class="w-full md:pt-[100px] pt-16 pb-0">
    <div class="consultation-section-wrapper w-full relative overflow-hidden">
        <div class="theme-container mx-auto relative z-10">
            <div class="overflow-hidden w-full py-[80px] xl:pl-[110px] pl-10 border border-[#e7e3fa] rounded-[20px] bg-main-gray md:flex items-center relative">
                <div class="absolute bottom-0 left-0 pointer-events-none">
                    <span>{{ get_svg('bg_dot_shape') }}</span>
                </div>

                <div class="md:w-[432px] w-full">
                    <span class="section-title-top-tag mb-5">{{ getTranslatedValue($cc_cta, 'section_label') ?: 'Ready to Grow?' }}</span>
                    <h2 class="md:text-48 text-34 font-semibold text-main-black mb-[32px]">
                        {!! getTranslatedValue($cc_cta, 'heading') ?: 'Let\'s Create Content That <span class="text-purple">Converts</span>' !!}
                    </h2>
                    <p class="text-paragraph text-18 mb-[45px]">
                        {{ getTranslatedValue($cc_cta, 'description') ?: 'Partner with CreativLab and get content that builds your brand, grows your audience, and drives real results.' }}
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ getTranslatedValue($cc_cta, 'button_1_url') ?: route('contact-us') }}">
                            <div class="home-two-btn-bg py-3 group bg-purple border-purple inline-flex">
                                <span class="text-base text-white group-hover:text-purple transition-all duration-300 font-inter relative z-10">
                                    {{ getTranslatedValue($cc_cta, 'button_1_text') ?: 'Book a Free Call' }}
                                </span>
                                {{ get_svg('home_cta_white') }}
                            </div>
                        </a>
                        @if(getTranslatedValue($cc_cta, 'button_2_text'))
                        <a href="{{ getTranslatedValue($cc_cta, 'button_2_url') ?: route('services') }}"
                           class="inline-flex items-center gap-2 text-purple font-semibold text-base hover:gap-4 transition-all duration-300 py-3">
                            {{ getTranslatedValue($cc_cta, 'button_2_text') }}
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        @endif
                    </div>

                    {{-- stat cards --}}
                    @if(getTranslatedValue($cc_cta, 'card_1_label') || getTranslatedValue($cc_cta, 'card_2_label'))
                    <div class="flex gap-4 mt-8">
                        @if(getTranslatedValue($cc_cta, 'card_1_label'))
                        <div class="bg-white rounded-xl px-5 py-3 border border-purple/10 shadow-sm">
                            <p class="text-xl font-bold text-purple">{{ getTranslatedValue($cc_cta, 'card_1_value') }}</p>
                            <p class="text-xs text-paragraph font-medium mt-0.5">{{ getTranslatedValue($cc_cta, 'card_1_label') }}</p>
                        </div>
                        @endif
                        @if(getTranslatedValue($cc_cta, 'card_2_label'))
                        <div class="bg-white rounded-xl px-5 py-3 border border-purple/10 shadow-sm">
                            <p class="text-xl font-bold text-purple">{{ getTranslatedValue($cc_cta, 'card_2_value') }}</p>
                            <p class="text-xs text-paragraph font-medium mt-0.5">{{ getTranslatedValue($cc_cta, 'card_2_label') }}</p>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>

                <div class="flex-1">
                    <div class="flex justify-end w-full relative mt-10">
                        <div class="mr-10">
                            <span>{{ get_svg('consultation_shape') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
