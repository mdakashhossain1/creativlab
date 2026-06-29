@extends('admin.master_layout')

@section('title')
<title>Registrations — {{ $webinar->title }}</title>
@endsection

@section('body-header')
<h3 class="crancy-header__title m-0">Registrations: {{ $webinar->title }}</h3>
<p class="crancy-header__text">Dashboard >> Webinars >> Registrations</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">
            <div class="col-12">
                <div class="crancy-body">
                    <div class="crancy-dsinner">

                        {{-- Stats Row --}}
                        <div class="row g-3 mg-top-30">
                            <div class="col-6 col-md-3">
                                <div class="crancy-wc__form-main text-center p-3">
                                    <h3 style="font-size:2rem;font-weight:800;color:#6366f1;margin:0 0 4px;">{{ $registrations->count() }}</h3>
                                    <p class="text-muted mb-0" style="font-size:13px;">Total Registrations</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="crancy-wc__form-main text-center p-3">
                                    <h3 style="font-size:2rem;font-weight:800;color:#10b981;margin:0 0 4px;">{{ $registrations->where('payment_status','approved')->count() }}</h3>
                                    <p class="text-muted mb-0" style="font-size:13px;">Approved</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="crancy-wc__form-main text-center p-3">
                                    <h3 style="font-size:2rem;font-weight:800;color:#f59e0b;margin:0 0 4px;">{{ $registrations->where('payment_status','pending')->count() }}</h3>
                                    <p class="text-muted mb-0" style="font-size:13px;">Pending</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="crancy-wc__form-main text-center p-3">
                                    <h3 style="font-size:2rem;font-weight:800;color:#374151;margin:0 0 4px;">
                                        {{ $webinar->currency_symbol }}{{ number_format($registrations->where('payment_status','approved')->sum('amount'), 2) }}
                                    </h3>
                                    <p class="text-muted mb-0" style="font-size:13px;">Total Revenue</p>
                                </div>
                            </div>
                        </div>

                        {{-- Table --}}
                        <div class="crancy-table crancy-table--v3 mg-top-30">

                            <div class="crancy-customer-filter">
                                <div class="crancy-customer-filter__single crancy-customer-filter__single--csearch d-flex items-center justify-between create_new_btn_box">
                                    <div class="crancy-header__form crancy-header__form--customer create_new_btn_inline_box">
                                        <h4 class="crancy-product-card__title">Registration List</h4>
                                        <a href="{{ route('admin.webinar.builder', $webinar->id) }}" class="crancy-btn">
                                            <span><i class="fas fa-paint-brush"></i></span> Builder
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div id="crancy-table__main_wrapper" class="dt-bootstrap5 no-footer">
                                <table class="crancy-table__main crancy-table__main-v3 no-footer" id="dataTable">

                                    <thead class="crancy-table__head">
                                        <tr>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">#</th>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('Name') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('Email') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('Phone') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('Payment') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('Amount') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('Status') }}</th>
                                            <th class="crancy-table__column-2 crancy-table__h2 sorting">{{ __('Date') }}</th>
                                            <th class="crancy-table__column-3 crancy-table__h3 sorting">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody class="crancy-table__body">
                                        @forelse($registrations as $i => $reg)
                                        <tr class="odd">
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <h4 class="crancy-table__product-title">{{ $i + 1 }}</h4>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <h4 class="crancy-table__product-title">{{ $reg->name }}</h4>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <h4 class="crancy-table__product-title">{{ $reg->email }}</h4>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <h4 class="crancy-table__product-title">{{ $reg->phone ?: '—' }}</h4>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <h4 class="crancy-table__product-title">{{ $reg->payment_method }}</h4>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <h4 class="crancy-table__product-title">{{ $webinar->currency_symbol }}{{ number_format($reg->amount, 2) }}</h4>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                @if($reg->payment_status === 'approved')
                                                    <span class="badge bg-success text-white">Approved</span>
                                                @elseif($reg->payment_status === 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @else
                                                    <span class="badge bg-secondary text-white">{{ $reg->payment_status }}</span>
                                                @endif
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <h4 class="crancy-table__product-title">{{ $reg->created_at->format('d M Y') }}</h4>
                                            </td>
                                            <td class="crancy-table__column-2 crancy-table__data-2">
                                                <div class="d-flex gap-2">
                                                    @if($reg->payment_status === 'pending')
                                                    <form action="{{ route('admin.webinar.registration.approve', $reg->id) }}" method="POST">
                                                        @csrf @method('PATCH')
                                                        <button type="submit" class="crancy-btn" style="padding:6px 14px;font-size:12px;" title="Approve">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                    @endif
                                                    <form action="{{ route('admin.webinar.registration.delete', $reg->id) }}" method="POST"
                                                          onsubmit="return confirm('Delete this registration?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="crancy-btn" style="padding:6px 14px;font-size:12px;background:#dc2626;">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr class="odd">
                                            <td colspan="9" class="crancy-table__column-2 crancy-table__data-2 text-center py-4">
                                                <h4 class="crancy-table__product-title text-muted">No registrations yet.</h4>
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
        </div>
    </div>
</section>
@endsection
