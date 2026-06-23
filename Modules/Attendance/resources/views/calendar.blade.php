@extends('admin.master_layout')
@section('title')<title>{{ __('Attendance Calendar') }}</title>@endsection
@section('body-header')
    <h3 class="crancy-header__title m-0">{{ $member->translate?->name }}</h3>
    <p class="crancy-header__text">{{ __('Attendance') }} >> {{ __('Calendar View') }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">
            <div class="col-12">
                <div class="crancy-body">
                    <div class="crancy-dsinner">

                        {{-- Controls --}}
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                            <form method="GET" class="d-flex gap-2 align-items-center">
                                <select name="month" class="form-select" style="width:180px;" onchange="this.form.submit()">
                                    @for($m = 1; $m <= 12; $m++)
                                        @php $val = now()->year . '-' . str_pad($m,2,'0',STR_PAD_LEFT); @endphp
                                        <option value="{{ $val }}" {{ $month === $val ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::parse($val.'-01')->format('F Y') }}
                                        </option>
                                    @endfor
                                </select>
                            </form>
                            <select class="form-select" style="width:200px;" onchange="location.href='{{ route('admin.attendance.calendar','__ID__') }}'.replace('__ID__',this.value)+'?month={{ $month }}'">
                                @foreach($allTeams as $t)
                                    <option value="{{ $t->id }}" {{ $t->id == $member->id ? 'selected' : '' }}>
                                        {{ $t->translate?->name }}
                                    </option>
                                @endforeach
                            </select>
                            <a href="{{ route('admin.attendance.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>{{ __('Back to Daily') }}
                            </a>
                        </div>

                        {{-- Legend --}}
                        <div class="d-flex gap-3 mb-3 flex-wrap">
                            @foreach(['success'=>'Present','warning'=>'Late','info'=>'Half Day','danger'=>'Absent','light'=>'Weekend/Future'] as $color => $label)
                                <span><span class="badge bg-{{ $color }} me-1">&nbsp;</span>{{ $label }}</span>
                            @endforeach
                        </div>

                        {{-- Calendar Grid --}}
                        <div class="card border-0 shadow-sm p-3">
                            <div class="row g-0 text-center mb-2">
                                @foreach(['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $day)
                                    <div class="col" style="font-weight:600;padding:8px 0;font-size:13px;">{{ $day }}</div>
                                @endforeach
                            </div>

                            @php
                                $startOfCalendar = $start->copy()->startOfWeek(\Carbon\Carbon::SUNDAY);
                                $endOfCalendar   = $start->copy()->endOfMonth()->endOfWeek(\Carbon\Carbon::SATURDAY);
                                $cursor          = $startOfCalendar->copy();
                            @endphp

                            <div class="row g-0">
                            @while($cursor->lte($endOfCalendar))
                                @php
                                    $dateStr    = $cursor->format('Y-m-d');
                                    $record     = $records[$dateStr] ?? null;
                                    $isThisMonth= $cursor->month === $start->month;
                                    $isToday    = $dateStr === today()->toDateString();
                                    $isFuture   = $cursor->isFuture();
                                    $isWeekend  = $cursor->isWeekend();

                                    if (!$isThisMonth || $isFuture || $isWeekend) {
                                        $bg = 'bg-light';
                                    } else {
                                        $bg = match($record?->status) {
                                            'present'  => 'bg-success bg-opacity-10 border-success',
                                            'late'     => 'bg-warning bg-opacity-10 border-warning',
                                            'half_day' => 'bg-info bg-opacity-10 border-info',
                                            default    => 'bg-danger bg-opacity-10 border-danger',
                                        };
                                    }
                                @endphp
                                <div class="col" style="min-height:90px;border:1px solid #f0f0f0;">
                                    <div class="p-2 h-100 {{ $bg }} {{ $isToday ? 'border border-primary' : '' }}" style="border-radius:4px;">
                                        <div class="fw-bold {{ !$isThisMonth ? 'text-muted' : '' }}" style="font-size:13px;">{{ $cursor->day }}</div>
                                        @if($isThisMonth && !$isFuture && !$isWeekend && $record)
                                            <div style="font-size:11px;margin-top:4px;">
                                                @if($record->check_in)
                                                    <div class="text-success"><i class="fas fa-sign-in-alt"></i> {{ \Carbon\Carbon::parse($record->check_in)->format('h:i A') }}</div>
                                                @endif
                                                @if($record->check_out)
                                                    <div class="text-danger"><i class="fas fa-sign-out-alt"></i> {{ \Carbon\Carbon::parse($record->check_out)->format('h:i A') }}</div>
                                                @endif
                                                @if($record->total_hours)
                                                    <div class="text-muted">{{ $record->total_hours }}h</div>
                                                @endif
                                            </div>
                                        @elseif($isThisMonth && !$isFuture && !$isWeekend)
                                            <div style="font-size:11px;margin-top:4px;" class="text-danger">Absent</div>
                                        @endif
                                    </div>
                                </div>
                                @php if($cursor->dayOfWeek === \Carbon\Carbon::SATURDAY) { echo '</div><div class="row g-0">'; } @endphp
                                @php $cursor->addDay(); @endphp
                            @endwhile
                            </div>
                        </div>

                        {{-- Monthly Summary --}}
                        @php
                            $totalDays  = $records->count();
                            $presentDays= $records->whereIn('status',['present','late'])->count();
                            $lateDays   = $records->where('status','late')->count();
                            $halfDays   = $records->where('status','half_day')->count();
                            $totalHours = round($records->sum('total_hours'), 1);
                        @endphp
                        <div class="row g-3 mt-3">
                            @foreach([
                                ['Days Present', $presentDays, 'success'],
                                ['Late Days',    $lateDays,    'warning'],
                                ['Half Days',    $halfDays,    'info'],
                                ['Total Hours',  $totalHours,  'primary'],
                            ] as [$label, $val, $color])
                            <div class="col-6 col-md-3">
                                <div class="card border-0 shadow-sm text-center p-3">
                                    <h3 class="fw-bold text-{{ $color }} mb-0">{{ $val }}</h3>
                                    <small class="text-muted">{{ $label }}</small>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
