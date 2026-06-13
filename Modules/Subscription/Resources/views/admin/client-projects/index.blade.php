@extends('admin.master_layout')
@section('title')
    <title>{{ __('Client Projects') }}</title>
@endsection

@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Client Projects') }}</h3>
    <p class="crancy-header__text">{{ __('Client Billing') }} >> {{ __('Project List') }}</p>
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
                                        <div class="crancy-header__form crancy-header__rm--customer create_new_btn_inline_box">
                                            <h4 class="crancy-product-card__title">{{ __('Project List') }}</h4>
                                            <a href="{{ route('admin.client-projects.create') }}" class="crancy-btn">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="M8 1V15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M1 8H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                                {{ __('Create New') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div id="crancy-table__main_wrapper" class="dt-bootstrap5 no-footer">
                                    <table class="crancy-table__main crancy-table__main-v3 no-footer" id="dataTable">
                                        <thead class="crancy-table__head">
                                            <tr>
                                                <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('#') }}</th>
                                                <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('Project Name') }}</th>
                                                <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('User') }}</th>
                                                <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('Type') }}</th>
                                                <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('Total Price') }}</th>
                                                <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('Paid / Total') }}</th>
                                                <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('Status') }}</th>
                                                <th class="crancy-table__column-3 crancy-table__h3 sorting">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="crancy-table__body">
                                            @foreach ($projects as $index => $project)
                                                <tr class="odd">
                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        <h4 class="crancy-table__product-title">{{ $projects->firstItem() + $index }}</h4>
                                                    </td>
                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        <h4 class="crancy-table__product-title">{{ $project->name }}</h4>
                                                        <small class="text-muted">{{ $project->title }}</small>
                                                    </td>
                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        <h4 class="crancy-table__product-title">{{ $project->user?->name ?? '—' }}</h4>
                                                        <small class="text-muted">{{ $project->user?->email }}</small>
                                                    </td>
                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        @if ($project->payment_type === 'split')
                                                            <span class="badge bg-info text-white">{{ __('Split') }}</span>
                                                        @else
                                                            <span class="badge bg-primary text-white">{{ __('Monthly') }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        <h4 class="crancy-table__product-title">{{ currency($project->total_price) }}</h4>
                                                    </td>
                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        @php
                                                            $paid  = $project->installments->where('status', 'paid')->count();
                                                            $total = $project->installments->count();
                                                        @endphp
                                                        <h4 class="crancy-table__product-title">{{ $paid }} / {{ $total }}</h4>
                                                    </td>
                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        @if ($project->status === 'active')
                                                            <span class="badge bg-success text-white">{{ __('Active') }}</span>
                                                        @elseif ($project->status === 'paused')
                                                            <span class="badge bg-warning text-white">{{ __('Paused') }}</span>
                                                        @else
                                                            <span class="badge bg-secondary text-white">{{ __('Completed') }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="crancy-table__column-2 crancy-table__data-2">
                                                        <div class="dropdown">
                                                            <button class="crancy-btn dropdown-toggle" type="button"
                                                                id="dropdownMenuButton{{ $project->id }}"
                                                                data-bs-toggle="dropdown"
                                                                data-bs-flip="false"
                                                                aria-expanded="false">
                                                                {{ __('Action') }}
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $project->id }}">
                                                                <li>
                                                                    <a href="{{ route('admin.client-projects.show', $project->id) }}" class="dropdown-item">
                                                                        <i class="fas fa-eye"></i> {{ __('View') }}
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('admin.client-projects.edit', $project->id) }}" class="dropdown-item">
                                                                        <i class="fas fa-edit"></i> {{ __('Edit') }}
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <form action="{{ route('admin.client-projects.toggle-status', $project->id) }}" method="POST">
                                                                        @csrf
                                                                        <button type="submit" class="dropdown-item">
                                                                            @if ($project->status === 'active')
                                                                                <i class="fas fa-pause"></i> {{ __('Pause') }}
                                                                            @else
                                                                                <i class="fas fa-play"></i> {{ __('Activate') }}
                                                                            @endif
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                                <li>
                                                                    <a onclick="itemDeleteConfrimation({{ $project->id }})"
                                                                       href="javascript:;" data-bs-toggle="modal"
                                                                       data-bs-target="#exampleModal"
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

                                @if ($projects->hasPages())
                                    <div class="mt-3">
                                        {{ $projects->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Delete Confirmation') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are you really want to delete this item?') }}</p>
                </div>
                <div class="modal-footer">
                    <form action="" id="item_delect_confirmation" class="delet_modal_form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Yes, Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js_section')
    <style>
        #crancy-table__main_wrapper { overflow: visible !important; }
        .dataTables_scrollBody { overflow: visible !important; }
    </style>
    <script>
        "use strict"
        function itemDeleteConfrimation(id) {
            $("#item_delect_confirmation").attr("action", '{{ url("admin/client-projects/") }}' + "/" + id);
        }
    </script>
@endpush
