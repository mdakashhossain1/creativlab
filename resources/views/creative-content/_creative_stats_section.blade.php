<section class="w-full bg-white md:py-10 py-8">
    <div class="theme-container mx-auto">
        <div class="relative rounded-[20px] overflow-hidden md:py-8 py-6 px-6 md:px-10"
             style="background: linear-gradient(90deg, #794AFF 0%, #BA4AFF 50%, #794AFF 100%);">
            <div class="absolute -top-8 left-1/4 size-32 rounded-full bg-white/10 pointer-events-none"></div>
            <div class="absolute -bottom-6 right-1/4 size-24 rounded-full bg-white/8 pointer-events-none"></div>

            <div class="relative z-10 grid xl:grid-cols-4 md:grid-cols-2 grid-cols-2 gap-6 md:gap-0 md:divide-x divide-white/20">
            @php
                $statIcons = [
                    '<rect x="3" y="3" width="18" height="18" rx="3" stroke="currentColor" stroke-width="1.6"/><circle cx="8.5" cy="8.5" r="1.5" stroke="currentColor" stroke-width="1.6"/><path d="M21 15l-5-5L5 21" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                    '<path d="M15 10l4.553-2.069A1 1 0 0121 8.87v6.26a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                    '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="1.6"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>',
                    '<path d="M22 12h-4l-3 9L9 3l-3 9H2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                ];
                $defaultValues = ['500+', '200+', '50+', '10M+'];
                $defaultLabels = ['Creative Designs', 'Reels Edited', 'Brands Managed', 'Organic Reach'];
            @endphp

            @for($i = 1; $i <= 4; $i++)
            <div class="flex items-center gap-4 md:justify-center md:px-8 group">
                <div class="size-12 rounded-xl bg-white/15 flex items-center justify-center flex-shrink-0 group-hover:bg-white/25 transition-all duration-300">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-white">
                        {!! $statIcons[$i - 1] !!}
                    </svg>
                </div>
                <div>
                    <p class="xl:text-[28px] text-[22px] font-bold text-white leading-none">
                        {{ getTranslatedValue($cc_stats, "stat_{$i}_value") ?: $defaultValues[$i - 1] }}
                    </p>
                    <p class="text-white/75 text-sm font-medium mt-0.5">
                        {{ getTranslatedValue($cc_stats, "stat_{$i}_label") ?: $defaultLabels[$i - 1] }}
                    </p>
                </div>
            </div>
            @endfor
            </div>
        </div>
    </div>
</section>
