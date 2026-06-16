<style>
    /* ── Process Section ── */
    .wa-process-section {
        position: relative;
        overflow: hidden;
    }
    .wa-process-section::before {
        content: '';
        position: absolute;
        top: -200px; right: -200px;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(121,74,255,0.06) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .wa-process-section::after {
        content: '';
        position: absolute;
        bottom: -200px; left: -200px;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(106,0,255,0.05) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    /* ── Wrapper ── */
    .wa-process-wrapper {
        max-width: 860px;
        margin: 0 auto;
        position: relative;
        padding: 2px 0;
    }

    /* ── Track SVG ── */
    .wa-track {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
    }

    /* ── Row layout ── */
    .wa-step-row {
        display: flex;
        align-items: center;
        gap: 28px;
    }
    .wa-step-row--odd  { justify-content: flex-start; }
    .wa-step-row--even { justify-content: flex-end; }

    /* ── Per-step horizontal nudge to sit on S-curve ── */
    .wa-step-pos-1 { padding-left: 6%; }
    .wa-step-pos-2 { padding-right: 1%; }
    .wa-step-pos-3 { padding-left: 4%; }
    .wa-step-pos-4 { padding-right: 1%; }

    /* ── Step number circle ── */
    .wa-step-num {
        width: 90px; height: 90px; border-radius: 50%;
        background: linear-gradient(135deg, #f3eeff 0%, #e4d8ff 100%);
        border: 2.5px dashed rgba(121,74,255,0.45);
        display: flex; align-items: center; justify-content: center;
        font-size: 28px; font-weight: 800; color: #794AFF;
        flex-shrink: 0; z-index: 2; position: relative;
        transition: transform 0.3s ease;
    }
    .wa-step-row:hover .wa-step-num { transform: scale(1.08); }

    /* ── Step card ── */
    .wa-step-card {
        background-image: url('{{ asset('frontend/assets/images/whatsapp-api/rectangle.svg') }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        background-color: transparent;
        border: 1.5px solid rgba(121,74,255,0.22);
        border-radius: 20px;
        padding: 28px 32px;
        max-width: 520px;
        width: 100%;
        display: flex;
        align-items: center;
        gap: 20px;
        z-index: 2;
        position: relative;
        transition: transform 0.3s ease;
    }
    .wa-step-row:hover .wa-step-card { transform: translateY(-3px); }

    .wa-step-card h3 { font-size: 18px; font-weight: 700; margin-bottom: 6px; }
    .wa-step-card p  { font-size: 13px; line-height: 1.6; }

    /* ── Icon box ── */
    .wa-step-icon {
        width: 52px; height: 52px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        background: rgba(121,74,255,0.08);
        border-radius: 14px;
    }
    .wa-step-icon img { width: 36px; height: 36px; object-fit: contain; }

    /* ── Track follower ── */
    .wa-track-follower {
        position: absolute;
        width: 38px; height: 38px;
        transform: translate(-50%, -50%);
        z-index: 10;
        pointer-events: none;
        display: flex; align-items: center; justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .wa-follower-inner {
        width: 38px; height: 38px;
        display: flex; align-items: center; justify-content: center;
    }

    /* ── Spacers ── */
    .wa-spacer-0 { height: 190px; }
    .wa-spacer-1 { height: 155px; }
    .wa-spacer-2 { height: 190px; }

    /* ════════════════════════════════════════
       RESPONSIVE — same layout, scaled down
    ════════════════════════════════════════ */

    /* Tablet: 768px – 1023px */
    @media (max-width: 1023px) {
        .wa-process-wrapper { max-width: 680px; }
        .wa-step-num  { width: 72px; height: 72px; font-size: 22px; }
        .wa-step-card { padding: 20px 24px; border-radius: 16px; max-width: 420px; }
        .wa-step-card h3 { font-size: 16px; }
        .wa-step-card p  { font-size: 12px; }
        .wa-step-icon { width: 44px; height: 44px; border-radius: 12px; }
        .wa-step-icon img { width: 28px; height: 28px; }
        .wa-step-row  { gap: 20px; }
        .wa-spacer-0  { height: 150px; }
        .wa-spacer-1  { height: 122px; }
        .wa-spacer-2  { height: 150px; }
        .wa-track-follower, .wa-follower-inner { width: 32px; height: 32px; }
        .wa-track-follower svg { width: 32px; height: 32px; }
    }

    /* Large mobile: 480px – 767px */
    @media (max-width: 767px) {
        .wa-process-wrapper { max-width: 100%; }
        .wa-step-num  { width: 54px; height: 54px; font-size: 16px; border-width: 2px; }
        .wa-step-card { padding: 14px 16px; border-radius: 14px; max-width: none; flex: 1; gap: 12px; }
        .wa-step-card h3 { font-size: 14px; margin-bottom: 4px; }
        .wa-step-card p  { font-size: 11px; line-height: 1.5; }
        .wa-step-icon { width: 36px; height: 36px; border-radius: 10px; }
        .wa-step-icon img { width: 22px; height: 22px; }
        .wa-step-row  { gap: 10px; }
        .wa-step-pos-1 { padding-left: 3%; }
        .wa-step-pos-3 { padding-left: 2%; }
        .wa-spacer-0  { height: 110px; }
        .wa-spacer-1  { height: 90px; }
        .wa-spacer-2  { height: 110px; }
        .wa-track-follower, .wa-follower-inner { width: 26px; height: 26px; }
        .wa-track-follower svg { width: 26px; height: 26px; }
    }

    /* Small mobile: 360px – 479px */
    @media (max-width: 479px) {
        .wa-step-num  { width: 42px; height: 42px; font-size: 13px; border-width: 1.5px; }
        .wa-step-card { padding: 10px 12px; border-radius: 12px; gap: 8px; }
        .wa-step-card h3 { font-size: 12px; margin-bottom: 3px; }
        .wa-step-card p  { font-size: 10px; }
        .wa-step-icon { width: 28px; height: 28px; border-radius: 8px; }
        .wa-step-icon img { width: 17px; height: 17px; }
        .wa-step-row  { gap: 7px; }
        .wa-step-pos-1, .wa-step-pos-3 { padding-left: 1%; }
        .wa-spacer-0  { height: 80px; }
        .wa-spacer-1  { height: 65px; }
        .wa-spacer-2  { height: 80px; }
        .wa-track-follower, .wa-follower-inner { width: 22px; height: 22px; }
        .wa-track-follower svg { width: 22px; height: 22px; }
    }

    /* Extra small: < 360px */
    @media (max-width: 359px) {
        .wa-step-num  { width: 34px; height: 34px; font-size: 11px; }
        .wa-step-card { padding: 8px 10px; border-radius: 10px; gap: 6px; }
        .wa-step-card h3 { font-size: 11px; }
        .wa-step-card p  { font-size: 9px; }
        .wa-step-icon { width: 24px; height: 24px; border-radius: 6px; }
        .wa-step-icon img { width: 14px; height: 14px; }
        .wa-step-row  { gap: 5px; }
        .wa-spacer-0  { height: 64px; }
        .wa-spacer-1  { height: 52px; }
        .wa-spacer-2  { height: 64px; }
    }
</style>

<section class="w-full bg-white md:py-[100px] py-16 wa-process-section">
    <div class="theme-container mx-auto">

        {{-- heading --}}
        <div class="flex flex-col items-center mb-14 md:mb-16">
            <span class="text-[#25D366] text-sm font-semibold tracking-wide mb-2 uppercase">Our work process</span>
            <h2 class="md:text-48 text-34 font-bold text-main-black text-center">
                Simple Steps, <span class="text-purple">Powerful Result</span>
            </h2>
        </div>

        @php
            $steps = [
                [
                    'num'  => '01',
                    'title'=> 'Understanding',
                    'desc' => 'We understand your business, audience, and communication goals to create the right automation strategy.',
                    'img'  => 'whatsapp-api/idea.png',
                ],
                [
                    'num'  => '02',
                    'title'=> 'Setup & Automation',
                    'desc' => 'We set up the WhatsApp API, chatbot flows, campaigns, and automation systems for your business.',
                    'img'  => 'whatsapp-api/gear.png',
                ],
                [
                    'num'  => '03',
                    'title'=> 'Campaign & Engagement',
                    'desc' => 'We help you run campaigns, automate customer interactions, and improve engagement efficiently.',
                    'img'  => 'whatsapp-api/campaign.png',
                ],
                [
                    'num'  => '04',
                    'title'=> 'Optimize & Grow',
                    'desc' => 'We analyze performance, optimize workflows, and scale your WhatsApp communication system for better results.',
                    'img'  => 'whatsapp-api/diagram 1.png',
                ],
            ];

            /*
                S-curve anchor points (viewBox 997x1412) calculated from step positions:
                Step 01 center ~6%  of height → y=83,  x=116  (left side)
                Step 02 center ~36% of height → y=514, x=939  (right side)
                Step 03 center ~64% of height → y=898, x=93   (left side)
                Step 04 center ~94% of height → y=1329, x=939 (right side)
                Spacers [190, 155, 190] are tuned so steps land at these proportions.
            */
        @endphp

        <div class="wa-process-wrapper">

            {{-- S-curve track — path anchor points match circle centres --}}
            <svg class="wa-track" viewBox="0 0 997 1412" fill="none" xmlns="http://www.w3.org/2000/svg"
                 preserveAspectRatio="none" style="overflow:visible;">
                <defs>
                    <linearGradient id="waTrackGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%"   stop-color="#794AFF" stop-opacity="0.55"/>
                        <stop offset="50%"  stop-color="#a87aff" stop-opacity="0.35"/>
                        <stop offset="100%" stop-color="#794AFF" stop-opacity="0.55"/>
                    </linearGradient>
                </defs>
                <path d="M116 83 C60 320 970 270 939 514 C970 740 50 680 93 898 C50 1140 970 1090 939 1329"
                      stroke="url(#waTrackGrad)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="9 9" fill="none"/>
            </svg>

            {{-- Scroll follower icon --}}
            <div class="wa-track-follower" id="waTrackFollower" style="left:0;top:0;">
                <div class="wa-follower-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="38" height="38" viewBox="0 0 512 512" xml:space="preserve"><g><linearGradient id="waRocketA" x1="164.85" x2="97.42" y1="415" y2="347.57" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#fe7838"></stop><stop offset=".54" stop-color="#fe7636"></stop><stop offset="1" stop-color="#ffad8a"></stop></linearGradient><linearGradient id="waRocketB" x1="389.98" x2="212.92" y1="299.5" y2="122.44" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#6f2efe"></stop><stop offset=".52" stop-color="#6f2efe"></stop><stop offset="1" stop-color="#ae90ff"></stop></linearGradient><g><path fill="#f2eeff" d="M496.52 129.86C483.09 80.38 431.63 28.92 382.15 15.49 351.82 7.92 311.17.13 256 0c-55.16.14-95.81 7.92-126.14 15.49C80.38 28.93 28.92 80.38 15.49 129.86 7.92 160.19.14 200.84 0 256c.14 55.17 7.92 95.82 15.49 126.15 13.43 49.48 64.89 100.93 114.37 114.37 30.33 7.57 71 15.35 126.14 15.49 55.17-.14 95.82-7.92 126.15-15.49 49.48-13.44 100.94-64.89 114.37-114.37 7.57-30.33 15.35-71 15.49-126.15-.14-55.16-7.92-95.81-15.49-126.14z" opacity="1"></path><path fill="url(#waRocketA)" d="M174.29 405.56a47.68 47.68 0 0 0-67.43-67.43c-13.27 13.26-18.49 33.81-20.15 52.43a166.88 166.88 0 0 0 .18 31.65 3.89 3.89 0 0 0 3.26 3.31h.12c1.07 0 16.31.35 21-14.49a30.26 30.26 0 0 1 3.68-7.83 5.15 5.15 0 0 1 9.37 3.62 25.27 25.27 0 0 0 3.32 16.29 3.17 3.17 0 0 0 3.2 1.52c15.93-2.43 32.27-7.89 43.45-19.07z" opacity="1"></path><path fill="url(#waRocketB)" d="M425.64 116.16c-1-16.56-12.82-28.39-29.37-29.38-56.27-3.35-118.91 20.49-167.78 69.37l-13 13q-7 7-13.39 14.45H161a25.51 25.51 0 0 0-20.8 12.75L116 244.71a25 25 0 0 0-1.35 5.37 11.89 11.89 0 0 0 11.75 11.75H157c-4 13.33-1.32 26.44 7.15 34.91l51.58 51.58c8.47 8.47 21.58 11.11 34.91 7.15V386a11.89 11.89 0 0 0 11.75 11.75 25.57 25.57 0 0 0 5.37-1.34L316 372.26a25.54 25.54 0 0 0 12.75-20.81v-41.09q7.42-6.36 14.49-13.36l13-13c48.91-48.94 72.76-111.61 69.4-167.84zM369.35 212a48.73 48.73 0 1 1 0-68.91 48.72 48.72 0 0 1 0 68.91z" opacity="1"></path></g></g></svg>
                </div>
            </div>

            {{-- Steps --}}
            <div class="flex flex-col relative" style="z-index:2;">

                @foreach($steps as $index => $step)
                    @php $isEven = ($index + 1) % 2 == 0; @endphp

                    <div class="wa-step-row {{ $isEven ? 'wa-step-row--even' : 'wa-step-row--odd' }} wa-step-pos-{{ $index + 1 }}">

                        @if(!$isEven)
                            {{-- ODD: circle LEFT, card RIGHT --}}
                            <div class="wa-step-num">{{ $step['num'] }}</div>
                            <div class="wa-step-card">
                                <div class="flex-1">
                                    <h3 class="font-bold text-main-black text-xl mb-2">{{ $step['title'] }}</h3>
                                    <p class="text-paragraph text-sm leading-6">{{ $step['desc'] }}</p>
                                </div>
                                <div class="wa-step-icon">
                                    <img src="{{ asset('frontend/assets/images/' . $step['img']) }}"
                                         alt="{{ $step['title'] }}" width="36" height="36"
>
                                </div>
                            </div>
                        @else
                            {{-- EVEN: card LEFT, circle RIGHT --}}
                            <div class="wa-step-card">
                                <div class="wa-step-icon">
                                    <img src="{{ asset('frontend/assets/images/' . $step['img']) }}"
                                         alt="{{ $step['title'] }}" width="36" height="36"
>
                                </div>
                                <div class="flex-1 md:text-right">
                                    <h3 class="font-bold text-main-black text-xl mb-2">{{ $step['title'] }}</h3>
                                    <p class="text-paragraph text-sm leading-6">{{ $step['desc'] }}</p>
                                </div>
                            </div>
                            <div class="wa-step-num">{{ $step['num'] }}</div>
                        @endif

                    </div>

                    @if(!$loop->last)
                        <div class="wa-spacer-{{ $index }}"></div>
                    @endif

                @endforeach

            </div>
        </div>

    </div>
</section>

<script>
(function () {
    function initTrackFollower() {
        var wrapper  = document.querySelector('.wa-process-wrapper');
        var follower = document.getElementById('waTrackFollower');
        var trackSvg = document.querySelector('.wa-track');

        if (!wrapper || !follower || !trackSvg) return;

        var path = trackSvg.querySelectorAll('path');
        var trackPath = path[path.length - 1];
        if (!trackPath) return;

        var totalLen = trackPath.getTotalLength();

        function update() {
            var rect    = wrapper.getBoundingClientRect();
            var wrapH   = wrapper.offsetHeight;
            var wrapW   = wrapper.offsetWidth;
            var viewH   = window.innerHeight;

            // progress 0→1 as wrapper scrolls through viewport
            var scrolled = viewH * 0.5 - rect.top;
            var progress = scrolled / wrapH;

            // Only show while inside the section
            if (progress <= 0 || progress >= 1) {
                follower.style.opacity = '0';
                return;
            }
            follower.style.opacity = '1';

            progress = Math.min(Math.max(progress, 0), 1);
            var len = progress * totalLen;
            var pt  = trackPath.getPointAtLength(len);

            // Tangent angle — look slightly ahead on path
            var delta   = Math.min(15, totalLen - len);
            var ptAhead = trackPath.getPointAtLength(Math.min(len + delta, totalLen));
            var angle   = Math.atan2(ptAhead.y - pt.y, ptAhead.x - pt.x) * 180 / Math.PI;

            // Rocket nose points northeast (−45° in screen coords), so offset = +45
            var rotation = angle + 45;

            // Scale SVG viewBox (997×1412) → wrapper pixels
            var x = pt.x * wrapW / 997;
            var y = pt.y * wrapH / 1412;

            follower.style.left      = x + 'px';
            follower.style.top       = y + 'px';
            follower.style.transform = 'translate(-50%, -50%) rotate(' + rotation + 'deg)';
        }

        window.addEventListener('scroll', update, { passive: true });
        window.addEventListener('resize', update, { passive: true });
        update();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTrackFollower);
    } else {
        initTrackFollower();
    }
})();
</script>
