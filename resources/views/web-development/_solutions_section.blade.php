<section class="w-full bg-[#FAFAFA] md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-12 md:mb-16" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">WHAT WE OFFER</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                Complete <span class="text-purple">Web Development</span> Solutions
            </h2>
        </div>

        <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6">
            @php
                $solutions = [
                    [
                        'bg' => 'bg-[#EDE8FF]', 'color' => '#794AFF',
                        'icon' => '<rect x="2" y="3" width="20" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M8 21h8M12 17v4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>',
                        'title' => 'Business Websites',
                        'desc'  => 'Professional websites that build credibility and bring more customers.',
                    ],
                    [
                        'bg' => 'bg-[#FFF0E8]', 'color' => '#FF7E40',
                        'icon' => '<circle cx="9" cy="21" r="1" stroke="currentColor" stroke-width="1.6"/><circle cx="20" cy="21" r="1" stroke="currentColor" stroke-width="1.6"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'E-Commerce Stores',
                        'desc'  => 'Powerful online stores designed to sell more and grow your brand.',
                    ],
                    [
                        'bg' => 'bg-[#E8F4FF]', 'color' => '#3B82F6',
                        'icon' => '<path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><rect x="3" y="3" width="18" height="18" rx="3" stroke="currentColor" stroke-width="1.6"/>',
                        'title' => 'Landing Pages',
                        'desc'  => 'High-converting landing pages that generate leads and boost campaigns.',
                    ],
                    [
                        'bg' => 'bg-[#FFF5E8]', 'color' => '#F59E0B',
                        'icon' => '<rect x="3" y="3" width="18" height="18" rx="3" stroke="currentColor" stroke-width="1.6"/><circle cx="8.5" cy="8.5" r="1.5" stroke="currentColor" stroke-width="1.6"/><path d="M21 15l-5-5L5 21" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Portfolio Websites',
                        'desc'  => 'Creative portfolio websites to showcase work and attract opportunities.',
                    ],
                    [
                        'bg' => 'bg-[#E8FFE8]', 'color' => '#22C55E',
                        'icon' => '<path d="M16 18l6-6-6-6M8 6l-6 6 6 6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Custom Web Apps',
                        'desc'  => 'Custom-built web applications tailored to your business needs.',
                    ],
                    [
                        'bg' => 'bg-[#F5E8FF]', 'color' => '#BA4AFF',
                        'icon' => '<path d="M23 4v6h-6M1 20v-6h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M3.51 9a9 9 0 0114.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0020.49 15" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Website Redesign',
                        'desc'  => 'Modern redesigns that improve performance, design and conversions.',
                    ],
                    [
                        'bg' => 'bg-[#E8F8FF]', 'color' => '#06B6D4',
                        'icon' => '<path d="M4 7V4h16v3M9 20h6M12 4v16" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'CMS Development',
                        'desc'  => 'Custom CMS solutions for easy content management.',
                    ],
                    [
                        'bg' => 'bg-[#FFF0F5]', 'color' => '#F43F5E',
                        'icon' => '<path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Website Maintenance',
                        'desc'  => 'Regular updates, backups and support to keep your website running smoothly.',
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
