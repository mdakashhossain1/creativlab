<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout — {{ $webinar->title }}</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body { margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: linear-gradient(135deg,#1a1a2e,#16213e); min-height: 100vh; }
        .wb-checkout { padding: 60px 20px; }
        .wb-checkout-box { max-width: 640px; margin: 0 auto; }
        .wb-checkout-box h2 { color: #fff; font-size: 1.8rem; font-weight: 800; margin: 0 0 4px; }
        .wb-sub { color: #94a3b8; margin: 0 0 32px; }
        .wb-section-title { color: #818cf8; font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 12px; }
        .wb-order-card { background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.1); border-radius: 16px; padding: 24px; margin-bottom: 24px; }
        .row-line { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,.07); color: #cbd5e1; font-size: 14px; }
        .row-line:last-child { border-bottom: none; font-weight: 700; font-size: 16px; color: #fff; }
        .wb-pay-method { background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.1); border-radius: 12px; padding: 20px; margin-bottom: 12px; cursor: pointer; transition: border-color .15s; }
        .wb-pay-method:hover, .wb-pay-method.active { border-color: #6366f1; background: rgba(99,102,241,.1); }
        .wb-pay-method h5 { color: #fff; font-size: 15px; font-weight: 700; margin: 0 0 4px; }
        .wb-pay-method p { color: #64748b; font-size: 13px; margin: 0; }
        .wb-pay-body { display: none; margin-top: 16px; padding-top: 16px; border-top: 1px solid rgba(255,255,255,.08); }
        .wb-pay-body.show { display: block; }
        .wb-input { width: 100%; padding: 12px 16px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.15); border-radius: 8px; color: #fff; font-size: 14px; outline: none; margin-bottom: 12px; }
        .wb-input::placeholder { color: #64748b; }
        .wb-input:focus { border-color: #6366f1; }
        .wb-pay-btn { width: 100%; padding: 14px; background: #6366f1; color: #fff; font-size: 16px; font-weight: 700; border: none; border-radius: 8px; cursor: pointer; }
        .wb-pay-btn:hover { background: #4f46e5; }
        .wb-alert-error { background: rgba(220,38,38,.15); border: 1px solid #dc2626; color: #fca5a5; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
        .wb-back { display: inline-flex; align-items: center; gap: 6px; color: #818cf8; text-decoration: none; font-size: 14px; margin-bottom: 32px; }
        .wb-back:hover { color: #a5b4fc; }
    </style>
</head>
<body>
<div class="wb-checkout">
    <div class="wb-checkout-box">

        <a href="{{ route('webinar.show', $webinar->slug) }}" class="wb-back">← Back to webinar</a>

        <div style="text-align:center;margin-bottom:40px;">
            <p class="wb-section-title">Secure Checkout</p>
            <h2>Complete Your Registration</h2>
            <p class="wb-sub">for <strong style="color:#818cf8;">{{ $webinar->title }}</strong></p>
        </div>

        {{-- Order Summary --}}
        <div class="wb-order-card">
            <p class="wb-section-title" style="margin-bottom:16px;">Order Summary</p>
            <div class="row-line"><span>Attendee</span><span>{{ $attendee['name'] }}</span></div>
            <div class="row-line"><span>Email</span><span>{{ $attendee['email'] }}</span></div>
            @if(!empty($attendee['phone']))
            <div class="row-line"><span>Phone</span><span>{{ $attendee['phone'] }}</span></div>
            @endif
            @if($webinar->webinar_date)
            <div class="row-line"><span>Date</span><span>{{ $webinar->webinar_date->format('d M Y, H:i') }}</span></div>
            @endif
            <div class="row-line"><span>Total</span><span>{{ $webinar->currency_symbol }}{{ number_format($webinar->price, 2) }}</span></div>
        </div>

        {{-- Payment Methods --}}
        <p class="wb-section-title">Choose Payment Method</p>

        @if(session('alert-type') === 'error')
        <div class="wb-alert-error">{{ session('message') }}</div>
        @endif

        {{-- Stripe --}}
        @if(!empty($payment->stripe_key ?? null))
        <div class="wb-pay-method" onclick="toggleMethod('stripe')">
            <h5>💳 Credit / Debit Card (Stripe)</h5>
            <p>Visa, Mastercard, American Express — instant</p>
            <div class="wb-pay-body" id="method-stripe">
                <form action="{{ route('webinar.pay.stripe', $webinar->slug) }}" method="POST" id="stripe-form">
                    @csrf
                    <input type="hidden" name="stripeToken" id="stripeToken">
                    <input type="text" class="wb-input" id="cardNumber" placeholder="Card Number (1234 5678 9012 3456)" maxlength="19">
                    <div style="display:flex;gap:10px;">
                        <input type="text" class="wb-input" id="cardExpiry" placeholder="MM / YY" style="flex:1;" maxlength="7">
                        <input type="text" class="wb-input" id="cardCvc" placeholder="CVC" style="flex:1;" maxlength="4">
                    </div>
                    <button type="submit" class="wb-pay-btn" id="stripe-submit">Pay {{ $webinar->currency_symbol }}{{ number_format($webinar->price, 2) }} with Card</button>
                </form>
            </div>
        </div>
        @endif

        {{-- Razorpay --}}
        @if(!empty($payment->razorpay_key ?? null))
        <div class="wb-pay-method" onclick="toggleMethod('razorpay')">
            <h5>🔷 Razorpay</h5>
            <p>UPI, cards, net banking, wallets</p>
            <div class="wb-pay-body" id="method-razorpay">
                <form action="{{ route('webinar.pay.razorpay', $webinar->slug) }}" method="POST" id="razorpay-form">
                    @csrf
                    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                    <button type="button" class="wb-pay-btn" id="razorpay-btn">Pay with Razorpay</button>
                </form>
            </div>
        </div>
        @endif

        {{-- Bank Transfer --}}
        <div class="wb-pay-method" onclick="toggleMethod('bank')">
            <h5>🏦 Bank Transfer</h5>
            <p>Manual bank payment — pending admin approval</p>
            <div class="wb-pay-body" id="method-bank">
                @if(!empty($payment->bank_account_name ?? null))
                <div style="background:rgba(255,255,255,.05);border-radius:8px;padding:16px;margin-bottom:16px;font-size:13px;color:#cbd5e1;line-height:1.8;">
                    <strong style="color:#818cf8;">Bank Details:</strong><br>
                    Account Name: {{ $payment->bank_account_name ?? 'N/A' }}<br>
                    Account Number: {{ $payment->bank_account_number ?? 'N/A' }}<br>
                    Bank Name: {{ $payment->bank_name ?? 'N/A' }}<br>
                    @if(!empty($payment->bank_routing_number ?? null))Routing: {{ $payment->bank_routing_number }}<br>@endif
                </div>
                @else
                <div style="background:rgba(255,255,255,.05);border-radius:8px;padding:16px;margin-bottom:16px;font-size:13px;color:#94a3b8;">
                    Please contact us for bank transfer details.
                </div>
                @endif
                <form action="{{ route('webinar.pay.bank', $webinar->slug) }}" method="POST">
                    @csrf
                    <input type="text" name="tnx_info" class="wb-input" placeholder="Enter your transaction / reference ID" required>
                    <button type="submit" class="wb-pay-btn">Submit Bank Payment</button>
                </form>
            </div>
        </div>

        <p style="color:#475569;font-size:12px;text-align:center;margin-top:20px;">
            🔒 Your information is secured with 256-bit SSL encryption.
        </p>
    </div>
</div>

<script src="https://js.stripe.com/v2/"></script>
<script>
function toggleMethod(id) {
    document.querySelectorAll('.wb-pay-body').forEach(el => el.classList.remove('show'));
    document.querySelectorAll('.wb-pay-method').forEach(el => el.classList.remove('active'));
    const body = document.getElementById('method-' + id);
    if (body) {
        body.classList.add('show');
        body.closest('.wb-pay-method').classList.add('active');
    }
}

const cardEl = document.getElementById('cardNumber');
if (cardEl) {
    cardEl.addEventListener('input', function () {
        let v = this.value.replace(/\D/g,'').substring(0,16);
        this.value = v.replace(/(.{4})/g,'$1 ').trim();
    });
}
const expiryEl = document.getElementById('cardExpiry');
if (expiryEl) {
    expiryEl.addEventListener('input', function () {
        let v = this.value.replace(/\D/g,'').substring(0,4);
        if (v.length >= 2) v = v.substring(0,2) + ' / ' + v.substring(2);
        this.value = v;
    });
}

const stripeForm = document.getElementById('stripe-form');
if (stripeForm) {
    const stripeKey = @json($payment->stripe_key ?? '');
    if (stripeKey) Stripe.setPublishableKey(stripeKey);
    document.getElementById('stripe-submit').addEventListener('click', function (e) {
        e.preventDefault();
        const cardNum = (document.getElementById('cardNumber').value || '').replace(/\s/g,'');
        const expiry  = (document.getElementById('cardExpiry').value || '').replace(/\s/g,'').split('/');
        const cvc     = document.getElementById('cardCvc').value || '';
        Stripe.card.createToken({ number: cardNum, exp_month: (expiry[0]||'').trim(), exp_year: (expiry[1]||'').trim(), cvc }, function (status, response) {
            if (response.error) { alert(response.error.message); }
            else { document.getElementById('stripeToken').value = response.id; stripeForm.submit(); }
        });
    });
}

const razorpayBtn = document.getElementById('razorpay-btn');
if (razorpayBtn) {
    const rzpKey = @json($payment->razorpay_key ?? '');
    const options = {
        key: rzpKey,
        amount: @json((int)($webinar->price * 100)),
        currency: 'INR',
        name: @json($webinar->title),
        description: 'Webinar Registration',
        handler: function (response) {
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay-form').submit();
        },
        prefill: { name: @json($attendee['name']), email: @json($attendee['email']) },
        theme: { color: '#6366f1' }
    };
    razorpayBtn.addEventListener('click', function () {
        new Razorpay(options).open();
    });
    const s = document.createElement('script');
    s.src = 'https://checkout.razorpay.com/v1/checkout.js';
    document.head.appendChild(s);
}
</script>
</body>
</html>
