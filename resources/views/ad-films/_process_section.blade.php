<style>
    @keyframes af-dash-move {
        to { background-position-x: 20px; }
    }
    @keyframes af-dot-move {
        0%   { left: 0%;   opacity: 0; }
        8%   { opacity: 1; }
        92%  { opacity: 1; }
        100% { left: 100%; opacity: 0; }
    }

    .af-conn {
        position: relative;
        height: 2px;
        background-image: linear-gradient(90deg, var(--c) 50%, transparent 50%);
        background-size: 18px 2px;
        background-repeat: repeat-x;
        animation: af-dash-move 0.4s linear infinite;
    }
    .af-conn::after {
        content: '';
        position: absolute;
        top: 50%; transform: translateY(-50%);
        width: 9px; height: 9px; border-radius: 50%;
        background: var(--c);
        box-shadow: 0 0 8px 3px color-mix(in srgb, var(--c) 50%, transparent);
        animation: af-dot-move 2.2s ease-in-out infinite;
    }
    .af-conn-1 { --c: #794AFF; }
    .af-conn-2 { --c: #BA4AFF; animation-delay: -0.13s; }
    .af-conn-2::after { animation-delay: 0.73s; }
    .af-conn-3 { --c: #FF7E40; animation-delay: -0.26s; }
    .af-conn-3::after { animation-delay: 1.46s; }
</style>

<section class="w-full bg-[#F4F1FF] md:py-[100px] py-16">
    <div class="theme-container mx-auto">

        <div class="flex flex-col items-center mb-14 md:mb-20" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">{{ getTranslatedValue($af_process, 'section_label') ?: 'OUR PROCESS' }}</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                {!! getTranslatedValue($af_process, 'section_title') ?: 'How We Create <span class="text-purple">Impactful Ad Films</span>' !!}
            </h2>
        </div>

        @php
            $steps = [
                ['num'=>'01','badge_bg'=>'#794AFF','icon_bg'=>'rgba(121,74,255,0.12)','icon_color'=>'#794AFF','conn'=>'af-conn-1','icon'=>'<circle cx="11" cy="11" r="8" stroke-width="1.8"/><path d="M21 21l-4.35-4.35" stroke-width="1.8" stroke-linecap="round"/>','title'=>getTranslatedValue($af_process,'step_1_title')?:'Discover &amp; Plan','desc'=>getTranslatedValue($af_process,'step_1_desc')?:'We understand your brand, audience & goals to plan the perfect concept.'],
                ['num'=>'02','badge_bg'=>'#BA4AFF','icon_bg'=>'rgba(186,74,255,0.12)','icon_color'=>'#BA4AFF','conn'=>'af-conn-2','icon'=>'<path d="M12 20h9M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>','title'=>getTranslatedValue($af_process,'step_2_title')?:'Script &amp; Concept','desc'=>getTranslatedValue($af_process,'step_2_desc')?:'We craft a creative script and visual concept that tells your story.'],
                ['num'=>'03','badge_bg'=>'#FF7E40','icon_bg'=>'rgba(255,126,64,0.12)','icon_color'=>'#FF7E40','conn'=>'af-conn-3','icon'=>'<rect x="2" y="2" width="20" height="20" rx="2.18" stroke-width="1.8"/><path d="M7 2v20M17 2v20M2 12h20M2 7h5M2 17h5M17 17h5M17 7h5" stroke-width="1.8" stroke-linecap="round"/>','title'=>getTranslatedValue($af_process,'step_3_title')?:'Shoot &amp; Produce','desc'=>getTranslatedValue($af_process,'step_3_desc')?:'Professional shooting with cinematic techniques and creative direction.'],
                ['num'=>'04','badge_bg'=>'#0EA5E9','icon_bg'=>'rgba(14,165,233,0.12)','icon_color'=>'#0EA5E9','conn'=>'','icon'=>'<path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>','title'=>getTranslatedValue($af_process,'step_4_title')?:'Edit &amp; Deliver','desc'=>getTranslatedValue($af_process,'step_4_desc')?:'We edit, enhance and deliver a film that creates impact and converts.'],
            ];
        @endphp

        {{-- DESKTOP: 7-col grid [step | conn | step | conn | step | conn | step] --}}
        <div class="xl:grid hidden items-start" style="grid-template-columns: 2fr 1fr 2fr 1fr 2fr 1fr 2fr;">
            @foreach($steps as $step)

                {{-- Step --}}
                <div class="flex flex-col items-center text-center px-2"
                     data-aos="fade-up" data-aos-delay="{{ $loop->index * 120 }}">
                    <div class="relative inline-block mb-7">
                        <div class="w-24 h-24 rounded-full flex items-center justify-center transition-transform duration-300 hover:scale-110"
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
                    <p class="text-paragraph text-sm leading-6">{{ $step['desc'] }}</p>
                </div>

                {{-- Animated connector --}}
                @if(!$loop->last)
                <div class="flex items-start" style="padding-top: 47px;">
                    <div class="w-full {{ $step['conn'] }} af-conn"></div>
                </div>
                @endif

            @endforeach
        </div>

        {{-- MOBILE / TABLET: 2-col grid --}}
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
