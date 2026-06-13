@extends('admin.master_layout')
@section('title')
    <title>{{ __('Create Client Project') }}</title>
@endsection

@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Create Client Project') }}</h3>
    <p class="crancy-header__text">{{ __('Client Billing') }} >> {{ __('Create Project') }}</p>
@endsection

@section('body-content')
    <section class="crancy-adashboard crancy-show">
        <div class="container container__bscreen">
            <div class="row">
                <div class="col-12">
                    <div class="crancy-body">
                        <div class="crancy-dsinner">
                            <form action="{{ route('admin.client-projects.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mg-top-30">
                                        <div class="crancy-product-card">
                                            <div class="create_new_btn_inline_box">
                                                <h4 class="crancy-product-card__title">{{ __('Create Client Project') }}</h4>
                                                <a href="{{ route('admin.client-projects.index') }}" class="crancy-btn">
                                                    <i class="fa fa-list"></i> {{ __('Project List') }}
                                                </a>
                                            </div>

                                            <div class="row mg-top-30">

                                                {{-- User --}}
                                                <div class="col-md-6">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Client (User)') }} *</label>
                                                        <select class="form-select crancy__item-input" name="user_id" required>
                                                            <option value="">{{ __('Select User') }}</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                                    {{ $user->name }} ({{ $user->email }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                {{-- Name --}}
                                                <div class="col-md-6">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Project Name') }} *</label>
                                                        <input class="crancy__item-input" type="text" name="name" value="{{ old('name') }}" required>
                                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                {{-- Title --}}
                                                <div class="col-md-6">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Project Title') }} *</label>
                                                        <input class="crancy__item-input" type="text" name="title" value="{{ old('title') }}" required>
                                                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                {{-- Slots --}}
                                                <div class="col-md-6">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Slots') }} *</label>
                                                        <input class="crancy__item-input" type="number" name="slots" value="{{ old('slots', 1) }}" min="1" required>
                                                        @error('slots') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                {{-- Description --}}
                                                <div class="col-12">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Description') }}</label>
                                                        <textarea class="crancy__item-input crancy__item-textarea" name="description" rows="3">{{ old('description') }}</textarea>
                                                    </div>
                                                </div>

                                                {{-- Start / End Date --}}
                                                <div class="col-md-6">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Start Date') }}</label>
                                                        <input class="crancy__item-input" type="date" name="start_date" value="{{ old('start_date') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('End Date') }}</label>
                                                        <input class="crancy__item-input" type="date" name="end_date" value="{{ old('end_date') }}">
                                                    </div>
                                                </div>

                                                {{-- Total Price --}}
                                                <div class="col-md-6">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Total Price') }} *</label>
                                                        <input class="crancy__item-input" type="number" step="0.01" name="total_price" value="{{ old('total_price', 0) }}" required>
                                                        @error('total_price') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                {{-- Payment Type --}}
                                                <div class="col-md-6">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Payment Type') }} *</label>
                                                        <div class="d-flex gap-4 mt-2 align-items-center">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="payment_type" value="split" id="type_split"
                                                                    {{ old('payment_type', 'split') === 'split' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="type_split">{{ __('Split Installments') }}</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="payment_type" value="monthly" id="type_monthly"
                                                                    {{ old('payment_type') === 'monthly' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="type_monthly">{{ __('Monthly') }}</label>
                                                            </div>
                                                        </div>
                                                        @error('payment_type') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                {{-- GST Toggle --}}
                                                <div class="col-md-6">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('GST Enabled') }}</label>
                                                        <div class="crancy-ptabs__notify-switch crancy-ptabs__notify-switch--two">
                                                            <label class="crancy__item-switch">
                                                                <input name="gst_enabled" type="checkbox" id="gst_enabled_toggle"
                                                                    {{ old('gst_enabled') ? 'checked' : '' }}>
                                                                <span class="crancy__item-switch--slide crancy__item-switch--round"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- GST Percent --}}
                                                <div class="col-md-6" id="gst_percent_field" style="{{ old('gst_enabled') ? '' : 'display:none;' }}">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('GST Percent (%)') }}</label>
                                                        <input class="crancy__item-input" type="number" step="0.01" name="gst_percent" value="{{ old('gst_percent', 0) }}">
                                                    </div>
                                                </div>

                                                {{-- Monthly Amount --}}
                                                <div class="col-md-6" id="monthly_amount_field" style="{{ old('payment_type') === 'monthly' ? '' : 'display:none;' }}">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Monthly Amount') }} *</label>
                                                        <input class="crancy__item-input" type="number" step="0.01" name="monthly_amount" value="{{ old('monthly_amount') }}">
                                                        @error('monthly_amount') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                {{-- Split Installments --}}
                                                <div class="col-12" id="split_installments_field" style="{{ old('payment_type', 'split') === 'split' ? '' : 'display:none;' }}">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Installments') }}</label>
                                                        <table class="table table-bordered mt-2" id="installments_table">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{ __('#') }}</th>
                                                                    <th>{{ __('Amount') }}</th>
                                                                    <th>{{ __('Due Date') }}</th>
                                                                    <th>{{ __('Remove') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="installment_rows">
                                                                @if (old('installments'))
                                                                    @foreach (old('installments') as $i => $inst)
                                                                        <tr>
                                                                            <td>{{ $i + 1 }}</td>
                                                                            <td><input type="number" step="0.01" name="installments[{{ $i }}][amount]" class="form-control" value="{{ $inst['amount'] }}" required></td>
                                                                            <td><input type="date" name="installments[{{ $i }}][due_date]" class="form-control" value="{{ $inst['due_date'] }}" required></td>
                                                                            <td><button type="button" class="btn btn-sm btn-danger remove_row">✕</button></td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td><input type="number" step="0.01" name="installments[0][amount]" class="form-control" required></td>
                                                                        <td><input type="date" name="installments[0][due_date]" class="form-control" required></td>
                                                                        <td><button type="button" class="btn btn-sm btn-danger remove_row">✕</button></td>
                                                                    </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                        <button type="button" class="btn btn-sm btn-secondary mt-2" id="add_installment_row">
                                                            + {{ __('Add Installment') }}
                                                        </button>
                                                        @error('installments') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <button class="crancy-btn mg-top-25" type="submit">{{ __('Save Project') }}</button>
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
    "use strict";
    $(function () {
        // Payment type toggle
        function toggleInstallmentRequired(isMonthly) {
            $('#split_installments_field input').prop('required', !isMonthly);
            $('#monthly_amount_field input').prop('required', isMonthly);
        }

        $('input[name="payment_type"]').on('change', function () {
            if ($(this).val() === 'monthly') {
                $('#monthly_amount_field').show();
                $('#split_installments_field').hide();
                toggleInstallmentRequired(true);
            } else {
                $('#monthly_amount_field').hide();
                $('#split_installments_field').show();
                toggleInstallmentRequired(false);
            }
        });

        // Set correct required state on page load
        toggleInstallmentRequired($('input[name="payment_type"]:checked').val() === 'monthly');

        // GST toggle
        $('#gst_enabled_toggle').on('change', function () {
            if ($(this).is(':checked')) {
                $('#gst_percent_field').show();
            } else {
                $('#gst_percent_field').hide();
            }
        });

        // Add installment row
        var rowIndex = $('#installment_rows tr').length;
        $('#add_installment_row').on('click', function () {
            var isSplit = $('input[name="payment_type"]:checked').val() !== 'monthly';
            var req = isSplit ? ' required' : '';
            var row = '<tr>' +
                '<td>' + (rowIndex + 1) + '</td>' +
                '<td><input type="number" step="0.01" name="installments[' + rowIndex + '][amount]" class="form-control"' + req + '></td>' +
                '<td><input type="date" name="installments[' + rowIndex + '][due_date]" class="form-control"' + req + '></td>' +
                '<td><button type="button" class="btn btn-sm btn-danger remove_row">✕</button></td>' +
                '</tr>';
            $('#installment_rows').append(row);
            rowIndex++;
        });

        // Remove row
        $(document).on('click', '.remove_row', function () {
            $(this).closest('tr').remove();
        });
    });
</script>
@endpush
