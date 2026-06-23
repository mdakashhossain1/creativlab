@extends('admin.master_layout')
@section('title')<title>{{ __('Portfolio Categories') }}</title>@endsection
@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Portfolio Categories') }}</h3>
    <p class="crancy-header__text">{{ __('Manage Project') }} >> {{ __('Portfolio Categories') }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">
            <div class="col-12">
                <div class="crancy-body">
                    <div class="crancy-dsinner">

                        {{-- Create form --}}
                        <div class="crancy-product-card mg-top-30">
                            <h4 class="crancy-product-card__title mb-3">{{ __('Add New Category') }}</h4>
                            <form action="{{ route('admin.portfolio-category.store') }}" method="POST">
                                @csrf
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-4">
                                        <label class="crancy__item-label">{{ __('Name') }} *</label>
                                        <input type="text" name="name" class="crancy__item-input"
                                            placeholder="{{ __('Category name') }}" required value="{{ old('name') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="crancy__item-label">{{ __('Description') }}</label>
                                        <input type="text" name="description" class="crancy__item-input"
                                            placeholder="{{ __('Optional description') }}" value="{{ old('description') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="crancy-btn w-100">
                                            <i class="fas fa-plus me-1"></i>{{ __('Add') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- List --}}
                        <div class="crancy-table crancy-table--v3 mg-top-30">
                            <div class="crancy-customer-filter">
                                <div class="crancy-customer-filter__single crancy-customer-filter__single--csearch d-flex items-center justify-between create_new_btn_box">
                                    <div class="crancy-header__form crancy-header__form--customer create_new_btn_inline_box">
                                        <h4 class="crancy-product-card__title">{{ __('All Portfolio Categories') }}</h4>
                                        <a href="{{ route('admin.project.index') }}" class="crancy-btn">
                                            <i class="fas fa-arrow-left me-1"></i>{{ __('Back to Projects') }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div id="crancy-table__main_wrapper" class="dt-bootstrap5 no-footer">
                                <table class="crancy-table__main crancy-table__main-v3 no-footer" id="dataTable">
                                    <thead class="crancy-table__head">
                                        <tr>
                                            <th class="crancy-table__column-2 crancy-table__h2">#</th>
                                            <th class="crancy-table__column-2 crancy-table__h2">{{ __('Name') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2">{{ __('Slug') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2">{{ __('Projects') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2">{{ __('Items') }}</th>
                                            <th class="crancy-table__column-3 crancy-table__h3">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="crancy-table__body">
                                        @forelse($categories as $index => $cat)
                                        <tr>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <h4 class="crancy-table__product-title">{{ $loop->iteration }}</h4>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <h4 class="crancy-table__product-title">{{ $cat->name }}</h4>
                                                @if($cat->description)
                                                    <small class="text-muted">{{ $cat->description }}</small>
                                                @endif
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <code>{{ $cat->slug }}</code>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <span class="badge bg-primary">{{ $cat->projects_count }}</span>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <span class="badge bg-secondary">{{ $cat->portfolio_items_count }}</span>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <button class="crancy-btn btn-sm"
                                                    onclick="openEditModal({{ $cat->id }}, '{{ addslashes($cat->name) }}', '{{ addslashes($cat->description) }}')">
                                                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                                                </button>
                                                <a onclick="confirmDelete({{ $cat->id }})"
                                                    href="javascript:;" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal"
                                                    class="crancy-btn delete_danger_btn btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">
                                                {{ __('No portfolio categories yet.') }}
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

{{-- Edit Modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Edit Portfolio Category') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="crancy__item-label">{{ __('Name') }} *</label>
                        <input type="text" name="name" id="editName" class="crancy__item-input" required>
                    </div>
                    <div class="mb-3">
                        <label class="crancy__item-label">{{ __('Description') }}</label>
                        <input type="text" name="description" id="editDescription" class="crancy__item-input">
                    </div>
                </div>
                <div class="modal-footer" style="gap:10px;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="width:auto!important;">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary" style="width:auto!important;">
                        {{ __('Save Changes') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Delete Confirmation') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ __('Are you really want to delete this category?') }}</p>
            </div>
            <div class="modal-footer" style="gap:10px;">
                <form id="deleteForm" method="POST" class="delet_modal_form">
                    @csrf @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="width:auto!important;">
                        {{ __('Close') }}
                    </button>
                    <button type="submit" class="btn btn-primary" style="width:auto!important;">
                        {{ __('Yes, Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js_section')
<script>
"use strict";

function openEditModal(id, name, description) {
    document.getElementById('editName').value        = name;
    document.getElementById('editDescription').value = description;
    document.getElementById('editForm').action       = '{{ url("admin/portfolio-category") }}/' + id;
    new bootstrap.Modal(document.getElementById('editModal')).show();
}

function confirmDelete(id) {
    document.getElementById('deleteForm').action = '{{ url("admin/portfolio-category") }}/' + id;
}
</script>
@endpush
