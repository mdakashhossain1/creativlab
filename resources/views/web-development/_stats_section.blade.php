<section class="w-full bg-[#F4F1FF] pb-[100px] md:-mt-4">
    <div class="theme-container mx-auto">
        <div class="relative w-full rounded-[20px] overflow-hidden py-10 px-8 md:px-12 bg-white border border-[#e7e3fa]">

            <div class="flex flex-wrap justify-center md:gap-[30px] gap-5">
                @php
                    $stats = [
                        ['icon' => true, 'text' => '50+ Websites Delivered'],
                        ['icon' => true, 'text' => '100% Responsive Design'],
                        ['icon' => true, 'text' => 'Fast & Secure'],
                        ['icon' => true, 'text' => 'High Performance'],
                        ['icon' => true, 'text' => 'SEO Optimized'],
                        ['icon' => true, 'text' => 'Search Friendly'],
                    ];
                @endphp

                @foreach($stats as $stat)
                <div class="flex space-x-2.5 items-center text-purple font-medium px-5 py-3 bg-main-gray border border-[#e7e3fa] leading-none rounded-full"
                     data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                    <span>
                        {{ get_svg('feature_svg') }}
                    </span>
                    <span>{{ $stat['text'] }}</span>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
