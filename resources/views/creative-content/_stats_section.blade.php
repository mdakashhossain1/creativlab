<section class="w-full bg-[#F4F1FF] md:py-[100px] py-16 overflow-hidden">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-12 md:mb-16" data-aos="fade-up">
            <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3">CLIENT LOVE</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center mb-4">
                What Our <span class="text-purple">Brands</span> Say
            </h2>
            <p class="text-paragraph text-center xl:max-w-[480px] leading-7">
                Real results from real businesses — here's how CreativLab helped brands grow their presence online.
            </p>
        </div>

        <div class="grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6">
            @php
                $testimonials = [
                    [
                        'quote'  => 'CreativLab transformed our Instagram completely. Our engagement went from 2% to over 12% in just two months. The reels are absolutely fire.',
                        'name'   => 'Priya Sharma',
                        'role'   => 'Founder, Bloom Organics',
                        'color'  => '#794AFF',
                        'rating' => 5,
                    ],
                    [
                        'quote'  => 'Every graphic they deliver is better than the last. Our brand now looks premium and our customers notice it. Best investment we made.',
                        'name'   => 'Rahul Mehta',
                        'role'   => 'CEO, FitFuel Nutrition',
                        'color'  => '#BA4AFF',
                        'rating' => 5,
                    ],
                    [
                        'quote'  => 'The motion graphics they created for our product launch got 2.4 million views organically. Absolutely incredible work and team.',
                        'name'   => 'Ananya Nair',
                        'role'   => 'Marketing Head, Zestify',
                        'color'  => '#FF7E40',
                        'rating' => 5,
                    ],
                    [
                        'quote'  => 'Fast, creative, and always on brand. They understand our audience better than we do sometimes. Couldn\'t be happier with the results.',
                        'name'   => 'Kiran Patel',
                        'role'   => 'Director, UrbanNest Interiors',
                        'color'  => '#22C55E',
                        'rating' => 5,
                    ],
                    [
                        'quote'  => 'Our YouTube channel grew from 1k to 48k subscribers after we started using CreativLab\'s thumbnails and video editing. Highly recommend.',
                        'name'   => 'Sneha Reddy',
                        'role'   => 'Content Creator, TravelWithSneha',
                        'color'  => '#3B82F6',
                        'rating' => 5,
                    ],
                    [
                        'quote'  => 'Professional, responsive, and genuinely talented. They delivered a full month of social media content in under a week. Outstanding.',
                        'name'   => 'Vikram Singh',
                        'role'   => 'Owner, SipCraft Brewery',
                        'color'  => '#F59E0B',
                        'rating' => 5,
                    ],
                ];
            @endphp

            @foreach($testimonials as $t)
            <div class="bg-white rounded-2xl p-7 border border-purple/8 hover:shadow-common transition-all duration-300"
                 data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 80 }}">
                {{-- star rating --}}
                <div class="flex gap-1 mb-5">
                    @for($i = 0; $i < $t['rating']; $i++)
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    @endfor
                </div>

                {{-- quote --}}
                <p class="text-paragraph text-sm leading-7 mb-6">"{{ $t['quote'] }}"</p>

                {{-- author --}}
                <div class="flex items-center gap-3">
                    <div class="size-10 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0"
                         style="background: {{ $t['color'] }}">
                        {{ strtoupper(substr($t['name'], 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-bold text-main-black text-sm leading-tight">{{ $t['name'] }}</p>
                        <p class="text-paragraph text-xs mt-0.5">{{ $t['role'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
