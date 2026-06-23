@extends('admin.master_layout')
@section('title')
    <title>{{ __('Google Reviews') }}</title>
@endsection
@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Google Reviews') }}</h3>
    <p class="crancy-header__text">{{ __('Dashboard') }} >> {{ __('Google Reviews') }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">

            {{-- Header Card --}}
            <div class="col-12 mg-top-30">
                <div class="crancy-product-card">
                    <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
                        <div>
                            <h4 class="crancy-product-card__title" style="margin:0 0 4px;">{{ __('Cached Google Reviews') }}</h4>
                            <p style="margin:0; font-size:13px; color:#5d6a83;">
                                {{ __('Reviews are fetched from Google Places API and cached here. Toggle visibility to show/hide on the website.') }}
                            </p>
                        </div>
                        <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                            @if(env('GOOGLE_PLACE_ID'))
                                <form action="{{ route('admin.google.reviews.sync') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="crancy-btn" style="width:auto !important;">
                                        <i class="fas fa-sync-alt"></i> {{ __('Sync Now') }}
                                    </button>
                                </form>
                            @else
                                <div style="background:#fff8e1; border:1px solid #fbbf24; border-radius:8px; padding:10px 16px; font-size:13px; color:#92400e;">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <strong>{{ __('GOOGLE_PLACE_ID not set') }}</strong> —
                                    {{ __('Add your Google Place ID to .env to enable review syncing.') }}
                                    <a href="https://developers.google.com/maps/documentation/places/web-service/place-id" target="_blank" style="color:#794AFF;">{{ __('Find your Place ID') }}</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if(session('message'))
                        <div class="alert alert-{{ session('alert-type') === 'success' ? 'success' : 'danger' }} mt-3">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Reviews Table --}}
            <div class="col-12 mg-top-30">
                <div class="crancy-product-card">
                    <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <table class="crancy-table__main crancy-table__main-v3 dataTable no-footer w-100">
                            <thead class="crancy-table__head">
                                <tr>
                                    <th class="crancy-table__h2" style="width:40px;">#</th>
                                    <th class="crancy-table__h2">{{ __('Reviewer') }}</th>
                                    <th class="crancy-table__h2">{{ __('Rating') }}</th>
                                    <th class="crancy-table__h2">{{ __('Review') }}</th>
                                    <th class="crancy-table__h2">{{ __('Date') }}</th>
                                    <th class="crancy-table__h2 text-center">{{ __('Visible') }}</th>
                                </tr>
                            </thead>
                            <tbody class="crancy-table__body">
                                @forelse($reviews as $index => $review)
                                <tr id="review-row-{{ $review->id }}">
                                    <td class="crancy-table__data-2">{{ $index + 1 }}</td>
                                    <td class="crancy-table__data-2">
                                        <div style="display:flex; align-items:center; gap:10px;">
                                            @if($review->profile_photo_url)
                                                <img src="{{ $review->profile_photo_url }}" alt="{{ $review->author_name }}"
                                                     style="width:36px; height:36px; border-radius:50%; object-fit:cover; flex-shrink:0;">
                                            @else
                                                <div style="width:36px; height:36px; border-radius:50%; background:#794AFF22;
                                                            display:flex; align-items:center; justify-content:center;
                                                            font-size:15px; font-weight:700; color:#794AFF; flex-shrink:0;">
                                                    {{ strtoupper(substr($review->author_name, 0, 1)) }}
                                                </div>
                                            @endif
                                            <div>
                                                <strong style="font-size:13px;">{{ $review->author_name }}</strong>
                                                @if($review->author_url)
                                                    <br><a href="{{ $review->author_url }}" target="_blank" style="font-size:11px; color:#794AFF;">{{ __('View profile') }}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="crancy-table__data-2">
                                        <span style="color:#f59e0b; font-size:15px; letter-spacing:1px;">
                                            @for($i = 1; $i <= 5; $i++)
                                                {{ $i <= $review->stars ? '★' : '☆' }}
                                            @endfor
                                        </span>
                                        <br><small class="text-muted">{{ $review->rating }}/5</small>
                                    </td>
                                    <td class="crancy-table__data-2" style="max-width:300px;">
                                        <p style="margin:0; font-size:13px; color:#3c4043; overflow:hidden; display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical;">
                                            {{ $review->text ?: '—' }}
                                        </p>
                                    </td>
                                    <td class="crancy-table__data-2">
                                        <span style="font-size:12px;">
                                            {{ $review->relative_time_description ?? \Carbon\Carbon::createFromTimestamp($review->review_time)->diffForHumans() }}
                                        </span>
                                    </td>
                                    <td class="crancy-table__data-2 text-center">
                                        <div class="form-check form-switch d-flex justify-content-center" style="padding-left:0;">
                                            <input class="form-check-input review-toggle" type="checkbox"
                                                   data-id="{{ $review->id }}"
                                                   {{ $review->is_visible ? 'checked' : '' }}
                                                   style="cursor:pointer; width:40px; height:20px;">
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="fas fa-star" style="font-size:32px; color:#e2e8f0; display:block; margin-bottom:10px;"></i>
                                        {{ __('No reviews synced yet. Click "Sync Now" to fetch reviews from Google.') }}
                                    </td>
                                </tr>
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

@push('js_section')
<script>
document.querySelectorAll('.review-toggle').forEach(function(toggle) {
    toggle.addEventListener('change', function() {
        var id = this.dataset.id;
        var checkbox = this;

        fetch('{{ url("admin/google/reviews") }}/' + id + '/toggle', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            checkbox.checked = data.visible;
        })
        .catch(function() {
            checkbox.checked = !checkbox.checked;
        });
    });
});
</script>
@endpush
