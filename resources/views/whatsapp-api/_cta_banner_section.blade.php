<style>
    @media (min-width: 768px) {
        .wa-cta-right-col {
            width: 360px;
            flex-shrink: 0;
        }
    }
</style>

<section class="w-full md:py-[100px] py-16">
    <div class="theme-container mx-auto">
        <div class="relative w-full rounded-[24px] overflow-hidden"
             style="background:
                        radial-gradient(120% 140% at 14% 18%, rgba(168,120,255,0.55) 0%, rgba(168,120,255,0) 52%),
                        radial-gradient(100% 120% at 92% 90%, rgba(70,20,200,0.45) 0%, rgba(70,20,200,0) 55%),
                        linear-gradient(135deg, #6E2AFF 0%, #6B21FF 48%, #5816D6 100%);
                    box-shadow: 0 24px 60px -20px rgba(107,33,255,0.45);">

            <div class="flex flex-col md:flex-row items-stretch">

                {{-- LEFT: image + text, takes all remaining width --}}
                <div class="flex-1 flex flex-col sm:flex-row items-center gap-6 sm:gap-8
                            px-8 md:px-10 py-10 md:py-12" data-aos="fade-right">

                    {{-- WhatsApp image --}}
                    <div class="flex-shrink-0">
                        <img src="{{ asset('frontend/assets/images/whatsapp-api/whatapp-bottom.png') }}"
                             alt="WhatsApp"
                             style="width:150px; height:150px; object-fit:contain; display:block;">
                    </div>

                    {{-- Text --}}
                    <div class="min-w-0">
                        <h2 class="font-bold text-white mb-3"
                            style="font-size:clamp(20px,2vw,30px); line-height:1.25;">
                            Ready to <span style="color:#7DFFB0;">Automate</span><br>
                            Customer Communication?
                        </h2>
                        <p class="mb-5"
                           style="color:rgba(255,255,255,0.78); font-size:13px; line-height:1.65;">
                            Let us help you build a smart WhatsApp Automation system that
                            improves engagement, support &amp; sales
                        </p>
                        {{-- Badges: forced into one row with nowrap --}}
                        <div style="display:flex; flex-direction:row; flex-wrap:nowrap; gap:10px;">
                            <div style="display:inline-flex; align-items:center; gap:6px;
                                        background:rgba(255,255,255,0.13);
                                        border:1px solid rgba(255,255,255,0.22);
                                        border-radius:999px; padding:6px 14px; white-space:nowrap;">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none">
                                    <path d="M23 6l-9.5 9.5-5-5L1 18" stroke="#7DFFB0" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17 6h6v6" stroke="#7DFFB0" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span style="color:#fff; font-size:11px; font-weight:600;">More Engagement</span>
                            </div>
                            <div style="display:inline-flex; align-items:center; gap:6px;
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

                {{-- Vertical divider --}}
                <div class="hidden md:block flex-shrink-0"
                     style="width:1px; background:rgba(255,255,255,0.18); margin:28px 0;"></div>

                {{-- RIGHT: card, pinned to far right at fixed 360px on desktop --}}
                <div class="wa-cta-right-col w-full flex items-center
                            px-8 md:px-8 py-8 md:py-0" data-aos="fade-left">
                    <div class="bg-white w-full"
                         style="border-radius:16px; padding:24px 28px;
                                box-shadow:0 12px 32px -10px rgba(0,0,0,0.22);">
                        <h3 class="font-bold text-gray-900 mb-2"
                            style="font-size:18px; line-height:1.3;">
                            Book your free consultation
                        </h3>
                        <p class="mb-5"
                           style="color:#6B7280; font-size:13px; line-height:1.6;">
                            Let's Discuss how we can help your Business grow with WhatsApp
                        </p>
                        <a href="{{ route('contact-us') }}"
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
