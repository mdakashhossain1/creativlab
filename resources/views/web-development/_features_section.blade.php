<section class="w-full md:py-[100px] py-16 bg-white overflow-hidden">
    <div class="theme-container mx-auto">
        <div class="grid xl:grid-cols-2 grid-cols-1 gap-12 xl:gap-16 items-center">

            <div class="relative flex justify-center items-center" data-aos="fade-right">
                @php $featImg = $wd_features?->data_values['images']['features_image'] ?? null; @endphp
                <img src="{{ $featImg ? asset($featImg) : asset('frontend/assets/images/web-delopmnet/web-developmnet.webp') }}"
                     alt="Web Solutions"
                     class="w-full h-auto object-cover"
                     style="border-radius: 32px;">
            </div>

            <div data-aos="fade-left">
                <span class="inline-flex items-center gap-2 text-purple text-xs font-bold uppercase tracking-[0.2em] bg-[#EDE8FF] px-4 py-2 rounded-full mb-5">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 18l6-6-6-6M8 6l-6 6 6 6" stroke="#794AFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    {{ getTranslatedValue($wd_features, 'badge_text') ?: 'Web Solutions' }}
                </span>

                <h2 class="xl:text-[48px] md:text-[38px] text-[28px] font-bold text-main-black leading-[1.1] mb-5">
                    {!! getTranslatedValue($wd_features, 'heading') ?: 'Building<br>Digital Experiences<br><span class="text-purple">That Convert</span>' !!}
                </h2>

                <p class="text-paragraph text-base leading-7 mb-8 xl:max-w-[460px]">
                    {{ getTranslatedValue($wd_features, 'description') ?: 'From business websites to custom platforms, we create digital experiences that combine modern design, smooth functionality, and user-focused performance.' }}
                </p>

                <ul class="space-y-4 mb-9">
                    @php
                        $featureItems = [
                            ['title' => getTranslatedValue($wd_features, 'feature_1_title') ?: 'Mobile-responsive layouts',  'desc' => getTranslatedValue($wd_features, 'feature_1_desc') ?: 'Pixel-perfect designs that look stunning on every screen size and device.'],
                            ['title' => getTranslatedValue($wd_features, 'feature_2_title') ?: 'SEO-optimised structure',    'desc' => getTranslatedValue($wd_features, 'feature_2_desc') ?: 'Clean, search-friendly code that helps your site rank higher on Google.'],
                            ['title' => getTranslatedValue($wd_features, 'feature_3_title') ?: 'Fast loading performance',  'desc' => getTranslatedValue($wd_features, 'feature_3_desc') ?: 'Optimised assets and caching for lightning-fast page load speeds.'],
                            ['title' => getTranslatedValue($wd_features, 'feature_4_title') ?: 'Modern UI/UX experience',   'desc' => getTranslatedValue($wd_features, 'feature_4_desc') ?: 'Intuitive interfaces that keep visitors engaged and convert them into customers.'],
                        ];
                    @endphp
                    @foreach($featureItems as $f)
                    <li class="flex items-start gap-4">
                        <div class="size-6 rounded-full bg-purple flex-shrink-0 flex items-center justify-center mt-0.5">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 6L9 17L4 12" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-main-black text-base leading-tight">{{ $f['title'] }}</p>
                            <p class="text-paragraph text-sm leading-6 mt-0.5">{{ $f['desc'] }}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <a href="{{ getTranslatedValue($wd_features, 'cta_link_url') ?: route('services') }}"
                   class="inline-flex items-center gap-2.5 text-purple font-bold text-base hover:gap-4 transition-all duration-300">
                    {{ getTranslatedValue($wd_features, 'cta_link_text') ?: 'Learn More' }}
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</section>
