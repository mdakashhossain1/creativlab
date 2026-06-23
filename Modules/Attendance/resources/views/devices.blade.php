@extends('admin.master_layout')
@section('title')<title>{{ __('Registered Devices') }}</title>@endsection
@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Registered Devices') }}</h3>
    <p class="crancy-header__text">{{ __('Attendance') }} >> {{ __('Devices') }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">
            <div class="col-12">
                <div class="crancy-body">
                    <div class="crancy-dsinner">

                        <div class="mb-3">
                            <a href="{{ route('admin.attendance.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>{{ __('Back') }}
                            </a>
                        </div>

                        <div class="crancy-table crancy-table--v3">
                            <div class="table-responsive">
                                <table class="crancy-table__main crancy-table__main-v3 no-footer w-100">
                                    <thead class="crancy-table__head">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Team Member') }}</th>
                                            <th>{{ __('Device Name') }}</th>
                                            <th>{{ __('Type') }}</th>
                                            <th>{{ __('Last Seen') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="crancy-table__body">
                                        @foreach($devices as $i => $device)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>
                                                <div class="fw-semibold">{{ $device->team?->translate?->name ?? 'N/A' }}</div>
                                                <small class="text-muted">{{ $device->team?->translate?->designation }}</small>
                                            </td>
                                            <td>{{ $device->device_name }}</td>
                                            <td>
                                                @php $icon = $device->device_type === 'android' ? 'fab fa-android text-success' : 'fab fa-windows text-primary'; @endphp
                                                <i class="{{ $icon }}"></i> {{ ucfirst($device->device_type) }}
                                            </td>
                                            <td>{{ $device->last_seen_at ? $device->last_seen_at->diffForHumans() : 'Never' }}</td>
                                            <td>
                                                <div class="crancy-ptabs__notify-switch crancy-ptabs__notify-switch--two">
                                                    <label class="crancy__item-switch">
                                                        <input type="checkbox" onclick="toggleDevice({{ $device->id }}, this)" {{ $device->is_active ? 'checked' : '' }}>
                                                        <span class="crancy__item-switch--slide crancy__item-switch--round"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.attendance.devices.delete', $device->id) }}" method="POST"
                                                      onsubmit="return confirm('Remove this device?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @if($devices->isEmpty())
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                No devices registered yet. Devices appear here after team members scan the QR code on the companion app.
                                            </td>
                                        </tr>
                                        @endif
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

@push('js_section')
<script>
"use strict";
function toggleDevice(id, el) {
    fetch('{{ url("admin/attendance/devices") }}/' + id + '/toggle', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(res => { toastr.success(res.active ? 'Device activated' : 'Device deactivated'); })
    .catch(() => { el.checked = !el.checked; toastr.error('Failed'); });
}
</script>
@endpush
