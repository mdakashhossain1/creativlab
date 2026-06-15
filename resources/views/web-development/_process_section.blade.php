<style>
    @keyframes wd-dash-move {
        to { background-position-x: 20px; }
    }
    @keyframes wd-dot-move {
        0%   { left: 0%;   opacity: 0; }
        8%   { opacity: 1; }
        92%  { opacity: 1; }
        100% { left: 100%; opacity: 0; }
    }

    .wd-conn {
        position: relative;
        height: 2px;
        background-image: linear-gradient(90deg, var(--c) 50%, transparent 50%);
        background-size: 18px 2px;
        background-repeat: repeat-x;
        animation: wd-dash-move 0.4s linear infinite;
    }
    .wd-conn::after {
        content: '';
        position: absolute;
        top: 50%; transform: translateY(-50%);
        width: 9px; height: 9px; border-radius: 50%;
        background: var(--c);
        box-shadow: 0 0 8px 3px color-mix(in srgb, var(--c) 50%, transparent);
        animation: wd-dot-move 2.2s ease-in-out infinite;
    }
    .wd-conn-1 { --c: #794AFF; }
    .wd-conn-2 { --c: #3B82F6; animation-delay: -0.13s; }
    .wd-conn-2::after { animation-delay: 0.73s; }
    .wd-conn-3 { --c: #EC4899; animation-delay: -0.26s; }
    .wd-conn-3::after { animation-delay: 1.46s; }
</style>

<section class="w-full bg-[#F4F1FF] md:py-[100px] py-16">
    <div class="theme-container mx-auto">

        <div class="flex flex-col items-center mb-14 md:mb-20" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">OUR PROCESS</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                How We <span class="text-purple">Build Websites</span>
            </h2>
        </div>

        @php
            $steps = [
                [
                    'num'        => '01',
                    'badge_bg'   => '#794AFF',
                    'icon_bg'    => 'rgba(121,74,255,0.12)',
                    'icon_color' => '#794AFF',
                    'conn'       => 'wd-conn-1',
                    'icon'       => '<circle cx="11" cy="11" r="8" stroke-width="1.8"/><path d="M21 21l-4.35-4.35" stroke-width="1.8" stroke-linecap="round"/>',
                    'title'      => 'Research & Planning',
                    'desc'       => 'We understand your business, goals and target audience to plan the best strategy.',
                ],
                [
                    'num'        => '02',
                    'badge_bg'   => '#3B82F6',
                    'icon_bg'    => 'rgba(59,130,246,0.12)',
                    'icon_color' => '#3B82F6',
                    'conn'       => 'wd-conn-2',
                    'icon'       => '<rect x="3" y="3" width="18" height="18" rx="2" stroke-width="1.8"/><path d="M3 9h18M9 21V9" stroke-width="1.8" stroke-linecap="round"/>',
                    'title'      => 'UI/UX Design',
                    'desc'       => 'We create modern, clean and user-friendly designs that represent your brand.',
                ],
                [
                    'num'        => '03',
                    'badge_bg'   => '#EC4899',
                    'icon_bg'    => 'rgba(236,72,153,0.12)',
                    'icon_color' => '#EC4899',
                    'conn'       => 'wd-conn-3',
                    'icon'       => '<path d="M16 18l6-6-6-6M8 6l-6 6 6 6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
                    'title'      => 'Development & Testing',
                    'desc'       => 'We build fast, secure and responsive websites and test every functionality.',
                ],
                [
                    'num'        => '04',
                    'badge_bg'   => '#0EA5E9',
                    'icon_bg'    => 'rgba(14,165,233,0.12)',
                    'icon_color' => '#0EA5E9',
                    'conn'       => '',
                    'icon'       => '<path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
                    'title'      => 'Launch & Optimization',
                    'desc'       => 'We launch your website and optimise it for performance, speed and SEO.',
                ],
            ];
        @endphp

        {{-- ── DESKTOP: 7-col grid [step | conn | step | conn | step | conn | step] ── --}}
        <div class="xl:grid hidden items-start" style="grid-template-columns: 2fr 1fr 2fr 1fr 2fr 1fr 2fr;">
            @foreach($steps as $step)

                {{-- Step --}}
                <div class="flex flex-col items-center text-center px-2"
                     data-aos="fade-up" data-aos-delay="{{ $loop->index * 120 }}">
                    {{-- icon + corner badge --}}
                    <div class="relative inline-block mb-7">
                        <div class="w-24 h-24 rounded-full flex items-center justify-center transition-transform duration-300 hover:scale-110"
                             style="background: {{ $step['icon_bg'] }};">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none"
                                 stroke="{{ $step['icon_color'] }}" xmlns="http://www.w3.org/2000/svg">
                                {!! $step['icon'] !!}
                            </svg>
                        </div>
                        {{-- number badge at top-right corner --}}
                        <span class="absolute -top-2 -right-2 w-7 h-7 rounded-full flex items-center justify-center
                                     text-white text-[10px] font-bold shadow-md z-10"
                              style="background: {{ $step['badge_bg'] }};">
                            {{ $step['num'] }}
                        </span>
                    </div>
                    <h3 class="font-bold text-main-black text-lg mb-2.5">{{ $step['title'] }}</h3>
                    <p class="text-paragraph text-sm leading-6">{{ $step['desc'] }}</p>
                </div>

                {{-- Animated connector (not after last step) --}}
                @if(!$loop->last)
                <div class="flex items-start" style="padding-top: 47px;">
                    <div class="w-full {{ $step['conn'] }} wd-conn"></div>
                </div>
                @endif

            @endforeach
        </div>

        {{-- ── MOBILE / TABLET: simple 2-col grid ── --}}
        <div class="xl:hidden grid md:grid-cols-2 grid-cols-1 gap-10">
            @foreach($steps as $step)
            <div class="flex flex-col items-center text-center" data-aos="fade-up">
                <div class="relative inline-block mb-7">
                    <div class="w-24 h-24 rounded-full flex items-center justify-center"
                         style="background: {{ $step['icon_bg'] }};">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none"
                             stroke="{{ $step['icon_color'] }}" xmlns="http://www.w3.org/2000/svg">
                            {!! $step['icon'] !!}
                        </svg>
                    </div>
                    <span class="absolute -top-2 -right-2 w-7 h-7 rounded-full flex items-center justify-center
                                 text-white text-[10px] font-bold shadow-md z-10"
                          style="background: {{ $step['badge_bg'] }};">
                        {{ $step['num'] }}
                    </span>
                </div>
                <h3 class="font-bold text-main-black text-lg mb-2.5">{{ $step['title'] }}</h3>
                <p class="text-paragraph text-sm leading-6 max-w-[220px]">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>

    </div>
</section>
