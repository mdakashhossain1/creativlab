@extends('admin.master_layout')
@section('title')<title>{{ __('Monthly Report') }}</title>@endsection
@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Monthly Attendance Report') }}</h3>
    <p class="crancy-header__text">{{ __('Attendance') }} >> {{ __('Monthly Report') }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">
            <div class="col-12">
                <div class="crancy-body">
                    <div class="crancy-dsinner">

                        {{-- Filter + Export --}}
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                            <form method="GET" class="d-flex gap-2 align-items-center">
                                <select name="month" class="form-select" style="width:200px;" onchange="this.form.submit()">
                                    @for($m = 1; $m <= 12; $m++)
                                        @php $val = now()->year . '-' . str_pad($m, 2, '0', STR_PAD_LEFT); @endphp
                                        <option value="{{ $val }}" {{ $month === $val ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::parse($val.'-01')->format('F Y') }}
                                        </option>
                                    @endfor
                                </select>
                            </form>
                            <a href="{{ route('admin.attendance.export', ['month' => $month]) }}"
                               class="crancy-btn d-inline-flex align-items-center gap-2">
                                <i class="fas fa-download"></i> {{ __('Export CSV') }}
                            </a>
                        </div>

                        {{-- Summary Cards --}}
                        @php
                            $avgPresent = $report->count() ? round($report->avg('present'), 1) : 0;
                            $avgHours   = $report->count() ? round($report->avg('hours'), 1) : 0;
                            $topMember  = $report->sortByDesc('present')->first();
                        @endphp
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm text-center p-3">
                                    <h3 class="fw-bold text-success mb-0">{{ $days }}</h3>
                                    <small class="text-muted">Working Days This Month</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm text-center p-3">
                                    <h3 class="fw-bold text-primary mb-0">{{ $avgPresent }}</h3>
                                    <small class="text-muted">Avg Present Days / Member</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm text-center p-3">
                                    <h3 class="fw-bold text-info mb-0">{{ $avgHours }}h</h3>
                                    <small class="text-muted">Avg Hours / Member</small>
                                </div>
                            </div>
                        </div>

                        {{-- Report Table --}}
                        <div class="crancy-table crancy-table--v3">
                            <div class="table-responsive">
                                <table class="crancy-table__main crancy-table__main-v3 no-footer w-100">
                                    <thead class="crancy-table__head">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Member') }}</th>
                                            <th class="text-center">{{ __('Present') }}</th>
                                            <th class="text-center">{{ __('Late') }}</th>
                                            <th class="text-center">{{ __('Half Day') }}</th>
                                            <th class="text-center">{{ __('Absent') }}</th>
                                            <th class="text-center">{{ __('Hours') }}</th>
                                            <th class="text-center">{{ __('Attendance %') }}</th>
                                            <th>{{ __('View') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="crancy-table__body">
                                        @foreach($report as $i => $row)
                                        @php
                                            $pct = $days > 0 ? round(($row['present'] / $days) * 100) : 0;
                                            $barColor = $pct >= 80 ? 'success' : ($pct >= 50 ? 'warning' : 'danger');
                                        @endphp
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    @if($row['team']->image)
                                                        <img src="{{ asset($row['team']->image) }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
                                                    @else
                                                        <div style="width:36px;height:36px;border-radius:50%;background:#e9ecef;display:flex;align-items:center;justify-content:center;">
                                                            <i class="fas fa-user text-muted"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="fw-semibold">{{ $row['team']->translate?->name }}</div>
                                                        <small class="text-muted">{{ $row['team']->translate?->designation }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center"><span class="badge bg-success">{{ $row['present'] }}</span></td>
                                            <td class="text-center"><span class="badge bg-warning text-dark">{{ $row['late'] }}</span></td>
                                            <td class="text-center"><span class="badge bg-info">{{ $row['half_day'] }}</span></td>
                                            <td class="text-center"><span class="badge bg-danger">{{ $row['absent'] }}</span></td>
                                            <td class="text-center">{{ $row['hours'] }}h</td>
                                            <td class="text-center" style="min-width:120px;">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="progress flex-grow-1" style="height:8px;">
                                                        <div class="progress-bar bg-{{ $barColor }}" style="width:{{ $pct }}%"></div>
                                                    </div>
                                                    <small>{{ $pct }}%</small>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.attendance.calendar', $row['team']->id) }}?month={{ $month }}"
                                                   class="btn btn-sm btn-outline-primary">
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
@endsection
