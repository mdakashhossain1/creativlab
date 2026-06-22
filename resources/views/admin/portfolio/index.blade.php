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
                                    <th class="crancy-table__column-4 crancy-table__h2">{{ __('Actions') }}</th>
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
                                        <a href="{{ route('admin.portfolio.items', $cat->id) }}" class="crancy-btn crancy-btn__small crancy-btn__secondary">{{ __('Manage Items') }}</a>
                                        <form action="{{ route('admin.portfolio.category.destroy', $cat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category and all its items?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="crancy-btn crancy-btn__small crancy-btn__danger" type="submit">{{ __('Delete') }}</button>
                                        </form>
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
@endsection
