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

                            {{-- Total --}}
                            <div class="col-lg-3 col-6 mg-top-30">
                                <div class="crancy-ecom-card crancy-ecom-card__v2">
                                    <div class="flex-main text-theme">
                                        <span>
                                            <svg width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle opacity="0.08" cx="27" cy="27" r="27" fill="currentcolor"/>
                                                <path d="M36.625 41H34.375V35.33C34.374 33.85 33.786 32.43 32.74 31.39C31.695 30.34 30.277 29.75 28.8 29.75H21.2C19.723 29.75 18.305 30.34 17.26 31.39C16.214 32.43 15.626 33.85 15.625 35.33V41H13.375V35.33C13.377 33.255 14.202 31.266 15.67 29.8C17.138 28.333 19.127 27.503 21.2 27.5H28.8C30.873 27.503 32.862 28.333 34.33 29.8C35.798 31.266 36.623 33.255 36.625 35.33V41ZM25 25.25C23.665 25.25 22.36 24.854 21.25 24.112C20.14 23.371 19.275 22.317 18.764 21.083C18.253 19.85 18.119 18.493 18.38 17.183C18.64 15.874 19.283 14.671 20.227 13.727C21.171 12.783 22.374 12.14 23.683 11.88C24.993 11.619 26.35 11.753 27.583 12.264C28.817 12.775 29.871 13.64 30.612 14.75C31.354 15.86 31.75 17.165 31.75 18.5C31.748 20.289 31.036 22.005 29.771 23.271C28.505 24.536 26.789 25.248 25 25.25ZM25 14C24.11 14 23.24 14.264 22.5 14.758C21.76 15.253 21.183 15.956 20.843 16.778C20.502 17.6 20.413 18.505 20.587 19.378C20.76 20.251 21.189 21.053 21.818 21.682C22.447 22.311 23.249 22.74 24.122 22.914C24.995 23.087 25.9 22.998 26.722 22.658C27.544 22.317 28.247 21.74 28.742 21C29.236 20.26 29.5 19.39 29.5 18.5C29.5 17.306 29.026 16.162 28.182 15.318C27.338 14.474 26.194 14 25 14ZM38.875 25.25H36.625C36.625 23.928 36.099 22.659 35.162 21.713C34.225 20.768 32.961 20.231 31.641 20.22C31.862 19.663 31.99 19.074 32.02 18.476C33.962 18.612 35.78 19.477 37.101 20.899C38.422 22.32 39.147 24.193 39.148 26.138L38.875 25.25ZM41.125 41H38.875V35.33C38.878 33.856 38.494 32.408 37.762 31.136C37.03 29.863 35.978 28.813 34.713 28.09C35.662 27.636 36.694 27.4 37.739 27.4C38.784 27.4 39.816 27.636 40.765 28.09C41.714 28.544 42.55 29.204 43.214 30.02C43.877 30.837 44.352 31.791 44.602 32.812C44.852 33.833 44.871 34.898 44.657 35.927L41.125 41Z" fill="currentcolor"/>
                                            </svg>
                                        </span>
                                        <div class="flex-1">
                                            <div class="crancy-ecom-card__heading">
                                                <div class="crancy-ecom-card__icon">
                                                    <h4 class="crancy-ecom-card__title">{{ __('Total') }}</h4>
                                                </div>
                                            </div>
                                            <div class="crancy-ecom-card__content">
                                                <div class="crancy-ecom-card__camount">
                                                    <div class="crancy-ecom-card__camount__inside">
                                                        <h3 class="crancy-ecom-card__amount">{{ $total }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Present --}}
                            <div class="col-lg-3 col-6 mg-top-30">
                                <div class="crancy-ecom-card crancy-ecom-card__v2">
                                    <div class="flex-main text-theme">
                                        <span>
                                            <svg width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle opacity="0.08" cx="27" cy="27" r="27" fill="currentcolor"/>
                                                <path d="M27 13C19.268 13 13 19.268 13 27C13 34.732 19.268 41 27 41C34.732 41 41 34.732 41 27C41 19.268 34.732 13 27 13ZM27 38.75C20.51 38.75 15.25 33.49 15.25 27C15.25 20.51 20.51 15.25 27 15.25C33.49 15.25 38.75 20.51 38.75 27C38.75 33.49 33.49 38.75 27 38.75ZM35.08 21.17L24.75 31.5L19.92 26.67L18.33 28.26L24.75 34.68L36.67 22.76L35.08 21.17Z" fill="currentcolor"/>
                                            </svg>
                                        </span>
                                        <div class="flex-1">
                                            <div class="crancy-ecom-card__heading">
                                                <div class="crancy-ecom-card__icon">
                                                    <h4 class="crancy-ecom-card__title">{{ __('Present') }}</h4>
                                                </div>
                                            </div>
                                            <div class="crancy-ecom-card__content">
                                                <div class="crancy-ecom-card__camount">
                                                    <div class="crancy-ecom-card__camount__inside">
                                                        <h3 class="crancy-ecom-card__amount">{{ $present }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Late --}}
                            <div class="col-lg-3 col-6 mg-top-30">
                                <div class="crancy-ecom-card crancy-ecom-card__v2">
                                    <div class="flex-main text-theme">
                                        <span>
                                            <svg width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle opacity="0.08" cx="27" cy="27" r="27" fill="currentcolor"/>
                                                <path d="M28.5 20.75C28.2016 20.75 27.9155 20.8685 27.7045 21.0795C27.4935 21.2905 27.375 21.5766 27.375 21.875V27.5C27.3751 27.7983 27.4936 28.0844 27.7046 28.2954L31.0796 31.6704C31.2918 31.8753 31.576 31.9887 31.871 31.9861C32.1659 31.9836 32.4481 31.8653 32.6567 31.6567C32.8653 31.4481 32.9836 31.1659 32.9861 30.871C32.9887 30.576 32.8753 30.2918 32.6704 30.0796L29.625 27.0343V21.875C29.625 21.5766 29.5065 21.2905 29.2955 21.0795C29.0845 20.8685 28.7984 20.75 28.5 20.75ZM29.625 40.9491C29.3266 40.9624 29.0352 40.8566 28.8148 40.655C28.5945 40.4534 28.4632 40.1725 28.4499 39.8742C28.4366 39.5758 28.5424 39.2844 28.744 39.064C28.9456 38.8436 29.2265 38.7124 29.5249 38.6991C31.6539 38.5043 33.6833 37.7069 35.3755 36.4003C37.0676 35.0936 38.3524 33.3319 39.0794 31.3214C39.8064 29.3109 39.9454 27.1348 39.4803 25.0481C39.0151 22.9615 37.965 21.0505 36.4529 19.5391C34.9408 18.0277 33.0294 16.9785 30.9425 16.5143C28.8556 16.0501 26.6796 16.1901 24.6694 16.9181C22.6593 17.646 20.8981 18.9316 19.5923 20.6243C18.2864 22.3171 17.4899 24.3469 17.2961 26.476C17.2693 26.7732 17.1254 27.0475 16.8963 27.2386C16.6672 27.4298 16.3715 27.5221 16.0744 27.4952C15.7772 27.4684 15.5028 27.3246 15.3117 27.0954C15.1206 26.8663 15.0283 26.5707 15.0551 26.2735C15.3689 22.8122 17.0054 19.6053 19.6241 17.3202C22.2428 15.0352 25.6419 13.8482 29.1137 14.0062C32.5856 14.1642 35.8628 15.6551 38.2631 18.1685C40.6634 20.6819 42.0019 24.0243 42 27.4997C42.0172 30.8729 40.7641 34.1289 38.4899 36.6201C36.2156 39.1114 33.087 40.6552 29.7262 40.9446C29.6925 40.948 29.6576 40.9491 29.625 40.9491Z" fill="currentcolor"/>
                                            </svg>
                                        </span>
                                        <div class="flex-1">
                                            <div class="crancy-ecom-card__heading">
                                                <div class="crancy-ecom-card__icon">
                                                    <h4 class="crancy-ecom-card__title">{{ __('Late') }}</h4>
                                                </div>
                                            </div>
                                            <div class="crancy-ecom-card__content">
                                                <div class="crancy-ecom-card__camount">
                                                    <div class="crancy-ecom-card__camount__inside">
                                                        <h3 class="crancy-ecom-card__amount">{{ $late }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Absent --}}
                            <div class="col-lg-3 col-6 mg-top-30">
                                <div class="crancy-ecom-card crancy-ecom-card__v2">
                                    <div class="flex-main text-theme">
                                        <span>
                                            <svg width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle opacity="0.08" cx="27" cy="27" r="27" fill="currentcolor"/>
                                                <path d="M32.875 25.25H30.625V19.625C30.625 16.5234 28.1016 14 25 14C21.8984 14 19.375 16.5234 19.375 19.625V25.25H17.125C15.8672 25.25 14.875 26.2422 14.875 27.5V38.75C14.875 40.0078 15.8672 41 17.125 41H32.875C34.1328 41 35.125 40.0078 35.125 38.75V27.5C35.125 26.2422 34.1328 25.25 32.875 25.25ZM21.625 19.625C21.625 17.7642 23.1392 16.25 25 16.25C26.8608 16.25 28.375 17.7642 28.375 19.625V25.25H21.625V19.625ZM32.875 38.75H17.125V27.5H32.875V38.75ZM25 35.375C26.2578 35.375 27.25 34.3828 27.25 33.125C27.25 31.8672 26.2578 30.875 25 30.875C23.7422 30.875 22.75 31.8672 22.75 33.125C22.75 34.3828 23.7422 35.375 25 35.375Z" fill="currentcolor"/>
                                                <line x1="36" y1="14" x2="42" y2="20" stroke="currentcolor" stroke-width="2.2" stroke-linecap="round"/>
                                                <line x1="42" y1="14" x2="36" y2="20" stroke="currentcolor" stroke-width="2.2" stroke-linecap="round"/>
                                            </svg>
                                        </span>
                                        <div class="flex-1">
                                            <div class="crancy-ecom-card__heading">
                                                <div class="crancy-ecom-card__icon">
                                                    <h4 class="crancy-ecom-card__title">{{ __('Absent') }}</h4>
                                                </div>
                                            </div>
                                            <div class="crancy-ecom-card__content">
                                                <div class="crancy-ecom-card__camount">
                                                    <div class="crancy-ecom-card__camount__inside">
                                                        <h3 class="crancy-ecom-card__amount">{{ $absent }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Date Filter + Actions --}}
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
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

                        {{-- Attendance Table --}}
                        <div class="crancy-table crancy-table--v3">
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
                                                <button class="btn btn-sm btn-outline-primary"
                                                    onclick="openManual({{ $team->id }}, '{{ $date }}', '{{ $att?->check_in }}', '{{ $att?->check_out }}', '{{ $att?->notes }}')">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a href="{{ route('admin.attendance.calendar', $team->id) }}" class="btn btn-sm btn-outline-secondary" title="Calendar">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </a>
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
