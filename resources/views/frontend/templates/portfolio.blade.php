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
    .pf-card .pf-img { position:relative; overflow:hidden; aspect-ratio:4/3; }
    .pf-card .pf-img img { width:100%; height:100%; object-fit:cover; transition:transform .5s ease; }
    .pf-card:hover .pf-img img { transform:scale(1.07); }
    .pf-img-overlay { position:absolute; inset:0; background:linear-gradient(to top, rgba(12,8,30,.55) 0%, transparent 55%); }
    .pf-play { position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); width:54px; height:54px; border-radius:50%; background:rgba(255,255,255,.92); display:flex; align-items:center; justify-content:center; box-shadow:0 8px 24px rgba(0,0,0,.25); transition:transform .3s; }
    .pf-card:hover .pf-play { transform:translate(-50%,-50%) scale(1.12); }
    .pf-video-card { position:relative; border-radius:16px; overflow:hidden; aspect-ratio:4/5; cursor:pointer; }
    .pf-video-card img { width:100%; height:100%; object-fit:cover; transition:transform .5s ease; }
    .pf-video-card:hover img { transform:scale(1.07); }
    .pf-video-overlay { position:absolute; inset:0; background:linear-gradient(to top, rgba(12,8,30,.8) 0%, rgba(12,8,30,.1) 60%, transparent 100%); }
    @keyframes pfFloat { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }
</style>
@endpush

@section('frontend_content')
    <main>

        {{-- ===================== HERO ===================== --}}
        <section class="pf-hero w-full xl:pt-[200px] pt-[140px] xl:pb-[90px] pb-16 relative overflow-hidden">
            <div class="absolute top-1/3 left-1/4 w-72 h-72 rounded-full bg-purple/20 blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 right-1/4 w-80 h-80 rounded-full bg-[#BA4AFF]/15 blur-3xl pointer-events-none"></div>
            {{-- grid texture --}}
            <div class="absolute inset-0 opacity-[0.04] pointer-events-none" style="background-image: repeating-linear-gradient(0deg,#fff 0,#fff 1px,transparent 1px,transparent 54px),repeating-linear-gradient(90deg,#fff 0,#fff 1px,transparent 1px,transparent 54px);"></div>

            <div class="theme-container mx-auto relative z-10 text-center">
                <h1 class="xl:text-[64px] md:text-[50px] text-[34px] font-bold text-white leading-[1.1] mb-7" data-aos="fade-up">
                    Our <span class="pf-hero-highlight">Creative</span> Portfolio
                </h1>
                <p class="text-white/70 text-base md:text-lg leading-8 max-w-[640px] mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Explore some of our recent works in
                    <span class="text-[#9D7BFF] font-semibold">Branding</span>,
                    <span class="text-[#9D7BFF] font-semibold">Web Development</span>,
                    <span class="text-[#9D7BFF] font-semibold">Ad Films</span>,
                    <span class="text-[#9D7BFF] font-semibold">Creative Content</span>, and
                    <span class="text-[#9D7BFF] font-semibold">Digital Marketing</span>.
                </p>
            </div>
        </section>

        {{-- ===================== BROWSE / TABS / GRID ===================== --}}
        <section class="w-full bg-white md:py-[90px] py-14">
            <div class="theme-container mx-auto">
                <h2 class="md:text-40 text-28 font-bold text-main-black text-center mb-9" data-aos="fade-up">Browse our work</h2>

                {{-- tabs --}}
                <div class="flex flex-wrap items-center justify-center gap-3 md:gap-4 mb-12" data-aos="fade-up">
                    <button class="pf-tab tab-active" data-filter="all">All Projects</button>
                    <button class="pf-tab" data-filter="branding">Branding</button>
                    <button class="pf-tab" data-filter="web">Web Design</button>
                    <button class="pf-tab" data-filter="adfilm">Ad Films</button>
                    <button class="pf-tab" data-filter="content">Creative Content</button>
                </div>

                @php
                    $works = [
                        ['img' => 'frontend/assets/images/projects/1.webp', 'cat' => 'content',  'label' => 'Digital Marketing', 'title' => 'ZWEAR Campaign',        'video' => false, 'extra' => false],
                        ['img' => 'frontend/assets/images/projects/2.webp', 'cat' => 'branding', 'label' => 'Branding',          'title' => 'ScorePlus Branding',     'video' => false, 'extra' => false],
                        ['img' => 'frontend/assets/images/projects/3.webp', 'cat' => 'web',      'label' => 'Web Design',         'title' => 'TechFlow Website',       'video' => false, 'extra' => false],
                        ['img' => 'frontend/assets/images/projects/4.webp', 'cat' => 'branding', 'label' => 'Branding',          'title' => 'Nature Glow Packaging',  'video' => false, 'extra' => false],
                        ['img' => 'frontend/assets/images/projects/5.webp', 'cat' => 'adfilm',   'label' => 'Ad Film',            'title' => 'Machine Arts Ad Film',   'video' => true,  'extra' => false],
                        ['img' => 'frontend/assets/images/projects/6.webp', 'cat' => 'branding', 'label' => 'Branding',          'title' => 'Pure Essence Branding',  'video' => false, 'extra' => false],
                        ['img' => 'frontend/assets/images/projects/7.webp', 'cat' => 'content',  'label' => 'Social Media',       'title' => 'Travellists Reels',      'video' => true,  'extra' => false],
                        ['img' => 'frontend/assets/images/projects/8.webp', 'cat' => 'web',      'label' => 'Web Design',         'title' => 'TaskHub Dashboard',      'video' => false, 'extra' => false],
                        // extra (revealed by Load More)
                        ['img' => 'frontend/assets/images/projects/9.webp', 'cat' => 'adfilm',   'label' => 'Ad Film',            'title' => 'Revolt Motors Film',     'video' => true,  'extra' => true],
                        ['img' => 'frontend/assets/images/projects/1.webp', 'cat' => 'web',      'label' => 'Web Design',         'title' => 'Finovate Fintech',       'video' => false, 'extra' => true],
                        ['img' => 'frontend/assets/images/projects/3.webp', 'cat' => 'content',  'label' => 'Content',            'title' => 'Urban Edge Reels',       'video' => true,  'extra' => true],
                        ['img' => 'frontend/assets/images/projects/6.webp', 'cat' => 'branding', 'label' => 'Branding',          'title' => 'BuildCraft Identity',    'video' => false, 'extra' => true],
                    ];
                @endphp

                <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6" id="portfolio-grid">
                    @foreach($works as $w)
                    <div class="pf-card portfolio-card {{ $w['extra'] ? 'pf-extra hidden' : '' }}" data-category="{{ $w['cat'] }}" data-aos="fade-up">
                        <div class="pf-img">
                            <img src="{{ asset($w['img']) }}" alt="{{ $w['title'] }}" />
                            <div class="pf-img-overlay"></div>
                            @if($w['video'])
                            <button class="pf-play"><svg width="20" height="20" viewBox="0 0 24 24" fill="#794AFF" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg></button>
                            @endif
                        </div>
                        <div class="p-5">
                            <p class="text-purple text-[11px] font-bold uppercase tracking-wider mb-1.5">{{ $w['label'] }}</p>
                            <p class="font-bold text-main-black text-base mb-3">{{ $w['title'] }}</p>
                            <a href="javascript:void(0)" class="inline-flex items-center gap-2 text-main-black text-sm font-semibold hover:text-purple transition-colors duration-300 group">
                                View Project
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-purple"><path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- empty state --}}
                <p id="pf-empty" class="hidden text-center text-paragraph py-12">No projects found in this category.</p>

                <div class="w-full flex justify-center mt-12">
                    <button id="pf-load-more" class="inline-flex items-center gap-2.5 bg-white border border-purple/20 text-main-black font-semibold text-sm px-7 py-3.5 rounded-full hover:bg-purple hover:text-white hover:border-purple transition-all duration-300">
                        Load More Projects
                        <span class="size-6 rounded-full bg-purple/10 flex items-center justify-center">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 5v14M5 12h14" stroke="#794AFF" stroke-width="2" stroke-linecap="round"/></svg>
                        </span>
                    </button>
                </div>
            </div>
        </section>

        {{-- ===================== FEATURED WORKS ===================== --}}
        <section class="w-full bg-[#FAFAFA] md:py-[90px] py-14">
            <div class="theme-container mx-auto">
                <div class="grid xl:grid-cols-3 grid-cols-1 gap-10 items-start">
                    {{-- left heading --}}
                    <div data-aos="fade-right">
                        <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3 block">FEATURED WORKS</span>
                        <h2 class="md:text-40 text-28 font-bold text-main-black leading-tight mb-5">Featured Projects We're Proud Of</h2>
                        <p class="text-paragraph text-sm leading-7 mb-7">Some of our most impactful projects that helped brands grow, engage and stand out.</p>
                        <a href="javascript:void(0)" class="inline-flex items-center gap-2.5 bg-purple text-white font-bold text-sm uppercase tracking-wider px-7 py-3.5 rounded-full hover:bg-main-black transition-all duration-300 shadow-purple">
                            View All Works
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>

                    {{-- right featured cards --}}
                    <div class="xl:col-span-2 grid md:grid-cols-3 grid-cols-1 gap-6">
                        @php
                            $featured = [
                                ['img' => 'frontend/assets/images/projects/3.webp', 'label' => 'Web Design', 'title' => 'Finovate – Fintech Website', 'desc' => 'A modern fintech website built for a leading brand.', 'video' => false],
                                ['img' => 'frontend/assets/images/projects/5.webp', 'label' => 'Ad Film',    'title' => 'Revolt Motors Ad Film',     'desc' => 'A cinematic ad film crafted for Revolt Motors.',    'video' => true],
                                ['img' => 'frontend/assets/images/projects/4.webp', 'label' => 'Branding',   'title' => 'Urban Edge Branding',       'desc' => 'Complete branding for a new-age lifestyle brand.',  'video' => false],
                            ];
                        @endphp
                        @foreach($featured as $f)
                        <div class="pf-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="pf-img" style="aspect-ratio:16/11;">
                                <img src="{{ asset($f['img']) }}" alt="{{ $f['title'] }}" />
                                <div class="pf-img-overlay"></div>
                                @if($f['video'])
                                <button class="pf-play"><svg width="18" height="18" viewBox="0 0 24 24" fill="#794AFF" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg></button>
                                @endif
                            </div>
                            <div class="p-5">
                                <p class="text-purple text-[11px] font-bold uppercase tracking-wider mb-1.5">{{ $f['label'] }}</p>
                                <p class="font-bold text-main-black text-base mb-2">{{ $f['title'] }}</p>
                                <p class="text-paragraph text-xs leading-5 mb-3">{{ $f['desc'] }}</p>
                                <a href="javascript:void(0)" class="inline-flex items-center gap-2 text-main-black text-sm font-semibold hover:text-purple transition-colors duration-300">
                                    View Case Study
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-purple"><path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- ===================== MOTION & VIDEO ===================== --}}
        <section class="w-full bg-white md:py-[90px] py-14">
            <div class="theme-container mx-auto">
                <div class="grid xl:grid-cols-3 grid-cols-1 gap-10 items-start">
                    <div data-aos="fade-right">
                        <span class="text-purple text-xs font-bold uppercase tracking-[0.2em] mb-3 block">MOTION & VIDEO</span>
                        <h2 class="md:text-40 text-28 font-bold text-main-black leading-tight mb-5">Motion &amp; Video Projects</h2>
                        <p class="text-paragraph text-sm leading-7 mb-7">Engaging reels, ad films and motion content that tell stories and drive impact.</p>
                        <a href="javascript:void(0)" class="inline-flex items-center gap-2.5 bg-purple text-white font-bold text-sm uppercase tracking-wider px-7 py-3.5 rounded-full hover:bg-main-black transition-all duration-300 shadow-purple">
                            View All Videos
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>

                    <div class="xl:col-span-2 grid grid-cols-2 md:grid-cols-4 gap-4">
                        @php
                            $videos = [
                                ['img' => 'frontend/assets/images/projects/5.webp', 'views' => '12.4K'],
                                ['img' => 'frontend/assets/images/projects/4.webp', 'views' => '24.7K'],
                                ['img' => 'frontend/assets/images/projects/7.webp', 'views' => '31.2K'],
                                ['img' => 'frontend/assets/images/projects/9.webp', 'views' => '16.6K'],
                            ];
                        @endphp
                        @foreach($videos as $v)
                        <div class="pf-video-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                            <img src="{{ asset($v['img']) }}" alt="video" />
                            <div class="pf-video-overlay"></div>
                            <button class="pf-play" style="width:46px;height:46px;"><svg width="16" height="16" viewBox="0 0 24 24" fill="#794AFF" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg></button>
                            <div class="absolute bottom-3 left-3 flex items-center gap-1.5">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="white" stroke-width="1.6"/><circle cx="12" cy="12" r="3" stroke="white" stroke-width="1.6"/></svg>
                                <span class="text-white text-xs font-semibold">{{ $v['views'] }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- ===================== BRANDS ===================== --}}
        <section class="w-full bg-[#FAFAFA] md:py-[70px] py-12">
            <div class="theme-container mx-auto">
                <h2 class="text-center font-bold text-main-black md:text-26 text-22 mb-10" data-aos="fade-up">Brands We've Worked With</h2>
                <div class="flex flex-wrap items-center justify-center xl:justify-between gap-x-10 gap-y-6 opacity-80" data-aos="fade-up">
                    @foreach(['ZWEAR','ScorePlus','Finovate','Nature Glow','Revolt','TechFlow','Pure Essence','Urban Edge'] as $brand)
                    <div class="flex items-center gap-2">
                        <div class="size-7 rounded-md bg-purple/15 flex items-center justify-center"><span class="size-3 rounded-sm bg-purple inline-block"></span></div>
                        <span class="font-bold text-main-black text-base">{{ $brand }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ===================== STATS ===================== --}}
        <section class="w-full bg-[#FAFAFA] md:pb-[70px] pb-12">
            <div class="theme-container mx-auto">
                <div class="relative w-full rounded-[20px] overflow-hidden md:py-9 py-7 px-6 md:px-10" style="background: linear-gradient(90deg,#794AFF 0%,#BA4AFF 50%,#794AFF 100%);">
                    <div class="absolute -top-8 left-1/4 size-32 rounded-full bg-white/10 pointer-events-none"></div>
                    <div class="absolute -bottom-6 right-1/4 size-24 rounded-full bg-white/8 pointer-events-none"></div>
                    <div class="relative z-10 grid xl:grid-cols-4 md:grid-cols-2 grid-cols-2 gap-6 md:gap-0 md:divide-x divide-white/20">
                        @php
                            $stats = [
                                ['icon' => '<rect x="3" y="3" width="18" height="18" rx="3" stroke="currentColor" stroke-width="1.6"/><path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>', 'value' => '100+', 'label' => 'Projects Completed'],
                                ['icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="1.6"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>', 'value' => '50+', 'label' => 'Brands Worked With'],
                                ['icon' => '<path d="M2 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="1.6"/><circle cx="13" cy="12" r="3" stroke="currentColor" stroke-width="1.6"/>', 'value' => '5M+', 'label' => 'Audience Reach'],
                                ['icon' => '<path d="M22 11.08V12a10 10 0 11-5.93-9.14" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M22 4L12 14.01l-3-3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>', 'value' => '99%', 'label' => 'Client Satisfaction'],
                            ];
                        @endphp
                        @foreach($stats as $s)
                        <div class="flex items-center gap-3.5 md:justify-center md:px-6 group">
                            <div class="size-12 rounded-xl bg-white/15 flex items-center justify-center flex-shrink-0 group-hover:bg-white/25 transition-all duration-300">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-white">{!! $s['icon'] !!}</svg>
                            </div>
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
                    <div class="absolute inset-0 opacity-[0.05] pointer-events-none" style="background-image: repeating-linear-gradient(0deg,#fff 0,#fff 1px,transparent 1px,transparent 50px),repeating-linear-gradient(90deg,#fff 0,#fff 1px,transparent 1px,transparent 50px);"></div>

                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8 px-8 md:px-14 xl:px-16 py-12 md:py-14">
                        <div class="text-center md:text-left">
                            <h2 class="xl:text-[40px] md:text-[32px] text-[26px] font-bold text-white leading-tight mb-3">
                                Let's Build Something <span class="text-[#9D7BFF]">Amazing</span> 🤝
                            </h2>
                            <p class="text-white/70 text-base leading-7 md:max-w-[440px]">
                                Ready to elevate your brand with creative digital solutions? Let's bring your vision to life.
                            </p>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center gap-4 flex-shrink-0">
                            <a href="{{ route('contact-us') }}" class="inline-flex items-center gap-2.5 bg-[#25D366] text-white font-bold text-sm uppercase tracking-wider px-7 py-4 rounded-full hover:bg-[#128C7E] transition-all duration-300" style="box-shadow:0 8px 24px rgba(37,211,102,.3);">
                                Start Your Project
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                            <a href="{{ route('contact-us') }}" class="inline-flex items-center gap-2 text-white/90 font-semibold text-sm hover:text-white transition-colors duration-300">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
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
    document.addEventListener('DOMContentLoaded', function () {
        const tabs   = document.querySelectorAll('.pf-tab');
        const cards  = Array.from(document.querySelectorAll('.portfolio-card'));
        const empty  = document.getElementById('pf-empty');
        const loadMoreBtn = document.getElementById('pf-load-more');
        let currentFilter = 'all';
        let expanded = false;

        function applyFilter() {
            let visibleCount = 0;
            cards.forEach(card => {
                const matchesCat   = currentFilter === 'all' || card.dataset.category === currentFilter;
                const isExtra      = card.classList.contains('pf-extra');
                // extra cards only show after Load More (or when a specific filter is chosen)
                const allowedByExpand = !isExtra || expanded || currentFilter !== 'all';
                const show = matchesCat && allowedByExpand;
                card.classList.toggle('hidden', !show);
                if (show) visibleCount++;
            });

            // empty state
            empty.classList.toggle('hidden', visibleCount !== 0);

            // load more visibility: only relevant for "all" view with collapsed extras
            const hiddenExtraInAll = cards.some(c =>
                c.classList.contains('pf-extra') &&
                (currentFilter === 'all') &&
                !expanded
            );
            loadMoreBtn.style.display = (currentFilter === 'all' && hiddenExtraInAll) ? '' : 'none';
        }

        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                tabs.forEach(t => t.classList.remove('tab-active'));
                this.classList.add('tab-active');
                currentFilter = this.dataset.filter;
                applyFilter();
            });
        });

        loadMoreBtn.addEventListener('click', function () {
            expanded = true;
            applyFilter();
        });

        applyFilter();
    });
</script>
@endpush
