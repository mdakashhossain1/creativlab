@extends('admin.master_layout')
@section('title')<title>{{ __('Portfolio Items') }} — {{ $project->translate?->title }}</title>@endsection
@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Portfolio Items') }}</h3>
    <p class="crancy-header__text">
        <a href="{{ route('admin.project.index') }}">{{ __('Projects') }}</a> >>
        {{ $project->translate?->title }} >> {{ __('Portfolio Items') }}
    </p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">
            <div class="col-12">
                <div class="crancy-body">
                    <div class="crancy-dsinner">

                        {{-- Add Item Form --}}
                        <div class="crancy-product-card mg-top-30">
                            <h4 class="crancy-product-card__title mb-3">{{ __('Add Portfolio Item') }}</h4>

                            <form action="{{ route('admin.project-items.store', $project->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="crancy__item-label">{{ __('Portfolio Category') }} *</label>
                                        <select class="form-select crancy__item-input" name="portfolio_category_id" required>
                                            <option value="">{{ __('Select Category') }}</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $project->portfolio_category_id == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="crancy__item-label">{{ __('Type') }} *</label>
                                        <select class="form-select crancy__item-input" name="type" id="itemType" required onchange="toggleFields()">
                                            <option value="image">{{ __('Image') }}</option>
                                            <option value="video">{{ __('Video URL') }}</option>
                                            <option value="bunny">{{ __('Bunny Embed') }}</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="crancy__item-label">{{ __('Title') }}</label>
                                        <input type="text" name="title" class="crancy__item-input" placeholder="{{ __('Item title') }}">
                                    </div>

                                    <div class="col-md-8" id="fieldContentSource">
                                        <label class="crancy__item-label" id="labelContent">{{ __('Image File / URL') }} *</label>
                                        <input type="text" name="content_source" class="crancy__item-input"
                                            placeholder="{{ __('Enter image URL or video/embed URL') }}" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="crancy__item-label">{{ __('Thumbnail') }} <span class="text-muted">(for video/bunny)</span></label>
                                        <input type="file" name="thumbnail" class="crancy__item-input" accept="image/*">
                                    </div>

                                    <div class="col-12">
                                        <label class="crancy__item-label">{{ __('Description') }}</label>
                                        <textarea name="description" class="crancy__item-input" rows="2"
                                            placeholder="{{ __('Short description') }}"></textarea>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="crancy-btn">
                                            <i class="fas fa-plus me-2"></i>{{ __('Add Item') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- Items Grid --}}
                        <div class="crancy-product-card mg-top-30">
                            <h4 class="crancy-product-card__title mb-3">
                                {{ __('Items') }} <span class="badge bg-primary ms-1">{{ $items->count() }}</span>
                            </h4>

                            @if($items->isEmpty())
                                <div class="text-center text-muted py-4">
                                    <i class="fas fa-images fa-3x mb-3 d-block"></i>
                                    {{ __('No portfolio items yet. Add the first one above.') }}
                                </div>
                            @else
                                <div class="row g-3">
                                    @foreach($items as $item)
                                    <div class="col-md-3 col-sm-6">
                                        <div class="card border-0 shadow-sm h-100">
                                            {{-- Preview --}}
                                            @if($item->type === 'image')
                                                <img src="{{ $item->content_source }}" class="card-img-top"
                                                    style="height:160px;object-fit:cover;"
                                                    onerror="this.src='{{ asset('backend/img/noimage.jpg') }}'">
                                            @elseif($item->thumbnail)
                                                <div style="position:relative;">
                                                    <img src="{{ asset($item->thumbnail) }}" class="card-img-top"
                                                        style="height:160px;object-fit:cover;">
                                                    <span style="position:absolute;top:8px;left:8px;" class="badge bg-dark">
                                                        <i class="fas fa-play"></i> {{ ucfirst($item->type) }}
                                                    </span>
                                                </div>
                                            @else
                                                <div class="d-flex align-items-center justify-content-center bg-light"
                                                    style="height:160px;">
                                                    <i class="fas fa-{{ $item->type === 'video' ? 'video' : 'film' }} fa-3x text-muted"></i>
                                                </div>
                                            @endif

                                            <div class="card-body p-2">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <span class="badge bg-secondary mb-1">{{ $item->portfolioCategory?->name }}</span>
                                                        <p class="mb-0 small fw-semibold">{{ $item->title ?: '—' }}</p>
                                                    </div>
                                                    <form action="{{ route('admin.project-item.delete', $item->id) }}" method="POST"
                                                        onsubmit="return confirm('{{ __('Delete this item?') }}')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

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
function toggleFields() {
    const type  = document.getElementById('itemType').value;
    const label = document.getElementById('labelContent');
    if (type === 'image')  label.textContent = '{{ __("Image URL") }} *';
    if (type === 'video')  label.textContent = '{{ __("Video URL") }} *';
    if (type === 'bunny')  label.textContent = '{{ __("Bunny Embed URL") }} *';
}
</script>
@endpush
