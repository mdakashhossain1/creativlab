<section class="w-full bg-white md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-12 md:mb-16" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">WHAT WE CREATE</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                Complete <span class="text-purple">Creative</span> Content Solutions
            </h2>
        </div>

        <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6">
            @php
                $solutions = [
                    [
                        'bg'    => 'bg-[#EDE8FF]',
                        'color' => '#794AFF',
                        'icon'  => '<rect x="2" y="3" width="20" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M8 21h8M12 17v4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>',
                        'title' => 'Social Media Designs',
                        'desc'  => 'Eye-catching posts for every platform, beautifully.',
                    ],
                    [
                        'bg'    => 'bg-[#FFF0E8]',
                        'color' => '#FF7E40',
                        'icon'  => '<path d="M15 10l4.553-2.069A1 1 0 0121 8.87v6.26a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Reels Editing',
                        'desc'  => 'Engaging reels that trends and drive maximum reach.',
                    ],
                    [
                        'bg'    => 'bg-[#E8F4FF]',
                        'color' => '#3B82F6',
                        'icon'  => '<circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>',
                        'title' => 'Motion Graphics',
                        'desc'  => 'Stunning animations that bring your brand story to life.',
                    ],
                    [
                        'bg'    => 'bg-[#FFF5E8]',
                        'color' => '#F59E0B',
                        'icon'  => '<rect x="3" y="3" width="18" height="18" rx="3" stroke="currentColor" stroke-width="1.6"/><circle cx="8.5" cy="8.5" r="1.5" stroke="currentColor" stroke-width="1.6"/><path d="M21 15l-5-5L5 21" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Brand Posters',
                        'desc'  => 'Creative posters that communicate and convert.',
                    ],
                    [
                        'bg'    => 'bg-[#E8FFE8]',
                        'color' => '#22C55E',
                        'icon'  => '<path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" stroke="currentColor" stroke-width="1.6"/><path d="M3.27 6.96L12 12.01l8.73-5.05M12 22.08V12" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>',
                        'title' => 'Product Ads',
                        'desc'  => 'High-converting ads that highlight and boost product sales.',
                    ],
                    [
                        'bg'    => 'bg-[#F5E8FF]',
                        'color' => '#BA4AFF',
                        'icon'  => '<path d="M4 6h16M4 10h16M4 14h8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><rect x="13" y="12" width="8" height="8" rx="1" stroke="currentColor" stroke-width="1.6"/>',
                        'title' => 'Thumbnail Design',
                        'desc'  => 'Crisp thumbnails that attract clicks and boost views.',
                    ],
                    [
                        'bg'    => 'bg-[#E8F8FF]',
                        'color' => '#06B6D4',
                        'icon'  => '<path d="M12 20h9M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Commercial Editing',
                        'desc'  => 'Professional editing for ads, promos and brand films.',
                    ],
                    [
                        'bg'    => 'bg-[#FFF0F5]',
                        'color' => '#F43F5E',
                        'icon'  => '<path d="M22 11.08V12a10 10 0 11-5.93-9.14" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M22 4L12 14.01l-3-3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Creative Campaigns',
                        'desc'  => 'Unique campaign ideas that increase impact and engagement.',
                    ],
                ];
            @endphp

            @foreach($solutions as $s)
            <div class="group flex items-start gap-4 bg-[#FAFAFA] hover:bg-white border border-transparent hover:border-purple/10 rounded-2xl p-6 hover:shadow-common transition-all duration-300 cursor-pointer"
                 data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 80 }}">
                <div class="size-12 rounded-xl {{ $s['bg'] }} flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color:{{ $s['color'] }}">
                        {!! $s['icon'] !!}
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-main-black text-base mb-1.5 group-hover:text-purple transition-colors duration-300">{{ $s['title'] }}</h3>
                    <p class="text-paragraph text-sm leading-5">{{ $s['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
