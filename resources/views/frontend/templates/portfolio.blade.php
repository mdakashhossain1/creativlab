@extends('inner_layout')
@section('title')
    <title>{{ __('Portfolio') }}</title>
    <meta name="title" content="{{ __('Portfolio') }}" />
    <meta name="description" content="{{ __('Portfolio Page') }}" />
@endsection

@push('style_section')
<style>
    .pf-hero { background: radial-gradient(ellipse at 50% 0%, #2d1b6b 0%, #1a1432 45%, #0e0b20 100%); }
    .pf-hero-highlight {
        display:inline-block; padding:2px 14px; border-radius:10px;
        background: linear-gradient(135deg,#794AFF 0%,#BA4AFF 100%); color:#fff;
    }
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
</style>
@endpush

@section('frontend_content')
    <main>

        {{-- ===================== HERO ===================== --}}
        <section id="home-one-hero">
        <div class="hero-one-section-wrapper w-full xl:h-[905px] overflow-hidden relative pf-hero">
            {{-- DotGrid canvas — interactive dots, matches other page hero animations --}}
            <canvas id="pf-dot-canvas" class="absolute inset-0 w-full h-full" style="z-index:1;"></canvas>

            {{-- Soft glow orbs --}}
            <div class="absolute top-1/4 left-1/4 w-80 h-80 rounded-full bg-purple/25 blur-3xl pointer-events-none" style="z-index:2;"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 rounded-full bg-[#BA4AFF]/15 blur-3xl pointer-events-none" style="z-index:2;"></div>

            {{-- Content --}}
            <div class="theme-container mx-auto h-full relative pointer-events-none" style="z-index:3;">
                <div class="flex flex-col items-center justify-center xl:pt-[223px] pt-[130px] xl:pb-0 pb-10 h-full text-center">
                    <div class="pointer-events-auto" data-aos="fade-up">
                        <div class="inline-flex items-center gap-2 mb-6 px-5 py-2.5 rounded-full border border-white/20 bg-white/10 backdrop-blur-sm">
                            <span class="flex size-2 relative">
                                <span class="animate-ping absolute inline-flex size-2 rounded-full bg-[#BA4AFF] opacity-75"></span>
                                <span class="relative inline-flex size-2 rounded-full bg-[#BA4AFF]"></span>
                            </span>
                            <span class="text-white/90 text-sm font-semibold tracking-wide">Creative Portfolio</span>
                        </div>
                        <h1 class="xl:text-[64px] md:text-[50px] text-[34px] font-bold text-white leading-[1.1] mb-7">
                            Our <span class="pf-hero-highlight">Creative</span> Portfolio
                        </h1>
                        <p class="text-white/70 text-base md:text-lg leading-8 max-w-[640px] mx-auto mb-10">
                            Explore some of our recent works in
                            <span class="text-[#9D7BFF] font-semibold">Branding</span>,
                            <span class="text-[#9D7BFF] font-semibold">Web Development</span>,
                            <span class="text-[#9D7BFF] font-semibold">Ad Films</span>,
                            <span class="text-[#9D7BFF] font-semibold">Creative Content</span>, and
                            <span class="text-[#9D7BFF] font-semibold">Digital Marketing</span>.
                        </p>
                        <a href="#portfolio-grid" class="inline-flex items-center gap-2.5 bg-purple text-white font-bold text-sm uppercase tracking-wider px-8 py-4 rounded-full hover:bg-[#BA4AFF] transition-all duration-300 shadow-purple">
                            Browse Work
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </section>

        {{-- ===================== PORTFOLIO GRID ===================== --}}
        <section class="w-full bg-white md:py-[90px] py-14" id="portfolio-grid">
            <div class="theme-container mx-auto">
                <h2 class="md:text-40 text-28 font-bold text-main-black text-center mb-9" data-aos="fade-up">Browse our work</h2>

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
                <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6" id="portfolio-grid">
                    @foreach($allItems as $item)
                    @php
                        $thumb = $item->thumbnail
                            ?: ($item->type === 'image' ? $item->content_source : null);
                        $isVideo = in_array($item->type, ['video', 'bunny']);
                    @endphp
                    <div class="pf-card portfolio-card" data-category="{{ $item->category_slug }}" data-aos="fade-up">
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
                                <video src="{{ $item->content_source }}" muted preload="metadata" style="pointer-events:none;"></video>
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

                <p id="pf-empty" class="hidden text-center text-paragraph py-12">No projects found in this category.</p>

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
/* ── DotGrid: vanilla JS port of the React DotGrid (error.txt) ── */
(function () {
    const canvas = document.getElementById('pf-dot-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    const DOT     = 4;   // dot diameter px
    const GAP     = 30;  // gap between dot centres
    const CELL    = DOT + GAP;
    const PROX    = 140; // colour-change radius
    const PROX_SQ = PROX * PROX;
    const SPEED_TRIGGER = 120; // px/s before scatter kicks in
    const SHOCK_RADIUS  = 220;
    const SHOCK_STR     = 9;
    const STIFFNESS     = 0.10;  // spring return
    const DAMPING       = 0.82;

    // Base: faint purple; Active: vivid purple/pink on proximity
    const BASE   = [121, 74, 255, 0.10];
    const ACTIVE = [186, 74, 255, 0.90];

    let dots = [];
    let ptr  = { x: -9999, y: -9999, vx: 0, vy: 0, speed: 0, lx: 0, ly: 0, lt: 0 };
    let raf;

    function buildGrid() {
        cancelAnimationFrame(raf);
        const w = canvas.parentElement.clientWidth;
        const h = canvas.parentElement.clientHeight;
        const dpr = window.devicePixelRatio || 1;
        canvas.width  = w * dpr;
        canvas.height = h * dpr;
        canvas.style.width  = w + 'px';
        canvas.style.height = h + 'px';
        ctx.scale(dpr, dpr);

        const cols  = Math.floor((w + GAP) / CELL);
        const rows  = Math.floor((h + GAP) / CELL);
        const gridW = CELL * cols - GAP;
        const gridH = CELL * rows - GAP;
        const sx    = (w - gridW) / 2 + DOT / 2;
        const sy    = (h - gridH) / 2 + DOT / 2;

        dots = [];
        for (let r = 0; r < rows; r++) {
            for (let c = 0; c < cols; c++) {
                dots.push({ cx: sx + c * CELL, cy: sy + r * CELL, xo: 0, yo: 0, vx: 0, vy: 0 });
            }
        }
        loop();
    }

    function lerp(a, b, t) { return a + (b - a) * t; }

    function loop() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        for (const d of dots) {
            // spring physics
            d.vx += -STIFFNESS * d.xo;
            d.vy += -STIFFNESS * d.yo;
            d.vx *= DAMPING;
            d.vy *= DAMPING;
            d.xo += d.vx;
            d.yo += d.vy;
            if (Math.abs(d.xo) < 0.02 && Math.abs(d.vx) < 0.02) { d.xo = 0; d.vx = 0; }
            if (Math.abs(d.yo) < 0.02 && Math.abs(d.vy) < 0.02) { d.yo = 0; d.vy = 0; }

            const ox = d.cx + d.xo;
            const oy = d.cy + d.yo;
            const dx = d.cx - ptr.x;
            const dy = d.cy - ptr.y;
            const dsq = dx * dx + dy * dy;
            const t   = dsq <= PROX_SQ ? 1 - Math.sqrt(dsq) / PROX : 0;

            ctx.beginPath();
            ctx.arc(ox, oy, DOT / 2, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(${Math.round(lerp(BASE[0], ACTIVE[0], t))},${Math.round(lerp(BASE[1], ACTIVE[1], t))},${Math.round(lerp(BASE[2], ACTIVE[2], t))},${lerp(BASE[3], ACTIVE[3], t).toFixed(2)})`;
            ctx.fill();
        }

        raf = requestAnimationFrame(loop);
    }

    /* ── Mouse tracking ── */
    canvas.parentElement.addEventListener('mousemove', function (e) {
        const rect = canvas.getBoundingClientRect();
        const now  = performance.now();
        const dt   = ptr.lt ? now - ptr.lt : 16;
        ptr.vx  = ((e.clientX - ptr.lx) / dt) * 1000;
        ptr.vy  = ((e.clientY - ptr.ly) / dt) * 1000;
        ptr.speed = Math.hypot(ptr.vx, ptr.vy);
        ptr.lt = now; ptr.lx = e.clientX; ptr.ly = e.clientY;
        ptr.x  = e.clientX - rect.left;
        ptr.y  = e.clientY - rect.top;

        // Scatter on fast move
        if (ptr.speed > SPEED_TRIGGER) {
            for (const d of dots) {
                const dist = Math.hypot(d.cx - ptr.x, d.cy - ptr.y);
                if (dist < PROX) {
                    const s = (1 - dist / PROX) * 0.007;
                    d.vx += ptr.vx * s;
                    d.vy += ptr.vy * s;
                }
            }
        }
    }, { passive: true });

    canvas.parentElement.addEventListener('mouseleave', function () {
        ptr.x = -9999; ptr.y = -9999;
    });

    /* ── Click shockwave ── */
    canvas.parentElement.addEventListener('click', function (e) {
        const rect = canvas.getBoundingClientRect();
        const cx = e.clientX - rect.left;
        const cy = e.clientY - rect.top;
        for (const d of dots) {
            const dist = Math.hypot(d.cx - cx, d.cy - cy);
            if (dist < SHOCK_RADIUS) {
                const falloff = 1 - dist / SHOCK_RADIUS;
                const ang = Math.atan2(d.cy - cy, d.cx - cx);
                d.vx += Math.cos(ang) * SHOCK_STR * falloff;
                d.vy += Math.sin(ang) * SHOCK_STR * falloff;
            }
        }
    });

    buildGrid();

    let resizeT;
    window.addEventListener('resize', function () {
        clearTimeout(resizeT);
        resizeT = setTimeout(buildGrid, 200);
    });
})();

/* ── Portfolio modal + filter ── */
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
            // Bunny Stream iframe embed
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
            // image lightbox
            const img = document.createElement('img');
            img.src = src;
            img.alt = '';
            modalInner.appendChild(img);
        }

        modal.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closePfModal() {
        modal.classList.remove('open');
        document.body.style.overflow = '';
        // Clear src to stop video/audio playback
        setTimeout(() => { modalInner.innerHTML = ''; }, 300);
    }

    closeBtn.addEventListener('click', closePfModal);
    modal.addEventListener('click', function (e) {
        if (e.target === modal) closePfModal();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closePfModal();
    });

    // Expose for inline onclick
    window.openPfModal = openPfModal;

    // Portfolio filter tabs
    const tabs       = document.querySelectorAll('.pf-tab');
    const cards      = Array.from(document.querySelectorAll('.portfolio-card'));
    const emptyMsg   = document.getElementById('pf-empty');

    function applyFilter(filter) {
        let visible = 0;
        cards.forEach(card => {
            const show = filter === 'all' || card.dataset.category === filter;
            card.style.display = show ? '' : 'none';
            if (show) visible++;
        });
        if (emptyMsg) emptyMsg.classList.toggle('hidden', visible > 0);
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            tabs.forEach(t => t.classList.remove('tab-active'));
            this.classList.add('tab-active');
            applyFilter(this.dataset.filter);
        });
    });
})();
</script>
@endpush
