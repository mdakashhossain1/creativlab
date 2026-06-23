@extends('inner_layout')
@section('title')
    <title>{{ __('Projects') }}</title>
    <meta name="title" content="{{ __('Projects') }}" />
    <meta name="description" content="{{ __('Our Projects Page') }}" />
@endsection

@push('style_section')
<style>
    #pj-aurora-bg { background: #020617; }
    #pj-aurora-bg .custom-heading { color: #fff; }
    #projects-grid .custom-heading { color: #161519; }
    #pj-aurora-cta {
        display:inline-flex; align-items:center; gap:10px;
        padding:14px 32px; border-radius:50px;
        background: rgba(2,6,23,0.15);
        color:#fff; font-weight:700; font-size:14px;
        letter-spacing:.08em; text-transform:uppercase;
        transition: background .3s, transform .2s;
        cursor:pointer; text-decoration:none;
    }
    #pj-aurora-cta:hover  { background: rgba(2,6,23,0.50); transform:scale(1.015); }
    #pj-aurora-cta:active { transform:scale(0.985); }
    #pj-aurora-cta .pj-cta-arrow { transition: transform .25s; }
    #pj-aurora-cta:hover .pj-cta-arrow { transform: rotate(-45deg); }

    .pj-tab {
        padding:11px 26px; border-radius:50px; font-weight:600; font-size:14px;
        color:#6D6D6D; background:#fff; border:1px solid rgba(121,74,255,.15);
        transition:all .25s; cursor:pointer; white-space:nowrap;
    }
    .pj-tab:hover { border-color:#794AFF; color:#794AFF; }
    .pj-tab.tab-active { background:#794AFF; color:#fff; border-color:#794AFF; box-shadow:0 8px 20px rgba(121,74,255,.3); }

    .pj-card { border-radius:16px; overflow:hidden; background:#fff; box-shadow:0 4px 20px rgba(121,74,255,.08); transition:transform .35s, box-shadow .35s; }
    .pj-card:hover { transform:translateY(-6px); box-shadow:0 14px 38px rgba(121,74,255,.18); }
    .pj-thumb { position:relative; overflow:hidden; aspect-ratio:4/3; background:#0e0b20; }
    .pj-thumb img { width:100%; height:100%; object-fit:cover; transition:transform .5s ease; display:block; }
    .pj-card:hover .pj-thumb img { transform:scale(1.07); }
    .pj-thumb-overlay { position:absolute; inset:0; background:linear-gradient(to top, rgba(12,8,30,.55) 0%, transparent 55%); }
    .pj-arrow-badge {
        position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);
        width:54px; height:54px; border-radius:50%; background:rgba(255,255,255,.92);
        display:flex; align-items:center; justify-content:center;
        box-shadow:0 8px 24px rgba(0,0,0,.25); transition:transform .3s;
    }
    .pj-card:hover .pj-arrow-badge { transform:translate(-50%,-50%) scale(1.12); }

    /* Shimmer */
    .pj-shimmer { border-radius:16px; overflow:hidden; background:#fff; box-shadow:0 4px 20px rgba(121,74,255,.08); }
    .pj-shimmer-thumb { aspect-ratio:4/3; }
    .pj-shimmer-thumb, .pj-shimmer-line {
        background:linear-gradient(90deg,#f3f0ff 25%,#e4dcff 50%,#f3f0ff 75%);
        background-size:200% 100%;
        animation:pjShimmer 1.5s infinite linear;
        border-radius:4px;
    }
    @keyframes pjShimmer {
        0%   { background-position:200% 0; }
        100% { background-position:-200% 0; }
    }

    /* Card reveal */
    .pj-card-reveal { animation:pjReveal .45s cubic-bezier(.22,.61,.36,1) both; }
    @keyframes pjReveal {
        from { opacity:0; transform:translateY(20px); }
        to   { opacity:1; transform:translateY(0); }
    }

    /* Load more */
    #pj-load-more-wrap { position:relative; margin-top:-220px; z-index:20; }
    #pj-blur-fade {
        height:260px;
        background:linear-gradient(to bottom, transparent 0%, rgba(255,255,255,.55) 35%, rgba(255,255,255,.90) 65%, #ffffff 100%);
        pointer-events:none;
        backdrop-filter:blur(2px); -webkit-backdrop-filter:blur(2px);
    }
    #pj-arrow-wrap { text-align:center; margin-top:-16px; padding-bottom:16px; display:flex; flex-direction:column; align-items:center; gap:6px; }
    #pj-load-more {
        display:inline-flex; align-items:center; justify-content:center;
        background:none; border:none; padding:0; cursor:pointer;
        transition:transform .25s, opacity .25s;
    }
    #pj-load-more:hover { transform:translateY(6px); opacity:.75; }
    #pj-load-more:disabled { opacity:.30; cursor:not-allowed; transform:none; }
    #pj-load-more:not(:disabled) svg { animation:pjArrowBounce 1.4s ease-in-out infinite; }
    #pj-count-text { display:block; font-size:11px; color:#9D7BFF; font-weight:600; letter-spacing:.10em; text-transform:uppercase; }
    #pj-count-text.loading-pulse { animation:pjCountPulse .6s ease-in-out infinite alternate; }
    @keyframes pjArrowBounce { 0%,100%{transform:translateY(0);} 50%{transform:translateY(8px);} }
    @keyframes pjCountPulse { from{opacity:.4;} to{opacity:1;} }
    #pj-scroll-sentinel { height:1px; }
</style>
@endpush

@section('frontend_content')
<main>

    {{-- ===================== HERO — Aurora + Starfield ===================== --}}
    <section id="home-one-hero">
    <div class="hero-one-section-wrapper w-full xl:h-[905px] overflow-hidden relative" id="pj-aurora-bg">
        <canvas id="pj-aurora-canvas" class="absolute inset-0 w-full h-full" style="z-index:1;pointer-events:none;"></canvas>
        <div class="theme-container mx-auto h-full relative pointer-events-none" style="z-index:3;">
            <div class="flex flex-col items-center justify-center xl:pt-[223px] pt-[130px] xl:pb-0 pb-10 h-full text-center">
                <div class="pointer-events-auto" data-aos="fade-up">

                    <div class="inline-flex items-center gap-2.5 bg-white/10 border border-white/20 rounded-full px-5 py-2.5 mb-6 shadow-sm">
                        <span class="flex size-2 relative">
                            <span class="animate-ping absolute inline-flex size-2 rounded-full bg-purple opacity-75"></span>
                            <span class="relative inline-flex size-2 rounded-full bg-purple"></span>
                        </span>
                        <span class="text-white text-sm font-semibold tracking-wide">Our Projects</span>
                    </div>

                    <h1 class="custom-heading text-center mb-7" style="font-weight:400 !important;">
                        Work We're <span>Proud</span> Of
                    </h1>

                    <p class="text-white/60 text-base md:text-lg leading-8 max-w-[640px] mx-auto mb-10">
                        Each project is a story — of strategy, creativity, and results that matter.
                        From
                        <span class="text-white/90 font-semibold">Brand Identities</span> to
                        <span class="text-white/90 font-semibold">Digital Campaigns</span>,
                        explore what we've built together with our clients.
                    </p>

                    <a id="pj-aurora-cta" href="#projects-grid">
                        Explore Projects
                        <svg class="pj-cta-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M13 6l6 6-6 6"/>
                        </svg>
                    </a>

                </div>
            </div>
        </div>
    </div>
    </section>

    {{-- ===================== PROJECTS GRID ===================== --}}
    <section class="w-full bg-white md:py-[90px] py-14" id="projects-grid">
        <div class="theme-container mx-auto">
            <div class="flex flex-col items-center mb-9" data-aos="fade-up">
                <div class="inline-flex items-center gap-2.5 bg-white border border-purple/15 rounded-full px-5 py-2.5 mb-6 shadow-sm">
                    <span class="flex size-2 relative">
                        <span class="animate-ping absolute inline-flex size-2 rounded-full bg-purple opacity-75"></span>
                        <span class="relative inline-flex size-2 rounded-full bg-purple"></span>
                    </span>
                    <span class="text-purple text-sm font-semibold tracking-wide">Our Projects</span>
                </div>
                <h2 class="custom-heading text-center" style="font-weight:400 !important;">
                    Browse our <span>Creative</span> Work
                </h2>
            </div>

            @if($projects->count())

            {{-- Category filter tabs --}}
            <div class="flex flex-wrap items-center justify-center gap-3 md:gap-4 mb-12" data-aos="fade-up">
                <button class="pj-tab tab-active" data-filter="all">All Projects</button>
                @foreach($categories as $cat)
                    <button class="pj-tab" data-filter="{{ \Illuminate\Support\Str::slug($cat->name) }}">{{ $cat->name }}</button>
                @endforeach
            </div>

            {{-- Grid --}}
            <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6" id="pj-grid-inner">
                @foreach($projects as $project)
                @php
                    $catSlug = \Illuminate\Support\Str::slug($project->portfolioCategory?->name ?? 'uncategorized');
                @endphp
                <div class="pj-card project-card" data-category="{{ $catSlug }}" style="display:none">
                    <a href="{{ route('project', $project->slug) }}" class="block">
                        <div class="pj-thumb">
                            <img src="{{ asset($project->thumb_image) }}" alt="{{ $project->title }}" loading="lazy" />
                            <div class="pj-thumb-overlay"></div>
                            <span class="pj-arrow-badge">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                     stroke="#794AFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14M13 6l6 6-6 6"/>
                                </svg>
                            </span>
                        </div>
                    </a>
                    <div class="p-5">
                        <p class="text-purple text-[11px] font-bold uppercase tracking-wider mb-1.5">
                            {{ $project->portfolioCategory?->name ?? __('Project') }}
                        </p>
                        <a href="{{ route('project', $project->slug) }}"
                           class="font-bold text-main-black text-base mb-1 block hover:text-purple transition-colors duration-200">
                            {{ $project->title }}
                        </a>
                        @if($project->short_description)
                        <p class="text-paragraph text-xs leading-5 line-clamp-2 mt-1">{{ $project->short_description }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Shimmer skeleton --}}
            <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6 mt-6" id="pj-shimmer-grid" style="display:none">
                @for($si = 0; $si < 8; $si++)
                <div class="pj-shimmer">
                    <div class="pj-shimmer-thumb"></div>
                    <div class="p-5">
                        <div class="pj-shimmer-line mb-3" style="width:38%;height:10px"></div>
                        <div class="pj-shimmer-line mb-2" style="width:72%;height:14px"></div>
                        <div class="pj-shimmer-line mb-1.5" style="width:90%;height:10px"></div>
                        <div class="pj-shimmer-line" style="width:65%;height:10px"></div>
                    </div>
                </div>
                @endfor
            </div>

            <p id="pj-empty" class="hidden text-center text-paragraph py-12">No projects found in this category.</p>

            {{-- Load more --}}
            <div id="pj-load-more-wrap" style="display:none">
                <div id="pj-blur-fade"></div>
                <div id="pj-arrow-wrap">
                    <button id="pj-load-more" type="button" aria-label="Load more projects">
                        <svg width="52" height="52" viewBox="0 0 24 24" fill="none"
                             stroke="#794AFF" stroke-width="3.5"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 8l7 7 7-7"/>
                        </svg>
                    </button>
                    <span id="pj-count-text"></span>
                </div>
                <div id="pj-scroll-sentinel"></div>
            </div>

            @else
            <p class="text-center text-paragraph py-16">Projects are coming soon. Check back later!</p>
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
                    @php $stats = [['value'=>'100+','label'=>'Projects Completed'],['value'=>'50+','label'=>'Brands Worked With'],['value'=>'5M+','label'=>'Audience Reach'],['value'=>'99%','label'=>'Client Satisfaction']]; @endphp
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
@endsection

@push('script_section')
<script>
/* Aurora Hero */
(function () {
    const AURORA_COLORS = ['#13FFAA', '#1E67C6', '#CE84CF', '#DD335C'];
    const CYCLE_MS = 10000, STAR_COUNT = 2500, STAR_SPEED = 2;
    const hero   = document.getElementById('pj-aurora-bg');
    const canvas = document.getElementById('pj-aurora-canvas');
    const cta    = document.getElementById('pj-aurora-cta');
    if (!hero || !canvas) return;
    const ctx = canvas.getContext('2d');
    let stars = [], startTime = performance.now(), W = 0, H = 0;
    function hexToRgb(h) { return [parseInt(h.slice(1,3),16),parseInt(h.slice(3,5),16),parseInt(h.slice(5,7),16)]; }
    function lerpRgb(a,b,t) { return a.map((v,i)=>Math.round(v+(b[i]-v)*t)); }
    function easeInOut(t) { return t<.5?2*t*t:1-Math.pow(-2*t+2,2)/2; }
    function auroraColor(now) {
        const total = CYCLE_MS * AURORA_COLORS.length;
        const elapsed = Math.abs((now - startTime) % total);
        const rawIdx = elapsed / CYCLE_MS;
        const from = ((Math.floor(rawIdx) % AURORA_COLORS.length) + AURORA_COLORS.length) % AURORA_COLORS.length;
        const to = (from + 1) % AURORA_COLORS.length;
        return lerpRgb(hexToRgb(AURORA_COLORS[from]), hexToRgb(AURORA_COLORS[to]), easeInOut(rawIdx - Math.floor(rawIdx)));
    }
    function buildStars(w, h) {
        stars = [];
        for (let i = 0; i < STAR_COUNT; i++) {
            stars.push({ x:Math.random()*w, y:Math.random()*h, r:Math.random()*1.3+0.2,
                baseAlpha:Math.random()*.55+.25, twinkleOff:Math.random()*Math.PI*2,
                twinkleSpeed:(Math.random()*.6+.2)*STAR_SPEED });
        }
    }
    function resizeCanvas() {
        const dpr = window.devicePixelRatio || 1;
        W = hero.clientWidth; H = hero.clientHeight;
        canvas.width = W*dpr; canvas.height = H*dpr;
        canvas.style.width = W+'px'; canvas.style.height = H+'px';
        ctx.setTransform(dpr,0,0,dpr,0,0);
        buildStars(W, H);
    }
    function loop(now) {
        if (!now || isNaN(now)) { startTime = performance.now(); requestAnimationFrame(loop); return; }
        const rgb = auroraColor(now);
        const colorStr = `rgb(${rgb[0]},${rgb[1]},${rgb[2]})`;
        const t = now / 1000;
        hero.style.backgroundImage = `radial-gradient(125% 125% at 50% 0%, #020617 50%, ${colorStr})`;
        if (cta) { cta.style.border = `1px solid ${colorStr}`; cta.style.boxShadow = `0px 4px 24px ${colorStr}`; }
        ctx.clearRect(0, 0, W, H);
        const cx = W/2, cy = H/2, maxD = Math.hypot(cx, cy);
        for (const s of stars) {
            const edgeFade = Math.max(0, 1 - Math.hypot(s.x-cx, s.y-cy)/maxD*1.15);
            const twinkle = .55 + .45*Math.sin(t*s.twinkleSpeed+s.twinkleOff);
            ctx.beginPath(); ctx.arc(s.x,s.y,s.r,0,Math.PI*2);
            ctx.fillStyle = `rgba(255,255,255,${(s.baseAlpha*edgeFade*twinkle).toFixed(3)})`; ctx.fill();
        }
        requestAnimationFrame(loop);
    }
    resizeCanvas(); requestAnimationFrame(loop);
    let resizeT;
    window.addEventListener('resize', () => { clearTimeout(resizeT); resizeT = setTimeout(resizeCanvas, 150); });
})();

/* Filter + lazy-batch loader */
(function () {
    const BATCH  = 8;
    const tabs   = document.querySelectorAll('.pj-tab');
    const cards  = Array.from(document.querySelectorAll('.project-card'));
    const emptyMsg  = document.getElementById('pj-empty');
    const shimGrid  = document.getElementById('pj-shimmer-grid');
    const shimCards = shimGrid ? Array.from(shimGrid.querySelectorAll('.pj-shimmer')) : [];
    const loadWrap  = document.getElementById('pj-load-more-wrap');
    const loadBtn   = document.getElementById('pj-load-more');
    const countText = document.getElementById('pj-count-text');
    const sentinel  = document.getElementById('pj-scroll-sentinel');
    if (!tabs.length || !cards.length) return;

    let filteredCards = [], shownCount = 0, isLoading = false;

    function getFiltered(filter) {
        return filter === 'all' ? cards : cards.filter(c => c.dataset.category === filter);
    }
    function updateUI() {
        const total = filteredCards.length, shown = Math.min(shownCount, total);
        countText.textContent = shown + ' of ' + total + ' projects';
        loadWrap.style.display = shown < total ? '' : 'none';
    }
    function showShimmers(count) {
        shimCards.forEach((s,i) => s.style.display = i < count ? '' : 'none');
        shimGrid.style.display = '';
    }
    function hideShimmers() { shimGrid.style.display = 'none'; }
    function revealCards(batch, animate) {
        batch.forEach((card, i) => {
            card.style.display = '';
            card.classList.add('aos-animate');
            if (animate) {
                card.style.animationDelay = (i * 45) + 'ms';
                card.classList.remove('pj-card-reveal');
                void card.offsetWidth;
                card.classList.add('pj-card-reveal');
            }
        });
    }
    function applyFilter(filter) {
        shownCount = 0; isLoading = false;
        cards.forEach(c => { c.style.display = 'none'; c.classList.remove('pj-card-reveal'); });
        hideShimmers();
        filteredCards = getFiltered(filter);
        if (!filteredCards.length) {
            emptyMsg && emptyMsg.classList.remove('hidden');
            loadWrap.style.display = 'none'; return;
        }
        emptyMsg && emptyMsg.classList.add('hidden');
        const first = filteredCards.slice(0, BATCH);
        revealCards(first, false);
        shownCount = first.length;
        updateUI();
    }
    function loadMore() {
        if (isLoading) return;
        const next = filteredCards.slice(shownCount, shownCount + BATCH);
        if (!next.length) return;
        isLoading = true; loadBtn.disabled = true;
        countText.textContent = 'Loading...';
        countText.classList.add('loading-pulse');
        showShimmers(next.length);
        setTimeout(() => {
            hideShimmers(); revealCards(next, true);
            shownCount += next.length;
            loadBtn.disabled = false; isLoading = false;
            countText.classList.remove('loading-pulse');
            updateUI();
        }, 600);
    }
    loadBtn.addEventListener('click', loadMore);
    tabs.forEach(tab => tab.addEventListener('click', function () {
        tabs.forEach(t => t.classList.remove('tab-active'));
        this.classList.add('tab-active');
        applyFilter(this.dataset.filter);
    }));
    applyFilter('all');
    setTimeout(() => {
        if ('IntersectionObserver' in window) {
            new IntersectionObserver(
                (entries) => { if (entries[0].isIntersecting) loadMore(); },
                { rootMargin: '0px 0px -150px 0px', threshold: 0 }
            ).observe(sentinel);
        }
    }, 800);
})();
</script>
@endpush
