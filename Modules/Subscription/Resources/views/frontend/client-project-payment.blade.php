@extends('inner_layout')

@section('title')
    <title>{{ __('Project Payment') }}</title>
@endsection
@php
    function client_project_currency_pay($amount, $is_convart = true)
    {
        $currency_icon = session('currency_icon', "$");
        $currency_position = Session::get('currency_position');
        $rate = session('currency_rate', 1);

        if ($is_convart) {
            $amount = $amount * $rate;
        }

        if ($currency_position == 'before_price') {
            $amount = $currency_icon . $amount;
        } elseif ($currency_position == 'before_price_with_space') {
            $amount = $currency_icon . ' ' . $amount;
        } elseif ($currency_position == 'after_price') {
            $amount = $amount . $currency_icon;
        } elseif ($currency_position == 'after_price_with_space') {
            $amount = $amount . ' ' . $currency_icon;
        } else {
            $amount = $currency_icon . $amount;
        }
        return $amount;
    }
@endphp

@section('frontend_content')
    <main>
        <x-breadcrumb name="{{ __('Project Payment') }}" />
        <section class="py-16 md:py-[130px]">
            <div class="theme-container mx-auto">
                <div class="gap-12 grid lg:grid-cols-3">
                    <div class="lg:col-span-2 h-fit">
                        <div class="bg-grayscale-100 rounded-lg border border-grey-300 p-4 sm:p-7 ">
                            <h4 class="text-22 font-medium pb-3 border-b border-grey-300">
                                {{ __('Select Payment Method') }}
                            </h4>
                            <ul class="flex flex-wrap gap-5 mt-6">
                                @if (($payment_setting->paypal_status ?? 0) == 1)
                                    <li>
                                        <button class="w-[244px] h-[58px] flex justify-center items-center border border-grayscale-300 current:border current:border-purple rounded-lg gap-7 payment-check transition-all duration-300" id="paypal_btn">
                                            <div class="w-0 h-0 overflow-hidden current:w-6 current:h-6 flex justify-center items-center current:bg-purple current:text-white transition-all duration-300">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="18" height="18" rx="2" fill="#794AFF" /><path d="M7.82919 12.8459C7.73373 12.9448 7.6035 13 7.46821 13C7.33293 13 7.20269 12.9448 7.10724 12.8459L4.22438 9.87525C3.92521 9.56701 3.92521 9.06719 4.22438 8.75953L4.58536 8.38752C4.88463 8.07929 5.3692 8.07929 5.66838 8.38752L7.46821 10.242L12.3316 5.23118C12.6309 4.92294 13.1159 4.92294 13.4146 5.23118L13.7756 5.60318C14.0748 5.91142 14.0748 6.41115 13.7756 6.7189L7.82919 12.8459Z" fill="white" /></svg>
                                            </div>
                                            <img src="{{ asset($payment_setting->paypal_image) }}" alt="" class="max-w-[174px] max-h-7 object-contain" />
                                        </button>
                                    </li>
                                @endif
                                @if ($payment_setting->razorpay_status == 1)
                                    <li>
                                        <button class="w-[244px] h-[58px] flex justify-center items-center border border-grayscale-300 current:border current:border-purple rounded-lg gap-7 payment-check transition-all duration-300" id="razorpay_btn">
                                            <div class="w-0 h-0 overflow-hidden current:w-6 current:h-6 flex justify-center items-center current:bg-purple current:text-white transition-all duration-300">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="18" height="18" rx="2" fill="#794AFF" /><path d="M7.82919 12.8459C7.73373 12.9448 7.6035 13 7.46821 13C7.33293 13 7.20269 12.9448 7.10724 12.8459L4.22438 9.87525C3.92521 9.56701 3.92521 9.06719 4.22438 8.75953L4.58536 8.38752C4.88463 8.07929 5.3692 8.07929 5.66838 8.38752L7.46821 10.242L12.3316 5.23118C12.6309 4.92294 13.1159 4.92294 13.4146 5.23118L13.7756 5.60318C14.0748 5.91142 14.0748 6.41115 13.7756 6.7189L7.82919 12.8459Z" fill="white" /></svg>
                                            </div>
                                            <img src="{{ asset($payment_setting->razorpay_image) }}" alt="img" class="max-w-[174px] max-h-7 object-contain" />
                                            @if($razorpay_currency)
                                            <form action="{{ route('user.client-projects.razorpay') }}" method="POST" class="hidden">
                                                @csrf
                                                @php
                                                    $payable_amount_for_razorpay = $payable_amount * $razorpay_currency->currency_rate;
                                                    $payable_amount_for_razorpay = round($payable_amount_for_razorpay, 2);
                                                @endphp
                                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                    data-key="{{ $payment_setting->razorpay_key }}"
                                                    data-currency="{{ $razorpay_currency->currency_code }}"
                                                    data-amount="{{ $payable_amount_for_razorpay * 100 }}"
                                                    data-buttontext="{{ __('Pay') }}"
                                                    data-name="{{ $payment_setting->razorpay_name }}"
                                                    data-description="{{ $payment_setting->razorpay_description }}"
                                                    data-image="{{ asset($payment_setting->razorpay_image) }}"
                                                    data-prefill.name=""
                                                    data-prefill.email=""
                                                    data-theme.color="{{ $payment_setting->razorpay_theme_color }}">
                                                </script>
                                            </form>
                                            @endif
                                        </button>
                                    </li>
                                @endif
                                @if (($payment_setting->bank_status ?? 0) == 1)
                                    <li>
                                        <button class="w-[244px] h-[58px] flex justify-center items-center border border-grayscale-300 current:border current:border-purple rounded-lg gap-7 payment-check transition-all duration-300" id="bankPaymentBtn">
                                            <div class="w-0 h-0 overflow-hidden current:w-6 current:h-6 flex justify-center items-center current:bg-purple current:text-white transition-all duration-300">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="18" height="18" rx="2" fill="#794AFF" /><path d="M7.82919 12.8459C7.73373 12.9448 7.6035 13 7.46821 13C7.33293 13 7.20269 12.9448 7.10724 12.8459L4.22438 9.87525C3.92521 9.56701 3.92521 9.06719 4.22438 8.75953L4.58536 8.38752C4.88463 8.07929 5.3692 8.07929 5.66838 8.38752L7.46821 10.242L12.3316 5.23118C12.6309 4.92294 13.1159 4.92294 13.4146 5.23118L13.7756 5.60318C14.0748 5.91142 14.0748 6.41115 13.7756 6.7189L7.82919 12.8459Z" fill="white" /></svg>
                                            </div>
                                            <img src="{{ asset($payment_setting->bank_image) }}" alt="img" class="max-w-[174px] max-h-7 object-contain" />
                                        </button>
                                    </li>
                                @endif
                                @if ($payment_setting->paystack_status == 1)
                                    <li>
                                        <button class="w-[244px] h-[58px] flex justify-center items-center border border-grayscale-300 current:border current:border-purple rounded-lg gap-7 payment-check transition-all duration-300" id="paystackPayment">
                                            <div class="w-0 h-0 overflow-hidden current:w-6 current:h-6 flex justify-center items-center current:bg-purple current:text-white transition-all duration-300">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="18" height="18" rx="2" fill="#794AFF" /><path d="M7.82919 12.8459C7.73373 12.9448 7.6035 13 7.46821 13C7.33293 13 7.20269 12.9448 7.10724 12.8459L4.22438 9.87525C3.92521 9.56701 3.92521 9.06719 4.22438 8.75953L4.58536 8.38752C4.88463 8.07929 5.3692 8.07929 5.66838 8.38752L7.46821 10.242L12.3316 5.23118C12.6309 4.92294 13.1159 4.92294 13.4146 5.23118L13.7756 5.60318C14.0748 5.91142 14.0748 6.41115 13.7756 6.7189L7.82919 12.8459Z" fill="white" /></svg>
                                            </div>
                                            <img src="{{ asset($payment_setting->paystack_image) }}" alt="img" class="max-w-[174px] max-h-7 object-contain" />
                                        </button>
                                    </li>
                                @endif
                                @if ($payment_setting->stripe_status == 1)
                                    <li>
                                        <button class="w-[244px] h-[58px] flex justify-center items-center border border-grayscale-300 current:border current:border-purple rounded-lg gap-7 payment-check transition-all duration-300" id="openStripeModalBtn">
                                            <div class="w-0 h-0 overflow-hidden current:w-6 current:h-6 flex justify-center items-center current:bg-purple current:text-white transition-all duration-300">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="18" height="18" rx="2" fill="#794AFF" /><path d="M7.82919 12.8459C7.73373 12.9448 7.6035 13 7.46821 13C7.33293 13 7.20269 12.9448 7.10724 12.8459L4.22438 9.87525C3.92521 9.56701 3.92521 9.06719 4.22438 8.75953L4.58536 8.38752C4.88463 8.07929 5.3692 8.07929 5.66838 8.38752L7.46821 10.242L12.3316 5.23118C12.6309 4.92294 13.1159 4.92294 13.4146 5.23118L13.7756 5.60318C14.0748 5.91142 14.0748 6.41115 13.7756 6.7189L7.82919 12.8459Z" fill="white" /></svg>
                                            </div>
                                            <img src="{{ asset($payment_setting->stripe_image) }}" alt="img" class="max-w-[174px] max-h-7 object-contain" />
                                        </button>
                                    </li>
                                @endif
                                @if ($payment_setting->instamojo_status == 1)
                                    <li>
                                        <button class="w-[244px] h-[58px] flex justify-center items-center border border-grayscale-300 current:border current:border-purple rounded-lg gap-7 payment-check transition-all duration-300" id="instamojoPayment">
                                            <div class="w-0 h-0 overflow-hidden current:w-6 current:h-6 flex justify-center items-center current:bg-purple current:text-white transition-all duration-300">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="18" height="18" rx="2" fill="#794AFF" /><path d="M7.82919 12.8459C7.73373 12.9448 7.6035 13 7.46821 13C7.33293 13 7.20269 12.9448 7.10724 12.8459L4.22438 9.87525C3.92521 9.56701 3.92521 9.06719 4.22438 8.75953L4.58536 8.38752C4.88463 8.07929 5.3692 8.07929 5.66838 8.38752L7.46821 10.242L12.3316 5.23118C12.6309 4.92294 13.1159 4.92294 13.4146 5.23118L13.7756 5.60318C14.0748 5.91142 14.0748 6.41115 13.7756 6.7189L7.82919 12.8459Z" fill="white" /></svg>
                                            </div>
                                            <img src="{{ asset($payment_setting->instamojo_image) }}" alt="img" class="max-w-[174px] max-h-7 object-contain" />
                                        </button>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    {{-- Right Column: Installment Summary --}}
                    <div class="border border-grayscale-300 rounded-lg overflow-hidden h-fit p-30">
                        <div>
                            <h4 class="text-24 text-black font-semibold">{{ __('Payment Summary') }}</h4>
                        </div>
                        <div class="mt-30">
                            <div class="bg-main-black rounded-xl p-5 md:p-8">
                                <h2 class="text-18 font-semibold text-white pb-2">{{ $project->name }}</h2>
                                <p class="text-white text-sm pb-4">{{ $project->title }}</p>
                                <div class="border-t border-white/20 pt-4">
                                    <p class="text-white text-sm pb-1">
                                        {{ __('Payment') }} #{{ $installment->installment_number }}
                                        {{ __('of') }} {{ $project->installments->count() }}
                                    </p>
                                    @if ($project->payment_type === 'split')
                                        <span class="inline-block bg-white/20 text-white text-xs px-3 py-1 rounded-full mb-3">{{ __('Split Payment') }}</span>
                                    @else
                                        <span class="inline-block bg-white/20 text-white text-xs px-3 py-1 rounded-full mb-3">{{ __('Monthly Payment') }}</span>
                                    @endif
                                    @if ($installment->due_date)
                                        <p class="text-white/70 text-sm">{{ __('Due') }}: {{ $installment->due_date->format('d M Y') }}</p>
                                    @endif
                                </div>
                                <div class="border-t border-white/20 mt-4 pt-4 space-y-2">
                                    <div class="flex justify-between text-white text-sm">
                                        <span>{{ __('Base Amount') }}</span>
                                        <span>{{ client_project_currency_pay($installment->base_amount, true) }}</span>
                                    </div>
                                    @if ($installment->gst_amount > 0)
                                        <div class="flex justify-between text-white text-sm">
                                            <span>{{ __('GST') }} ({{ $project->gst_percent }}%)</span>
                                            <span>{{ client_project_currency_pay($installment->gst_amount, true) }}</span>
                                        </div>
                                    @endif
                                    <div class="flex justify-between text-white font-semibold text-lg border-t border-white/20 pt-2 mt-2">
                                        <span>{{ __('Total') }}</span>
                                        <span>{{ client_project_currency_pay($installment->total_amount, true) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('popup_video')
    {{-- Stripe Modal --}}
    <div id="stripePaymentModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <button type="button" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" id="closeStripeModalBtn">&times;</button>
            <h3 class="text-xl font-semibold mb-4">{{ __('Pay with Stripe') }}</h3>
            <form id="payment-form" class="require-validation"
                  data-stripe-publishable-key="{{ $payment_setting?->stripe_key }}"
                  method="POST"
                  action="{{ route('user.client-projects.stripe') }}">
                @csrf
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">{{ __('Card Number') }}</label>
                    <input type="text" name="card_number" class="form-input card-number required w-full border rounded px-3 py-2" autocomplete="off" placeholder="•••• •••• •••• ••••" />
                </div>
                <div class="mb-3 flex gap-2">
                    <div class="w-1/2">
                        <label class="block text-sm font-medium mb-1">{{ __('Expiry Month') }}</label>
                        <input type="text" class="form-input card-expiry-month required w-full border rounded px-3 py-2" autocomplete="off" placeholder="MM" name="month" />
                    </div>
                    <div class="w-1/2">
                        <label class="block text-sm font-medium mb-1">{{ __('Expiry Year') }}</label>
                        <input type="text" class="form-input card-expiry-year required w-full border rounded px-3 py-2" autocomplete="off" placeholder="YY" name="year" />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">{{ __('CVC') }}</label>
                    <input type="text" class="form-input card-cvc required w-full border rounded px-3 py-2" autocomplete="off" placeholder="CVC" name="cvc" />
                </div>
                <div class="stripe_error d-none mb-3">
                    <div class="alert text-red-600 text-sm"></div>
                </div>
                <button type="submit" id="stripe_form_btn" class="w-full bg-purple text-white py-2 rounded font-semibold">{{ __('Pay Now') }}</button>
            </form>
        </div>
    </div>

    {{-- Bank Modal --}}
    <div id="bankPaymentModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <button type="button" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" id="closeBankModalBtn">&times;</button>
            <h3 class="text-xl font-semibold mb-4">{{ __('Bank Payment') }}</h3>
            <div class="mb-4">
                <h4 class="text-lg font-medium flex justify-between items-center">
                    {{ __('Amount') }}
                    <span class="font-bold">{{ $payable_amount }}</span>
                </h4>
            </div>
            <div class="mb-4 text-sm text-gray-700 border rounded p-3 bg-gray-50">
                {!! clean(nl2br($bank?->account_info ?? ($payment_setting?->bank_account_info ?? ''))) !!}
            </div>
            <form action="{{ route('user.client-projects.bank') }}" method="POST" id="bank_payment_form">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1" for="bankTnxInfo">{{ __('Transaction information') }}</label>
                    <textarea class="form-input required w-full border rounded px-3 py-2" id="bankTnxInfo" required rows="3" placeholder="{{ __('Transaction information') }}" name="tnx_info"></textarea>
                </div>
                <button type="submit" id="bank_payment_btn" class="w-full bg-purple text-white py-2 rounded font-semibold">{{ __('Payment Now') }}</button>
            </form>
        </div>
    </div>
@endsection

@push('script_section')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        $(function () {
            $("#bankPaymentBtn").on("click", function () { $("#bankPaymentModal").removeClass("hidden"); });
            $("#closeBankModalBtn").on("click", function () { $("#bankPaymentModal").addClass("hidden"); });
            $("#bankPaymentModal").on("click", function (e) { if (e.target === this) { $(this).addClass("hidden"); } });
        });
    </script>
    <script>
        $(function () {
            $(document).on('click', '.payment-check', function () {
                $('.payment-check').removeClass('current');
                $(this).addClass('current');
            });

            $("#openStripeModalBtn").on("click", function () { $("#stripePaymentModal").removeClass("hidden"); });
            $("#closeStripeModalBtn").on("click", function () { $("#stripePaymentModal").addClass("hidden"); });
            $("#stripePaymentModal").on("click", function (e) { if (e.target === this) { $(this).addClass("hidden"); } });
        });
    </script>
    <script>
        "use strict";
        $(function () {
            var $form = $(".require-validation");
            $('form.require-validation').on('submit', function (e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.stripe_error');
                $errorMessage.addClass('hidden');
                $('.has-error').removeClass('has-error');
                $inputs.each(function (i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hidden');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.stripe_error').removeClass('d-none').find('.alert').text(response.error.message);
                } else {
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

            $("#razorpay_btn").on("click", function () { $(".razorpay-payment-button").get(0).click(); });
            $("#paypal_btn").on("click", function () { window.location.href = "{{ route('user.client-projects.paypal') }}"; });
            $("#instamojoPayment").on("click", function () { window.location.href = "{{ route('user.client-projects.instamojo') }}"; });
            $("#bank_payment_btn").on("click", function () { $("#bank_payment_form").submit(); });
        });
    </script>
    @if ($payment_setting->paystack_status == 1)
        <script src="https://js.paystack.co/v1/inline.js"></script>
        @php
            $public_key = $payment_setting->paystack_public_key;
            $currency   = optional($paystack_currency)->currency_code;
            $currency   = strtoupper($currency);
            $ngn_amount = $payable_amount * (optional($paystack_currency)->currency_rate ?? 1);
            $ngn_amount = round($ngn_amount * 100);
        @endphp
        <script>
            "use strict";
            $(function () {
                $("#paystackPayment").on("click", function () {
                    var isDemo = "{{ env('APP_MODE') }}";
                    if (isDemo == 'DEMO') { toastr.error('This Is Demo Version. You Can Not Change Anything'); return; }
                    var handler = PaystackPop.setup({
                        key: '{{ $public_key }}',
                        email: '{{ $user->email ?? '' }}',
                        amount: '{{ $ngn_amount }}',
                        currency: "{{ $currency }}",
                        callback: function (response) {
                            let reference = response.reference;
                            let _token = "{{ csrf_token() }}";
                            $.ajax({
                                type: "get",
                                data: { reference, _token },
                                url: "{{ route('user.client-projects.paystack') }}",
                                success: function (response) {
                                    if (response.status == 'success') {
                                        toastr.success(response.message);
                                        window.location.href = "{{ route('user.client-projects.index') }}";
                                    } else {
                                        toastr.error(response.message);
                                        window.location.reload();
                                    }
                                },
                                error: function () { toastr.error('Server Error'); window.location.reload(); }
                            });
                        },
                        onClose: function () { alert('window closed'); }
                    });
                    handler.openIframe();
                });
            });
        </script>
    @endif
@endpush
