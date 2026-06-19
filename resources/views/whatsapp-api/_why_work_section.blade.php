<section class="w-full bg-white md:pb-[100px] pb-16">
    <div class="theme-container mx-auto">
        <div class="relative w-full rounded-[24px] overflow-hidden md:py-12 py-10 px-6 md:px-12"
             style="background: linear-gradient(120deg, #EDE8FF 0%, #F4F1FF 50%, #E4DCFF 100%);" data-aos="fade-up">

            <div class="absolute -top-10 -right-10 size-40 rounded-full bg-purple/10 pointer-events-none"></div>
            <div class="absolute -bottom-8 left-1/4 size-32 rounded-full bg-[#25D366]/10 pointer-events-none"></div>

            <div class="relative z-10">
                <h2 class="md:text-[34px] text-26 font-bold text-purple text-center mb-10">{{ getTranslatedValue($wa_why_work, 'section_title') ?: 'Why Work With CreativLab?' }}</h2>

                @php
                    $waWhyMeta = [
                        ['color'=>'#25D366','bg'=>'bg-[#E8FFF0]','icon'=>'<path d="M9 11l3 3L22 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>'],
                        ['color'=>'#794AFF','bg'=>'bg-[#EDE8FF]','icon'=>'<circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 11-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 110-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 114 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 110 4h-.09a1.65 1.65 0 00-1.51 1z" stroke="currentColor" stroke-width="1.8"/>'],
                        ['color'=>'#FF7E40','bg'=>'bg-[#FFF0E8]','icon'=>'<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>'],
                        ['color'=>'#BA4AFF','bg'=>'bg-[#F5E8FF]','icon'=>'<path d="M22 12h-4l-3 9L9 3l-3 9H2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>'],
                    ];
                    $waWhyDefTitles = ['Complete Setup Assistance','Automation Strategy','Personalized Workflows','Ongoing Campaign Support'];
                    $waWhyDefDescs  = ['We help businesses with API setup, verification, integration, and complete onboarding support.','Custom WhatsApp automation strategies tailored to your business goals and customer journey.','Smart chatbot flows and campaigns built specifically for your business needs.','We help optimise campaigns, improve engagement, and scale customer communication effectively.'];
                @endphp
                <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6">
                    @for($i = 1; $i <= 4; $i++)
                    @php $p = $waWhyMeta[$i - 1]; @endphp
                    <div class="bg-white/60 rounded-2xl p-5 border border-white">
                        <div class="size-11 rounded-xl {{ $p['bg'] }} flex items-center justify-center mb-4">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color:{{ $p['color'] }}">
                                {!! $p['icon'] !!}
                            </svg>
                        </div>
                        <h3 class="font-bold text-main-black text-sm mb-2">{{ getTranslatedValue($wa_why_work, "point_{$i}_title") ?: $waWhyDefTitles[$i - 1] }}</h3>
                        <p class="text-paragraph text-xs leading-5">{{ getTranslatedValue($wa_why_work, "point_{$i}_desc") ?: $waWhyDefDescs[$i - 1] }}</p>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>
