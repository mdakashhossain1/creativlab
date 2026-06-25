@extends('admin.master_layout')
@section('title')
    <title>{{ $account ? __('Edit Email Account') : __('Add Email Account') }}</title>
@endsection

@section('body-header')
    <h3 class="crancy-header__title m-0">{{ $account ? __('Edit Email Account') : __('Add Email Account') }}</h3>
    <p class="crancy-header__text">{{ __('Email') }} >> {{ __('Accounts') }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-11 col-12">
                <div class="crancy-body mg-top-30">
                    <div class="crancy-dsinner">

                        <form action="{{ $account ? route('admin.email-accounts.update', $account->id) : route('admin.email-accounts.store') }}" method="POST">
                            @csrf
                            @if($account) @method('PUT') @endif

                            {{-- ── SMTP Section ─────────────────────────────── --}}
                            <div class="crancy-product-card">
                                <div class="create_new_btn_inline_box mb-3">
                                    <h4 class="crancy-product-card__title">
                                        <i class="fas fa-paper-plane me-2" style="color:#4338ca;"></i>{{ __('Outgoing Mail (SMTP)') }}
                                    </h4>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.email-accounts.index') }}" class="crancy-btn" style="background:#6c757d;font-size:13px;">
                                            {{ __('Cancel') }}
                                        </a>
                                        <button type="submit" class="crancy-btn" style="font-size:13px;">
                                            <i class="fas fa-save me-1"></i>
                                            {{ $account ? __('Update') : __('Save Account') }}
                                        </button>
                                    </div>
                                </div>

                                <div class="row g-0">

                                    <div class="col-md-6">
                                        <div class="crancy__item-form--group mg-top-form-20">
                                            <label class="crancy__item-label">{{ __('Account Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="crancy__item-input @error('name') is-invalid @enderror"
                                                value="{{ old('name', $account?->name) }}"
                                                placeholder="{{ __('e.g. Sales Email') }}">
                                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="crancy__item-form--group mg-top-form-20">
                                            <label class="crancy__item-label">{{ __('From Email Address') }} <span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="crancy__item-input @error('email') is-invalid @enderror"
                                                value="{{ old('email', $account?->email) }}"
                                                placeholder="sales@yourdomain.com">
                                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="crancy__item-form--group mg-top-form-20">
                                            <label class="crancy__item-label">{{ __('SMTP Host') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="smtp_host" class="crancy__item-input @error('smtp_host') is-invalid @enderror"
                                                value="{{ old('smtp_host', $account?->smtp_host) }}"
                                                placeholder="smtp.hostinger.com">
                                            @error('smtp_host')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="crancy__item-form--group mg-top-form-20">
                                            <label class="crancy__item-label">{{ __('SMTP Port') }} <span class="text-danger">*</span></label>
                                            <input type="number" name="smtp_port" class="crancy__item-input @error('smtp_port') is-invalid @enderror"
                                                value="{{ old('smtp_port', $account?->smtp_port ?? '465') }}">
                                            @error('smtp_port')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="crancy__item-form--group mg-top-form-20">
                                            <label class="crancy__item-label">{{ __('Encryption') }} <span class="text-danger">*</span></label>
                                            <select name="encryption" class="form-select crancy__item-input">
                                                @foreach(['ssl' => 'SSL', 'tls' => 'TLS', 'none' => 'None'] as $val => $label)
                                                    <option value="{{ $val }}" {{ old('encryption', $account?->encryption ?? 'ssl') === $val ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="crancy__item-form--group mg-top-form-20">
                                            <label class="crancy__item-label">{{ __('SMTP Username') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="smtp_username" class="crancy__item-input @error('smtp_username') is-invalid @enderror"
                                                value="{{ old('smtp_username', $account?->smtp_username) }}"
                                                placeholder="your@email.com"
                                                autocomplete="username">
                                            @error('smtp_username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="crancy__item-form--group mg-top-form-20">
                                            <label class="crancy__item-label">{{ __('SMTP Password') }} <span class="text-danger">*</span></label>
                                            <div style="position:relative;">
                                                <input type="password" id="smtpPassword" name="smtp_password"
                                                    class="crancy__item-input @error('smtp_password') is-invalid @enderror"
                                                    value="{{ old('smtp_password', $account?->smtp_password) }}"
                                                    placeholder="••••••••"
                                                    autocomplete="current-password"
                                                    style="padding-right:46px;width:100%;">
                                                <button type="button" id="togglePasswordBtn"
                                                    style="position:absolute;right:0;top:0;bottom:0;width:44px;background:transparent;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#6b7280;z-index:5;"
                                                    title="{{ __('Show / Hide') }}">
                                                    <i class="fas fa-eye" id="eyeIcon" style="font-size:15px;pointer-events:none;"></i>
                                                </button>
                                            </div>
                                            @error('smtp_password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="crancy__item-form--group mg-top-form-20">
                                            <label class="crancy__item-label">{{ __('Status') }}</label>
                                            <select name="status" class="form-select crancy__item-input">
                                                <option value="active"   {{ old('status', $account?->status ?? 'active') === 'active'   ? 'selected' : '' }}>{{ __('Active') }}</option>
                                                <option value="inactive" {{ old('status', $account?->status)             === 'inactive' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="crancy__item-form--group mg-top-form-20 d-flex align-items-center gap-3" style="padding-top:38px;">
                                            <div class="form-check form-switch" style="margin:0;">
                                                <input class="form-check-input" type="checkbox" name="is_default" id="isDefault" value="1"
                                                    {{ old('is_default', $account?->is_default) ? 'checked' : '' }}>
                                                <label class="form-check-label crancy__item-label mb-0" for="isDefault">
                                                    {{ __('Set as Default Account') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- ── IMAP Section ─────────────────────────────── --}}
                            <div class="crancy-product-card mg-top-30">
                                <h4 class="crancy-product-card__title mb-1">
                                    <i class="fas fa-inbox me-2" style="color:#4338ca;"></i>{{ __('Incoming Mail (IMAP)') }}
                                    <small class="text-muted fw-normal" style="font-size:13px;"> — {{ __('Optional — needed to receive emails in Inbox') }}</small>
                                </h4>

                                <div class="row g-0">

                                    <div class="col-md-6">
                                        <div class="crancy__item-form--group mg-top-form-20">
                                            <label class="crancy__item-label">{{ __('IMAP Host') }}</label>
                                            <input type="text" name="imap_host" class="crancy__item-input @error('imap_host') is-invalid @enderror"
                                                value="{{ old('imap_host', $account?->imap_host) }}"
                                                placeholder="imap.hostinger.com">
                                            @error('imap_host')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="crancy__item-form--group mg-top-form-20">
                                            <label class="crancy__item-label">{{ __('IMAP Port') }}</label>
                                            <input type="number" name="imap_port" class="crancy__item-input @error('imap_port') is-invalid @enderror"
                                                value="{{ old('imap_port', $account?->imap_port ?? '993') }}">
                                            @error('imap_port')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="crancy__item-form--group mg-top-form-20">
                                            <label class="crancy__item-label">{{ __('IMAP Encryption') }}</label>
                                            <select name="imap_encryption" class="form-select crancy__item-input">
                                                @foreach(['ssl' => 'SSL (993)', 'tls' => 'TLS (143)', 'none' => 'None'] as $val => $label)
                                                    <option value="{{ $val }}" {{ old('imap_encryption', $account?->imap_encryption ?? 'ssl') === $val ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <p class="text-muted small mt-2 mb-0">
                                            <i class="fas fa-info-circle me-1"></i>{{ __('IMAP uses the same username and password entered above.') }}
                                        </p>
                                    </div>

                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js_section')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var btn   = document.getElementById('togglePasswordBtn');
    var input = document.getElementById('smtpPassword');
    var icon  = document.getElementById('eyeIcon');
    if (!btn || !input || !icon) return;

    btn.addEventListener('click', function (e) {
        e.preventDefault();
        var isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        icon.classList.remove(isPassword ? 'fa-eye' : 'fa-eye-slash');
        icon.classList.add(isPassword ? 'fa-eye-slash' : 'fa-eye');
        input.focus();
    });
});
</script>
@endpush
