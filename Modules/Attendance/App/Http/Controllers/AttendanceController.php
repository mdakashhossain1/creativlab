<?php

namespace Modules\Attendance\App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamTranslation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Attendance\App\Models\Attendance;
use Modules\Attendance\App\Models\AttendanceDevice;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    // Daily attendance sheet
    public function index(Request $request)
    {
        $date  = $request->input('date', today()->toDateString());
        $teams = Team::with(['translate', 'attendance' => fn($q) => $q->whereDate('date', $date)])->get();

        return view('attendance::index', compact('teams', 'date'));
    }

    // Calendar view — one member, one month
    public function calendar(Request $request, $team_id)
    {
        $member = Team::with('translate')->findOrFail($team_id);
        $month  = $request->input('month', today()->format('Y-m'));
        $start  = Carbon::parse($month . '-01')->startOfMonth();
        $end    = $start->copy()->endOfMonth();

        $records = Attendance::where('team_id', $team_id)
            ->whereBetween('date', [$start, $end])
            ->get()
            ->keyBy(fn($r) => $r->date->format('Y-m-d'));

        $allTeams = Team::with('translate')->latest()->get();

        return view('attendance::calendar', compact('member', 'records', 'month', 'start', 'allTeams'));
    }

    // Monthly report — all members
    public function monthly(Request $request)
    {
        $month = $request->input('month', today()->format('Y-m'));
        $start = Carbon::parse($month . '-01')->startOfMonth();
        $end   = $start->copy()->endOfMonth();
        $days  = $start->diffInDays($end) + 1;

        $teams = Team::with(['translate', 'attendances' => fn($q) => $q->whereBetween('date', [$start, $end])])->get();

        $report = $teams->map(function ($team) use ($days) {
            $present  = $team->attendances->whereIn('status', ['present', 'late'])->count();
            $late     = $team->attendances->where('status', 'late')->count();
            $halfDay  = $team->attendances->where('status', 'half_day')->count();
            $absent   = $days - $team->attendances->count();
            $hours    = $team->attendances->sum('total_hours');
            return [
                'team'     => $team,
                'present'  => $present,
                'late'     => $late,
                'half_day' => $halfDay,
                'absent'   => max(0, $absent),
                'hours'    => round($hours, 1),
            ];
        });

        return view('attendance::monthly', compact('report', 'month', 'days'));
    }

    // Export monthly CSV
    public function export(Request $request)
    {
        $month = $request->input('month', today()->format('Y-m'));
        $start = Carbon::parse($month . '-01')->startOfMonth();
        $end   = $start->copy()->endOfMonth();
        $days  = $start->diffInDays($end) + 1;

        $teams = Team::with(['translate', 'attendances' => fn($q) => $q->whereBetween('date', [$start, $end])])->get();

        $filename = 'attendance-' . $month . '.csv';
        $headers  = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=$filename"];

        $callback = function () use ($teams, $days) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Name', 'Designation', 'Days Present', 'Late', 'Half Day', 'Absent', 'Total Hours']);
            foreach ($teams as $team) {
                $present = $team->attendances->whereIn('status', ['present', 'late'])->count();
                $late    = $team->attendances->where('status', 'late')->count();
                $half    = $team->attendances->where('status', 'half_day')->count();
                $absent  = max(0, $days - $team->attendances->count());
                $hours   = round($team->attendances->sum('total_hours'), 1);
                fputcsv($handle, [
                    $team->translate?->name ?? 'N/A',
                    $team->translate?->designation ?? '',
                    $present, $late, $half, $absent, $hours,
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Manual check-in/out override by admin
    public function manualEntry(Request $request)
    {
        $request->validate([
            'team_id'   => 'required|exists:teams,id',
            'date'      => 'required|date',
            'check_in'  => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i',
            'notes'     => 'nullable|string',
        ]);

        $attendance = Attendance::firstOrNew([
            'team_id' => $request->team_id,
            'date'    => $request->date,
        ]);

        $attendance->check_in  = $request->input('check_in');
        $attendance->check_out = $request->input('check_out');
        $attendance->source    = 'manual';
        $attendance->notes     = $request->input('notes');
        $attendance->status    = $attendance->computeStatus();
        $attendance->total_hours = $attendance->computeTotalHours();
        $attendance->save();

        return response()->json(['success' => true, 'status' => $attendance->status]);
    }

    // List registered devices
    public function devices()
    {
        $devices = AttendanceDevice::with('team.translate')->latest()->get();
        return view('attendance::devices', compact('devices'));
    }

    // Toggle device active/inactive
    public function toggleDevice($id)
    {
        $device = AttendanceDevice::findOrFail($id);
        $device->update(['is_active' => !$device->is_active]);
        return response()->json(['active' => $device->is_active]);
    }

    // Delete device
    public function deleteDevice($id)
    {
        AttendanceDevice::findOrFail($id)->delete();
        return back()->with(['message' => 'Device removed', 'alert-type' => 'success']);
    }

    // Office QR code display page
    public function qrCode()
    {
        return view('attendance::qrcode');
    }
}
