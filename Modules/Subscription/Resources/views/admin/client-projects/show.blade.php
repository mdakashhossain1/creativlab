@extends('admin.master_layout')
@section('title')
    <title>{{ __('Project Details') }}</title>
@endsection

@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Project Details') }}</h3>
    <p class="crancy-header__text">{{ __('Client Billing') }} >> {{ __('Project Details') }}</p>
@endsection

@section('body-content')
    <section class="crancy-adashboard crancy-show">
        <div class="container container__bscreen">
            <div class="row">
                <div class="col-12">
                    <div class="crancy-body">
                        <div class="crancy-dsinner">

                            {{-- Project Info --}}
                            <div class="crancy-product-card mg-top-30">
                                <div class="create_new_btn_inline_box">
                                    <h4 class="crancy-product-card__title">{{ $project->name }}</h4>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.client-projects.edit', $project->id) }}" class="crancy-btn">
                                            <i class="fas fa-edit"></i> {{ __('Edit') }}
                                        </a>
                                        <a href="{{ route('admin.client-projects.index') }}" class="crancy-btn">
                                            <i class="fas fa-list"></i> {{ __('All Projects') }}
                                        </a>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <p><strong>{{ __('Client') }}:</strong> {{ $project->user?->name }} ({{ $project->user?->email }})</p>
                                        <p><strong>{{ __('Title') }}:</strong> {{ $project->title }}</p>
                                        <p><strong>{{ __('Payment Type') }}:</strong>
                                            @if ($project->payment_type === 'split')
                                                <span class="badge bg-info">{{ __('Split') }}</span>
                                            @else
                                                <span class="badge bg-primary">{{ __('Monthly') }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>{{ __('Total Price') }}:</strong> {{ currency($project->total_price) }}</p>
                                        <p><strong>{{ __('Slots') }}:</strong> {{ $project->slots }}</p>
                                        <p><strong>{{ __('Status') }}:</strong>
                                            @if ($project->status === 'active')
                                                <span class="badge bg-success">{{ __('Active') }}</span>
                                            @elseif ($project->status === 'paused')
                                                <span class="badge bg-warning">{{ __('Paused') }}</span>
                                            @else
                                                <span class="badge bg-secondary">{{ __('Completed') }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>{{ __('Start Date') }}:</strong> {{ $project->start_date?->format('d M Y') ?? '—' }}</p>
                                        <p><strong>{{ __('End Date') }}:</strong> {{ $project->end_date?->format('d M Y') ?? '—' }}</p>
                                        <p><strong>{{ __('GST') }}:</strong>
                                            {{ $project->gst_enabled ? $project->gst_percent . '%' : __('None') }}
                                        </p>
                                    </div>
                                    @if ($project->description)
                                        <div class="col-12 mt-2">
                                            <p><strong>{{ __('Description') }}:</strong> {{ $project->description }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Installments Table --}}
                            <div class="crancy-table crancy-table--v3 mg-top-30">
                                <div class="crancy-customer-filter">
                                    <div class="crancy-customer-filter__single create_new_btn_box">
                                        <h4 class="crancy-product-card__title">{{ __('Installments') }}</h4>
                                    </div>
                                </div>
                                <div class="dt-bootstrap5 no-footer">
                                    <table class="crancy-table__main crancy-table__main-v3 no-footer">
                                        <thead class="crancy-table__head">
                                            <tr>
                                                <th class="crancy-table__h2">#</th>
                                                <th class="crancy-table__h2">{{ __('Base Amount') }}</th>
                                                <th class="crancy-table__h2">{{ __('GST') }}</th>
                                                <th class="crancy-table__h2">{{ __('Total') }}</th>
                                                <th class="crancy-table__h2">{{ __('Due Date') }}</th>
                                                <th class="crancy-table__h2">{{ __('Status') }}</th>
                                                <th class="crancy-table__h2">{{ __('Payment Method') }}</th>
                                                <th class="crancy-table__h2">{{ __('Paid At') }}</th>
                                                <th class="crancy-table__h2">{{ __('Invoice') }}</th>
                                                <th class="crancy-table__h3">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="crancy-table__body">
                                            @foreach ($project->installments->sortBy('installment_number') as $installment)
                                                <tr class="odd">
                                                    <td class="crancy-table__data-2">{{ $installment->installment_number }}</td>
                                                    <td class="crancy-table__data-2">{{ currency($installment->base_amount) }}</td>
                                                    <td class="crancy-table__data-2">{{ currency($installment->gst_amount) }}</td>
                                                    <td class="crancy-table__data-2">{{ currency($installment->total_amount) }}</td>
                                                    <td class="crancy-table__data-2">{{ $installment->due_date?->format('d M Y') ?? '—' }}</td>
                                                    <td class="crancy-table__data-2">
                                                        @if ($installment->status === 'paid')
                                                            <span class="badge bg-success">{{ __('Paid') }}</span>
                                                        @elseif ($installment->status === 'overdue')
                                                            <span class="badge bg-danger">{{ __('Overdue') }}</span>
                                                        @else
                                                            <span class="badge bg-warning">{{ __('Pending') }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="crancy-table__data-2">{{ $installment->payment_method ?? '—' }}</td>
                                                    <td class="crancy-table__data-2">{{ $installment->paid_at?->format('d M Y H:i') ?? '—' }}</td>
                                                    <td class="crancy-table__data-2">{{ $installment->invoice_number ?? '—' }}</td>
                                                    <td class="crancy-table__data-2">
                                                        @if ($installment->status === 'pending' && $installment->payment_method === 'Bank_Payment')
                                                            <form action="{{ route('admin.client-projects.installment.approve', $installment->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="crancy-btn">
                                                                    <i class="fas fa-check"></i> {{ __('Approve') }}
                                                                </button>
                                                            </form>
                                                        @elseif ($installment->status === 'pending')
                                                            <form action="{{ route('admin.client-projects.installment.approve', $installment->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="crancy-btn">
                                                                    <i class="fas fa-check"></i> {{ __('Mark Paid') }}
                                                                </button>
                                                            </form>
                                                        @else
                                                            <span class="text-muted">—</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
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
@endsection
