@extends('admin.master_layout')
@section('title')<title>{{ __('Daily Attendance') }}</title>@endsection
@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Attendance') }}</h3>
    <p class="crancy-header__text">{{ __('Team') }} >> {{ __('Daily Attendance') }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">
            <div class="col-12">
                <div class="crancy-body">
                    <div class="crancy-dsinner">

                        {{-- Stat Cards --}}
                        @php
                            $total   = $teams->count();
                            $present = $teams->filter(fn($t) => in_array($t->attendance?->status, ['present','late']))->count();
                            $late    = $teams->filter(fn($t) => $t->attendance?->status === 'late')->count();
                            $absent  = $teams->filter(fn($t) => !$t->attendance?->check_in)->count();
                        @endphp
                        <div class="row mg-top-30">

                            @foreach([
                                ['Total',   $total,   'fas fa-users'],
                                ['Present', $present, 'fas fa-user-check'],
                                ['Late',    $late,    'fas fa-clock'],
                                ['Absent',  $absent,  'fas fa-user-times'],
                            ] as [$label, $count, $icon])
                            <div class="col-lg-3 col-6 mg-top-30">
                                <div class="crancy-ecom-card crancy-ecom-card__v2">
                                    <div class="flex-main text-theme">
                                        <span style="width:54px;height:54px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;position:relative;">
                                            <span style="position:absolute;inset:0;border-radius:50%;background:currentColor;opacity:0.08;"></span>
                                            <i class="{{ $icon }}" style="font-size:20px;position:relative;z-index:1;"></i>
                                        </span>
                                        <div class="flex-1">
                                            <div class="crancy-ecom-card__heading">
                                                <div class="crancy-ecom-card__icon">
                                                    <h4 class="crancy-ecom-card__title">{{ __($label) }}</h4>
                                                </div>
                                            </div>
                                            <div class="crancy-ecom-card__content">
                                                <div class="crancy-ecom-card__camount">
                                                    <div class="crancy-ecom-card__camount__inside">
                                                        <h3 class="crancy-ecom-card__amount">{{ $count }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>

                        {{-- Attendance Table --}}
                        <div class="crancy-table crancy-table--v3">
                            {{-- Date Filter + Actions --}}
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                                <form method="GET" class="d-flex gap-2 align-items-center">
                                    <input type="date" name="date" value="{{ $date }}" class="form-control" style="width:200px;">
                                    <button class="crancy-btn">{{ __('Filter') }}</button>
                                </form>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.attendance.monthly') }}" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-chart-bar me-1"></i>{{ __('Monthly Report') }}
                                    </a>
                                    <a href="{{ route('admin.attendance.devices') }}" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-mobile-alt me-1"></i>{{ __('Devices') }}
                                    </a>
                                    <a href="{{ route('admin.attendance.qrcode') }}" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-qrcode me-1"></i>{{ __('QR Code') }}
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="crancy-table__main crancy-table__main-v3 no-footer w-100">
                                    <thead class="crancy-table__head">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Member') }}</th>
                                            <th>{{ __('Check In') }}</th>
                                            <th>{{ __('Check Out') }}</th>
                                            <th>{{ __('Hours') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Source') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="crancy-table__body">
                                        @foreach($teams as $i => $team)
                                        @php $att = $team->attendance; @endphp
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    @if($team->image)
                                                        <img src="{{ asset($team->image) }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
                                                    @else
                                                        <div style="width:36px;height:36px;border-radius:50%;background:#e9ecef;display:flex;align-items:center;justify-content:center;">
                                                            <i class="fas fa-user text-muted"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="fw-semibold">{{ $team->translate?->name }}</div>
                                                        <small class="text-muted">{{ $team->translate?->designation }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $att?->check_in ? \Carbon\Carbon::parse($att->check_in)->format('h:i A') : '—' }}</td>
                                            <td>{{ $att?->check_out ? \Carbon\Carbon::parse($att->check_out)->format('h:i A') : '—' }}</td>
                                            <td>{{ $att?->total_hours ? $att->total_hours . 'h' : '—' }}</td>
                                            <td>
                                                @php
                                                    $status = $att?->status ?? 'absent';
                                                    $badge = ['present'=>'success','late'=>'warning','half_day'=>'info','absent'=>'danger'][$status] ?? 'secondary';
                                                @endphp
                                                <span class="badge bg-{{ $badge }}">{{ ucfirst(str_replace('_',' ',$status)) }}</span>
                                            </td>
                                            <td>
                                                @if($att?->source)
                                                    <span class="badge bg-secondary">{{ ucfirst($att->source) }}</span>
                                                @else
                                                    —
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="crancy-btn dropdown-toggle" type="button"
                                                        id="dropdownMenuButton{{ $team->id }}"
                                                        data-bs-toggle="dropdown"
                                                        data-bs-flip="false"
                                                        aria-expanded="false">
                                                        {{ __('Action') }}
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $team->id }}">
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:;"
                                                                onclick="openManual({{ $team->id }}, '{{ $date }}', '{{ $att?->check_in }}', '{{ $att?->check_out }}', '{{ $att?->notes }}')">
                                                                <i class="fas fa-edit"></i> {{ __('Edit') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.attendance.calendar', $team->id) }}">
                                                                <i class="fas fa-calendar-alt"></i> {{ __('Calendar') }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
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

{{-- Manual Entry Modal --}}
<div class="modal fade" id="manualModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Manual Attendance Entry') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <form id="manualForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="m_team_id" name="team_id">
                    <input type="hidden" id="m_date"    name="date">
                    <div class="mb-3">
                        <label class="form-label">{{ __('Check In Time') }}</label>
                        <input type="time" id="m_check_in" name="check_in" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Check Out Time') }}</label>
                        <input type="time" id="m_check_out" name="check_out" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Notes') }}</label>
                        <textarea name="notes" id="m_notes" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="display:flex;justify-content:space-between;gap:10px;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js_section')
<script>
"use strict";
function openManual(teamId, date, checkIn, checkOut, notes) {
    document.getElementById('m_team_id').value  = teamId;
    document.getElementById('m_date').value     = date;
    document.getElementById('m_check_in').value = checkIn ? checkIn.substring(0,5) : '';
    document.getElementById('m_check_out').value= checkOut ? checkOut.substring(0,5) : '';
    document.getElementById('m_notes').value    = notes || '';
    new bootstrap.Modal(document.getElementById('manualModal')).show();
}

document.getElementById('manualForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const data = new FormData(this);
    fetch('{{ route("admin.attendance.manual-entry") }}', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: data
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) { toastr.success('Attendance saved'); setTimeout(() => location.reload(), 800); }
        else toastr.error('Failed to save');
    });
});
</script>
@endpush
