<style>
    @keyframes waFloat  { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    @keyframes waFloatR { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)}  }
    .wa-float      { animation: waFloat  4.5s ease-in-out infinite; }
    .wa-float-rev  { animation: waFloatR 5.5s ease-in-out infinite reverse; }
    .wa-float-slow { animation: waFloat  7s   ease-in-out infinite; }
    @keyframes popIn { 0%{opacity:0;transform:scale(0)} 70%{opacity:1;transform:scale(1.1)} 100%{opacity:1;transform:scale(1)} }
    .pop-card { animation: popIn 0.5s cubic-bezier(0.34,1.56,0.64,1) both; transform-origin: center; }
    .pop-d1{animation-delay:.1s} .pop-d2{animation-delay:.25s} .pop-d3{animation-delay:.4s}

    /* Partner badges card custom responsive styles */
    .partner-badges-card {
        display: flex;
        align-items: stretch;
        background: #fff;
        border: 1.5px solid rgba(37, 211, 102, 0.5);
        border-radius: 14px;
        height: 88px;
        width: 100%;
        max-width: 620px;
    }
    .partner-card-left {
        width: 45%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        padding: 0 20px;
        gap: 7px;
    }
    .partner-card-divider {
        width: 1px;
        background: #E5E7EB;
        flex-shrink: 0;
        align-self: stretch;
        margin: 12px 0;
    }
    .partner-card-right {
        width: 55%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        padding: 0 20px;
        gap: 7px;
    }
    .partner-card-row {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    
    /* Tablet: keep horizontal, scale down */
    @media (max-width: 768px) {
        .partner-badges-card {
            height: 58px;
            max-width: 100%;
            border-radius: 10px;
        }
        .partner-card-left {
            padding: 0 12px;
            gap: 4px;
        }
        .partner-card-right {
            padding: 0 12px;
            gap: 4px;
        }
        .partner-card-left img {
            height: 20px;
        }
        .partner-card-row {
            gap: 8px;
        }
        .partner-label-text {
            font-size: 9px !important;
        }
        .partner-name-text {
            font-size: 11px !important;
        }
        .partner-sub-text {
            font-size: 8px !important;
        }
        .partner-card-row img[alt="WhatsApp"] {
            height: 22px !important;
            width: 22px !important;
        }
        .partner-card-row img[alt="Meta"] {
            height: 14px !important;
        }
        .partner-card-inner-divider {
            margin: 0 8px !important;
            height: 26px !important;
        }
    }

    /* Small mobile */
    @media (max-width: 480px) {
        .partner-badges-card {
            height: 50px;
            border-radius: 8px;
        }
        .partner-card-left {
            padding: 0 8px;
            gap: 3px;
        }
        .partner-card-right {
            padding: 0 8px;
            gap: 3px;
        }
        .partner-card-left img {
            height: 16px;
        }
        .partner-card-row {
            gap: 5px;
        }
        .partner-card-inner-divider {
            margin: 0 5px !important;
            height: 22px !important;
        }
        .partner-card-row img[alt="WhatsApp"] {
            height: 18px !important;
            width: 18px !important;
        }
        .partner-card-row img[alt="Meta"] {
            height: 11px !important;
        }
        .partner-label-text {
            font-size: 8px !important;
        }
        .partner-name-text {
            font-size: 9px !important;
        }
        .partner-sub-text {
            font-size: 7px !important;
        }
    }

    /* Green button hover SVG styling */
    .btn-green-whatsapp:hover svg {
        color: #25D366 !important;
    }

    /* Book Meeting link base overlay styles */
    .btn-book-meeting-group p::before {
        content: "Book Meeting" !important;
        left: 0 !important;
        white-space: nowrap !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        font-size: inherit !important;
        line-height: inherit !important;
        letter-spacing: inherit !important;
    }

    /* Book Meeting hover text & underline color override */
    .btn-book-meeting-group:hover p::before {
        width: 100% !important;
        color: #25D366 !important;
        border-color: #25D366 !important;
    }

    /* Book Meeting hover SVG path stroke override */
    .btn-book-meeting-group:hover svg path {
        stroke: #25D366 !important;
    }

    /* WhatsApp Green Heading Highlight styling */
    .custom-heading span:first-child {
        background: linear-gradient(
            90deg,
            #25D366 0%,
            rgba(37, 211, 102, 0.15) 100%
        ) !important;
    }

    /* WhatsApp Green Description styling */
    .wa-desc-container {
        border-color: #25D366 !important;
    }
    .wa-desc-text {
        color: #128C7E !important;
    }
</style>

<section class="hero-one-section-wrapper w-full lg:h-[900px] pb-16 lg:pb-0 overflow-hidden relative">
    <div class="win-grid w-full h-full absolute left-0 top-0" id="win-grid"></div>

    <div class="theme-container mx-auto h-full relative z-10">
        <div class="grid lg:grid-cols-2 grid-cols-1 items-center lg:gap-12 gap-12 lg:pt-[200px] pt-[110px] h-full">

            {{-- LEFT: text --}}
            <div class="lg:pb-24 relative z-10">
                <div class="inline-flex items-center gap-2.5 bg-white border border-[#25D366]/25 rounded-full px-5 py-2.5 mb-6 shadow-sm">
                    <img src="{{ asset('frontend/assets/images/whatsapp-api/whatapp.png') }}"
                         alt="WhatsApp" class="size-7 object-contain flex-shrink-0">
                    <span class="text-[#128C7E] text-sm font-semibold tracking-wide">{{ getTranslatedValue($wa_hero, 'badge_text') ?: 'Official WhatsApp Business API' }}</span>
                </div>

                <h1 class="text-main-black mb-[35px] custom-heading md:text-left" style="font-weight: 400 !important;">
                    {!! getTranslatedValue($wa_hero, 'heading') ?: 'Official <span>WhatsApp API</span> Solutions For <span>Businesses</span>' !!}
                </h1>

                <div class="px-6 py-[14px] bg-white border-l-2 wa-desc-container mb-[35px] lg:w-full md:w-[500px]">
                    <p class="text-ptwo wa-desc-text text-paragraph">
                        {{ getTranslatedValue($wa_hero, 'description') ?: 'Automate conversations, engage customers, and grow your business with powerful WhatsApp automation solutions.' }}
                    </p>
                </div>

                <div class="flex space-x-[30px] items-center mb-[35px]">
                    <a href="{{ getTranslatedValue($wa_hero, 'cta_button_1_url') ?: route('contact-us') }}">
                        <div class="home-two-btn-bg py-3 group bg-[#25D366] border-[#25D366] btn-green-whatsapp">
                            <span class="text-base text-white group-hover:text-[#25D366] transition-all duration-300 font-semibold font-inter relative z-10">
                                {{ getTranslatedValue($wa_hero, 'cta_button_1') ?: 'Get Started' }}
                            </span>
                            <span>
                                {{ get_svg('home_cta_white') }}
                            </span>
                        </div>
                    </a>
                    <a href="{{ getTranslatedValue($wa_hero, 'cta_button_2_url') ?: route('contact-us') }}">
                        <div class="flex items-center gap-2 group btn-book-meeting-group">
                            <p class="mb-[1px] font-medium text-main-black leading-5 font-inter border-b border-main-black relative">{{ getTranslatedValue($wa_hero, 'cta_button_2') ?: 'Book Meeting' }}</p>
                            <span>
                                {{ get_svg('arrow2') }}
                            </span>
                        </div>
                    </a>
                </div>

                {{-- partner badges --}}
                <div class="partner-badges-card">

                    {{-- Left 45% --}}
                    <div class="partner-card-left">
                        <p class="partner-label-text" style="font-size:11px;font-weight:400;color:#6B7280;margin:0;line-height:1;">{{ getTranslatedValue($wa_hero, 'partner_badge_label_1') ?: 'Official Partner of' }}</p>
                        <img src="{{ asset('frontend/assets/images/whatsapp-api/aisensy.png') }}"
                             alt="AiSensy" style="height:24px;width:auto;max-width:110px;object-fit:contain;object-position:left;">
                    </div>

                    {{-- Divider --}}
                    <div class="partner-card-divider"></div>

                    {{-- Right 55% --}}
                    <div class="partner-card-right">
                        <p class="partner-label-text" style="font-size:11px;font-weight:400;color:#6B7280;margin:0;line-height:1;">{{ getTranslatedValue($wa_hero, 'partner_badge_label_2') ?: 'Powered By' }}</p>
                        <div class="partner-card-row">

                            {{-- WhatsApp --}}
                            <div style="display:flex;align-items:center;gap:8px;">
                                <img src="{{ asset('frontend/assets/images/whatsapp-api/whatapp.png') }}"
                                     alt="WhatsApp" style="height:34px;width:34px;object-fit:contain;flex-shrink:0;">
                                <div style="line-height:1;">
                                    <p class="partner-name-text" style="font-size:13px;font-weight:700;color:#111827;margin:0;">WhatsApp</p>
                                    <p class="partner-sub-text" style="font-size:10px;color:#6B7280;margin:3px 0 0 0;">Business API</p>
                                </div>
                            </div>

                            {{-- Inner divider --}}
                            <div class="partner-card-divider partner-card-inner-divider" style="height:32px;margin:0 14px;"></div>

                            {{-- Meta --}}
                            <div style="display:flex;flex-direction:column;align-items:center;gap:4px;flex-shrink:0;">
                                <img src="{{ asset('frontend/assets/images/whatsapp-api/meta.png') }}"
                                     alt="Meta" style="height:20px;width:auto;object-fit:contain;flex-shrink:0;">
                                <p class="partner-sub-text" style="font-size:10px;color:#6B7280;margin:0;white-space:nowrap;line-height:1;">Business Partner</p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            {{-- RIGHT: hero image --}}
            <div class="image-area relative lg:h-full">
                <div class="lg:absolute relative 2xl:w-[752px] lg:w-[600px] w-full left-0 top-0 lg:h-full h-auto">

                    {{-- phone image with pills anchored relative to phone --}}
                    <div class="lg:absolute relative left-0 bottom-0 w-full z-10">
                        <div class="flex justify-center">
                            <div class="relative inline-block">
                                <img src="{{ asset('frontend/assets/images/whatsapp-api/whatsapp-hero.png') }}" alt="WhatsApp API Solutions" />

                                {{-- Bulk Msg — top right edge of phone --}}
                                <div class="absolute md:block hidden z-30 wa-float-rev" style="right: -55px; top: 12%;">
                                    <div class="flex items-center gap-2 bg-[#25D366] rounded-full rounded-bl-none pl-2 pr-4 py-2 shadow-common pop-card pop-d1">
                                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </div>
                                        <span class="text-xs font-bold text-white">{{ getTranslatedValue($wa_hero, 'pill_1') ?: 'Bulk Msg' }}</span>
                                    </div>
                                </div>

                                {{-- AI Chat BOT — left middle edge of phone --}}
                                <div class="absolute md:block hidden z-30 wa-float" style="left: -65px; top: 45%;">
                                    <div class="flex items-center gap-2 bg-[#25D366] rounded-full rounded-br-none pl-2 pr-4 py-2 shadow-common pop-card pop-d2">
                                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="11" width="18" height="10" rx="2" stroke="white" stroke-width="2"/><circle cx="12" cy="5" r="2" stroke="white" stroke-width="2"/><path d="M12 7v4M8 16h.01M16 16h.01" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>
                                        </div>
                                        <span class="text-xs font-bold text-white">{{ getTranslatedValue($wa_hero, 'pill_2') ?: 'AI Chat BOT' }}</span>
                                    </div>
                                </div>

                                {{-- AI Automation — bottom right edge of phone --}}
                                <div class="absolute md:block hidden z-30 wa-float-slow" style="right: -65px; bottom: 18%;">
                                    <div class="flex items-center gap-2 bg-[#25D366] rounded-full rounded-bl-none pl-2 pr-4 py-2 shadow-common pop-card pop-d3">
                                        <div class="size-7 rounded-full bg-white/25 flex items-center justify-center">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="3" stroke="white" stroke-width="2"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 11-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l-.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 110-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 114 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 110 4h-.09a1.65 1.65 0 00-1.51 1z" stroke="white" stroke-width="2"/></svg>
                                        </div>
                                        <span class="text-xs font-bold text-white">{{ getTranslatedValue($wa_hero, 'pill_3') ?: 'AI Automation' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- purple glow shadow oval --}}
                    <div class="absolute left-0 bottom-[60px] w-full md:block hidden pointer-events-none">
                        <div class="flex justify-center">
                            <div style="width:500px;height:540px;border-radius:50%;background:radial-gradient(ellipse at center, rgba(37,211,102,0.65) 0%, rgba(37,211,102,0.4) 35%, rgba(37,211,102,0.15) 65%, transparent 100%);filter:blur(22px);"></div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
