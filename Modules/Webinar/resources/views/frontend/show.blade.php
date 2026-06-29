@extends('inner_layout')

@section('title')
<title>{{ $webinar->title }}</title>
<meta name="description" content="{{ $webinar->title }}">
@endsection

@push('style_section')
<style>
    /* Inject GrapesJS page CSS */
    {!! $webinar->page_css !!}

    /* Registration section */
    .wb-reg-section { padding: 80px 20px; background: linear-gradient(135deg,#1a1a2e,#16213e); }
    .wb-reg-box { max-width: 560px; margin: 0 auto; background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.1); border-radius: 20px; padding: 48px 40px; }
    .wb-reg-box h2 { color: #fff; font-size: 1.8rem; font-weight: 800; margin-bottom: 8px; }
    .wb-reg-box p.sub { color: #94a3b8; margin-bottom: 32px; }
    .wb-reg-box .form-group { margin-bottom: 18px; }
    .wb-reg-box label { color: #cbd5e1; font-size: 13px; font-weight: 600; margin-bottom: 6px; display: block; }
    .wb-reg-box input { width: 100%; padding: 12px 16px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.15); border-radius: 8px; color: #fff; font-size: 15px; outline: none; }
    .wb-reg-box input::placeholder { color: #64748b; }
    .wb-reg-box input:focus { border-color: #6366f1; background: rgba(99,102,241,.1); }
    .wb-reg-btn { width: 100%; padding: 14px; background: #6366f1; color: #fff; font-size: 16px; font-weight: 700; border: none; border-radius: 8px; cursor: pointer; margin-top: 8px; }
    .wb-reg-btn:hover { background: #4f46e5; }
    .wb-success-box { text-align: center; padding: 48px 32px; }
    .wb-success-box .icon { font-size: 64px; margin-bottom: 20px; }
    .wb-success-box h2 { color: #10b981; font-size: 1.8rem; font-weight: 800; margin-bottom: 12px; }
    .wb-success-box p { color: #94a3b8; }
    .wb-badge { display: inline-flex; align-items: center; gap: 8px; background: rgba(99,102,241,.15); border: 1px solid #6366f1; color: #818cf8; padding: 6px 14px; border-radius: 20px; font-size: 13px; margin: 4px; }
</style>
@endpush

@section('frontend_content')
<main>

    {{-- ── GrapesJS built page content ─────────────────────────────────── --}}
    @if($webinar->page_html)
        <div class="wb-page-content">
            {!! $webinar->page_html !!}
        </div>
    @else
        {{-- Default when no page is built yet --}}
        <section style="padding:100px 20px;text-align:center;background:linear-gradient(135deg,#1a1a2e,#0f3460);color:#fff;">
            <h1 style="font-size:3rem;font-weight:800;margin-bottom:16px;">{{ $webinar->title }}</h1>
            @if($webinar->webinar_date)
                <p style="color:#818cf8;font-size:18px;margin-bottom:32px;">📅 {{ $webinar->webinar_date->format('l, d F Y • H:i') }}</p>
            @endif
            <a href="#register" style="background:#6366f1;color:#fff;padding:16px 40px;border-radius:8px;font-weight:700;text-decoration:none;font-size:16px;">Register Now →</a>
        </section>
    @endif

    {{-- ── Registration / Success Section ─────────────────────────────── --}}
    <section class="wb-reg-section" id="register">
        <div class="wb-reg-box">

            @if(session('alert-type') === 'success')
                <div class="wb-success-box">
                    <div class="icon">🎉</div>
                    <h2>You're Registered!</h2>
                    <p>{{ session('message') }}</p>
                    <p style="margin-top:16px;color:#64748b;">A confirmation will be sent to your email.</p>
                </div>

            @elseif($registered)
                <div class="wb-success-box">
                    <div class="icon">✅</div>
                    <h2>Already Registered</h2>
                    <p style="color:#94a3b8;">You're already signed up for this webinar. Check your email for details.</p>
                </div>

            @else
                <div style="text-align:center;margin-bottom:32px;">
                    <p style="color:#818cf8;font-weight:600;font-size:13px;letter-spacing:2px;text-transform:uppercase;margin-bottom:8px;">Reserve Your Spot</p>
                    <h2>Register for the Webinar</h2>
                    <p class="sub">
                        @if($webinar->payment_enabled)
                            {{ $webinar->currency_symbol }}{{ number_format($webinar->price, 2) }} — Secure your seat now
                        @else
                            Free Event — Limited Seats Available
                        @endif
                    </p>

                    @if($webinar->webinar_date)
                    <div style="display:flex;gap:8px;justify-content:center;flex-wrap:wrap;margin-bottom:8px;">
                        <span class="wb-badge">📅 {{ $webinar->webinar_date->format('d M Y, H:i') }}</span>
                        @if($webinar->total_seats > 0)
                            <span class="wb-badge">💺 {{ $webinar->total_seats - $webinar->registrations()->count() }} seats left</span>
                        @endif
                    </div>
                    @endif
                </div>

                @if(session('alert-type') === 'error')
                    <div style="background:rgba(220,38,38,.15);border:1px solid #dc2626;color:#fca5a5;padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:14px;">
                        {{ session('message') }}
                    </div>
                @endif

                <form action="{{ route('webinar.register', $webinar->slug) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Full Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Your full name">
                    </div>
                    <div class="form-group">
                        <label>Email Address *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="your@email.com">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+1 (555) 000-0000">
                    </div>
                    <button type="submit" class="wb-reg-btn">
                        @if($webinar->payment_enabled)
                            Continue to Payment →
                        @else
                            Register for Free →
                        @endif
                    </button>
                </form>
            @endif
        </div>
    </section>

</main>

@push('style_section')
<script>
    // Countdown timer
    document.addEventListener('DOMContentLoaded', function () {
        const eventDate = @json($webinar->webinar_date ? $webinar->webinar_date->timestamp * 1000 : null);
        if (!eventDate) return;

        function tick() {
            const diff = eventDate - Date.now();
            if (diff <= 0) return;
            const days  = Math.floor(diff / 86400000);
            const hours = Math.floor((diff % 86400000) / 3600000);
            const mins  = Math.floor((diff % 3600000) / 60000);
            const secs  = Math.floor((diff % 60000) / 1000);
            ['cnt-days','cnt-hours','cnt-mins','cnt-secs'].forEach((id, i) => {
                const el = document.getElementById(id);
                if (el) el.textContent = String([days,hours,mins,secs][i]).padStart(2,'0');
            });
        }
        tick();
        setInterval(tick, 1000);
    });
</script>
@endpush
@endsection
