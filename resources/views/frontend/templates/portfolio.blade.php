@extends('inner_layout')
@section('title')
    <title>{{ __('Portfolio') }}</title>
    <meta name="title" content="{{ __('Portfolio') }}" />
    <meta name="description" content="{{ __('Portfolio Page') }}" />
@endsection

@push('style_section')
<style>
    /* Aurora background is animated each frame by JS; #020617 is the dark base */
    #pf-aurora-bg { background: #020617; }
    /* Override custom-heading text colour for dark aurora background */
    #pf-aurora-bg .custom-heading { color: #fff; }
    /* Portfolio grid section — ensure dark heading on white bg */
    #portfolio-grid .custom-heading { color: #161519; }
    /* Aurora CTA button — border + shadow driven by JS */
    #pf-aurora-cta {
        display:inline-flex; align-items:center; gap:10px;
        padding:14px 32px; border-radius:50px;
        background: rgba(2,6,23,0.15);
        color:#fff; font-weight:700; font-size:14px;
        letter-spacing:.08em; text-transform:uppercase;
        transition: background .3s, transform .2s;
        cursor:pointer; text-decoration:none;
    }
    #pf-aurora-cta:hover  { background: rgba(2,6,23,0.50); transform:scale(1.015); }
    #pf-aurora-cta:active { transform:scale(0.985); }
    #pf-aurora-cta .pf-cta-arrow {
        transition: transform .25s;
    }
    #pf-aurora-cta:hover .pf-cta-arrow { transform: rotate(-45deg); }
    .pf-tab {
        padding:11px 26px; border-radius:50px; font-weight:600; font-size:14px;
        color:#6D6D6D; background:#fff; border:1px solid rgba(121,74,255,.15);
        transition:all .25s; cursor:pointer; white-space:nowrap;
    }
    .pf-tab:hover { border-color:#794AFF; color:#794AFF; }
    .pf-tab.tab-active { background:#794AFF; color:#fff; border-color:#794AFF; box-shadow:0 8px 20px rgba(121,74,255,.3); }

    .pf-card { border-radius:16px; overflow:hidden; background:#fff; box-shadow:0 4px 20px rgba(121,74,255,.08); transition:transform .35s, box-shadow .35s; }
    .pf-card:hover { transform:translateY(-6px); box-shadow:0 14px 38px rgba(121,74,255,.18); }
    .pf-thumb { position:relative; overflow:hidden; aspect-ratio:4/3; background:#0e0b20; cursor:pointer; }
    .pf-thumb img,
    .pf-thumb video { width:100%; height:100%; object-fit:cover; transition:transform .5s ease; display:block; }
    .pf-card:hover .pf-thumb img,
    .pf-card:hover .pf-thumb video { transform:scale(1.07); }
    .pf-thumb-overlay { position:absolute; inset:0; background:linear-gradient(to top, rgba(12,8,30,.55) 0%, transparent 55%); }
    .pf-play-btn {
        position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);
        width:54px; height:54px; border-radius:50%; background:rgba(255,255,255,.92);
        display:flex; align-items:center; justify-content:center;
        box-shadow:0 8px 24px rgba(0,0,0,.25); transition:transform .3s;
        border:none; cursor:pointer;
    }
    .pf-card:hover .pf-play-btn { transform:translate(-50%,-50%) scale(1.12); }

    /* Modal */
    #pf-media-modal {
        display:flex; position:fixed; inset:0;
        background:rgba(0,0,0,.85); z-index:9999;
        align-items:center; justify-content:center;
        opacity:0; visibility:hidden; transition:opacity .3s, visibility .3s;
    }
    #pf-media-modal.open { opacity:1; visibility:visible; }
    #pf-modal-close {
        position:absolute; top:20px; right:28px;
        background:none; border:none; color:#fff; font-size:32px;
        line-height:1; cursor:pointer; opacity:.85; transition:opacity .2s;
    }
    #pf-modal-close:hover { opacity:1; }
    #pf-modal-inner {
        position:relative; width:90vw; max-width:1100px;
        background:#000; border-radius:12px; overflow:hidden;
    }
    #pf-modal-inner iframe,
    #pf-modal-inner video,
    #pf-modal-inner img {
        width:100%; display:block;
        aspect-ratio:16/9; object-fit:contain;
    }
    #pf-modal-inner img { background:#111; }

    /* Portrait video in modal */
    #pf-modal-inner.portrait { max-width:420px; }
    #pf-modal-inner.portrait iframe,
    #pf-modal-inner.portrait video { aspect-ratio:9/16; }

    /* ── Shimmer skeleton ── */
    .pf-shimmer {
        border-radius:16px; overflow:hidden;
        background:#fff; box-shadow:0 4px 20px rgba(121,74,255,.08);
    }
    .pf-shimmer-thumb { aspect-ratio:4/3; }
    .pf-shimmer-thumb,
    .pf-shimmer-line {
        background:linear-gradient(90deg,#f3f0ff 25%,#e4dcff 50%,#f3f0ff 75%);
        background-size:200% 100%;
        animation:pfShimmer 1.5s infinite linear;
        border-radius:4px;
    }
    @keyframes pfShimmer {
        0%   { background-position:200% 0; }
        100% { background-position:-200% 0; }
    }

    /* ── Card reveal (load more batch) ── */
    .pf-card-reveal {
        animation:pfReveal .45s cubic-bezier(.22,.61,.36,1) both;
    }
    @keyframes pfReveal {
        from { opacity:0; transform:translateY(20px); }
        to   { opacity:1; transform:translateY(0); }
    }

    /* ── Load more: blur fade + floating arrow ── */
    #pf-load-more-wrap {
        position:relative; margin-top:-220px; z-index:20;
    }
    #pf-blur-fade {
        height:260px;
        background:linear-gradient(
            to bottom,
            transparent 0%,
            rgba(255,255,255,.55) 35%,
            rgba(255,255,255,.90) 65%,
            #ffffff 100%
        );
        pointer-events:none;
        backdrop-filter: blur(2px);
        -webkit-backdrop-filter: blur(2px);
    }
    #pf-arrow-wrap {
        text-align:center; margin-top:-16px; padding-bottom:16px;
        display:flex; flex-direction:column; align-items:center; gap:6px;
    }
    #pf-load-more {
        display:inline-flex; align-items:center; justify-content:center;
        background:none; border:none; padding:0; cursor:pointer;
        transition:transform .25s, opacity .25s;
    }
    #pf-load-more:hover {
        transform:translateY(6px);
        opacity:.75;
    }
    #pf-load-more:disabled {
        opacity:.30; cursor:not-allowed; transform:none;
    }
    #pf-load-more:not(:disabled) svg { animation:pfArrowBounce 1.4s ease-in-out infinite; }
    #pf-count-text {
        display:block;
        font-size:11px; color:#9D7BFF; font-weight:600; letter-spacing:.10em;
        text-transform:uppercase;
    }
    #pf-count-text.loading-pulse {
        animation: pfCountPulse .6s ease-in-out infinite alternate;
    }
    @keyframes pfArrowBounce {
        0%,100% { transform:translateY(0); }
        50%      { transform:translateY(8px); }
    }
    @keyframes pfCountPulse {
        from { opacity:.4; } to { opacity:1; }
    }
    #pf-scroll-sentinel { height:1px; }
</style>
@endpush

@section('frontend_content')
    <main>

        {{-- ===================== HERO — Aurora + Starfield ===================== --}}
        <section id="home-one-hero">
        <div class="hero-one-section-wrapper w-full xl:h-[905px] overflow-hidden relative" id="pf-aurora-bg">

            {{-- Stars canvas (fills entire hero, z-index 1) --}}
            <canvas id="pf-aurora-canvas" class="absolute inset-0 w-full h-full" style="z-index:1;pointer-events:none;"></canvas>

            {{-- Content --}}
            <div class="theme-container mx-auto h-full relative pointer-events-none" style="z-index:3;">
                <div class="flex flex-col items-center justify-center xl:pt-[223px] pt-[130px] xl:pb-0 pb-10 h-full text-center">
                    <div class="pointer-events-auto" data-aos="fade-up">

                        {{-- Badge — pulsing dot pill matching WD hero --}}
                        <div class="inline-flex items-center gap-2.5 bg-white/10 border border-white/20 rounded-full px-5 py-2.5 mb-6 shadow-sm">
                            <span class="flex size-2 relative">
                                <span class="animate-ping absolute inline-flex size-2 rounded-full bg-purple opacity-75"></span>
                                <span class="relative inline-flex size-2 rounded-full bg-purple"></span>
                            </span>
                            <span class="text-white text-sm font-semibold tracking-wide">Creative Portfolio</span>
                        </div>

                        {{-- Title — custom-heading (Agency font) with white colour --}}
                        <h1 class="custom-heading text-center mb-7" style="font-weight:400 !important;">
                            Our <span>Creative</span> Portfolio
                        </h1>

                        {{-- Description --}}
                        <p class="text-white/60 text-base md:text-lg leading-8 max-w-[640px] mx-auto mb-10">
                            Explore our recent works in
                            <span class="text-white/90 font-semibold">Branding</span>,
                            <span class="text-white/90 font-semibold">Web Development</span>,
                            <span class="text-white/90 font-semibold">Ad Films</span>,
                            <span class="text-white/90 font-semibold">Creative Content</span>, and
                            <span class="text-white/90 font-semibold">Digital Marketing</span>.
                        </p>

                        {{-- CTA — border + box-shadow animated by aurora JS --}}
                        <a id="pf-aurora-cta" href="#portfolio-grid">
                            Browse Work
                            <svg class="pf-cta-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M13 6l6 6-6 6"/>
                            </svg>
                        </a>

                    </div>
                </div>
            </div>
        </div>
        </section>

        {{-- ===================== PORTFOLIO GRID ===================== --}}
        <section class="w-full bg-white md:py-[90px] py-14" id="portfolio-grid">
            <div class="theme-container mx-auto">
                <div class="flex flex-col items-center mb-9" data-aos="fade-up">
                    {{-- Pulsing badge — same style as web-development hero --}}
                    <div class="inline-flex items-center gap-2.5 bg-white border border-purple/15 rounded-full px-5 py-2.5 mb-6 shadow-sm">
                        <span class="flex size-2 relative">
                            <span class="animate-ping absolute inline-flex size-2 rounded-full bg-purple opacity-75"></span>
                            <span class="relative inline-flex size-2 rounded-full bg-purple"></span>
                        </span>
                        <span class="text-purple text-sm font-semibold tracking-wide">Our Portfolio</span>
                    </div>
                    {{-- Heading — custom-heading class (Agency font, 65px) matching WD page --}}
                    <h2 class="custom-heading text-center" style="font-weight:400 !important;">
                        Browse our <span>Creative</span> Work
                    </h2>
                </div>


                @php
                    $allItems = collect();
                    foreach($portfolioCategories as $cat) {
                        foreach($cat->items as $item) {
                            $item->category_slug = \Illuminate\Support\Str::slug($cat->name);
                            $item->category_name = $cat->name;
                            $allItems->push($item);
                        }
                    }
                @endphp

                @if($portfolioCategories->count())
                {{-- Category filter tabs --}}
                <div class="flex flex-wrap items-center justify-center gap-3 md:gap-4 mb-12" data-aos="fade-up">
                    <button class="pf-tab tab-active" data-filter="all">All Projects</button>
                    @foreach($portfolioCategories as $cat)
                        <button class="pf-tab" data-filter="{{ \Illuminate\Support\Str::slug($cat->name) }}">{{ $cat->name }}</button>
                    @endforeach
                </div>

                {{-- Grid --}}
                <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6" id="pf-grid-inner">
                    @foreach($allItems as $item)
                    @php
                        $thumb = $item->thumbnail
                            ?: ($item->type === 'image' ? $item->content_source : null);
                        $isVideo = in_array($item->type, ['video', 'bunny']);
                    @endphp
                    <div class="pf-card portfolio-card" data-category="{{ $item->category_slug }}" style="display:none">
                        <div class="pf-thumb"
                             @if($isVideo)
                                 data-modal-type="{{ $item->type }}"
                                 data-modal-src="{{ $item->content_source }}"
                                 onclick="openPfModal(this)"
                             @else
                                 data-modal-type="image"
                                 data-modal-src="{{ $item->content_source }}"
                                 onclick="openPfModal(this)"
                             @endif
                        >
                            @if($thumb)
                                <img src="{{ $thumb }}" alt="{{ $item->title }}" loading="lazy" />
                            @elseif($item->type === 'video')
                                <video src="{{ $item->content_source }}" muted preload="none" style="pointer-events:none;"></video>
                            @else
                                <div style="width:100%;height:100%;background:#1a1432;display:flex;align-items:center;justify-content:center;">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none"><rect width="24" height="24" rx="4" fill="#794AFF" opacity=".2"/><path d="M8 5v14l11-7z" fill="#794AFF"/></svg>
                                </div>
                            @endif
                            <div class="pf-thumb-overlay"></div>
                            @if($isVideo)
                            <button class="pf-play-btn" type="button" aria-label="Play video">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="#794AFF"><path d="M8 5v14l11-7z"/></svg>
                            </button>
                            @else
                            <button class="pf-play-btn" type="button" aria-label="View image">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#794AFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
                            </button>
                            @endif
                        </div>
                        <div class="p-5">
                            <p class="text-purple text-[11px] font-bold uppercase tracking-wider mb-1.5">{{ $item->category_name }}</p>
                            <p class="font-bold text-main-black text-base mb-1">{{ $item->title ?: $item->category_name }}</p>
                            @if($item->description)
                            <p class="text-paragraph text-xs leading-5">{{ $item->description }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Shimmer skeleton grid (shown while loading next batch) --}}
                <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6 mt-6" id="pf-shimmer-grid" style="display:none">
                    @for($si = 0; $si < 8; $si++)
                    <div class="pf-shimmer">
                        <div class="pf-shimmer-thumb"></div>
                        <div class="p-5">
                            <div class="pf-shimmer-line mb-3" style="width:38%;height:10px"></div>
                            <div class="pf-shimmer-line mb-2" style="width:72%;height:14px"></div>
                            <div class="pf-shimmer-line mb-1.5" style="width:90%;height:10px"></div>
                            <div class="pf-shimmer-line" style="width:65%;height:10px"></div>
                        </div>
                    </div>
                    @endfor
                </div>

                {{-- Empty state --}}
                <p id="pf-empty" class="hidden text-center text-paragraph py-12">No projects found in this category.</p>

                {{-- Load more: gradient blur fade + floating arrow + scroll sentinel --}}
                <div id="pf-load-more-wrap" style="display:none">
                    {{-- blur gradient overlaps the last row of cards --}}
                    <div id="pf-blur-fade"></div>
                    {{-- floating bold chevron arrow + count label --}}
                    <div id="pf-arrow-wrap">
                        <button id="pf-load-more" type="button" aria-label="Load more projects">
                            <svg width="52" height="52" viewBox="0 0 24 24" fill="none"
                                 stroke="#794AFF" stroke-width="3.5"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 8l7 7 7-7"/>
                            </svg>
                        </button>
                        <span id="pf-count-text"></span>
                    </div>
                    {{-- invisible sentinel watched by IntersectionObserver --}}
                    <div id="pf-scroll-sentinel"></div>
                </div>

                @else
                {{-- No DB items yet — fallback message --}}
                <p class="text-center text-paragraph py-16">Portfolio items are being loaded. Check back soon!</p>
                @endif

            </div>
        </section>

        {{-- ===================== STATS ===================== --}}
        <section class="w-full bg-[#FAFAFA] md:py-[70px] py-12">
            <div class="theme-container mx-auto">
                <div class="relative w-full rounded-[20px] overflow-hidden md:py-9 py-7 px-6 md:px-10" style="background: linear-gradient(90deg,#794AFF 0%,#BA4AFF 50%,#794AFF 100%);">
                    <div class="absolute -top-8 left-1/4 size-32 rounded-full bg-white/10 pointer-events-none"></div>
                    <div class="absolute -bottom-6 right-1/4 size-24 rounded-full bg-white/8 pointer-events-none"></div>
                    <div class="relative z-10 grid xl:grid-cols-4 md:grid-cols-2 grid-cols-2 gap-6 md:gap-0 md:divide-x divide-white/20">
                        @php
                            $stats = [
                                ['value' => '100+', 'label' => 'Projects Completed'],
                                ['value' => '50+',  'label' => 'Brands Worked With'],
                                ['value' => '5M+',  'label' => 'Audience Reach'],
                                ['value' => '99%',  'label' => 'Client Satisfaction'],
                            ];
                        @endphp
                        @foreach($stats as $s)
                        <div class="flex items-center gap-3.5 md:justify-center md:px-6">
                            <div>
                                <p class="xl:text-[28px] text-[22px] font-bold text-white leading-none">{{ $s['value'] }}</p>
                                <p class="text-white/75 text-sm font-medium mt-0.5">{{ $s['label'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- ===================== CTA ===================== --}}
        <section class="w-full bg-[#FAFAFA] md:pb-[90px] pb-14">
            <div class="theme-container mx-auto">
                <div class="relative w-full rounded-[24px] overflow-hidden" style="background: linear-gradient(120deg,#1a1432 0%,#2d1b6b 50%,#1a1432 100%);" data-aos="fade-up">
                    <div class="absolute -top-10 -left-10 size-48 rounded-full bg-purple/20 pointer-events-none"></div>
                    <div class="absolute -bottom-8 right-1/4 size-40 rounded-full bg-[#BA4AFF]/15 pointer-events-none"></div>
                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8 px-8 md:px-14 xl:px-16 py-12 md:py-14">
                        <div class="text-center md:text-left">
                            <h2 class="xl:text-[40px] md:text-[32px] text-[26px] font-bold text-white leading-tight mb-3">
                                Let's Build Something <span class="text-[#9D7BFF]">Amazing</span>
                            </h2>
                            <p class="text-white/70 text-base leading-7 md:max-w-[440px]">
                                Ready to elevate your brand with creative digital solutions? Let's bring your vision to life.
                            </p>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center gap-4 flex-shrink-0">
                            <a href="{{ route('contact-us') }}" class="inline-flex items-center gap-2.5 bg-[#25D366] text-white font-bold text-sm uppercase tracking-wider px-7 py-4 rounded-full hover:bg-[#128C7E] transition-all duration-300">
                                Start Your Project
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                            <a href="{{ route('contact-us') }}" class="inline-flex items-center gap-2 text-white/90 font-semibold text-sm hover:text-white transition-colors duration-300">
                                Book a Free Consultation
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    {{-- ===================== BUNNY / VIDEO / IMAGE MODAL ===================== --}}
    <div id="pf-media-modal" role="dialog" aria-modal="true" aria-label="Media viewer">
        <button id="pf-modal-close" aria-label="Close">&times;</button>
        <div id="pf-modal-inner">
            {{-- content injected by JS --}}
        </div>
    </div>
@endsection

@push('script_section')
<script>
/* ══════════════════════════════════════════════════════════════
   Aurora Hero — vanilla JS port of AuroraHero (error.txt)
   • Radial gradient background cycles through 4 colours (10s each)
   • 2500-star canvas starfield with per-star twinkle + edge fade
   • CTA button border & glow sync to the aurora colour live
   ══════════════════════════════════════════════════════════════ */
(function () {
    /* ── config (matches the React original) ── */
    const AURORA_COLORS = ['#13FFAA', '#1E67C6', '#CE84CF', '#DD335C'];
    const CYCLE_MS      = 10000;   // 10 s per colour — same as duration:10 in the original
    const STAR_COUNT    = 2500;    // matches count={2500}
    const STAR_SPEED    = 2;       // matches speed={2} — twinkle rate multiplier

    const hero   = document.getElementById('pf-aurora-bg');
    const canvas = document.getElementById('pf-aurora-canvas');
    const cta    = document.getElementById('pf-aurora-cta');
    if (!hero || !canvas) return;
    const ctx = canvas.getContext('2d');

    let stars     = [];
    let startTime = performance.now();
    let W = 0, H = 0;

    /* ── colour helpers ── */
    function hexToRgb(h) {
        if (!h || typeof h !== 'string') return [0, 0, 0];
        return [parseInt(h.slice(1,3),16), parseInt(h.slice(3,5),16), parseInt(h.slice(5,7),16)];
    }
    function lerpRgb(a, b, t) {
        return a.map((v,i) => Math.round(v + (b[i]-v)*t));
    }
    function easeInOut(t) { return t<.5 ? 2*t*t : 1-Math.pow(-2*t+2,2)/2; }

    /* returns the current blended aurora RGB for a given timestamp */
    function auroraColor(now) {
        const total   = CYCLE_MS * AURORA_COLORS.length;
        // clamp elapsed to always be positive — avoids NaN/negative index
        const elapsed = Math.abs((now - startTime) % total);
        const rawIdx  = elapsed / CYCLE_MS;
        const from    = ((Math.floor(rawIdx) % AURORA_COLORS.length) + AURORA_COLORS.length) % AURORA_COLORS.length;
        const to      = (from + 1) % AURORA_COLORS.length;
        const frac    = easeInOut(rawIdx - Math.floor(rawIdx));
        return lerpRgb(hexToRgb(AURORA_COLORS[from]), hexToRgb(AURORA_COLORS[to]), frac);
    }

    /* ── starfield ── */
    function buildStars(w, h) {
        stars = [];
        for (let i = 0; i < STAR_COUNT; i++) {
            stars.push({
                x:            Math.random() * w,
                y:            Math.random() * h,
                r:            Math.random() * 1.3 + 0.2,           // 0.2–1.5 px
                baseAlpha:    Math.random() * 0.55 + 0.25,          // 0.25–0.8
                twinkleOff:   Math.random() * Math.PI * 2,
                twinkleSpeed: (Math.random() * 0.6 + 0.2) * STAR_SPEED,
            });
        }
    }

    function resizeCanvas() {
        const dpr = window.devicePixelRatio || 1;
        W = hero.clientWidth;
        H = hero.clientHeight;
        canvas.width  = W * dpr;
        canvas.height = H * dpr;
        canvas.style.width  = W + 'px';
        canvas.style.height = H + 'px';
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        buildStars(W, H);
    }

    /* ── main loop ── */
    function loop(now) {
        // Guard: if now is invalid (tab was hidden/resumed), reset startTime
        if (!now || isNaN(now)) { startTime = performance.now(); requestAnimationFrame(loop); return; }
        const rgb      = auroraColor(now);
        const colorStr = `rgb(${rgb[0]},${rgb[1]},${rgb[2]})`;
        const t        = now / 1000; // seconds for twinkle

        /* 1. Aurora gradient — matches the React template exactly:
              radial-gradient(125% 125% at 50% 0%, #020617 50%, ${color}) */
        hero.style.backgroundImage =
            `radial-gradient(125% 125% at 50% 0%, #020617 50%, ${colorStr})`;

        /* 2. CTA button border + glow (mirrors motion.button style props) */
        if (cta) {
            cta.style.border    = `1px solid ${colorStr}`;
            cta.style.boxShadow = `0px 4px 24px ${colorStr}`;
        }

        /* 3. Stars */
        ctx.clearRect(0, 0, W, H);
        const cx = W / 2, cy = H / 2;
        const maxD = Math.hypot(cx, cy);

        for (const s of stars) {
            /* fade=true in the original: stars at the edge are more transparent */
            const edgeFade = Math.max(0, 1 - Math.hypot(s.x-cx, s.y-cy) / maxD * 1.15);
            const twinkle  = 0.55 + 0.45 * Math.sin(t * s.twinkleSpeed + s.twinkleOff);
            const alpha    = s.baseAlpha * edgeFade * twinkle;

            ctx.beginPath();
            ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(255,255,255,${alpha.toFixed(3)})`;
            ctx.fill();
        }

        requestAnimationFrame(loop);
    }

    /* ── init ── */
    resizeCanvas();
    requestAnimationFrame(loop);

    let resizeT;
    window.addEventListener('resize', () => {
        clearTimeout(resizeT);
        resizeT = setTimeout(resizeCanvas, 150);
    });
})();

/* ── Modal ── */
(function () {
    const modal      = document.getElementById('pf-media-modal');
    const modalInner = document.getElementById('pf-modal-inner');
    const closeBtn   = document.getElementById('pf-modal-close');

    function openPfModal(thumb) {
        const type = thumb.dataset.modalType;
        const src  = thumb.dataset.modalSrc;
        modalInner.classList.remove('portrait');
        modalInner.innerHTML = '';

        if (type === 'bunny') {
            const iframe = document.createElement('iframe');
            iframe.src = src + (src.includes('?') ? '&' : '?') + 'autoplay=true&responsive=true';
            iframe.setAttribute('frameborder', '0');
            iframe.setAttribute('scrolling', 'no');
            iframe.setAttribute('allow', 'accelerometer;autoplay;encrypted-media;picture-in-picture');
            iframe.setAttribute('allowfullscreen', '');
            modalInner.appendChild(iframe);
        } else if (type === 'video') {
            const video = document.createElement('video');
            video.src = src;
            video.setAttribute('controls', '');
            video.setAttribute('autoplay', '');
            video.setAttribute('playsinline', '');
            modalInner.appendChild(video);
        } else {
            const img = document.createElement('img');
            img.src = src; img.alt = '';
            modalInner.appendChild(img);
        }
        modal.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closePfModal() {
        modal.classList.remove('open');
        document.body.style.overflow = '';
        setTimeout(() => { modalInner.innerHTML = ''; }, 300);
    }

    closeBtn.addEventListener('click', closePfModal);
    modal.addEventListener('click', e => { if (e.target === modal) closePfModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closePfModal(); });
    window.openPfModal = openPfModal;
})();

/* ── Filter + lazy-batch loader ── */
(function () {
    const BATCH    = 8;
    const tabs     = document.querySelectorAll('.pf-tab');
    const cards    = Array.from(document.querySelectorAll('.portfolio-card'));
    const emptyMsg = document.getElementById('pf-empty');
    const shimGrid = document.getElementById('pf-shimmer-grid');
    const shimCards= Array.from(shimGrid.querySelectorAll('.pf-shimmer'));
    const loadWrap = document.getElementById('pf-load-more-wrap');
    const loadBtn  = document.getElementById('pf-load-more');
    const countText= document.getElementById('pf-count-text');
    const sentinel = document.getElementById('pf-scroll-sentinel');

    let filteredCards = [];
    let shownCount    = 0;
    let isLoading     = false;

    /* ── helpers ── */
    function getFiltered(filter) {
        return filter === 'all' ? cards : cards.filter(c => c.dataset.category === filter);
    }

    function updateUI() {
        const total   = filteredCards.length;
        const shown   = Math.min(shownCount, total);
        const hasMore = shown < total;
        countText.textContent = shown + ' of ' + total + ' projects';
        loadWrap.style.display = hasMore ? '' : 'none';
    }

    function showShimmers(count) {
        shimCards.forEach((s, i) => s.style.display = i < count ? '' : 'none');
        shimGrid.style.display = '';
    }

    function hideShimmers() {
        shimGrid.style.display = 'none';
    }

    function revealCards(batch, animate) {
        batch.forEach((card, i) => {
            card.style.display = '';
            card.classList.add('aos-animate');
            if (animate) {
                card.style.animationDelay = (i * 45) + 'ms';
                card.classList.remove('pf-card-reveal');
                void card.offsetWidth;
                card.classList.add('pf-card-reveal');
            }
        });
    }

    /* ── filter ── */
    function applyFilter(filter) {
        shownCount = 0; isLoading = false;
        cards.forEach(c => { c.style.display = 'none'; c.classList.remove('pf-card-reveal'); });
        hideShimmers();

        filteredCards = getFiltered(filter);

        if (!filteredCards.length) {
            emptyMsg && emptyMsg.classList.remove('hidden');
            loadWrap.style.display = 'none';
            return;
        }
        emptyMsg && emptyMsg.classList.add('hidden');

        const first = filteredCards.slice(0, BATCH);
        revealCards(first, false);
        shownCount = first.length;
        updateUI();
    }

    /* ── load more — shimmer shows for 600 ms so user can see it ── */
    function loadMore() {
        if (isLoading) return;
        const next = filteredCards.slice(shownCount, shownCount + BATCH);
        if (!next.length) return;

        isLoading = true;
        loadBtn.disabled = true;
        countText.textContent = 'Loading...';
        countText.classList.add('loading-pulse');
        showShimmers(next.length);

        // Give shimmers 600 ms of visibility before swapping to real cards
        setTimeout(() => {
            hideShimmers();
            revealCards(next, true);
            shownCount += next.length;
            loadBtn.disabled = false;
            isLoading = false;
            countText.classList.remove('loading-pulse');
            updateUI();
        }, 600);
    }

    /* ── arrow click triggers load ── */
    loadBtn.addEventListener('click', loadMore);

    /* ── filter tabs ── */
    tabs.forEach(tab => tab.addEventListener('click', function () {
        tabs.forEach(t => t.classList.remove('tab-active'));
        this.classList.add('tab-active');
        applyFilter(this.dataset.filter);
    }));

    // Boot — show first batch only
    applyFilter('all');

    /* ── auto-scroll: start observer AFTER initial render + 800 ms delay
         rootMargin: negative value means sentinel must be INSIDE viewport
         by 150 px before auto-load fires — prevents firing on page load  ── */
    setTimeout(() => {
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(
                (entries) => { if (entries[0].isIntersecting) loadMore(); },
                { rootMargin: '0px 0px -150px 0px', threshold: 0 }
            );
            observer.observe(sentinel);
        }
    }, 800);
})();
</script>
@endpush
