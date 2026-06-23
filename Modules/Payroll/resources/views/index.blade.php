@extends('admin.master_layout')
@section('title')<title>{{ __('Payroll Management') }}</title>@endsection
@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Payroll') }}</h3>
    <p class="crancy-header__text">{{ __('Team') }} >> {{ __('Payroll Management') }}</p>
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
                            $totalMembers  = $teams->count();
                            $paidCount     = $records->where('status', 'paid')->count();
                            $pendingCount  = $records->where('status', 'pending')->count();
                            $totalPayout   = $records->sum('net_salary');
                        @endphp
                        <div class="row mg-top-30">
                            @foreach([
                                ['Total Members', $totalMembers, 'fas fa-users'],
                                ['Paid',          $paidCount,    'fas fa-check-circle'],
                                ['Pending',       $pendingCount, 'fas fa-hourglass-half'],
                                ['Total Payout',  number_format($totalPayout, 2), 'fas fa-money-bill-wave'],
                            ] as [$label, $value, $icon])
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
                                                        <h3 class="crancy-ecom-card__amount">{{ $value }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- Month Filter + Export --}}
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mg-top-30">
                            <form method="GET" class="d-flex gap-2 align-items-center flex-wrap">
                                <select name="month" class="form-select" style="width:150px;">
                                    @foreach(range(1,12) as $m)
                                        <option value="{{ $m }}" @selected($m == $month)>
                                            {{ \Carbon\Carbon::createFromDate(null, $m, 1)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="year" class="form-select" style="width:110px;">
                                    @foreach(range(now()->year - 2, now()->year + 1) as $y)
                                        <option value="{{ $y }}" @selected($y == $year)>{{ $y }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="crancy-btn">{{ __('Filter') }}</button>
                            </form>
                            <a href="{{ route('admin.payroll.export', ['year' => $year, 'month' => $month]) }}"
                               class="crancy-btn">
                                <i class="fas fa-file-csv me-1"></i>{{ __('Export CSV') }}
                            </a>
                        </div>

                        {{-- Payroll Table --}}
                        <div class="crancy-table crancy-table--v3 mg-top-30">
                            <div class="table-responsive">
                                <table class="crancy-table__main crancy-table__main-v3 no-footer w-100">
                                    <thead class="crancy-table__head">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Member') }}</th>
                                            <th>{{ __('Base Salary') }}</th>
                                            <th>{{ __('Bonus') }}</th>
                                            <th>{{ __('Deductions') }}</th>
                                            <th>{{ __('Net Salary') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="crancy-table__body">
                                        @foreach($teams as $i => $team)
                                        @php $rec = $records->get($team->id); @endphp
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
                                            <td>{{ $rec ? number_format($rec->base_salary, 2) : '—' }}</td>
                                            <td>{{ $rec ? number_format($rec->bonus, 2) : '—' }}</td>
                                            <td>{{ $rec ? number_format($rec->deductions, 2) : '—' }}</td>
                                            <td>{{ $rec ? number_format($rec->net_salary, 2) : '—' }}</td>
                                            <td>
                                                @if(!$rec)
                                                    <span class="badge bg-secondary">{{ __('Not Set') }}</span>
                                                @elseif($rec->status === 'paid')
                                                    <span class="badge bg-success">{{ __('Paid') }}</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary me-1"
                                                    onclick="openSalaryModal(
                                                        {{ $team->id }},
                                                        '{{ addslashes($team->translate?->name) }}',
                                                        {{ $year }}, {{ $month }},
                                                        {{ $rec ? $rec->id : 'null' }},
                                                        {{ $rec ? $rec->base_salary : 0 }},
                                                        {{ $rec ? $rec->bonus : 0 }},
                                                        {{ $rec ? $rec->deductions : 0 }},
                                                        '{{ addslashes($rec?->notes ?? '') }}'
                                                    )">
                                                    <i class="fas fa-{{ $rec ? 'edit' : 'plus' }}"></i>
                                                    {{ $rec ? __('Edit') : __('Set Salary') }}
                                                </button>
                                                @if($rec && $rec->status === 'pending')
                                                <form method="POST"
                                                      action="{{ route('admin.payroll.mark-paid', $rec->id) }}"
                                                      style="display:inline;"
                                                      onsubmit="return confirm('Mark this member as paid and send email?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fas fa-check me-1"></i>{{ __('Mark Paid') }}
                                                    </button>
                                                </form>
                                                @elseif($rec && $rec->status === 'paid')
                                                    <small class="text-muted ms-1">
                                                        {{ __('Paid') }} {{ $rec->paid_at?->format('d M Y') }}
                                                    </small>
                                                @endif
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

{{-- Set / Edit Salary Modal --}}
<div class="modal fade" id="salaryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="salaryModalLabel">{{ __('Set Salary') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <form method="POST" action="{{ route('admin.payroll.save') }}">
                @csrf
                <input type="hidden" name="team_id" id="s_team_id">
                <input type="hidden" name="year"    id="s_year">
                <input type="hidden" name="month"   id="s_month">
                <div class="modal-body">
                    <p class="mb-3 fw-semibold" id="s_member_name"></p>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">{{ __('Base Salary') }} <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" name="base_salary" id="s_base"
                                   class="form-control" required oninput="calcNet()">
                        </div>
                        <div class="col-6">
                            <label class="form-label">{{ __('Bonus') }}</label>
                            <input type="number" step="0.01" min="0" name="bonus" id="s_bonus"
                                   class="form-control" value="0" oninput="calcNet()">
                        </div>
                        <div class="col-6">
                            <label class="form-label">{{ __('Deductions') }}</label>
                            <input type="number" step="0.01" min="0" name="deductions" id="s_deductions"
                                   class="form-control" value="0" oninput="calcNet()">
                        </div>
                        <div class="col-12">
                            <label class="form-label">{{ __('Net Salary') }}</label>
                            <div class="form-control bg-light fw-bold" id="s_net">0.00</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">{{ __('Notes') }}</label>
                            <textarea name="notes" id="s_notes" class="form-control" rows="2"></textarea>
                        </div>
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

function openSalaryModal(teamId, name, year, month, recId, base, bonus, deductions, notes) {
    document.getElementById('s_team_id').value    = teamId;
    document.getElementById('s_year').value       = year;
    document.getElementById('s_month').value      = month;
    document.getElementById('s_member_name').textContent = name;
    document.getElementById('s_base').value       = base || '';
    document.getElementById('s_bonus').value      = bonus || 0;
    document.getElementById('s_deductions').value = deductions || 0;
    document.getElementById('s_notes').value      = notes || '';
    calcNet();
    new bootstrap.Modal(document.getElementById('salaryModal')).show();
}

function calcNet() {
    const base       = parseFloat(document.getElementById('s_base').value) || 0;
    const bonus      = parseFloat(document.getElementById('s_bonus').value) || 0;
    const deductions = parseFloat(document.getElementById('s_deductions').value) || 0;
    document.getElementById('s_net').textContent = (base + bonus - deductions).toFixed(2);
}
</script>
@endpush
