@extends('admin.master_layout')
@section('title')<title>{{ __('Office Check-In QR') }}</title>@endsection
@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Office Check-In QR Code') }}</h3>
    <p class="crancy-header__text">{{ __('Attendance') }} >> {{ __('QR Code') }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="crancy-body">
                    <div class="crancy-dsinner">

                        <div class="card border-0 shadow-sm text-center p-4 mt-3">
                            <h4 class="mb-1">Today's Check-In QR Code</h4>
                            <p class="text-muted mb-4" style="font-size:14px;">
                                Display this QR at the office entrance. Team members scan it from the Attendance PWA to check in.
                                <strong>Refreshes daily automatically.</strong>
                            </p>

                            {{-- QR Code rendered by JS --}}
                            <div id="qrcode" class="d-flex justify-content-center mb-4"></div>

                            <div class="alert alert-info d-flex align-items-center gap-2 text-start" style="font-size:13px;">
                                <i class="fas fa-info-circle"></i>
                                <div>
                                    QR Token: <code id="qrToken" style="font-size:12px; word-break:break-all;"></code>
                                </div>
                            </div>

                            <div class="d-flex gap-3 justify-content-center flex-wrap mt-2">
                                <button onclick="window.print()" class="crancy-btn">
                                    <i class="fas fa-print me-2"></i>Print QR Code
                                </button>
                                <a href="{{ url('/attendance-app/') }}" target="_blank" class="btn btn-outline-secondary">
                                    <i class="fas fa-external-link-alt me-2"></i>Open PWA App
                                </a>
                            </div>

                            <hr class="my-4">

                            <h6 class="mb-3 text-muted">PWA Installation Instructions</h6>
                            <div class="row g-3 text-start">
                                <div class="col-md-6">
                                    <div class="p-3 rounded" style="background:#f8fafc; border:1px solid #e2e8f0;">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <i class="fab fa-android text-success fa-lg"></i>
                                            <strong>Android</strong>
                                        </div>
                                        <ol class="mb-0 ps-3" style="font-size:13px;">
                                            <li>Open Chrome browser</li>
                                            <li>Visit: <code style="font-size:11px;">{{ url('/attendance-app/') }}</code></li>
                                            <li>Tap <strong>⋮ Menu → Add to Home Screen</strong></li>
                                            <li>App installs and runs in background</li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 rounded" style="background:#f8fafc; border:1px solid #e2e8f0;">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <i class="fab fa-windows text-primary fa-lg"></i>
                                            <strong>Windows</strong>
                                        </div>
                                        <ol class="mb-0 ps-3" style="font-size:13px;">
                                            <li>Open Edge or Chrome browser</li>
                                            <li>Visit: <code style="font-size:11px;">{{ url('/attendance-app/') }}</code></li>
                                            <li>Click <strong>⋯ Menu → Apps → Install</strong></li>
                                            <li>App installs to Start Menu</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js_section')
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
<script>
"use strict";
const token = 'CREATIVLAB_OFFICE_CHECKIN_{{ date("Ymd") }}';
document.getElementById('qrToken').textContent = token;

QRCode.toCanvas(document.createElement('canvas'), token, {
    width: 280, margin: 2,
    color: { dark: '#0f172a', light: '#ffffff' }
}, function (err, canvas) {
    if (err) return;
    canvas.style.borderRadius = '12px';
    canvas.style.border = '8px solid white';
    canvas.style.boxShadow = '0 4px 20px rgba(0,0,0,.12)';
    document.getElementById('qrcode').appendChild(canvas);
});
</script>
<style>
@media print {
    /* Hide everything */
    body * { visibility: hidden !important; }

    /* Show only the QR canvas and its label */
    #qrcode,
    #qrcode *,
    #qrToken { visibility: visible !important; }

    /* Center QR on the printed page */
    #qrcode {
        position: fixed !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -60%) !important;
    }

    #qrcode canvas {
        width: 350px !important;
        height: 350px !important;
        display: block !important;
    }
}
</style>
@endpush
