<style>
    .wa-hero-bg { background: linear-gradient(135deg, #F4F1FF 0%, #EDE8FF 40%, #F8F6FF 100%); }
    @keyframes waFloat  { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    @keyframes waFloatR { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)}  }
    .wa-float      { animation: waFloat  4.5s ease-in-out infinite; }
    .wa-float-rev  { animation: waFloatR 5.5s ease-in-out infinite reverse; }
    .wa-float-slow { animation: waFloat  7s   ease-in-out infinite; }
    .wa-highlight {
        display:inline-block; position:relative;
        background: linear-gradient(135deg, #794AFF 0%, #BA4AFF 100%);
        -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
    }
    .wa-highlight::after { content:''; position:absolute; left:0; right:0; bottom:-4px; height:3px; border-radius:2px; background:linear-gradient(90deg,#794AFF,#BA4AFF); }
    .wa-chat-bg { background:#0b141a; }
</style>

<section class="wa-hero-bg w-full xl:pt-[200px] pt-[110px] xl:pb-0 pb-16 overflow-hidden relative">
    <div class="absolute top-20 left-0 w-72 h-72 rounded-full bg-purple/5 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-10 w-96 h-96 rounded-full bg-[#25D366]/8 blur-3xl pointer-events-none"></div>

    <div class="theme-container mx-auto">
        <div class="grid xl:grid-cols-2 grid-cols-1 items-center xl:gap-12 gap-12">

            {{-- LEFT: text --}}
            <div class="xl:pb-24 relative z-10" data-aos="fade-right">
                <div class="inline-flex items-center gap-2.5 bg-white border border-[#25D366]/25 rounded-full px-5 py-2.5 mb-6 shadow-sm">
                    <span class="size-7 rounded-full bg-[#25D366] flex items-center justify-center">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38c1.45.79 3.08 1.21 4.79 1.21 5.46 0 9.91-4.45 9.91-9.91C21.95 6.45 17.5 2 12.04 2zm5.8 14.04c-.24.68-1.42 1.31-1.97 1.36-.5.05-1.13.07-1.83-.11-.42-.13-.96-.31-1.65-.61-2.9-1.25-4.79-4.17-4.94-4.36-.14-.19-1.18-1.57-1.18-3 0-1.43.75-2.13 1.02-2.42.27-.29.58-.36.78-.36.19 0 .39 0 .56.01.18.01.42-.07.66.5.24.59.82 2.04.89 2.18.07.15.12.32.02.51-.09.19-.14.31-.27.48-.14.16-.29.36-.41.49-.14.14-.28.29-.12.57.16.27.71 1.17 1.52 1.9 1.05.93 1.93 1.22 2.2 1.36.27.14.43.12.59-.07.16-.19.68-.79.86-1.06.18-.27.36-.22.61-.13.25.09 1.58.75 1.85.88.27.14.45.21.51.32.07.11.07.62-.17 1.29z"/></svg>
                    </span>
                    <span class="text-[#128C7E] text-sm font-semibold tracking-wide">Official WhatsApp Business API</span>
                </div>

                <h1 class="xl:text-[60px] md:text-[48px] text-[34px] font-bold text-main-black leading-[1.08] tracking-tight mb-6">
                    Official <span class="wa-highlight">WhatsApp</span> API Solutions For Businesses
                </h1>

                <p class="text-paragraph font-medium text-base leading-7 mb-9 xl:max-w-[440px]">
                    Automate conversations, engage customers, and grow your business with powerful WhatsApp automation solutions.
                </p>

                <div class="flex flex-wrap items-center gap-4 mb-9">
                    <a href="{{ route('contact-us') }}"
                       class="inline-flex items-center gap-3 bg-[#25D366] text-white font-bold text-sm uppercase tracking-widest px-9 py-4 rounded-full hover:bg-[#128C7E] transition-all duration-300"
                       style="box-shadow:0 8px 24px rgba(37,211,102,.3);">
                        Get Started
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="{{ route('contact-us') }}"
                       class="inline-flex items-center gap-2 border-2 border-purple text-purple font-bold text-sm uppercase tracking-widest px-8 py-3.5 rounded-full hover:bg-purple hover:text-white transition-all duration-300">
                        Book Meeting
                    </a>
                </div>

                {{-- partner badges --}}
                <div class="flex flex-wrap items-center gap-6">
                    <div>
                        <p class="text-[10px] text-paragraph font-semibold uppercase tracking-wider mb-1.5">Official Partner of</p>
                        <div class="flex items-center gap-2 bg-white rounded-lg px-3 py-2 shadow-sm border border-purple/8">
                            <span class="size-6 rounded-md bg-[#794AFF] flex items-center justify-center text-white text-xs font-bold">Ai</span>
                            <span class="font-bold text-main-black text-sm">AiSensy</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-[10px] text-paragraph font-semibold uppercase tracking-wider mb-1.5">Powered by</p>
                        <div class="flex items-center gap-2 bg-white rounded-lg px-3 py-2 shadow-sm border border-purple/8">
                            <span class="size-6 rounded-md bg-[#25D366] flex items-center justify-center">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38c1.45.79 3.08 1.21 4.79 1.21 5.46 0 9.91-4.45 9.91-9.91C21.95 6.45 17.5 2 12.04 2z"/></svg>
                            </span>
                            <span class="font-bold text-main-black text-sm">WhatsApp</span>
                            <span class="text-paragraph text-xs">&middot; Meta</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: phone with WhatsApp chat + floating green pills --}}
            <div class="relative flex justify-center xl:justify-end items-center" data-aos="fade-left">
                <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(circle at 60% 50%, rgba(37,211,102,0.15) 0%, transparent 70%);"></div>

                {{-- phone --}}
                <div class="relative z-10 wa-float xl:w-[300px] w-[250px]">
                    <div style="background:#1a1432; border-radius:38px; padding:10px; box-shadow:0 40px 80px -10px rgba(121,74,255,.4), 0 0 0 1px rgba(121,74,255,.15);">
                        <div class="w-24 h-5 bg-[#0e0b20] rounded-full mx-auto mb-2"></div>
                        <div class="wa-chat-bg rounded-[26px] overflow-hidden" style="aspect-ratio:9/17;">
                            {{-- chat header --}}
                            <div class="bg-[#128C7E] px-3.5 py-3 flex items-center gap-2.5">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M15 18l-6-6 6-6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <div class="size-8 rounded-full bg-white/20 flex items-center justify-center text-white text-[10px] font-bold">CL</div>
                                <div class="flex-1">
                                    <p class="text-white text-[11px] font-bold leading-none">CREATIVLAB LLP</p>
                                    <p class="text-white/70 text-[8px] mt-0.5">online</p>
                                </div>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 7l-7 5 7 5V7z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><rect x="1" y="5" width="15" height="14" rx="2" stroke="white" stroke-width="2"/></svg>
                            </div>
                            {{-- chat body --}}
                            <div class="p-3 space-y-2" style="background:url('data:image/svg+xml,%3Csvg width=%2240%22 height=%2240%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Crect width=%2240%22 height=%2240%22 fill=%22%230b141a%22/%3E%3C/svg%3E');">
                                {{-- incoming --}}
                                <div class="max-w-[80%]">
                                    <div class="bg-[#1f2c33] rounded-xl rounded-tl-sm px-3 py-2">
                                        <p class="text-white text-[9px] leading-snug">Hi! 👋 Welcome to CreativLab. How can we help you today?</p>
                                        <p class="text-white/40 text-[6px] text-right mt-1">10:24</p>
                                    </div>
                                </div>
                                {{-- promo card --}}
                                <div class="max-w-[85%]">
                                    <div class="bg-[#1f2c33] rounded-xl rounded-tl-sm overflow-hidden">
                                        <div class="h-16 bg-gradient-to-br from-purple to-[#BA4AFF] flex items-center justify-center">
                                            <span class="text-white text-[9px] font-bold">CreativLab LLP</span>
                                        </div>
                                        <div class="px-2.5 py-2">
                                            <p class="text-white text-[8px] font-semibold mb-1">🎉 Special Offer Inside!</p>
                                            <p class="text-white/60 text-[7px] leading-snug">Automate your business chats and grow faster with our WhatsApp API.</p>
                                        </div>
                                    </div>
                                </div>
                                {{-- outgoing --}}
                                <div class="flex justify-end">
                                    <div class="max-w-[75%] bg-[#005c4b] rounded-xl rounded-tr-sm px-3 py-2">
                                        <p class="text-white text-[9px] leading-snug">Sounds great! Tell me more 🚀</p>
                                        <p class="text-white/50 text-[6px] text-right mt-1">10:25 ✓✓</p>
                                    </div>
                                </div>
                            </div>
                            {{-- input bar --}}
                            <div class="absolute bottom-2.5 left-2.5 right-2.5 flex items-center gap-2">
                                <div class="flex-1 bg-[#1f2c33] rounded-full px-3 py-2">
                                    <span class="text-white/40 text-[8px]">Type a message...</span>
                                </div>
                                <div class="size-7 rounded-full bg-[#25D366] flex items-center justify-center">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- floating pill: Bulk Msg --}}
                <div class="absolute xl:-right-2 right-0 xl:top-8 top-2 z-30 wa-float-rev">
                    <div class="flex items-center gap-2 bg-[#25D366] rounded-full pl-2 pr-4 py-2 shadow-common">
                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <span class="text-xs font-bold text-white">Bulk Msg</span>
                    </div>
                </div>

                {{-- floating pill: AI Chat BOT --}}
                <div class="absolute xl:left-2 left-0 xl:top-1/3 top-1/4 z-30 wa-float">
                    <div class="flex items-center gap-2 bg-[#25D366] rounded-full pl-2 pr-4 py-2 shadow-common">
                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="11" width="18" height="10" rx="2" stroke="white" stroke-width="2"/><circle cx="12" cy="5" r="2" stroke="white" stroke-width="2"/><path d="M12 7v4M8 16h.01M16 16h.01" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>
                        </div>
                        <span class="text-xs font-bold text-white">AI Chat BOT</span>
                    </div>
                </div>

                {{-- floating pill: AI Automation --}}
                <div class="absolute xl:-right-4 right-0 xl:bottom-12 bottom-6 z-30 wa-float-slow">
                    <div class="flex items-center gap-2 bg-[#25D366] rounded-full pl-2 pr-4 py-2 shadow-common">
                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="3" stroke="white" stroke-width="2"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 11-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 110-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 114 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 110 4h-.09a1.65 1.65 0 00-1.51 1z" stroke="white" stroke-width="2"/></svg>
                        </div>
                        <span class="text-xs font-bold text-white">AI Automation</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
