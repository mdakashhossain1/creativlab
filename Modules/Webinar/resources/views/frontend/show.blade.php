<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $webinar->title }}</title>
    <meta name="description" content="{{ $webinar->title }}">

    {{-- GrapesJS page CSS --}}
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body { margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
        img { max-width: 100%; }

        {!! $webinar->page_css !!}

        /* ── Registration section ───────────────────────────────────────── */
        .wb-reg-section { padding: 80px 20px; background: linear-gradient(135deg,#1a1a2e,#16213e); }
        .wb-reg-box { max-width: 560px; margin: 0 auto; background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.1); border-radius: 20px; padding: 48px 40px; }
        @media(max-width:600px){ .wb-reg-box { padding: 32px 20px; } }
        .wb-reg-label { color: #818cf8; font-weight: 600; font-size: 13px; letter-spacing: 2px; text-transform: uppercase; text-align: center; margin-bottom: 8px; }
        .wb-reg-title { color: #fff; font-size: 1.8rem; font-weight: 800; text-align: center; margin: 0 0 8px; }
        .wb-reg-sub { color: #94a3b8; text-align: center; margin: 0 0 28px; }
        .wb-badge-row { display: flex; gap: 8px; justify-content: center; flex-wrap: wrap; margin-bottom: 20px; }
        .wb-badge { display: inline-flex; align-items: center; gap: 6px; background: rgba(99,102,241,.15); border: 1px solid #6366f1; color: #818cf8; padding: 5px 13px; border-radius: 20px; font-size: 13px; }
        .wb-form-group { margin-bottom: 16px; }
        .wb-form-group label { color: #cbd5e1; font-size: 13px; font-weight: 600; display: block; margin-bottom: 6px; }
        .wb-form-group input { width: 100%; padding: 12px 16px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.15); border-radius: 8px; color: #fff; font-size: 15px; outline: none; transition: border-color .15s; }
        .wb-form-group input::placeholder { color: #64748b; }
        .wb-form-group input:focus { border-color: #6366f1; background: rgba(99,102,241,.1); }
        .wb-submit-btn { width: 100%; padding: 14px; background: #6366f1; color: #fff; font-size: 16px; font-weight: 700; border: none; border-radius: 8px; cursor: pointer; margin-top: 8px; transition: background .15s; }
        .wb-submit-btn:hover { background: #4f46e5; }
        .wb-success-box { text-align: center; padding: 32px 0; }
        .wb-success-box .wb-icon { font-size: 56px; margin-bottom: 16px; }
        .wb-success-box h2 { color: #10b981; font-size: 1.6rem; font-weight: 800; margin: 0 0 10px; }
        .wb-success-box p { color: #94a3b8; margin: 0; }
        .wb-alert-error { background: rgba(220,38,38,.15); border: 1px solid #dc2626; color: #fca5a5; padding: 12px 16px; border-radius: 8px; margin-bottom: 18px; font-size: 14px; }
    </style>
</head>
<body>

{{-- ── GrapesJS built page content ──────────────────────────────────────── --}}
@if($webinar->page_html)
    {!! $webinar->page_html !!}
@else
    <section style="padding:120px 20px;text-align:center;background:linear-gradient(135deg,#1a1a2e,#0f3460);color:#fff;">
        <h1 style="font-size:clamp(2rem,5vw,3.5rem);font-weight:800;margin-bottom:16px;">{{ $webinar->title }}</h1>
        @if($webinar->webinar_date)
            <p style="color:#818cf8;font-size:18px;margin-bottom:32px;">📅 {{ $webinar->webinar_date->format('l, d F Y • H:i') }}</p>
        @endif
        <a href="#register" style="background:#6366f1;color:#fff;padding:16px 40px;border-radius:8px;font-weight:700;text-decoration:none;font-size:16px;">Register Now →</a>
    </section>
@endif

{{-- ── Registration / Confirmation section ──────────────────────────────── --}}
<section class="wb-reg-section" id="register">
    <div class="wb-reg-box">

        @if(session('alert-type') === 'success')
            <div class="wb-success-box">
                <div class="wb-icon">🎉</div>
                <h2>You're Registered!</h2>
                <p>{{ session('message') }}</p>
                <p style="margin-top:12px;color:#64748b;">A confirmation will be sent to your email.</p>
            </div>

        @elseif($registered)
            <div class="wb-success-box">
                <div class="wb-icon">✅</div>
                <h2>Already Registered</h2>
                <p>You're already signed up for this webinar. Check your email for details.</p>
            </div>

        @else
            <p class="wb-reg-label">Reserve Your Spot</p>
            <h2 class="wb-reg-title">Register for the Webinar</h2>
            <p class="wb-reg-sub">
                @if($webinar->payment_enabled)
                    {{ $webinar->currency_symbol }}{{ number_format($webinar->price, 2) }} — Secure your seat now
                @else
                    Free Event — Limited Seats Available
                @endif
            </p>

            @if($webinar->webinar_date || $webinar->total_seats > 0)
            <div class="wb-badge-row">
                @if($webinar->webinar_date)
                    <span class="wb-badge">📅 {{ $webinar->webinar_date->format('d M Y, H:i') }}</span>
                @endif
                @if($webinar->total_seats > 0)
                    <span class="wb-badge">💺 {{ max(0, $webinar->total_seats - $webinar->registrations()->count()) }} seats left</span>
                @endif
            </div>
            @endif

            @if(session('alert-type') === 'error')
                <div class="wb-alert-error">{{ session('message') }}</div>
            @endif

            @if($errors->any())
                <div class="wb-alert-error">
                    @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
                </div>
            @endif

            <form action="{{ route('webinar.register', $webinar->slug) }}" method="POST">
                @csrf
                <div class="wb-form-group">
                    <label>Full Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Your full name">
                </div>
                <div class="wb-form-group">
                    <label>Email Address *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="your@email.com">
                </div>
                <div class="wb-form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+1 (555) 000-0000">
                </div>
                <button type="submit" class="wb-submit-btn">
                    {{ $webinar->payment_enabled ? 'Continue to Payment →' : 'Register for Free →' }}
                </button>
            </form>
        @endif

    </div>
</section>

<script>
    // Countdown — powers any #cnt-days / #cnt-hours / #cnt-mins / #cnt-secs elements in the built page
    (function () {
        const ts = {{ $webinar->webinar_date ? $webinar->webinar_date->timestamp * 1000 : 'null' }};
        if (!ts) return;
        function tick() {
            const diff = ts - Date.now();
            if (diff <= 0) return;
            const d = Math.floor(diff / 86400000);
            const h = Math.floor((diff % 86400000) / 3600000);
            const m = Math.floor((diff % 3600000) / 60000);
            const s = Math.floor((diff % 60000) / 1000);
            [['cnt-days',d],['cnt-hours',h],['cnt-mins',m],['cnt-secs',s]].forEach(([id, v]) => {
                const el = document.getElementById(id);
                if (el) el.textContent = String(v).padStart(2, '0');
            });
        }
        tick();
        setInterval(tick, 1000);
    })();
</script>

</body>
</html>
