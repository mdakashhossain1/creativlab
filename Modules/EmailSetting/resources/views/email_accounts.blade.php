@extends('admin.master_layout')
@section('title')<title>{{ __('Business Email Accounts') }}</title>@endsection

@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Business Email Accounts') }}</h3>
    <p class="crancy-header__text">{{ __('Email') }} >> {{ __('Accounts') }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">
            <div class="col-12">
                <div class="crancy-body">
                    <div class="crancy-dsinner">
                        <div class="crancy-table crancy-table--v3 mg-top-30">

                            <div class="crancy-customer-filter">
                                <div class="crancy-customer-filter__single crancy-customer-filter__single--csearch d-flex items-center justify-between create_new_btn_box">
                                    <div class="crancy-header__form crancy-header__form--customer create_new_btn_inline_box">
                                        <h4 class="crancy-product-card__title">{{ __('Email Accounts') }}</h4>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.email-accounts.create') }}" class="crancy-btn" style="transition:transform .1s ease;display:inline-flex;align-items:center;gap:6px;" onmousedown="this.style.transform='scale(0.96)'" onmouseup="this.style.transform='scale(1)'" onmouseleave="this.style.transform='scale(1)'">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M8 1V15" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M1 8H15" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                {{ __('Add Account') }}
                                            </a>
                                            <a href="{{ route('admin.mailbox.index') }}" class="crancy-btn" style="background:#17a2b8;transition:transform .1s ease;display:inline-flex;align-items:center;gap:6px;" onmousedown="this.style.transform='scale(0.96)'" onmouseup="this.style.transform='scale(1)'" onmouseleave="this.style.transform='scale(1)'">
                                                <i class="fas fa-inbox"></i> {{ __('Mailbox') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <table class="crancy-table__main crancy-table__main-v3 dataTable no-footer" id="dataTable">
                                    <thead class="crancy-table__head">
                                        <tr>
                                            <th class="crancy-table__column-2 crancy-table__h2">#</th>
                                            <th class="crancy-table__column-2 crancy-table__h2">{{ __('Account Name') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2">{{ __('Email') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2">{{ __('SMTP Host') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2">{{ __('Port / Enc') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2">{{ __('Default') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2">{{ __('Status') }}</th>
                                            <th class="crancy-table__column-3 crancy-table__h3">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="crancy-table__body">
                                        @forelse($accounts as $i => $account)
                                        <tr>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <h4 class="crancy-table__product-title" style="font-variant-numeric:tabular-nums;">{{ $i + 1 }}</h4>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#667eea,#764ba2);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:14px;flex-shrink:0;box-shadow:0 1px 4px rgba(0,0,0,0.18),0 0 0 1px rgba(0,0,0,0.06);">
                                                        {{ strtoupper(substr($account->name, 0, 1)) }}
                                                    </div>
                                                    <span class="crancy-table__product-title">{{ $account->name }}</span>
                                                </div>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <h4 class="crancy-table__product-title">{{ $account->email }}</h4>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <h4 class="crancy-table__product-title">{{ $account->smtp_host }}</h4>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2" style="white-space:nowrap;">
                                                <span style="display:inline-flex;align-items:center;gap:6px;font-variant-numeric:tabular-nums;">
                                                    {{ $account->smtp_port }} / <span style="background:#dcfce7;color:#16a34a;border-radius:20px;padding:2px 8px;font-size:11px;font-weight:600;letter-spacing:.3px;line-height:1.6;white-space:nowrap;">{{ strtoupper($account->encryption) }}</span>
                                                </span>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                @if($account->is_default)
                                                    <span style="display:inline-flex;align-items:center;justify-content:center;width:40px;height:40px;">
                                                        <i class="fas fa-star" style="color:#f59e0b;font-size:18px;" title="{{ __('Default') }}"></i>
                                                    </span>
                                                @else
                                                    <form action="{{ route('admin.email-accounts.set-default', $account->id) }}" method="POST" style="display:inline-flex;margin:0;padding:0;">
                                                        @csrf
                                                        <button type="submit"
                                                            style="background:none;border:none;padding:0;margin:0;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;width:40px;height:40px;transition:transform .1s ease;"
                                                            title="{{ __('Set as Default') }}"
                                                            onmousedown="this.style.transform='scale(0.88)'"
                                                            onmouseup="this.style.transform='scale(1)'"
                                                            onmouseleave="this.style.transform='scale(1)'">
                                                            <i class="far fa-star" style="color:#d1d5db;font-size:18px;transition:color .15s ease,transform .15s ease;" onmouseover="this.style.color='#f59e0b';this.style.transform='scale(1.15)'" onmouseout="this.style.color='#d1d5db';this.style.transform='scale(1)'"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                @if($account->status === 'active')
                                                    <span class="badge bg-success text-white">{{ __('Active') }}</span>
                                                @else
                                                    <span class="badge bg-danger text-white">{{ __('Inactive') }}</span>
                                                @endif
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <div class="dropdown">
                                                    <button class="crancy-btn dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        style="transition:transform .1s ease;"
                                                        onmousedown="this.style.transform='scale(0.96)'"
                                                        onmouseup="this.style.transform='scale(1)'"
                                                        onmouseleave="this.style.transform='scale(1)'">
                                                        {{ __('Action') }}
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('admin.email-accounts.edit', $account->id) }}" class="dropdown-item">
                                                                <i class="fas fa-edit"></i> {{ __('Edit') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a onclick="itemDeleteConfrimation({{ $account->id }})" href="javascript:;" data-bs-toggle="modal" data-bs-target="#deleteModal" class="dropdown-item text-danger">
                                                                <i class="fas fa-trash"></i> {{ __('Delete') }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <i class="fas fa-envelope-open fa-2x text-muted mb-2 d-block"></i>
                                                {{ __('No email accounts added yet.') }}
                                                <a href="{{ route('admin.email-accounts.create') }}" class="d-block mt-2">{{ __('Add your first account') }}</a>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Delete Confirmation') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body"><p>{{ __('Are you sure you want to delete this account?') }}</p></div>
            <div class="modal-footer" style="display:flex;flex-wrap:nowrap;justify-content:space-between;gap:10px;">
                <form id="deleteForm" method="POST">
                    @csrf @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('Yes, Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js_section')
<script>
"use strict";
function itemDeleteConfrimation(id) {
    document.getElementById('deleteForm').action = '{{ url("admin/email-accounts") }}/' + id;
}
</script>
@endpush
