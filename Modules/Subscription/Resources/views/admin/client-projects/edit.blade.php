@extends('admin.master_layout')
@section('title')
    <title>{{ __('Edit Client Project') }}</title>
@endsection

@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Edit Client Project') }}</h3>
    <p class="crancy-header__text">{{ __('Client Billing') }} >> {{ __('Edit Project') }}</p>
@endsection

@section('body-content')
    <section class="crancy-adashboard crancy-show">
        <div class="container container__bscreen">
            <div class="row">
                <div class="col-12">
                    <div class="crancy-body">
                        <div class="crancy-dsinner">
                            <form action="{{ route('admin.client-projects.update', $project->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12 mg-top-30">
                                        <div class="crancy-product-card">
                                            <div class="create_new_btn_inline_box">
                                                <h4 class="crancy-product-card__title">{{ __('Edit Client Project') }}</h4>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('admin.client-projects.show', $project->id) }}" class="crancy-btn">
                                                        <i class="fas fa-eye"></i> {{ __('View') }}
                                                    </a>
                                                    <a href="{{ route('admin.client-projects.index') }}" class="crancy-btn">
                                                        <i class="fa fa-list"></i> {{ __('Project List') }}
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="row mg-top-30">

                                                {{-- User --}}
                                                <div class="col-md-6">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Client (User)') }} *</label>
                                                        <select class="form-select crancy__item-input" name="user_id" required>
                                                            <option value="">{{ __('Select User') }}</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}"
                                                                    {{ old('user_id', $project->user_id) == $user->id ? 'selected' : '' }}>
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
                                                        <input class="crancy__item-input" type="text" name="name"
                                                            value="{{ old('name', $project->name) }}" required>
                                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                {{-- Title --}}
                                                <div class="col-md-6">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Project Title') }} *</label>
                                                        <input class="crancy__item-input" type="text" name="title"
                                                            value="{{ old('title', $project->title) }}" required>
                                                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                {{-- Slots --}}
                                                <div class="col-md-6">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Slots') }} *</label>
                                                        <input class="crancy__item-input" type="number" name="slots"
                                                            value="{{ old('slots', $project->slots) }}" min="1" required>
                                                        @error('slots') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                {{-- Description --}}
                                                <div class="col-12">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Description') }}</label>
                                                        <textarea class="crancy__item-input crancy__item-textarea" name="description" rows="3">{{ old('description', $project->description) }}</textarea>
                                                    </div>
                                                </div>

                                                {{-- Start / End Date --}}
                                                <div class="col-md-6">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Start Date') }}</label>
                                                        <input class="crancy__item-input" type="date" name="start_date"
                                                            value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('End Date') }}</label>
                                                        <input class="crancy__item-input" type="date" name="end_date"
                                                            value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}">
                                                    </div>
                                                </div>

                                                {{-- Total Price --}}
                                                <div class="col-md-6">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Total Price') }} *</label>
                                                        <input class="crancy__item-input" type="number" step="0.01" name="total_price"
                                                            value="{{ old('total_price', $project->total_price) }}" required>
                                                        @error('total_price') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                {{-- Monthly Amount --}}
                                                <div class="col-md-6">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Monthly Amount') }}</label>
                                                        <input class="crancy__item-input" type="number" step="0.01" name="monthly_amount"
                                                            value="{{ old('monthly_amount', $project->monthly_amount) }}">
                                                        @error('monthly_amount') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                {{-- GST Toggle --}}
                                                <div class="col-md-6">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('GST Enabled') }}</label>
                                                        <div class="crancy-ptabs__notify-switch crancy-ptabs__notify-switch--two">
                                                            <label class="crancy__item-switch">
                                                                <input name="gst_enabled" type="checkbox" id="gst_enabled_toggle"
                                                                    {{ old('gst_enabled', $project->gst_enabled) ? 'checked' : '' }}>
                                                                <span class="crancy__item-switch--slide crancy__item-switch--round"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- GST Percent --}}
                                                <div class="col-md-6" id="gst_percent_field"
                                                    style="{{ old('gst_enabled', $project->gst_enabled) ? '' : 'display:none;' }}">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('GST Percent (%)') }}</label>
                                                        <input class="crancy__item-input" type="number" step="0.01" name="gst_percent"
                                                            value="{{ old('gst_percent', $project->gst_percent) }}">
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-3">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle"></i>
                                                        {{ __('Installments are managed from the project details page.') }}
                                                    </div>
                                                </div>

                                            </div>

                                            <button class="crancy-btn mg-top-25" type="submit">{{ __('Update Project') }}</button>
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
        $('#gst_enabled_toggle').on('change', function () {
            if ($(this).is(':checked')) {
                $('#gst_percent_field').show();
            } else {
                $('#gst_percent_field').hide();
            }
        });
    });
</script>
@endpush
