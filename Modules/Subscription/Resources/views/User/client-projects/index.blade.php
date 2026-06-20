@extends('inner_layout')

@section('title')
    <title>{{ __('My Projects') }}</title>
@endsection

@section('frontend_content')
    <main>
        <x-breadcrumb name="{{ __('My Projects') }}" />

        <section class="dashboard py-20">
            <div class="theme-container mx-auto">
                <div class="flex flex-col xl:flex-row gap-30">
                    @include('user.sidebar')

                    <div class="dashboard-main w-full flex-1 max-w-[982px]">
                        <div class="p-6 rounded-[10px] bg-white" data-aos="fade-up">
                            <h4 class="text-22 font-semibold mb-6">{{ __('My Projects') }}</h4>

                            @if ($projects->isEmpty())
                                @include('user._no_order')
                            @else
                                <div class="grid sm:grid-cols-2 gap-6">
                                    @foreach ($projects as $project)
                                        <div class="border border-[#E6E0FF] rounded-xl p-5 flex flex-col gap-3">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h5 class="text-18 font-semibold text-black">{{ $project->name }}</h5>
                                                    <p class="text-sm text-paragraph mt-1">{{ $project->title }}</p>
                                                </div>
                                                <div class="flex flex-col items-end gap-1">
                                                    {{-- Payment type badge --}}
                                                    @if ($project->payment_type === 'split')
                                                        <span class="text-xs px-3 py-1 rounded-full bg-blue-100 text-blue-700">{{ __('Split') }}</span>
                                                    @else
                                                        <span class="text-xs px-3 py-1 rounded-full bg-purple-100 text-purple-700">{{ __('Monthly') }}</span>
                                                    @endif
                                                    {{-- Status badge --}}
                                                    @if ($project->status === 'active')
                                                        <span class="text-xs px-3 py-1 rounded-full bg-green-100 text-green-700">{{ __('Active') }}</span>
                                                    @elseif ($project->status === 'paused')
                                                        <span class="text-xs px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">{{ __('Paused') }}</span>
                                                    @else
                                                        <span class="text-xs px-3 py-1 rounded-full bg-gray-100 text-gray-600">{{ __('Completed') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="flex items-center justify-between text-sm text-paragraph">
                                                <span>{{ __('Total') }}: <strong class="text-black">{{ currency($project->total_price) }}</strong></span>
                                                @php $pendingCount = $project->pendingInstallments->count(); @endphp
                                                @if ($pendingCount > 0)
                                                    <span class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-600">
                                                        {{ $pendingCount }} {{ __('payment(s) due') }}
                                                    </span>
                                                @else
                                                    <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-600">
                                                        {{ __('All paid') }}
                                                    </span>
                                                @endif
                                            </div>

                                            @if ($project->start_date || $project->end_date)
                                                <p class="text-xs text-paragraph">
                                                    @if ($project->start_date)
                                                        {{ __('Start') }}: {{ $project->start_date->format('d M Y') }}
                                                    @endif
                                                    @if ($project->end_date)
                                                        &nbsp;|&nbsp; {{ __('End') }}: {{ $project->end_date->format('d M Y') }}
                                                    @endif
                                                </p>
                                            @endif

                                            <a href="{{ route('user.client-projects.show', $project->id) }}"
                                               class="mt-auto inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-purple text-white text-sm font-medium hover:bg-opacity-90 transition-all">
                                                {{ __('View Details') }}
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @if(session('payment_success'))
    @php $ps = session('payment_success'); @endphp

    {{-- Overlay --}}
    <div id="paymentSuccessModal"
         style="position:fixed;inset:0;z-index:9999;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,0.55);backdrop-filter:blur(4px);">
        <div style="background:#fff;border-radius:20px;padding:40px 32px;max-width:440px;width:90%;text-align:center;box-shadow:0 25px 60px rgba(0,0,0,0.18);position:relative;animation:modalIn .35s cubic-bezier(.34,1.56,.64,1) both;">

            {{-- Lottie --}}
            <div id="lottie-success" style="width:160px;height:160px;margin:0 auto 8px;"></div>

            <h3 style="font-size:22px;font-weight:700;color:#101828;margin-bottom:8px;">{{ __('Payment Successful!') }}</h3>
            <p style="font-size:14px;color:#667085;margin-bottom:24px;">{{ __('Your payment has been processed successfully.') }}</p>

            {{-- Details card --}}
            <div style="background:#f9f5ff;border-radius:12px;padding:16px;text-align:left;margin-bottom:28px;">
                <div style="display:flex;justify-content:space-between;padding:6px 0;border-bottom:1px solid #ede9fe;">
                    <span style="font-size:13px;color:#667085;">{{ __('Project') }}</span>
                    <span style="font-size:13px;font-weight:600;color:#101828;">{{ $ps['project_name'] }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;padding:6px 0;border-bottom:1px solid #ede9fe;">
                    <span style="font-size:13px;color:#667085;">{{ __('Invoice') }}</span>
                    <span style="font-size:13px;font-weight:600;color:#101828;">{{ $ps['invoice_number'] }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;padding:6px 0;border-bottom:1px solid #ede9fe;">
                    <span style="font-size:13px;color:#667085;">{{ __('Amount Paid') }}</span>
                    <span style="font-size:13px;font-weight:700;color:#794AFF;">{{ currency($ps['amount']) }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;padding:6px 0;">
                    <span style="font-size:13px;color:#667085;">{{ __('Method') }}</span>
                    <span style="font-size:13px;font-weight:600;color:#101828;">{{ $ps['payment_method'] }}</span>
                </div>
            </div>

            {{-- Countdown button --}}
            <button onclick="closeSuccessModal()"
                style="width:100%;padding:13px;background:#794AFF;color:#fff;border:none;border-radius:10px;font-size:15px;font-weight:600;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;">
                {{ __('Continue') }}
                <span id="countdown-badge"
                    style="background:rgba(255,255,255,0.25);border-radius:20px;padding:2px 10px;font-size:13px;">5</span>
            </button>
        </div>
    </div>

    <style>
        @keyframes modalIn {
            from { opacity:0; transform:scale(.85) translateY(20px); }
            to   { opacity:1; transform:scale(1)  translateY(0);     }
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js"></script>
    <script>
        "use strict";
        lottie.loadAnimation({
            container: document.getElementById('lottie-success'),
            renderer: 'svg',
            loop: false,
            autoplay: true,
            path: '{{ asset('lottie/success.json') }}'
        });

        var _countdown = 5;
        var _timer = setInterval(function () {
            _countdown--;
            var badge = document.getElementById('countdown-badge');
            if (badge) badge.textContent = _countdown;
            if (_countdown <= 0) {
                clearInterval(_timer);
                closeSuccessModal();
            }
        }, 1000);

        function closeSuccessModal() {
            clearInterval(_timer);
            var modal = document.getElementById('paymentSuccessModal');
            if (modal) {
                modal.style.opacity = '0';
                modal.style.transition = 'opacity .3s';
                setTimeout(function(){ modal.remove(); }, 300);
            }
        }
    </script>
    @endif
@endsection
