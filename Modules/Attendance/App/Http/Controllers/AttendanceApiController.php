<?php

namespace Modules\Attendance\App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamTranslation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Attendance\App\Models\Attendance;
use Modules\Attendance\App\Models\AttendanceDevice;
use Carbon\Carbon;

class AttendanceApiController extends Controller
{
    // Register a new device and link it to a team member
    public function registerDevice(Request $request)
    {
        $request->validate([
            'team_id'            => 'required|exists:teams,id',
            'device_name'        => 'required|string|max:255',
            'device_type'        => 'required|in:android,windows,other',
            'device_fingerprint' => 'required|string|unique:attendance_devices,device_fingerprint',
        ]);

        $device = AttendanceDevice::create([
            'team_id'            => $request->team_id,
            'device_name'        => $request->device_name,
            'device_type'        => $request->device_type,
            'device_fingerprint' => $request->device_fingerprint,
            'is_active'          => true,
            'last_seen_at'       => now(),
        ]);

        return response()->json([
            'success'   => true,
            'device_id' => $device->id,
            'message'   => 'Device registered successfully',
        ]);
    }

    // Check-in
    public function checkIn(Request $request)
    {
        $request->validate([
            'device_fingerprint' => 'required|string',
            'source'             => 'required|in:wifi,qr,manual',
        ]);

        $device = AttendanceDevice::where('device_fingerprint', $request->device_fingerprint)
            ->where('is_active', true)
            ->first();

        if (!$device) {
            return response()->json(['success' => false, 'message' => 'Device not registered or inactive'], 404);
        }

        $device->update(['last_seen_at' => now()]);

        $today = today()->toDateString();

        // Already checked in today — ignore duplicate
        $existing = Attendance::where('team_id', $device->team_id)->whereDate('date', $today)->first();
        if ($existing && $existing->check_in) {
            return response()->json([
                'success'    => true,
                'message'    => 'Already checked in',
                'check_in'   => $existing->check_in,
                'status'     => $existing->status,
                'already_in' => true,
            ]);
        }

        $attendance = Attendance::firstOrNew(['team_id' => $device->team_id, 'date' => $today]);
        $attendance->device_id = $device->id;
        $attendance->check_in  = now()->format('H:i:s');
        $attendance->source    = $request->source;
        $attendance->status    = $attendance->computeStatus();
        $attendance->save();

        return response()->json([
            'success'  => true,
            'message'  => 'Check-in recorded',
            'check_in' => $attendance->check_in,
            'status'   => $attendance->status,
        ]);
    }

    // Check-out
    public function checkOut(Request $request)
    {
        $request->validate([
            'device_fingerprint' => 'required|string',
        ]);

        $device = AttendanceDevice::where('device_fingerprint', $request->device_fingerprint)
            ->where('is_active', true)
            ->first();

        if (!$device) {
            return response()->json(['success' => false, 'message' => 'Device not registered'], 404);
        }

        $device->update(['last_seen_at' => now()]);

        $attendance = Attendance::where('team_id', $device->team_id)
            ->whereDate('date', today())
            ->first();

        if (!$attendance || !$attendance->check_in) {
            return response()->json(['success' => false, 'message' => 'No check-in found for today'], 404);
        }

        if ($attendance->check_out) {
            return response()->json(['success' => true, 'message' => 'Already checked out', 'check_out' => $attendance->check_out]);
        }

        $attendance->check_out   = now()->format('H:i:s');
        $attendance->total_hours = $attendance->computeTotalHours();
        $attendance->status      = $attendance->computeStatus();
        $attendance->save();

        return response()->json([
            'success'     => true,
            'message'     => 'Check-out recorded',
            'check_out'   => $attendance->check_out,
            'total_hours' => $attendance->total_hours,
            'status'      => $attendance->status,
        ]);
    }

    // Current status for a device
    public function status(Request $request, $fingerprint)
    {
        $device = AttendanceDevice::where('device_fingerprint', $fingerprint)->first();

        if (!$device) {
            return response()->json(['registered' => false]);
        }

        $attendance = Attendance::where('team_id', $device->team_id)
            ->whereDate('date', today())
            ->first();

        return response()->json([
            'registered'  => true,
            'team_id'     => $device->team_id,
            'device_id'   => $device->id,
            'checked_in'  => $attendance?->check_in !== null,
            'checked_out' => $attendance?->check_out !== null,
            'check_in'    => $attendance?->check_in,
            'check_out'   => $attendance?->check_out,
            'status'      => $attendance?->status ?? 'absent',
        ]);
    }

    // All team members with today's attendance — for the PWA profile display
    public function teamMembers()
    {
        $today = today()->toDateString();
        $teams = Team::with(['translate', 'attendance' => fn($q) => $q->whereDate('date', $today)])->get();

        return response()->json($teams->map(fn($t) => [
            'id'          => $t->id,
            'name'        => $t->translate?->name ?? 'N/A',
            'designation' => $t->translate?->designation ?? '',
            'image'       => $t->image ? asset($t->image) : null,
            'check_in'    => $t->attendance?->check_in,
            'check_out'   => $t->attendance?->check_out,
            'status'      => $t->attendance?->status ?? 'absent',
        ]));
    }

    // All team members with attendance for a specific date — for admin Edit screen
    public function byDate(Request $request)
    {
        $request->validate(['date' => 'required|date']);
        $date  = $request->date;
        $teams = Team::with(['translate', 'attendance' => fn($q) => $q->whereDate('date', $date)])->get();

        return response()->json($teams->map(fn($t) => [
            'team_member_id' => $t->id,
            'name'           => $t->translate?->name ?? 'N/A',
            'designation'    => $t->translate?->designation ?? '',
            'image'          => $t->image ? asset($t->image) : null,
            'check_in'       => $t->attendance?->check_in,
            'check_out'      => $t->attendance?->check_out,
            'status'         => $t->attendance?->status ?? 'absent',
        ]));
    }

    // Admin manually sets check-in / check-out for any member on any date
    public function adminEdit(Request $request)
    {
        $request->validate([
            'team_member_id' => 'required|exists:teams,id',
            'date'           => 'required|date',
            'check_in'       => 'nullable|date_format:H:i',
            'check_out'      => 'nullable|date_format:H:i',
        ]);

        $attendance = Attendance::firstOrNew([
            'team_id' => $request->team_member_id,
            'date'    => $request->date,
        ]);

        if ($request->filled('check_in')) {
            $attendance->check_in = $request->check_in . ':00';
        }

        if ($request->filled('check_out')) {
            $attendance->check_out   = $request->check_out . ':00';
            $attendance->total_hours = $attendance->computeTotalHours();
        }

        $attendance->status = $attendance->computeStatus();
        $attendance->source = $attendance->source ?? 'manual';
        $attendance->save();

        return response()->json([
            'success'   => true,
            'message'   => 'Attendance updated',
            'check_in'  => $attendance->check_in,
            'check_out' => $attendance->check_out,
            'status'    => $attendance->status,
        ]);
    }
}
