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
                                                        @if ($installment->status !== 'paid')
                                                            <button type="button" class="crancy-btn"
                                                                onclick="openMarkPaidModal({{ $installment->id }}, '{{ addslashes($installment->payment_method) }}')">
                                                                <i class="fas fa-money-bill-wave"></i> {{ __('Mark as Paid') }}
                                                            </button>
                                                        @else
                                                            <span class="badge bg-success"><i class="fas fa-check"></i> {{ __('Paid') }}</span>
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

    {{-- Mark as Paid Modal --}}
    <div class="modal fade" id="markPaidModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:12px;border:none;">
                <form id="markPaidForm" method="POST" action="">
                    @csrf
                    <div class="modal-header" style="border-bottom:1px solid #f0f0f0;padding:20px 24px;">
                        <h5 class="modal-title" style="font-weight:700;font-size:18px;">
                            <i class="fas fa-money-bill-wave text-success me-2"></i>
                            {{ __('Mark Installment as Paid') }}
                        </h5>
                        <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="padding:24px;">

                        {{-- Payment Method --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2" style="font-size:14px;">
                                {{ __('Payment Method') }} <span class="text-danger">*</span>
                            </label>
                            <div class="d-flex flex-wrap gap-2" id="paymentMethodOptions">
                                @foreach(['Cash' => 'fas fa-money-bill-alt', 'Bank_Payment' => 'fas fa-university', 'Cheque' => 'fas fa-file-invoice', 'Other' => 'fas fa-ellipsis-h'] as $value => $icon)
                                    <label class="payment-method-option" style="cursor:pointer;">
                                        <input type="radio" name="payment_method" value="{{ $value }}" class="d-none payment-method-radio" {{ $value === 'Cash' ? 'checked' : '' }}>
                                        <span class="d-flex align-items-center gap-2 px-3 py-2 rounded border method-label {{ $value === 'Cash' ? 'selected-method' : '' }}"
                                              style="font-size:14px;font-weight:500;transition:all .2s;border-color:#dee2e6;">
                                            <i class="{{ $icon }}"></i>
                                            {{ $value === 'Bank_Payment' ? __('Bank Transfer') : __($value) }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Transaction Reference --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold mb-2" style="font-size:14px;">
                                {{ __('Transaction / Reference No.') }}
                                <span class="text-muted fw-normal">({{ __('optional') }})</span>
                            </label>
                            <input type="text" name="transaction_id" class="form-control"
                                   placeholder="{{ __('e.g. receipt no., cheque no., or leave blank for cash') }}"
                                   style="border-radius:8px;font-size:14px;">
                        </div>

                        {{-- Info note --}}
                        <div class="d-flex align-items-start gap-2 p-3 rounded" style="background:#f0fdf4;border:1px solid #bbf7d0;">
                            <i class="fas fa-info-circle text-success mt-1"></i>
                            <p class="mb-0" style="font-size:13px;color:#166534;">
                                {{ __('An invoice email will be sent to the client automatically after marking as paid.') }}
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top:1px solid #f0f0f0;padding:16px 24px;display:flex;align-items:center;justify-content:flex-end;gap:10px;flex-wrap:nowrap;">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius:8px;font-weight:500;">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="crancy-btn" style="border-radius:8px;">
                            <i class="fas fa-check me-1"></i> {{ __('Confirm Payment') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .selected-method { background:#794AFF !important; color:#fff !important; border-color:#794AFF !important; }
        .payment-method-option:hover .method-label:not(.selected-method) { border-color:#794AFF; color:#794AFF; }
    </style>

    <script>
        "use strict";
        function openMarkPaidModal(installmentId, existingMethod) {
            var baseUrl = "{{ url('admin/client-projects/installment') }}";
            document.getElementById('markPaidForm').action = baseUrl + '/' + installmentId + '/mark-paid';

            // Pre-select existing method if any
            var radios = document.querySelectorAll('.payment-method-radio');
            radios.forEach(function(r) {
                var label = r.nextElementSibling;
                if (r.value === existingMethod) {
                    r.checked = true;
                    label.classList.add('selected-method');
                } else {
                    label.classList.remove('selected-method');
                }
            });

            // Default to Cash if nothing matches
            var anyChecked = Array.from(radios).some(r => r.checked && r.value === existingMethod);
            if (!anyChecked || !existingMethod) {
                radios[0].checked = true;
                radios[0].nextElementSibling.classList.add('selected-method');
            }

            var modal = new bootstrap.Modal(document.getElementById('markPaidModal'));
            modal.show();
        }

        // Visual toggle for payment method selection
        document.querySelectorAll('.payment-method-radio').forEach(function(radio) {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.method-label').forEach(function(l) { l.classList.remove('selected-method'); });
                radio.nextElementSibling.classList.add('selected-method');
            });
        });
    </script>
@endsection
