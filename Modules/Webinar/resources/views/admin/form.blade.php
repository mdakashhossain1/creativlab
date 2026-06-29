@extends('admin.master_layout')

@section('title')
<title>{{ isset($webinar) ? 'Edit Webinar Settings' : 'Create Webinar' }}</title>
@endsection

@section('body-header')
<h4 class="crancy-header__title">{{ isset($webinar) ? 'Edit Webinar Settings' : 'Create Webinar' }}</h4>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.webinar.index') }}">Webinars</a></li>
        <li class="breadcrumb-item active">{{ isset($webinar) ? 'Edit' : 'Create' }}</li>
    </ol>
</nav>
@endsection

@section('body-content')
<div class="crancy-body">
    <div class="crancy-ds">
        <div class="crancy-ds__main">
            <div class="container-fluid">
                <div class="row mg-top-30 justify-content-center">
                    <div class="col-lg-8">
                        <div class="crancy-wc__form-main">
                            <form action="{{ isset($webinar) ? route('admin.webinar.update', $webinar->id) : route('admin.webinar.store') }}"
                                  method="POST">
                                @csrf
                                @if(isset($webinar)) @method('PUT') @endif

                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="crancy-wc__form-group">
                                            <label>Webinar Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="form-control crancy-wc__form-input"
                                                   value="{{ old('title', $webinar->title ?? '') }}" required
                                                   placeholder="e.g. Digital Marketing Masterclass 2026">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="crancy-wc__form-group">
                                            <label>URL Slug</label>
                                            <input type="text" name="slug" class="form-control crancy-wc__form-input"
                                                   value="{{ old('slug', $webinar->slug ?? '') }}"
                                                   placeholder="auto-generated if blank">
                                            <small class="text-muted">Will be: /webinar/<strong>your-slug</strong></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="crancy-wc__form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control crancy-wc__form-input">
                                                <option value="1" {{ old('status', $webinar->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status', $webinar->status ?? 1) == 0 ? 'selected' : '' }}>Draft</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="payment_enabled"
                                                   name="payment_enabled" value="1"
                                                   {{ old('payment_enabled', $webinar->payment_enabled ?? 0) ? 'checked' : '' }}
                                                   onchange="document.getElementById('priceSection').style.display = this.checked ? 'flex' : 'none'">
                                            <label class="form-check-label" for="payment_enabled">
                                                <strong>Enable Paid Registration</strong>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12" id="priceSection"
                                         style="display: {{ old('payment_enabled', $webinar->payment_enabled ?? 0) ? 'flex' : 'none' }}; gap: 1rem; flex-wrap: wrap;">
                                        <div class="crancy-wc__form-group" style="flex:1;min-width:120px;">
                                            <label>Currency Symbol</label>
                                            <input type="text" name="currency_symbol" class="form-control crancy-wc__form-input"
                                                   value="{{ old('currency_symbol', $webinar->currency_symbol ?? '$') }}" placeholder="$">
                                        </div>
                                        <div class="crancy-wc__form-group" style="flex:2;min-width:180px;">
                                            <label>Price</label>
                                            <input type="number" name="price" step="0.01" min="0"
                                                   class="form-control crancy-wc__form-input"
                                                   value="{{ old('price', $webinar->price ?? 0) }}">
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="crancy-btn">
                                            {{ isset($webinar) ? 'Save Changes' : 'Create & Open Builder' }}
                                        </button>
                                        @if(isset($webinar))
                                        <a href="{{ route('admin.webinar.builder', $webinar->id) }}" class="crancy-btn ms-2" style="background:#6366f1;">
                                            <i class="fas fa-paint-brush"></i> Open Page Builder
                                        </a>
                                        @endif
                                        <a href="{{ route('admin.webinar.index') }}" class="crancy-btn ms-2" style="background:#6b7280;">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
