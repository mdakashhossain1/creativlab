@extends('admin.master_layout')
@section('title')
    <title>{{ __('Portfolio Categories') }}</title>
@endsection
@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Portfolio') }}</h3>
    <p class="crancy-header__text">{{ __('Dashboard') }} >> {{ __('Portfolio Categories') }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">
            <div class="col-12 mg-top-30">
                <div class="crancy-product-card">
                    <h4 class="crancy-product-card__title">{{ __('Add Category') }}</h4>
                    <form action="{{ route('admin.portfolio.category.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="crancy__item-form--group mg-top-form-20">
                                    <label class="crancy__item-label">{{ __('Category Name') }}</label>
                                    <input class="crancy__item-input" type="text" name="name" required placeholder="e.g. Branding, Ad Films">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="crancy__item-form--group mg-top-form-20">
                                    <label class="crancy__item-label">{{ __('Description') }}</label>
                                    <input class="crancy__item-input" type="text" name="description" placeholder="Optional">
                                </div>
                            </div>
                        </div>
                        <button class="crancy-btn mg-top-25" type="submit">{{ __('Create Category') }}</button>
                    </form>
                </div>
            </div>

            <div class="col-12 mg-top-30">
                <div class="crancy-product-card">
                    <h4 class="crancy-product-card__title">{{ __('All Categories') }}</h4>
                    <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <table class="crancy-table__main crancy-table__main-v3 dataTable no-footer w-100">
                            <thead class="crancy-table__head">
                                <tr>
                                    <th class="crancy-table__column-1 crancy-table__h1">#</th>
                                    <th class="crancy-table__column-2 crancy-table__h2">{{ __('Name') }}</th>
                                    <th class="crancy-table__column-3 crancy-table__h2">{{ __('Items') }}</th>
                                    <th class="crancy-table__column-4 crancy-table__h2">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="crancy-table__body">
                                @forelse($categories as $cat)
                                <tr>
                                    <td class="crancy-table__column-1 crancy-table__data-1">{{ $loop->iteration }}</td>
                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                        <h4 class="crancy-table__product-title">{{ $cat->name }}</h4>
                                        @if($cat->description)<small class="text-muted">{{ $cat->description }}</small>@endif
                                    </td>
                                    <td class="crancy-table__column-3 crancy-table__data-2">
                                        <span class="crancy-badge crancy-badge__active">{{ $cat->items_count }}</span>
                                    </td>
                                    <td class="crancy-table__column-4 crancy-table__data-2">
                                        <div class="dropdown">
                                            <button class="crancy-btn dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ __('Action') }}
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('admin.portfolio.items', $cat->id) }}" class="dropdown-item">
                                                        <i class="fas fa-list"></i> {{ __('Manage Items') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a onclick="editCategory({{ $cat->id }}, '{{ addslashes($cat->name) }}', '{{ addslashes($cat->description) }}')"
                                                       href="javascript:;" data-bs-toggle="modal" data-bs-target="#editCategoryModal"
                                                       class="dropdown-item">
                                                        <i class="fas fa-edit"></i> {{ __('Edit') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a onclick="setCategoryDelete({{ $cat->id }})"
                                                       href="javascript:;" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                       class="dropdown-item">
                                                        <i class="fas fa-trash"></i> {{ __('Delete') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center py-4">{{ __('No categories yet. Add one above.') }}</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Edit Category Modal --}}
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Edit Category') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editCategoryForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="crancy__item-form--group mb-3">
                        <label class="crancy__item-label">{{ __('Category Name') }}</label>
                        <input class="crancy__item-input" type="text" id="editCatName" name="name" required>
                    </div>
                    <div class="crancy__item-form--group">
                        <label class="crancy__item-label">{{ __('Description') }}</label>
                        <input class="crancy__item-input" type="text" id="editCatDesc" name="description">
                    </div>
                </div>
                <div class="modal-footer" style="justify-content:space-between;">
                    <button type="submit" class="crancy-btn"><i class="fas fa-check"></i> {{ __('Save Changes') }}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> {{ __('Cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Delete Confirmation') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>{{ __('Are you really want to delete this item?') }}</p>
            </div>
            <div class="modal-footer">
                <form action="" id="item_delect_confirmation" class="delet_modal_form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> {{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-trash"></i> {{ __('Yes, Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js_section')
<script>
"use strict"
function editCategory(id, name, desc) {
    document.getElementById('editCategoryForm').action = '{{ url("admin/portfolio/category") }}/' + id;
    document.getElementById('editCatName').value = name;
    document.getElementById('editCatDesc').value = desc || '';
}
function setCategoryDelete(id) {
    document.getElementById('item_delect_confirmation').action = '{{ url("admin/portfolio/category") }}/' + id;
}
</script>
@endpush
