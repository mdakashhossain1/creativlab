<section class="w-full bg-[#FAFAFA] md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-12 md:mb-16" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">WHAT WE OFFER</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                Complete <span class="text-purple">Ad Film Production</span> Solutions
            </h2>
        </div>

        <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6">
            @php
                $solutions = [
                    [
                        'bg' => 'bg-[#EDE8FF]', 'color' => '#794AFF',
                        'icon' => '<path d="M12 20h9M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Concept & Scripting',
                        'desc'  => 'Creative ideas and engaging scripts that bring your brand story to life.',
                    ],
                    [
                        'bg' => 'bg-[#FFF0E8]', 'color' => '#FF7E40',
                        'icon' => '<rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M16 2v4M8 2v4M3 10h18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>',
                        'title' => 'Pre-Production',
                        'desc'  => 'Planning, storyboarding, location and scheduling.',
                    ],
                    [
                        'bg' => 'bg-[#E8F4FF]', 'color' => '#3B82F6',
                        'icon' => '<rect x="2" y="2" width="20" height="20" rx="2.18" stroke="currentColor" stroke-width="1.6"/><path d="M7 2v20M17 2v20M2 12h20M2 7h5M2 17h5M17 17h5M17 7h5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>',
                        'title' => 'Production',
                        'desc'  => 'High-quality shooting with professional crew, camera and equipment.',
                    ],
                    [
                        'bg' => 'bg-[#FFF5E8]', 'color' => '#F59E0B',
                        'icon' => '<path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="13" r="4" stroke="currentColor" stroke-width="1.6"/>',
                        'title' => 'Product Shoots',
                        'desc'  => 'Cinematic product videos that highlight features and build desire.',
                    ],
                    [
                        'bg' => 'bg-[#E8FFE8]', 'color' => '#22C55E',
                        'icon' => '<path d="M15 10l4.553-2.069A1 1 0 0121 8.87v6.26a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Editing & Post-Production',
                        'desc'  => 'Smooth editing, color grading, VFX and sound design for impact.',
                    ],
                    [
                        'bg' => 'bg-[#F5E8FF]', 'color' => '#BA4AFF',
                        'icon' => '<path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z" stroke="currentColor" stroke-width="1.6"/><path d="M19 10v2a7 7 0 01-14 0v-2M12 19v4M8 23h8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Voice Over & Sound',
                        'desc'  => 'Professional voice overs and background score that elevate the story.',
                    ],
                    [
                        'bg' => 'bg-[#E8F8FF]', 'color' => '#06B6D4',
                        'icon' => '<path d="M4 19.5A2.5 2.5 0 016.5 17H20" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Brand Films',
                        'desc'  => 'Build brand identity and emotional connect through powerful visuals.',
                    ],
                    [
                        'bg' => 'bg-[#FFF0F5]', 'color' => '#F43F5E',
                        'icon' => '<rect x="2" y="2" width="20" height="20" rx="5" stroke="currentColor" stroke-width="1.6"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" stroke="currentColor" stroke-width="1.6"/><path d="M17.5 6.5h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>',
                        'title' => 'Social Media Ad Films',
                        'desc'  => 'Short, engaging ad films that perform best for reels, ads & digital platforms.',
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
