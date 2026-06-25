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
            <div class="col-xl-8 col-lg-10 col-12">
                <div class="crancy-body mg-top-30">
                    <div class="crancy-dsinner">
                        <div class="crancy-create-wp">

                            <form action="{{ $account ? route('admin.email-accounts.update', $account->id) : route('admin.email-accounts.store') }}" method="POST">
                                @csrf
                                @if($account) @method('PUT') @endif

                                <div class="row g-4">

                                    <div class="col-md-6">
                                        <div class="crancy-option__single">
                                            <label class="crancy-option__label">{{ __('Account Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="crancy-option__input @error('name') is-invalid @enderror"
                                                value="{{ old('name', $account?->name) }}"
                                                placeholder="{{ __('e.g. Sales Email') }}">
                                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="crancy-option__single">
                                            <label class="crancy-option__label">{{ __('From Email Address') }} <span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="crancy-option__input @error('email') is-invalid @enderror"
                                                value="{{ old('email', $account?->email) }}"
                                                placeholder="sales@yourdomain.com">
                                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="crancy-option__single">
                                            <label class="crancy-option__label">{{ __('SMTP Host') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="smtp_host" class="crancy-option__input @error('smtp_host') is-invalid @enderror"
                                                value="{{ old('smtp_host', $account?->smtp_host) }}"
                                                placeholder="smtp.hostinger.com">
                                            @error('smtp_host')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="crancy-option__single">
                                            <label class="crancy-option__label">{{ __('SMTP Port') }} <span class="text-danger">*</span></label>
                                            <input type="number" name="smtp_port" class="crancy-option__input @error('smtp_port') is-invalid @enderror"
                                                value="{{ old('smtp_port', $account?->smtp_port ?? '465') }}">
                                            @error('smtp_port')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="crancy-option__single">
                                            <label class="crancy-option__label">{{ __('Encryption') }} <span class="text-danger">*</span></label>
                                            <select name="encryption" class="crancy-option__input">
                                                @foreach(['ssl' => 'SSL', 'tls' => 'TLS', 'none' => 'None'] as $val => $label)
                                                    <option value="{{ $val }}" {{ old('encryption', $account?->encryption ?? 'ssl') === $val ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="crancy-option__single">
                                            <label class="crancy-option__label">{{ __('SMTP Username') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="smtp_username" class="crancy-option__input @error('smtp_username') is-invalid @enderror"
                                                value="{{ old('smtp_username', $account?->smtp_username) }}"
                                                placeholder="your@email.com">
                                            @error('smtp_username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="crancy-option__single">
                                            <label class="crancy-option__label">{{ __('SMTP Password') }} <span class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <input type="password" id="smtpPassword" name="smtp_password" class="crancy-option__input @error('smtp_password') is-invalid @enderror"
                                                    value="{{ old('smtp_password', $account?->smtp_password) }}"
                                                    placeholder="••••••••">
                                                <button type="button" onclick="togglePassword()" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;">
                                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                                </button>
                                            </div>
                                            @error('smtp_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="crancy-option__single">
                                            <label class="crancy-option__label">{{ __('Status') }}</label>
                                            <select name="status" class="crancy-option__input">
                                                <option value="active" {{ old('status', $account?->status ?? 'active') === 'active' ? 'selected' : '' }}>{{ __('Active') }}</option>
                                                <option value="inactive" {{ old('status', $account?->status) === 'inactive' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="crancy-option__single d-flex align-items-center gap-3 pt-4">
                                            <div class="form-check form-switch" style="margin:0;">
                                                <input class="form-check-input" type="checkbox" name="is_default" id="isDefault" value="1"
                                                    {{ old('is_default', $account?->is_default) ? 'checked' : '' }}>
                                                <label class="form-check-label crancy-option__label mb-0" for="isDefault">
                                                    {{ __('Set as Default Account') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- IMAP Section --}}
                                    <div class="col-12">
                                        <hr style="border-color:#eef0f7;margin:8px 0;">
                                        <p class="crancy-option__label mb-1" style="font-size:13px;font-weight:700;color:#4338ca;">
                                            <i class="fas fa-inbox me-1"></i> {{ __('Incoming Mail (IMAP) — Optional') }}
                                        </p>
                                        <small class="text-muted">{{ __('Fill this section to receive emails in the mailbox inbox.') }}</small>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="crancy-option__single">
                                            <label class="crancy-option__label">{{ __('IMAP Host') }}</label>
                                            <input type="text" name="imap_host" class="crancy-option__input @error('imap_host') is-invalid @enderror"
                                                value="{{ old('imap_host', $account?->imap_host) }}"
                                                placeholder="imap.hostinger.com">
                                            @error('imap_host')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="crancy-option__single">
                                            <label class="crancy-option__label">{{ __('IMAP Port') }}</label>
                                            <input type="number" name="imap_port" class="crancy-option__input @error('imap_port') is-invalid @enderror"
                                                value="{{ old('imap_port', $account?->imap_port ?? '993') }}">
                                            @error('imap_port')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="crancy-option__single">
                                            <label class="crancy-option__label">{{ __('IMAP Encryption') }}</label>
                                            <select name="imap_encryption" class="crancy-option__input">
                                                @foreach(['ssl' => 'SSL (993)', 'tls' => 'TLS (143)', 'none' => 'None'] as $val => $label)
                                                    <option value="{{ $val }}" {{ old('imap_encryption', $account?->imap_encryption ?? 'ssl') === $val ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <small class="text-muted"><i class="fas fa-info-circle me-1"></i>{{ __('IMAP uses the same username and password as SMTP above.') }}</small>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex gap-3">
                                            <button type="submit" class="crancy-btn">
                                                <i class="fas fa-save me-1"></i>
                                                {{ $account ? __('Update Account') : __('Save Account') }}
                                            </button>
                                            <a href="{{ route('admin.email-accounts.index') }}" class="crancy-btn" style="background:#6c757d;">
                                                {{ __('Cancel') }}
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js_section')
<script>
"use strict";
function togglePassword() {
    var input = document.getElementById('smtpPassword');
    var icon = document.getElementById('eyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>
@endpush
