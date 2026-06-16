<style>
    /* Desktop ≥768px: horizontal two-column */
    .wa-cta-right-col { width: 360px; flex-shrink: 0; }
    .wa-cta-outer { flex-direction: row; }

    /* Tablet 768–1023px: horizontal, scaled down */
    @media (max-width: 1023px) {
        .wa-cta-right-col { width: 280px; }
        .wa-cta-banner-wrap { border-radius: 18px; }
        .wa-cta-left-pad { padding: 28px 24px !important; gap: 20px !important; }
        .wa-cta-right-pad { padding: 0 20px !important; }
        .wa-cta-wa-img { width: 100px !important; height: 100px !important; }
        .wa-cta-heading { font-size: 20px !important; }
        .wa-cta-desc { font-size: 12px !important; margin-bottom: 12px !important; }
        .wa-cta-badge { padding: 5px 11px !important; }
        .wa-cta-badge span { font-size: 10px !important; }
        .wa-cta-card { border-radius: 12px !important; padding: 18px 18px !important; }
        .wa-cta-card-title { font-size: 14px !important; }
        .wa-cta-card-desc { font-size: 11px !important; }
        .wa-cta-btn { padding: 10px 14px !important; font-size: 11px !important; }
        .wa-cta-divider-v { margin: 20px 0 !important; }
    }

    /* Mobile <768px: stack vertically, card goes below */
    @media (max-width: 767px) {
        .wa-cta-outer { flex-direction: column !important; }
        .wa-cta-right-col { width: 100% !important; }
        .wa-cta-banner-wrap { border-radius: 14px; }
        .wa-cta-left-pad { padding: 24px 20px !important; gap: 14px !important; }
        .wa-cta-right-pad { padding: 0 20px 24px !important; }
        .wa-cta-wa-img { width: 72px !important; height: 72px !important; }
        .wa-cta-heading { font-size: 18px !important; line-height: 1.3 !important; }
        .wa-cta-desc { font-size: 12px !important; margin-bottom: 10px !important; }
        .wa-cta-badges { flex-wrap: wrap !important; }
        .wa-cta-badge { padding: 5px 12px !important; }
        .wa-cta-badge span { font-size: 10px !important; }
        .wa-cta-card { border-radius: 12px !important; padding: 18px 20px !important; }
        .wa-cta-card-title { font-size: 15px !important; }
        .wa-cta-card-desc { font-size: 12px !important; }
        .wa-cta-btn { padding: 11px 18px !important; font-size: 12px !important; }
        .wa-cta-divider-v { display: none !important; }
        .wa-cta-divider-h { display: block !important; }
    }

    /* Small mobile <480px */
    @media (max-width: 479px) {
        .wa-cta-left-pad { padding: 20px 16px !important; gap: 12px !important; }
        .wa-cta-right-pad { padding: 0 16px 20px !important; }
        .wa-cta-wa-img { width: 56px !important; height: 56px !important; }
        .wa-cta-heading { font-size: 15px !important; }
        .wa-cta-desc { font-size: 11px !important; }
        .wa-cta-card { padding: 14px 16px !important; border-radius: 10px !important; }
        .wa-cta-card-title { font-size: 13px !important; }
        .wa-cta-card-desc { font-size: 11px !important; }
        .wa-cta-btn { padding: 10px 16px !important; font-size: 11px !important; }
    }

    /* Horizontal divider (mobile only, hidden by default) */
    .wa-cta-divider-h { display: none; height: 1px; background: rgba(255,255,255,0.18); margin: 0 20px; }
</style>

<section class="w-full md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="wa-cta-banner-wrap relative w-full overflow-hidden"
             style="border-radius:24px;
                    background:
                        radial-gradient(120% 140% at 14% 18%, rgba(168,120,255,0.55) 0%, rgba(168,120,255,0) 52%),
                        radial-gradient(100% 120% at 92% 90%, rgba(70,20,200,0.45) 0%, rgba(70,20,200,0) 55%),
                        linear-gradient(135deg, #6E2AFF 0%, #6B21FF 48%, #5816D6 100%);
                    box-shadow: 0 24px 60px -20px rgba(107,33,255,0.45);">

            <div class="wa-cta-outer flex items-stretch">

                {{-- LEFT: image + text --}}
                <div class="wa-cta-left-pad flex-1 flex flex-row items-center"
                     style="gap:28px; padding:48px 40px;"
                     data-aos="fade-right">

                    {{-- WhatsApp image --}}
                    <div class="flex-shrink-0">
                        <img src="{{ asset('frontend/assets/images/whatsapp-api/whatapp-bottom.png') }}"
                             alt="WhatsApp"
                             class="wa-cta-wa-img"
                             style="width:150px; height:150px; object-fit:contain; display:block;">
                    </div>

                    {{-- Text --}}
                    <div class="min-w-0">
                        <h2 class="wa-cta-heading font-bold text-white mb-3"
                            style="font-size:28px; line-height:1.25;">
                            Ready to <span style="color:#7DFFB0;">Automate</span><br>
                            Customer Communication?
                        </h2>
                        <p class="wa-cta-desc mb-5"
                           style="color:rgba(255,255,255,0.78); font-size:13px; line-height:1.65;">
                            Let us help you build a smart WhatsApp Automation system that
                            improves engagement, support &amp; sales
                        </p>
                        {{-- Badges --}}
                        <div class="wa-cta-badges" style="display:flex; flex-direction:row; flex-wrap:nowrap; gap:10px;">
                            <div class="wa-cta-badge" style="display:inline-flex; align-items:center; gap:6px;
                                        background:rgba(255,255,255,0.13);
                                        border:1px solid rgba(255,255,255,0.22);
                                        border-radius:999px; padding:6px 14px; white-space:nowrap;">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none">
                                    <path d="M23 6l-9.5 9.5-5-5L1 18" stroke="#7DFFB0" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17 6h6v6" stroke="#7DFFB0" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span style="color:#fff; font-size:11px; font-weight:600;">More Engagement</span>
                            </div>
                            <div class="wa-cta-badge" style="display:inline-flex; align-items:center; gap:6px;
                                        background:rgba(255,255,255,0.13);
                                        border:1px solid rgba(255,255,255,0.22);
                                        border-radius:999px; padding:6px 14px; white-space:nowrap;">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none">
                                    <path d="M23 6l-9.5 9.5-5-5L1 18" stroke="#7DFFB0" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17 6h6v6" stroke="#7DFFB0" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span style="color:#fff; font-size:11px; font-weight:600;">Higher Conversion</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Vertical divider (desktop/tablet only) --}}
                <div class="wa-cta-divider-v flex-shrink-0"
                     style="width:1px; background:rgba(255,255,255,0.18); margin:28px 0;"></div>

                {{-- Horizontal divider (mobile only) --}}
                <div class="wa-cta-divider-h"></div>

                {{-- RIGHT: consultation card --}}
                <div class="wa-cta-right-col wa-cta-right-pad flex items-center"
                     style="padding:0 32px;"
                     data-aos="fade-left">
                    <div class="wa-cta-card bg-white w-full"
                         style="border-radius:16px; padding:24px 28px;
                                box-shadow:0 12px 32px -10px rgba(0,0,0,0.22);">
                        <h3 class="wa-cta-card-title font-bold text-gray-900 mb-2"
                            style="font-size:18px; line-height:1.3;">
                            Book your free consultation
                        </h3>
                        <p class="wa-cta-card-desc mb-5"
                           style="color:#6B7280; font-size:13px; line-height:1.6;">
                            Let's Discuss how we can help your Business grow with WhatsApp
                        </p>
                        <a href="{{ route('contact-us') }}"
                           class="wa-cta-btn"
                           style="display:flex; align-items:center; justify-content:space-between;
                                  gap:12px; background:#25D366; color:#fff; font-weight:700;
                                  font-size:13px; border-radius:999px; padding:12px 20px;
                                  text-decoration:none; transition:opacity 0.3s;"
                           onmouseover="this.style.opacity='0.9'"
                           onmouseout="this.style.opacity='1'">
                            <span>Book free consultation</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M5 12H19M19 12L13 6M19 12L13 18"
                                      stroke="white" stroke-width="2.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
