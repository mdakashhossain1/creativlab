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
                        <div class="row mg-top-30">

                            @php
                                $stats = [
                                    ['label' => 'Total Registrations', 'value' => $registrations->count(),                                                                              'icon' => 'fas fa-users'],
                                    ['label' => 'Approved',            'value' => $registrations->where('payment_status','approved')->count(),                                          'icon' => 'fas fa-check-circle'],
                                    ['label' => 'Pending',             'value' => $registrations->where('payment_status','pending')->count(),                                           'icon' => 'fas fa-clock'],
                                    ['label' => 'Total Revenue',       'value' => $webinar->currency_symbol . number_format($registrations->where('payment_status','approved')->sum('amount'), 2), 'icon' => 'fas fa-dollar-sign'],
                                ];
                            @endphp

                            @foreach($stats as $stat)
                            <div class="col-lg-3 col-md-6 col-12 mg-top-30">
                                <div class="crancy-ecom-card crancy-ecom-card__v2">
                                    <div class="flex-main text-theme">
                                        <span style="display:inline-flex;align-items:center;justify-content:center;width:54px;height:54px;border-radius:50%;background:rgba(108,93,211,0.08);flex-shrink:0;">
                                            <i class="{{ $stat['icon'] }}" style="font-size:22px;"></i>
                                        </span>
                                        <div class="flex-1">
                                            <div class="crancy-ecom-card__heading">
                                                <div class="crancy-ecom-card__icon">
                                                    <h4 class="crancy-ecom-card__title">{{ __($stat['label']) }}</h4>
                                                </div>
                                            </div>
                                            <div class="crancy-ecom-card__content">
                                                <div class="crancy-ecom-card__camount">
                                                    <div class="crancy-ecom-card__camount__inside">
                                                        <h3 class="crancy-ecom-card__amount">{{ $stat['value'] }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

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
