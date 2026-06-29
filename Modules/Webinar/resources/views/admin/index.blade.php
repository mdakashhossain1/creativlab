@extends('admin.master_layout')

@section('title')
<title>{{ __('Webinar Pages') }}</title>
@endsection

@section('body-header')
<h3 class="crancy-header__title m-0">{{ __('Webinar Pages') }}</h3>
<p class="crancy-header__text">{{ __('Dashboard') }} >> {{ __('Webinar Pages') }}</p>
@endsection

@section('body-content')
<!-- crancy Dashboard -->
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
                                        <h4 class="crancy-product-card__title">{{ __('Webinar Pages') }}</h4>
                                        <a href="{{ route('admin.webinar.create') }}" class="crancy-btn">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M8 1V15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M1 8H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span> {{ __('Create New') }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- crancy Table -->
                            <div id="crancy-table__main_wrapper" class="dt-bootstrap5 no-footer">
                                <table class="crancy-table__main crancy-table__main-v3 no-footer" id="dataTable">

                                    <!-- Head -->
                                    <thead class="crancy-table__head">
                                        <tr>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">#</th>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('Title') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('Slug') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('Price') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('Registrations') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('Status') }}</th>
                                            <th class="crancy-table__column-3 crancy-table__h3 sorting">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>

                                    <!-- Body -->
                                    <tbody class="crancy-table__body">
                                        @foreach($webinars as $i => $webinar)
                                        <tr class="odd">
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <h4 class="crancy-table__product-title">{{ $i + 1 }}</h4>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <h4 class="crancy-table__product-title">{{ $webinar->title }}</h4>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <h4 class="crancy-table__product-title">{{ $webinar->slug }}</h4>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                @if($webinar->payment_enabled)
                                                    <h4 class="crancy-table__product-title">{{ $webinar->currency_symbol }}{{ number_format($webinar->price, 2) }}</h4>
                                                @else
                                                    <span class="badge bg-success text-white">{{ __('Free') }}</span>
                                                @endif
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <h4 class="crancy-table__product-title">{{ $webinar->registrations()->count() }}</h4>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                @if($webinar->status)
                                                    <span class="badge bg-success text-white">{{ __('Active') }}</span>
                                                @else
                                                    <span class="badge bg-danger text-white">{{ __('Draft') }}</span>
                                                @endif
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <div class="dropdown">
                                                    <button class="crancy-btn dropdown-toggle" type="button"
                                                        id="dropdownWebinar{{ $webinar->id }}"
                                                        data-bs-toggle="dropdown"
                                                        data-bs-flip="false"
                                                        aria-expanded="false">
                                                        {{ __('Action') }}
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownWebinar{{ $webinar->id }}">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.webinar.builder', $webinar->id) }}">
                                                                <i class="fas fa-paint-brush"></i> {{ __('Page Builder') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('webinar.show', $webinar->slug) }}" target="_blank">
                                                                <i class="fas fa-eye"></i> {{ __('Preview') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.webinar.registrations', $webinar->id) }}">
                                                                <i class="fas fa-users"></i> {{ __('Registrations') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.webinar.edit', $webinar->id) }}">
                                                                <i class="fas fa-cog"></i> {{ __('Settings') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a onclick="webinarDeleteConfirm({{ $webinar->id }})"
                                                               href="javascript:;"
                                                               data-bs-toggle="modal"
                                                               data-bs-target="#deleteModal"
                                                               class="dropdown-item text-danger">
                                                                <i class="fas fa-trash"></i> {{ __('Delete') }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <!-- End crancy Table -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End crancy Dashboard -->

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">{{ __('Delete Confirmation') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <p>{{ __('Are you really want to delete this webinar?') }}</p>
            </div>
            <div class="modal-footer" style="display:flex;flex-wrap:nowrap;justify-content:space-between;gap:10px;">
                <form action="" id="webinar_delete_form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="width:auto !important;">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary" style="width:auto !important;">{{ __('Yes, Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js_section')
<script>
    "use strict";
    function webinarDeleteConfirm(id) {
        $("#webinar_delete_form").attr("action", '{{ url("admin/webinar") }}/' + id);
    }
</script>
@endpush
