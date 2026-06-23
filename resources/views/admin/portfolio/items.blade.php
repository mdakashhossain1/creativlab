@extends('admin.master_layout')
@section('title')
    <title>{{ __('Portfolio Items') }} – {{ $category->name }}</title>
@endsection
@section('body-header')
    <h3 class="crancy-header__title m-0">{{ $category->name }}</h3>
    <p class="crancy-header__text">{{ __('Dashboard') }} >> <a href="{{ route('admin.portfolio.index') }}">{{ __('Portfolio') }}</a> >> {{ $category->name }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">

            {{-- Add Item Form --}}
            <div class="col-12 mg-top-30">
                <div class="crancy-product-card">
                    <h4 class="crancy-product-card__title">{{ __('Add New Item') }}</h4>
                    <form action="{{ route('admin.portfolio.item.store', $category->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="crancy__item-form--group mg-top-form-20">
                                    <label class="crancy__item-label">{{ __('Type') }}</label>
                                    <select name="type" class="crancy__item-input" id="item-type-select">
                                        <option value="image">Image</option>
                                        <option value="video">Video (direct URL)</option>
                                        <option value="bunny">Bunny Stream (iframe)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="crancy__item-form--group mg-top-form-20">
                                    <label class="crancy__item-label" id="source-label">{{ __('Image URL (Bunny CDN or any URL)') }}</label>
                                    <input class="crancy__item-input" type="text" name="content_source" required
                                        placeholder="https://creativlab.b-cdn.net/portfolio/image.jpg"
                                        id="source-input">
                                </div>
                            </div>
                            <div class="col-md-6" id="thumbnail-group">
                                <div class="crancy__item-form--group mg-top-form-20">
                                    <label class="crancy__item-label">{{ __('Thumbnail URL') }} <small class="text-muted">(required for video/bunny)</small></label>
                                    <input class="crancy__item-input" type="text" name="thumbnail"
                                        placeholder="https://creativlab.b-cdn.net/portfolio/thumb.jpg">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="crancy__item-form--group mg-top-form-20">
                                    <label class="crancy__item-label">{{ __('Title') }}</label>
                                    <input class="crancy__item-input" type="text" name="title" placeholder="Project title">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="crancy__item-form--group mg-top-form-20">
                                    <label class="crancy__item-label">{{ __('Description') }}</label>
                                    <input class="crancy__item-input" type="text" name="description" placeholder="Short description (optional)">
                                </div>
                            </div>
                        </div>

                        <div id="type-hint" class="mt-2 p-3 rounded" style="background:#f4f1ff;font-size:13px;">
                            <strong>Image:</strong> Paste the direct Bunny CDN image URL.<br>
                            <span id="hint-video" class="d-none"><strong>Video:</strong> Paste a direct .mp4 or .webm URL. Add a thumbnail URL too.</span>
                            <span id="hint-bunny" class="d-none"><strong>Bunny Stream:</strong> Paste the full Bunny embed URL, e.g. <code>https://iframe.mediadelivery.net/embed/{library_id}/{video_id}</code>. Add a thumbnail URL too.</span>
                        </div>

                        <button class="crancy-btn mg-top-25" type="submit">{{ __('Add Item') }}</button>
                    </form>
                </div>
            </div>

            {{-- Items Table --}}
            <div class="col-12 mg-top-30">
                <div class="crancy-product-card">
                    <h4 class="crancy-product-card__title">{{ __('Items in') }} {{ $category->name }}</h4>
                    <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <table class="crancy-table__main crancy-table__main-v3 dataTable no-footer w-100">
                            <thead class="crancy-table__head">
                                <tr>
                                    <th class="crancy-table__h1">#</th>
                                    <th class="crancy-table__h2">{{ __('Preview') }}</th>
                                    <th class="crancy-table__h2">{{ __('Type') }}</th>
                                    <th class="crancy-table__h2">{{ __('Title') }}</th>
                                    <th class="crancy-table__h2">{{ __('Source URL') }}</th>
                                    <th class="crancy-table__h2">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="crancy-table__body">
                                @forelse($category->items as $item)
                                <tr>
                                    <td class="crancy-table__data-1">{{ $loop->iteration }}</td>
                                    <td class="crancy-table__data-2">
                                        @php $thumb = $item->thumbnail ?: ($item->type === 'image' ? $item->content_source : null); @endphp
                                        @if($thumb)
                                            <img src="{{ $thumb }}" alt="" style="width:80px;height:60px;object-fit:cover;border-radius:6px;">
                                        @elseif($item->type === 'video')
                                            <video src="{{ $item->content_source }}" style="width:80px;height:60px;object-fit:cover;border-radius:6px;" muted></video>
                                        @else
                                            <div style="width:80px;height:60px;background:#794AFF22;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:24px;">▶</div>
                                        @endif
                                    </td>
                                    <td class="crancy-table__data-2">
                                        <span class="crancy-badge {{ $item->type === 'bunny' ? 'crancy-badge__active' : ($item->type === 'video' ? 'crancy-badge__pending' : 'crancy-badge__completed') }}">
                                            {{ strtoupper($item->type) }}
                                        </span>
                                    </td>
                                    <td class="crancy-table__data-2">{{ $item->title ?: '—' }}</td>
                                    <td class="crancy-table__data-2">
                                        <small class="text-muted" style="word-break:break-all;max-width:200px;display:block;">{{ Str::limit($item->content_source, 60) }}</small>
                                    </td>
                                    <td class="crancy-table__data-2">
                                        <div class="dropdown">
                                            <button class="crancy-btn dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ __('Action') }}
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a onclick="editItem({{ $item->id }}, '{{ $item->type }}', '{{ addslashes($item->content_source) }}', '{{ addslashes($item->thumbnail) }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->description) }}')"
                                                       href="javascript:;" data-bs-toggle="modal" data-bs-target="#editItemModal"
                                                       class="dropdown-item">
                                                        <i class="fas fa-edit"></i> {{ __('Edit') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a onclick="setItemDelete({{ $item->id }})"
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
                                <tr><td colspan="6" class="text-center py-4">{{ __('No items yet.') }}</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Edit Item Modal --}}
<div class="modal fade" id="editItemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Edit Item') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editItemForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="crancy__item-form--group mb-3">
                                <label class="crancy__item-label">{{ __('Type') }}</label>
                                <select name="type" id="editItemType" class="crancy__item-input">
                                    <option value="image">Image</option>
                                    <option value="video">Video (direct URL)</option>
                                    <option value="bunny">Bunny Stream (iframe)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="crancy__item-form--group mb-3">
                                <label class="crancy__item-label">{{ __('Source URL') }}</label>
                                <input class="crancy__item-input" type="text" id="editItemSource" name="content_source" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="crancy__item-form--group mb-3">
                                <label class="crancy__item-label">{{ __('Thumbnail URL') }}</label>
                                <input class="crancy__item-input" type="text" id="editItemThumb" name="thumbnail">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="crancy__item-form--group mb-3">
                                <label class="crancy__item-label">{{ __('Title') }}</label>
                                <input class="crancy__item-input" type="text" id="editItemTitle" name="title">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="crancy__item-form--group">
                                <label class="crancy__item-label">{{ __('Description') }}</label>
                                <input class="crancy__item-input" type="text" id="editItemDesc" name="description">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> {{ __('Cancel') }}</button>
                    <button type="submit" class="crancy-btn"><i class="fas fa-check"></i> {{ __('Save Changes') }}</button>
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

// Add item form — type switcher
(function () {
    const select = document.getElementById('item-type-select');
    const sourceLabel = document.getElementById('source-label');
    const sourceInput = document.getElementById('source-input');
    const hintVideo = document.getElementById('hint-video');
    const hintBunny = document.getElementById('hint-bunny');
    const labels = {
        image: 'Image URL (Bunny CDN or any image URL)',
        video: 'Video URL (.mp4 / .webm from Bunny CDN)',
        bunny: 'Bunny Stream Embed URL (iframe.mediadelivery.net/embed/...)',
    };
    const placeholders = {
        image: 'https://creativlab.b-cdn.net/portfolio/image.jpg',
        video: 'https://creativlab.b-cdn.net/portfolio/video.mp4',
        bunny: 'https://iframe.mediadelivery.net/embed/{library_id}/{video_id}',
    };
    select.addEventListener('change', function () {
        const v = this.value;
        sourceLabel.textContent = labels[v];
        sourceInput.placeholder = placeholders[v];
        hintVideo.classList.toggle('d-none', v !== 'video');
        hintBunny.classList.toggle('d-none', v !== 'bunny');
    });
})();

// Edit item modal
function editItem(id, type, source, thumb, title, desc) {
    document.getElementById('editItemForm').action = '{{ url("admin/portfolio/item") }}/' + id;
    document.getElementById('editItemType').value = type;
    document.getElementById('editItemSource').value = source;
    document.getElementById('editItemThumb').value = thumb || '';
    document.getElementById('editItemTitle').value = title || '';
    document.getElementById('editItemDesc').value = desc || '';
}

// Delete item modal
function setItemDelete(id) {
    document.getElementById('item_delect_confirmation').action = '{{ url("admin/portfolio/item") }}/' + id;
}
</script>
@endpush
