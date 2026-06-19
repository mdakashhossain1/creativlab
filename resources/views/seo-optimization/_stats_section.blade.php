<section class="w-full bg-[#F4F1FF] pb-[100px] md:-mt-4">
    <div class="theme-container mx-auto">
        <div class="relative w-full rounded-[20px] overflow-hidden md:py-8 py-6 px-6 md:px-10"
             style="background: linear-gradient(90deg, #794AFF 0%, #BA4AFF 50%, #794AFF 100%);">
            <div class="absolute -top-8 left-1/4 size-32 rounded-full bg-white/10 pointer-events-none"></div>
            <div class="absolute -bottom-6 right-1/4 size-24 rounded-full bg-white/8 pointer-events-none"></div>

            <div class="relative z-10 grid xl:grid-cols-4 md:grid-cols-2 grid-cols-2 gap-6 md:gap-0 md:divide-x divide-white/20">
                @php
                    $stats = [
                        ['icon'=>'<rect x="2" y="3" width="20" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M8 21h8M12 17v4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>','value'=>getTranslatedValue($seo_stats,'stat_1_value')?:'250+','label'=>getTranslatedValue($seo_stats,'stat_1_label')?:'Websites Optimized'],
                        ['icon'=>'<path d="M22 12h-4l-3 9L9 3l-3 9H2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>','value'=>getTranslatedValue($seo_stats,'stat_2_value')?:'1M+','label'=>getTranslatedValue($seo_stats,'stat_2_label')?:'Organic Traffic Generated'],
                        ['icon'=>'<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="1.6"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>','value'=>getTranslatedValue($seo_stats,'stat_3_value')?:'95%','label'=>getTranslatedValue($seo_stats,'stat_3_label')?:'Client Retention'],
                        ['icon'=>'<path d="M12 2L2 7l10 5 10-5-10-5z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>','value'=>getTranslatedValue($seo_stats,'stat_4_value')?:'#1','label'=>getTranslatedValue($seo_stats,'stat_4_label')?:'Rankings Achieved'],
                    ];
                @endphp

                @foreach($stats as $stat)
                <div class="flex items-center gap-3.5 md:justify-center md:px-6 group">
                    <div class="size-12 rounded-xl bg-white/15 flex items-center justify-center flex-shrink-0 group-hover:bg-white/25 transition-all duration-300">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-white">
                            {!! $stat['icon'] !!}
                        </svg>
                    </div>
                    <div>
                        <p class="xl:text-[28px] text-[22px] font-bold text-white leading-none">{!! $stat['value'] !!}</p>
                        <p class="text-white/75 text-sm font-medium mt-0.5">{!! $stat['label'] !!}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
