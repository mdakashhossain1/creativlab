<style>
    .wa-step-num {
        width: 88px; height: 88px; border-radius: 50%;
        background: #EDE8FF; border: 2px dashed #794AFF;
        display: flex; align-items: center; justify-content: center;
        font-size: 32px; font-weight: 800; color: #794AFF; flex-shrink: 0;
    }
    .wa-step-box { background: #EDE8FF; border-radius: 18px; padding: 22px 26px; }
    .wa-zigzag-line { border-left: 2px dashed #794AFF; }
</style>

<section class="w-full bg-white md:py-[100px] py-16 overflow-hidden">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-14 md:mb-20" data-aos="fade-up">
            <span class="text-[#25D366] text-xs font-bold uppercase tracking-[0.2em] mb-3">OUR WORK PROCESS</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                Simple Steps, <span class="text-purple">Powerful Result</span>
            </h2>
        </div>

        <div class="relative max-w-[860px] mx-auto">
            @php
                $steps = [
                    ['num' => '01', 'title' => 'Understanding',          'desc' => 'We understand your business, audience, and communication goals to create the right automation strategy.', 'icon' => '<path d="M9 18h6M10 22h4M12 2a7 7 0 00-4 12.7V17h8v-2.3A7 7 0 0012 2z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>'],
                    ['num' => '02', 'title' => 'Setup & Automation',      'desc' => 'We set up the WhatsApp API, chatbot flows, campaigns, and automation systems for your business.', 'icon' => '<circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 11-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 110-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 114 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 110 4h-.09a1.65 1.65 0 00-1.51 1z" stroke="currentColor" stroke-width="1.8"/>'],
                    ['num' => '03', 'title' => 'Campaign & Engagement',   'desc' => 'We help you run campaigns, automate customer interactions, and improve engagement efficiently.', 'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="1.8"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>'],
                    ['num' => '04', 'title' => 'Optimize & Grow',         'desc' => 'We analyze performance, optimize workflows, and scale your WhatsApp communication system for better results.', 'icon' => '<path d="M23 6l-9.5 9.5-5-5L1 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M17 6h6v6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>'],
                ];
            @endphp

            <div class="space-y-6 md:space-y-2">
                @foreach($steps as $step)
                    @php $isEven = $loop->iteration % 2 == 0; @endphp
                    <div class="flex items-center gap-6 md:gap-8 {{ $isEven ? 'md:flex-row-reverse' : '' }}"
                         data-aos="{{ $isEven ? 'fade-left' : 'fade-right' }}">
                        {{-- number circle --}}
                        <div class="wa-step-num">{{ $step['num'] }}</div>

                        {{-- content box --}}
                        <div class="wa-step-box flex-1 flex items-start gap-4 {{ $isEven ? 'md:text-right md:flex-row-reverse' : '' }}">
                            <div class="size-11 rounded-xl bg-white flex items-center justify-center flex-shrink-0">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-purple">
                                    {!! $step['icon'] !!}
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-main-black text-xl mb-1.5">{{ $step['title'] }}</h3>
                                <p class="text-paragraph text-sm leading-6">{{ $step['desc'] }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- dashed connector (between steps, desktop) --}}
                    @if(!$loop->last)
                    <div class="hidden md:flex {{ $isEven ? 'justify-end pr-[88px]' : 'justify-start pl-[44px]' }}">
                        <div class="h-8 wa-zigzag-line"></div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
