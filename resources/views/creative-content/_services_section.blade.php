<section class="w-full bg-[#F4F1FF] md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-12 md:mb-16" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">{{ getTranslatedValue($cc_services, 'section_label') ?: 'WHAT WE DO' }}</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center mb-4">
                {!! getTranslatedValue($cc_services, 'section_title') ?: 'Our Creative <span class="text-purple">Content Services</span>' !!}
            </h2>
            <p class="text-paragraph text-center xl:max-w-[540px] leading-7">
                {{ getTranslatedValue($cc_services, 'section_desc') ?: 'From thumb-stopping reels to powerful brand visuals — we cover every creative format your brand needs to dominate online.' }}
            </p>
        </div>

        <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6">
            @php
                $serviceIcons = [
                    '<path d="M15 10l4.553-2.069A1 1 0 0121 8.87v6.26a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
                    '<rect x="3" y="3" width="18" height="18" rx="3" stroke="currentColor" stroke-width="1.5"/><path d="M9 9l6 6M15 9l-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>',
                    '<path d="M7 4v16M17 4v16M3 8h4m10 0h4M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
                    '<path d="M12 2L2 7l10 5 10-5-10-5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
                    '<circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z" stroke="currentColor" stroke-width="1.5"/>',
                    '<path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
                    '<path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><line x1="4" y1="22" x2="4" y2="15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>',
                    '<path d="M14.5 10c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5z" stroke="currentColor" stroke-width="1.5"/><path d="M20.5 10H19V8.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z" stroke="currentColor" stroke-width="1.5"/>',
                ];
                $defaultTitles = ['Reels & Short Videos','Graphic Design','Motion Graphics','Brand Identity','Content Strategy','Social Media Management','Campaign Creatives','UI/UX Creatives'];
                $defaultDescs  = [
                    'Engaging short-form videos crafted for Instagram, YouTube Shorts & Facebook — designed to go viral.',
                    'Eye-catching social media posts, banners, and creatives that reflect your brand identity.',
                    'Animated visuals, logo reveals, and kinetic typography that bring your brand to life.',
                    'Logo design, brand colour palettes, typography systems and complete style guides.',
                    'Monthly content calendars, topic ideation, and platform-specific posting strategies.',
                    'End-to-end management of your social channels — creation, scheduling, engagement and reporting.',
                    'Ad creatives for Facebook, Instagram, and Google Ads — built to maximise click-through rates.',
                    'Landing page mockups, app screens, and interactive prototypes to showcase your digital products.',
                ];
            @endphp

            @for($i = 1; $i <= 8; $i++)
            @php
                $idx   = $i - 1;
                $title = getTranslatedValue($cc_services, "service_{$i}_title") ?: $defaultTitles[$idx];
                $desc  = getTranslatedValue($cc_services, "service_{$i}_desc")  ?: $defaultDescs[$idx];
            @endphp
            <div class="group bg-white rounded-2xl p-7 border border-purple/8 hover:bg-purple hover:shadow-purple transition-all duration-300 cursor-pointer"
                 data-aos="fade-up">
                <div class="size-14 rounded-xl bg-[#EDE8FF] group-hover:bg-white/20 flex items-center justify-center mb-5 transition-all duration-300">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                         class="text-purple group-hover:text-white transition-colors duration-300">
                        {!! $serviceIcons[$idx] !!}
                    </svg>
                </div>
                <h3 class="font-bold text-main-black group-hover:text-white text-lg mb-2.5 transition-colors duration-300">{{ $title }}</h3>
                <p class="text-paragraph group-hover:text-white/80 text-sm leading-6 transition-colors duration-300">{{ $desc }}</p>
            </div>
            @endfor
        </div>
    </div>
</section>
