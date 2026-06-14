<section class="w-full bg-[#F4F1FF] md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-12 md:mb-16" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">WHAT WE DO</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center mb-4">
                Our Creative <span class="text-purple">Content Services</span>
            </h2>
            <p class="text-paragraph text-center xl:max-w-[540px] leading-7">
                From thumb-stopping reels to powerful brand visuals — we cover every creative format your brand needs to dominate online.
            </p>
        </div>

        <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6">
            @php
                $services = [
                    [
                        'icon' => '<path d="M15 10l4.553-2.069A1 1 0 0121 8.87v6.26a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Reels & Short Videos',
                        'desc'  => 'Engaging short-form videos crafted for Instagram, YouTube Shorts & Facebook — designed to go viral.',
                    ],
                    [
                        'icon' => '<rect x="3" y="3" width="18" height="18" rx="3" stroke="currentColor" stroke-width="1.5"/><path d="M9 9l6 6M15 9l-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>',
                        'title' => 'Graphic Design',
                        'desc'  => 'Eye-catching social media posts, banners, and creatives that reflect your brand identity.',
                    ],
                    [
                        'icon' => '<path d="M7 4v16M17 4v16M3 8h4m10 0h4M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Motion Graphics',
                        'desc'  => 'Animated visuals, logo reveals, and kinetic typography that bring your brand to life.',
                    ],
                    [
                        'icon' => '<path d="M12 2L2 7l10 5 10-5-10-5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Brand Identity',
                        'desc'  => 'Logo design, brand colour palettes, typography systems and complete style guides.',
                    ],
                    [
                        'icon' => '<circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z" stroke="currentColor" stroke-width="1.5"/>',
                        'title' => 'Content Strategy',
                        'desc'  => 'Monthly content calendars, topic ideation, and platform-specific posting strategies.',
                    ],
                    [
                        'icon' => '<path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Social Media Management',
                        'desc'  => 'End-to-end management of your social channels — creation, scheduling, engagement and reporting.',
                    ],
                    [
                        'icon' => '<path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><line x1="4" y1="22" x2="4" y2="15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>',
                        'title' => 'Campaign Creatives',
                        'desc'  => 'Ad creatives for Facebook, Instagram, and Google Ads — built to maximise click-through rates.',
                    ],
                    [
                        'icon' => '<path d="M14.5 10c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5z" stroke="currentColor" stroke-width="1.5"/><path d="M20.5 10H19V8.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z" stroke="currentColor" stroke-width="1.5"/><path d="M9.5 14c.83 0 1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5S8 21.33 8 20.5v-5c0-.83.67-1.5 1.5-1.5z" stroke="currentColor" stroke-width="1.5"/><path d="M3.5 14H5v1.5c0 .83-.67 1.5-1.5 1.5S2 16.33 2 15.5 2.67 14 3.5 14z" stroke="currentColor" stroke-width="1.5"/><path d="M14 14.5c0-.83.67-1.5 1.5-1.5h5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-5c-.83 0-1.5-.67-1.5-1.5z" stroke="currentColor" stroke-width="1.5"/><path d="M15 20.5v-2h-1.5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5z" stroke="currentColor" stroke-width="1.5"/><path d="M10 9.5C10 8.67 9.33 8 8.5 8h-5C2.67 8 2 8.67 2 9.5S2.67 11 3.5 11h5c.83 0 1.5-.67 1.5-1.5z" stroke="currentColor" stroke-width="1.5"/><path d="M9 3.5v2H7.5C6.67 5.5 6 4.83 6 4s.67-1.5 1.5-1.5S9 3 9 3.5z" stroke="currentColor" stroke-width="1.5"/>',
                        'title' => 'UI/UX Creatives',
                        'desc'  => 'Landing page mockups, app screens, and interactive prototypes to showcase your digital products.',
                    ],
                ];
            @endphp

            @foreach($services as $s)
            <div class="group bg-white rounded-2xl p-7 border border-purple/8 hover:bg-purple hover:shadow-purple transition-all duration-300 cursor-pointer"
                 data-aos="fade-up">
                <div class="size-14 rounded-xl bg-[#EDE8FF] group-hover:bg-white/20 flex items-center justify-center mb-5 transition-all duration-300">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                         class="text-purple group-hover:text-white transition-colors duration-300">
                        {!! $s['icon'] !!}
                    </svg>
                </div>
                <h3 class="font-bold text-main-black group-hover:text-white text-lg mb-2.5 transition-colors duration-300">{{ $s['title'] }}</h3>
                <p class="text-paragraph group-hover:text-white/80 text-sm leading-6 transition-colors duration-300">{{ $s['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
