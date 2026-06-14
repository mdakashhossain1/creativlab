<section class="w-full bg-white md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="flex flex-col items-center mb-12 md:mb-16" data-aos="fade-up">
            <span class="text-[#25D366] text-xs font-bold uppercase tracking-[0.2em] mb-3">OUR SERVICES</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                <span class="text-purple">WhatsApp API</span> Services
            </h2>
        </div>

        <div class="grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6">
            @php
                $services = [
                    [
                        'bg' => 'bg-[#E8FFF0]', 'color' => '#25D366',
                        'icon' => '<path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Bulk Messaging',
                        'desc'  => 'Send promotional messages, offers, updates and notifications to thousands of customers instantly.',
                    ],
                    [
                        'bg' => 'bg-[#EDE8FF]', 'color' => '#794AFF',
                        'icon' => '<rect x="3" y="11" width="18" height="10" rx="2" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="5" r="2" stroke="currentColor" stroke-width="1.7"/><path d="M12 7v4M8 16h.01M16 16h.01" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>',
                        'title' => 'AI Chatbot',
                        'desc'  => 'Build smart chatbot flows to automate conversations and provide instant customer support.',
                    ],
                    [
                        'bg' => 'bg-[#FFF0E8]', 'color' => '#FF7E40',
                        'icon' => '<path d="M3 11l18-5v12L3 13v-2z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.6 16.8a3 3 0 11-5.8-1.6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Campaign Automation',
                        'desc'  => 'Create, schedule and automate WhatsApp marketing campaigns to engage and re-engage your customers.',
                    ],
                    [
                        'bg' => 'bg-[#E8F4FF]', 'color' => '#3B82F6',
                        'icon' => '<path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="1.7"/><path d="M22 11l-3 3-2-2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Lead Generation',
                        'desc'  => 'Capture high-quality leads directly from WhatsApp and manage them in one place.',
                    ],
                    [
                        'bg' => 'bg-[#F5E8FF]', 'color' => '#BA4AFF',
                        'icon' => '<path d="M20 7h-9M14 17H5M17 21a4 4 0 100-8 4 4 0 000 8zM7 11a4 4 0 100-8 4 4 0 000 8z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'CRM Integration',
                        'desc'  => 'Integrate WhatsApp with your CRM and automate workflows to boost productivity.',
                    ],
                    [
                        'bg' => 'bg-[#FFF0F5]', 'color' => '#F43F5E',
                        'icon' => '<path d="M3 18v-6a9 9 0 0118 0v6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3zM3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>',
                        'title' => 'Customer Support',
                        'desc'  => 'Deliver fast and personalized customer support with a shared team inbox and smart automation.',
                    ],
                ];
            @endphp

            @foreach($services as $s)
            <div class="group relative bg-white rounded-2xl p-7 border border-purple/10 hover:border-[#25D366]/40 hover:shadow-common transition-all duration-300 cursor-pointer"
                 data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 80 }}">
                <div class="size-14 rounded-xl {{ $s['bg'] }} flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color:{{ $s['color'] }}">
                        {!! $s['icon'] !!}
                    </svg>
                </div>
                <h3 class="font-bold text-main-black text-lg mb-2.5 group-hover:text-purple transition-colors duration-300">{{ $s['title'] }}</h3>
                <p class="text-paragraph text-sm leading-6 pr-8">{{ $s['desc'] }}</p>

                {{-- arrow button bottom-right --}}
                <div class="absolute bottom-6 right-6 size-9 rounded-full bg-[#EDE8FF] group-hover:bg-[#25D366] flex items-center justify-center transition-all duration-300">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-purple group-hover:text-white transition-colors duration-300">
                        <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
