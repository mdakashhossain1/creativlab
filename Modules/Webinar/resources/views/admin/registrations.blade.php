@extends('admin.master_layout')

@section('title')
<title>Registrations — {{ $webinar->title }}</title>
@endsection

@section('body-header')
<h4 class="crancy-header__title">Registrations: {{ $webinar->title }}</h4>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.webinar.index') }}">Webinars</a></li>
        <li class="breadcrumb-item active">Registrations</li>
    </ol>
</nav>
@endsection

@section('body-content')
<div class="crancy-body">
    <div class="crancy-ds">
        <div class="crancy-ds__main crancy-ds__main--v3">
            <div class="container-fluid">
                <div class="row mg-top-30">

                    {{-- Stats Row --}}
                    <div class="col-md-3 mb-3">
                        <div class="crancy-wc__form-main text-center">
                            <h3 class="mb-1" style="font-size:2rem;color:#6366f1;">{{ $registrations->count() }}</h3>
                            <p class="text-muted mb-0">Total Registrations</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="crancy-wc__form-main text-center">
                            <h3 class="mb-1" style="font-size:2rem;color:#10b981;">{{ $registrations->where('payment_status','approved')->count() }}</h3>
                            <p class="text-muted mb-0">Approved</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="crancy-wc__form-main text-center">
                            <h3 class="mb-1" style="font-size:2rem;color:#f59e0b;">{{ $registrations->where('payment_status','pending')->count() }}</h3>
                            <p class="text-muted mb-0">Pending</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="crancy-wc__form-main text-center">
                            <h3 class="mb-1" style="font-size:2rem;color:#374151;">
                                {{ $webinar->currency_symbol }}{{ number_format($registrations->where('payment_status','approved')->sum('amount'), 2) }}
                            </h3>
                            <p class="text-muted mb-0">Total Revenue</p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="crancy-table crancy-table--v3">
                            <div class="crancy-table__heading">
                                <h4 class="crancy-table__title">Registration List</h4>
                                <a href="{{ route('admin.webinar.builder', $webinar->id) }}" class="crancy-btn crancy-btn__header">
                                    <i class="fas fa-paint-brush"></i> Builder
                                </a>
                            </div>
                            <div class="crancy-table__inner">
                                <table id="dataTable" class="table crancy-table__main">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Payment Method</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Transaction ID</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($registrations as $i => $reg)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td><strong>{{ $reg->name }}</strong></td>
                                            <td>{{ $reg->email }}</td>
                                            <td>{{ $reg->phone ?: '—' }}</td>
                                            <td>{{ $reg->payment_method }}</td>
                                            <td>{{ $webinar->currency_symbol }}{{ number_format($reg->amount, 2) }}</td>
                                            <td>
                                                @if($reg->payment_status === 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @elseif($reg->payment_status === 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $reg->payment_status }}</span>
                                                @endif
                                            </td>
                                            <td><small>{{ $reg->transaction_id ?: '—' }}</small></td>
                                            <td><small>{{ $reg->created_at->format('d M Y, H:i') }}</small></td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    @if($reg->payment_status === 'pending')
                                                    <form action="{{ route('admin.webinar.registration.approve', $reg->id) }}" method="POST">
                                                        @csrf @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-success" title="Approve">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                    @endif
                                                    <form action="{{ route('admin.webinar.registration.delete', $reg->id) }}" method="POST"
                                                          onsubmit="return confirm('Delete this registration?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-4 text-muted">No registrations yet.</td>
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
</div>
@endsection
