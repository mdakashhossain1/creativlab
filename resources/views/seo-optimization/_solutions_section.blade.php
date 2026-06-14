<section class="w-full bg-[#FAFAFA] md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-12 md:mb-16" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">WHAT WE OFFER</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                Complete <span class="text-purple">SEO Optimization</span> Solutions
            </h2>
        </div>

        <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6">
            @php
                $solutions = [
                    [
                        'bg' => 'bg-[#EDE8FF]', 'color' => '#794AFF',
                        'icon' => '<circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="1.6"/><path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>',
                        'title' => 'Keyword Research',
                        'desc'  => 'We find high-potential keywords that drive relevant traffic.',
                    ],
                    [
                        'bg' => 'bg-[#FFF0E8]', 'color' => '#FF7E40',
                        'icon' => '<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 2v6h6M9 13l2 2 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'On-Page SEO',
                        'desc'  => 'Optimize content, meta tags, headings & website structure.',
                    ],
                    [
                        'bg' => 'bg-[#E8F4FF]', 'color' => '#3B82F6',
                        'icon' => '<circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 11-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 110-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 114 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 110 4h-.09a1.65 1.65 0 00-1.51 1z" stroke="currentColor" stroke-width="1.6"/>',
                        'title' => 'Technical SEO',
                        'desc'  => 'Improve site speed, crawlability, indexing & overall performance.',
                    ],
                    [
                        'bg' => 'bg-[#FFF5E8]', 'color' => '#F59E0B',
                        'icon' => '<path d="M12 20h9M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Content Optimization',
                        'desc'  => 'Create SEO-friendly content that ranks and engages your audience.',
                    ],
                    [
                        'bg' => 'bg-[#E8FFE8]', 'color' => '#22C55E',
                        'icon' => '<path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Link Building',
                        'desc'  => 'Build high-quality backlinks to increase authority and ranking.',
                    ],
                    [
                        'bg' => 'bg-[#F5E8FF]', 'color' => '#BA4AFF',
                        'icon' => '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="1.6"/>',
                        'title' => 'Local SEO',
                        'desc'  => 'Optimise your presence to rank higher in local search results.',
                    ],
                    [
                        'bg' => 'bg-[#E8F8FF]', 'color' => '#06B6D4',
                        'icon' => '<path d="M9 11l3 3L22 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'SEO Audit',
                        'desc'  => 'Detailed website audit to find issues and growth opportunities.',
                    ],
                    [
                        'bg' => 'bg-[#FFF0F5]', 'color' => '#F43F5E',
                        'icon' => '<path d="M18 20V10M12 20V4M6 20v-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Analytics & Reporting',
                        'desc'  => 'Track performance and get monthly SEO reports with insights.',
                    ],
                ];
            @endphp

            @foreach($solutions as $s)
            <div class="group flex items-start gap-4 bg-white hover:bg-purple border border-purple/8 hover:border-purple rounded-2xl p-6 hover:shadow-purple transition-all duration-300 cursor-pointer"
                 data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 80 }}">
                <div class="size-12 rounded-xl {{ $s['bg'] }} group-hover:bg-white/20 flex items-center justify-center flex-shrink-0 transition-all duration-300">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color:{{ $s['color'] }}" class="group-hover:!text-white transition-colors duration-300">
                        {!! $s['icon'] !!}
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-main-black group-hover:text-white text-base mb-1.5 transition-colors duration-300">{{ $s['title'] }}</h3>
                    <p class="text-paragraph group-hover:text-white/80 text-sm leading-5 transition-colors duration-300">{{ $s['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
