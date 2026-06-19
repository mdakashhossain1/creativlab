<section class="w-full bg-[#F4F1FF] pb-[100px] md:-mt-4">
    <div class="theme-container mx-auto">
        <div class="relative w-full rounded-[20px] overflow-hidden md:py-8 py-6 px-6 md:px-10"
             style="background: linear-gradient(90deg, #794AFF 0%, #BA4AFF 50%, #794AFF 100%);">
            <div class="absolute -top-8 left-1/4 size-32 rounded-full bg-white/10 pointer-events-none"></div>
            <div class="absolute -bottom-6 right-1/4 size-24 rounded-full bg-white/8 pointer-events-none"></div>

            <div class="relative z-10 grid xl:grid-cols-4 md:grid-cols-2 grid-cols-2 gap-6 md:gap-0 md:divide-x divide-white/20">
                @php
                    $statIcons = [
                        '<rect x="2" y="3" width="20" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M8 21h8M12 17v4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>',
                        '<rect x="2" y="4" width="13" height="11" rx="1.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><rect x="11" y="9" width="6" height="10" rx="1" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>',
                        '<path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        '<circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="1.6"/><path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>',
                    ];
                    $defaultValues = ['50+', '100%', '98/100', '95%'];
                    $defaultLabels = ['Websites Delivered', 'Responsive Design', 'Performance Score', 'SEO Optimized'];
                @endphp

                @for($i = 1; $i <= 4; $i++)
                <div class="flex items-center gap-3.5 md:justify-center md:px-6 group">
                    <div class="size-12 rounded-xl bg-white/15 flex items-center justify-center flex-shrink-0 group-hover:bg-white/25 transition-all duration-300">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-white">
                            {!! $statIcons[$i - 1] !!}
                        </svg>
                    </div>
                    <div>
                        <p class="xl:text-[28px] text-[22px] font-bold text-white leading-none">
                            {{ getTranslatedValue($wd_stats, "stat_{$i}_value") ?: $defaultValues[$i - 1] }}
                        </p>
                        <p class="text-white/75 text-sm font-medium mt-0.5">
                            {{ getTranslatedValue($wd_stats, "stat_{$i}_label") ?: $defaultLabels[$i - 1] }}
                        </p>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</section>
