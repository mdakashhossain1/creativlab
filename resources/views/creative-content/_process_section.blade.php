<section class="w-full bg-white md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-12 md:mb-16" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">HOW WE WORK</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center mb-4">
                Our <span class="text-purple">Creative Process</span>
            </h2>
            <p class="text-paragraph text-center xl:max-w-[500px] leading-7">
                A streamlined four-step approach that takes your idea from concept to a high-performing content piece.
            </p>
        </div>

        <div class="relative">
            {{-- connector line (desktop only) --}}
            <div class="xl:block hidden absolute top-[52px] left-[calc(12.5%+28px)] right-[calc(12.5%+28px)] h-[2px]"
                 style="background: repeating-linear-gradient(90deg, #794AFF 0px, #794AFF 12px, transparent 12px, transparent 24px);"></div>

            <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-8">
                @php
                    $steps = [
                        ['num' => '01', 'color' => 'bg-purple',       'title' => 'Discovery & Brief',           'desc' => 'We dive deep into your brand, audience, and goals through a structured creative brief session.'],
                        ['num' => '02', 'color' => 'bg-[#BA4AFF]',    'title' => 'Concept & Storyboarding',     'desc' => 'Our team builds concept boards and storyboards so you can visualise the content before creation begins.'],
                        ['num' => '03', 'color' => 'bg-orange',       'title' => 'Content Creation',            'desc' => 'Designers and editors craft the reels, graphics, or motion assets with premium tools and attention to detail.'],
                        ['num' => '04', 'color' => 'bg-blue-sass',    'title' => 'Publish & Optimise',          'desc' => 'We publish at peak times, monitor performance, and iterate based on real engagement data.'],
                    ];
                @endphp

                @foreach($steps as $step)
                <div class="flex flex-col items-center text-center relative group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    {{-- step circle --}}
                    <div class="relative mb-6">
                        <div class="size-[104px] rounded-full {{ $step['color'] }} flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <span class="text-white font-bold text-2xl">{{ $step['num'] }}</span>
                        </div>
                    </div>
                    <h3 class="font-bold text-main-black text-xl mb-3">{{ $step['title'] }}</h3>
                    <p class="text-paragraph text-sm leading-6">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
