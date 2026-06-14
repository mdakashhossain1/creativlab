<section class="w-full bg-purple md:py-20 py-14 relative overflow-hidden">
    {{-- decorative circles --}}
    <div class="absolute -top-20 -left-20 size-64 rounded-full bg-white/5 pointer-events-none"></div>
    <div class="absolute -bottom-16 -right-16 size-80 rounded-full bg-white/5 pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/3 size-48 rounded-full bg-white/5 pointer-events-none"></div>

    <div class="theme-container mx-auto relative z-10">
        <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-2 gap-8 md:gap-12">
            @php
                $stats = [
                    [
                        'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
                        'value' => '50+',
                        'label' => 'Brands Served',
                    ],
                    [
                        'icon' => '<path d="M15 10l4.553-2.069A1 1 0 0121 8.87v6.26a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
                        'value' => '500+',
                        'label' => 'Reels Created',
                    ],
                    [
                        'icon' => '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5"/>',
                        'value' => '1M+',
                        'label' => 'Reach Generated',
                    ],
                    [
                        'icon' => '<path d="M22 11.08V12a10 10 0 11-5.93-9.14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M22 4L12 14.01l-3-3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
                        'value' => '100%',
                        'label' => 'Client Satisfaction',
                    ],
                ];
            @endphp

            @foreach($stats as $stat)
            <div class="flex flex-col items-center text-center group" data-aos="fade-up">
                <div class="size-16 rounded-2xl bg-white/15 flex items-center justify-center mb-4 group-hover:bg-white/25 transition-all duration-300">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-white">
                        {!! $stat['icon'] !!}
                    </svg>
                </div>
                <h3 class="xl:text-[48px] md:text-[42px] text-[36px] font-bold text-white leading-none mb-2">{{ $stat['value'] }}</h3>
                <p class="text-white/80 text-base font-medium">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
