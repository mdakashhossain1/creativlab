@extends('inner_layout')
@section('title')
    <title>{{ $project->translate?->seo_title ?? $project->title }}</title>
    <meta name="title" content="{{ $project->translate?->seo_title ?? $project->title }}">
    <meta name="description" content="{{ $project->translate?->seo_description ?? $project->short_description }}">
@endsection

@push('style_section')
<style>
    .active-video-player { display: flex !important; }

    /* ── Portfolio items grid (same as portfolio.blade.php) ── */
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
    #pf-modal-inner img { width:100%; display:block; aspect-ratio:16/9; object-fit:contain; }
    #pf-modal-inner img { background:#111; }
    #pf-modal-inner.portrait { max-width:420px; }
    #pf-modal-inner.portrait iframe,
    #pf-modal-inner.portrait video { aspect-ratio:9/16; }

    /* Shimmer */
    .pf-shimmer { border-radius:16px; overflow:hidden; background:#fff; box-shadow:0 4px 20px rgba(121,74,255,.08); }
    .pf-shimmer-thumb { aspect-ratio:4/3; }
    .pf-shimmer-thumb, .pf-shimmer-line {
        background:linear-gradient(90deg,#f3f0ff 25%,#e4dcff 50%,#f3f0ff 75%);
        background-size:200% 100%;
        animation:pfShimmer 1.5s infinite linear; border-radius:4px;
    }
    @keyframes pfShimmer { 0%{background-position:200% 0;} 100%{background-position:-200% 0;} }

    /* Card reveal */
    .pf-card-reveal { animation:pfReveal .45s cubic-bezier(.22,.61,.36,1) both; }
    @keyframes pfReveal { from{opacity:0;transform:translateY(20px);} to{opacity:1;transform:translateY(0);} }

    /* Load more */
    #pf-load-more-wrap { position:relative; margin-top:-220px; z-index:20; }
    #pf-blur-fade {
        height:260px;
        background:linear-gradient(to bottom, transparent 0%, rgba(255,255,255,.55) 35%, rgba(255,255,255,.90) 65%, #ffffff 100%);
        pointer-events:none; backdrop-filter:blur(2px); -webkit-backdrop-filter:blur(2px);
    }
    #pf-arrow-wrap { text-align:center; margin-top:-16px; padding-bottom:16px; display:flex; flex-direction:column; align-items:center; gap:6px; }
    #pf-load-more { display:inline-flex; align-items:center; justify-content:center; background:none; border:none; padding:0; cursor:pointer; transition:transform .25s, opacity .25s; }
    #pf-load-more:hover { transform:translateY(6px); opacity:.75; }
    #pf-load-more:disabled { opacity:.30; cursor:not-allowed; transform:none; }
    #pf-load-more:not(:disabled) svg { animation:pfArrowBounce 1.4s ease-in-out infinite; }
    #pf-count-text { display:block; font-size:11px; color:#9D7BFF; font-weight:600; letter-spacing:.10em; text-transform:uppercase; }
    #pf-count-text.loading-pulse { animation:pfCountPulse .6s ease-in-out infinite alternate; }
    @keyframes pfArrowBounce { 0%,100%{transform:translateY(0);} 50%{transform:translateY(8px);} }
    @keyframes pfCountPulse { from{opacity:.4;} to{opacity:1;} }
    #pf-scroll-sentinel { height:1px; }

    /* Fix header dropdown menus getting cut off */
    .header-wrapper li.group:hover > div {
        height: auto !important;
        overflow: visible !important;
    }
    .header-wrapper li.group:hover > div > ul {
        overflow: visible !important;
    }
</style>
@endpush

@section('frontend_content')
<main>

    {{-- ======= BREADCRUMB ======= --}}
    <x-breadcrumb name="{{ __('Project Details') }}" />

    {{-- ======= HERO: THUMB + OVERVIEW ======= --}}
    <section class="w-full pt-16 md:pt-[130px]">
        <div class="theme-container mx-auto w-full">
            <div class="grid grid-cols-6 md:grid-cols-12 items-center gap-8">
                <div class="col-span-6">
                    <p class="text-purple text-sm font-bold uppercase tracking-widest mb-3">
                        {{ $project->portfolioCategory?->name }}
                    </p>
                    <h1 class="text-24 sm:text-34 leading-tight tracking-tight font-semibold text-main-black mb-4">
                        {{ $project->title }}
                    </h1>
                    <p class="max-w-[533px] text-18 lg:text-24 lg:leading-[40px] text-paragraph mt-2.5 md:mt-3.5">
                        {{ $project->author_comment }}
                    </p>
                    @if($project->author_name || $project->author_image)
                    <div class="flex items-center gap-5 mt-3.5 md:mt-8 w-fit">
                        <div class="w-14 h-14 rounded-full overflow-hidden">
                            <img src="{{ $project->author_image ? asset($project->author_image) : asset($general_setting?->default_avatar) }}"
                                alt="" class="w-full object-cover" />
                        </div>
                        <div>
                            <h4 class="text-main-black text-18 font-semibold">{{ ucfirst($project->author_name) }}</h4>
                            <p class="text-sm leading-7 font-medium text-paragraph">{{ $project->author_designation }}</p>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-span-6 flex justify-center items-center mt-5 md:mt-0 relative">
                    <img src="{{ asset($project->thumb_image) }}" alt="{{ $project->title }}" class="w-full rounded-[20px]" />
                    @if($project->video_url)
                    <button type="button" aria-label="play-video"
                        class="video-play-btn flex space-x-8 ml-7 sm:ml-0 items-center absolute">
                        <span class="flex size-11 sm:size-[56px] rounded-full justify-center items-center bg-white relative">
                            <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.9611 8.29308L2.99228 12.8467C1.65896 13.6086 0 12.6459 0 11.1102V2.00295C0 0.467309 1.65896 -0.495425 2.99228 0.266469L10.9611 4.82011C12.3048 5.5879 12.3048 7.52529 10.9611 8.29308Z" fill="#794AFF"/>
                            </svg>
                            <div class="absolute w-full h-full rounded-full h5-play-btn-line1"></div>
                            <div class="absolute w-[130%] h-[130%] rounded-full h5-play-btn-line2"></div>
                            <div class="absolute w-[160%] h-[160%] rounded-full h5-play-btn-line3"></div>
                        </span>
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ======= DESCRIPTION ======= --}}
    <section class="w-full py-16 md:py-20">
        <div class="theme-container mx-auto w-full">
            <div class="html-description">
                {!! clean($project->description) !!}
            </div>
        </div>
    </section>

    {{-- ======= PORTFOLIO ITEMS GRID ======= --}}
    @if($project->portfolioItems->count())
    @php
        $itemCategories = $project->portfolioItems
            ->pluck('portfolioCategory')
            ->filter()
            ->unique('id')
            ->values();
    @endphp
    <section class="w-full bg-[#FAFAFA] md:py-[90px] py-14" id="project-items-section">
        <div class="theme-container mx-auto">

            <div class="flex flex-col items-center mb-9" data-aos="fade-up">
                <div class="inline-flex items-center gap-2.5 bg-white border border-purple/15 rounded-full px-5 py-2.5 mb-6 shadow-sm">
                    <span class="flex size-2 relative">
                        <span class="animate-ping absolute inline-flex size-2 rounded-full bg-purple opacity-75"></span>
                        <span class="relative inline-flex size-2 rounded-full bg-purple"></span>
                    </span>
                    <span class="text-purple text-sm font-semibold tracking-wide">Project Contents</span>
                </div>
                <h2 class="custom-heading text-center" style="font-weight:400 !important;">
                    Inside This <span>Project</span>
                </h2>
            </div>

            {{-- Filter tabs --}}
            <div class="flex flex-wrap items-center justify-center gap-3 md:gap-4 mb-12" data-aos="fade-up">
                <button class="pf-tab tab-active" data-filter="all">All</button>
                @foreach($itemCategories as $cat)
                    <button class="pf-tab" data-filter="{{ \Illuminate\Support\Str::slug($cat->name) }}">{{ $cat->name }}</button>
                @endforeach
            </div>

            {{-- Grid --}}
            <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6" id="pf-grid-inner">
                @foreach($project->portfolioItems as $item)
                @php
                    $catSlug = \Illuminate\Support\Str::slug($item->portfolioCategory?->name ?? 'general');
                    $thumb   = $item->thumbnail ?: ($item->type === 'image' ? $item->content_source : null);
                    $isVideo = in_array($item->type, ['video', 'bunny']);
                @endphp
                <div class="pf-card portfolio-card" data-category="{{ $catSlug }}" style="display:none">
                    <div class="pf-thumb"
                         data-modal-type="{{ $item->type }}"
                         data-modal-src="{{ $item->content_source }}"
                         onclick="openPfModal(this)">
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
                        <button class="pf-play-btn" type="button" aria-label="{{ $isVideo ? 'Play video' : 'View image' }}">
                            @if($isVideo)
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#794AFF"><path d="M8 5v14l11-7z"/></svg>
                            @else
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#794AFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
                            @endif
                        </button>
                    </div>
                    <div class="p-5">
                        <p class="text-purple text-[11px] font-bold uppercase tracking-wider mb-1.5">{{ $item->portfolioCategory?->name }}</p>
                        <p class="font-bold text-main-black text-base mb-1">{{ $item->title ?: ($item->portfolioCategory?->name ?? '') }}</p>
                        @if($item->description)
                        <p class="text-paragraph text-xs leading-5">{{ $item->description }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Shimmer --}}
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

            <p id="pf-empty" class="hidden text-center text-paragraph py-12">No items found in this category.</p>

            {{-- Load more --}}
            <div id="pf-load-more-wrap" style="display:none">
                <div id="pf-blur-fade"></div>
                <div id="pf-arrow-wrap">
                    <button id="pf-load-more" type="button" aria-label="Load more">
                        <svg width="52" height="52" viewBox="0 0 24 24" fill="none"
                             stroke="#794AFF" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 8l7 7 7-7"/>
                        </svg>
                    </button>
                    <span id="pf-count-text"></span>
                </div>
                <div id="pf-scroll-sentinel"></div>
            </div>

        </div>
    </section>
    @endif

    {{-- ======= PREV / NEXT PROJECT ======= --}}
    <section>
        <div class="theme-container w-full mx-auto">
            <div class="w-full flex flex-col sm:flex-row justify-between items-center border-t border-purple/10 pt-10 md:pt-[60px] pb-20 gap-5">
                @if($previousProject)
                <div class="flex items-center gap-8">
                    <img src="{{ asset($previousProject->thumb_image) }}" alt=""
                        class="w-[110px] aspect-square rounded-lg object-cover" />
                    <div>
                        <p class="text-sm font-semibold text-paragraph">{{ $previousProject->portfolioCategory?->name }}</p>
                        <a href="{{ route('project', $previousProject->slug) }}"
                            class="text-18 lg:text-22 font-semibold text-main-black mt-2 font-inter line-clamp-2 block hover:text-purple transition-colors">
                            {{ $previousProject->title }}
                        </a>
                    </div>
                </div>
                @endif
                {{ get_svg('innerpage.divider') }}
                @if($nextProject)
                <div class="flex items-center gap-8">
                    <img src="{{ asset($nextProject->thumb_image) }}" alt=""
                        class="w-[110px] aspect-square rounded-lg object-cover" />
                    <div>
                        <p class="text-sm font-semibold text-paragraph">{{ $nextProject->portfolioCategory?->name }}</p>
                        <a href="{{ route('project', $nextProject->slug) }}"
                            class="text-18 lg:text-22 font-semibold text-main-black mt-2 font-inter line-clamp-2 block hover:text-purple transition-colors">
                            {{ $nextProject->title }}
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

</main>
@endsection

{{-- Video player popup (YouTube) --}}
@section('popup_video')
<div id="video-player"
    class="video-play-btn fixed top-0 left-0 w-screen h-screen bg-black/70 z-[51] hidden justify-center items-center player-open-anim transition-all duration-300 overflow-hidden origin-top-left">
    <button class="text-24 text-white/90 transition-all duration-300 hover:text-white/100 absolute right-10 top-10">
        {{ __('X') }}
    </button>
    <iframe class="absolute aspect-video max-w-[1280px] max-h-[720px]"
        src="https://www.youtube.com/embed/{{ $project->video_url ?: 'ZUXNCY2R5Wo' }}?si=E8zWRcLieSpVH2z4"
        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen>
    </iframe>
</div>
@endsection

{{-- Media modal (for portfolio items) --}}
<div id="pf-media-modal" role="dialog" aria-modal="true" aria-label="Media viewer">
    <button id="pf-modal-close" aria-label="Close">&times;</button>
    <div id="pf-modal-inner"></div>
</div>

@push('script_section')
<script>
/* ── Media modal ── */
(function () {
    const modal      = document.getElementById('pf-media-modal');
    const modalInner = document.getElementById('pf-modal-inner');
    const closeBtn   = document.getElementById('pf-modal-close');
    if (!modal) return;
    function openPfModal(thumb) {
        const type = thumb.dataset.modalType, src = thumb.dataset.modalSrc;
        modalInner.classList.remove('portrait');
        modalInner.innerHTML = '';
        if (type === 'bunny') {
            const iframe = document.createElement('iframe');
            iframe.src = src + (src.includes('?') ? '&' : '?') + 'autoplay=true&responsive=true';
            iframe.setAttribute('frameborder', '0'); iframe.setAttribute('scrolling', 'no');
            iframe.setAttribute('allow', 'accelerometer;autoplay;encrypted-media;picture-in-picture');
            iframe.setAttribute('allowfullscreen', '');
            modalInner.appendChild(iframe);
        } else if (type === 'video') {
            const video = document.createElement('video');
            video.src = src; video.setAttribute('controls', ''); video.setAttribute('autoplay', ''); video.setAttribute('playsinline', '');
            modalInner.appendChild(video);
        } else {
            const img = document.createElement('img'); img.src = src; img.alt = '';
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

/* ── Filter + lazy-batch loader for portfolio items ── */
(function () {
    const BATCH     = 8;
    const tabs      = document.querySelectorAll('.pf-tab');
    const cards     = Array.from(document.querySelectorAll('.portfolio-card'));
    const emptyMsg  = document.getElementById('pf-empty');
    const shimGrid  = document.getElementById('pf-shimmer-grid');
    const shimCards = shimGrid ? Array.from(shimGrid.querySelectorAll('.pf-shimmer')) : [];
    const loadWrap  = document.getElementById('pf-load-more-wrap');
    const loadBtn   = document.getElementById('pf-load-more');
    const countText = document.getElementById('pf-count-text');
    const sentinel  = document.getElementById('pf-scroll-sentinel');
    if (!tabs.length || !cards.length) return;

    let filteredCards = [], shownCount = 0, isLoading = false;

    function getFiltered(filter) { return filter === 'all' ? cards : cards.filter(c => c.dataset.category === filter); }
    function updateUI() {
        const total = filteredCards.length, shown = Math.min(shownCount, total);
        countText.textContent = shown + ' of ' + total + ' items';
        loadWrap.style.display = shown < total ? '' : 'none';
    }
    function showShimmers(count) { shimCards.forEach((s,i) => s.style.display = i < count ? '' : 'none'); shimGrid.style.display = ''; }
    function hideShimmers() { shimGrid.style.display = 'none'; }
    function revealCards(batch, animate) {
        batch.forEach((card, i) => {
            card.style.display = '';
            card.classList.add('aos-animate');
            if (animate) {
                card.style.animationDelay = (i * 45) + 'ms';
                card.classList.remove('pf-card-reveal'); void card.offsetWidth; card.classList.add('pf-card-reveal');
            }
        });
    }
    function applyFilter(filter) {
        shownCount = 0; isLoading = false;
        cards.forEach(c => { c.style.display = 'none'; c.classList.remove('pf-card-reveal'); });
        hideShimmers();
        filteredCards = getFiltered(filter);
        if (!filteredCards.length) { emptyMsg && emptyMsg.classList.remove('hidden'); loadWrap.style.display = 'none'; return; }
        emptyMsg && emptyMsg.classList.add('hidden');
        revealCards(filteredCards.slice(0, BATCH), false);
        shownCount = Math.min(BATCH, filteredCards.length);
        updateUI();
    }
    function loadMore() {
        if (isLoading) return;
        const next = filteredCards.slice(shownCount, shownCount + BATCH);
        if (!next.length) return;
        isLoading = true; loadBtn.disabled = true;
        countText.textContent = 'Loading...'; countText.classList.add('loading-pulse');
        showShimmers(next.length);
        setTimeout(() => {
            hideShimmers(); revealCards(next, true);
            shownCount += next.length; loadBtn.disabled = false; isLoading = false;
            countText.classList.remove('loading-pulse'); updateUI();
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
