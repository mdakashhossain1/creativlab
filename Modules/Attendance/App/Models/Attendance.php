<?php

namespace Modules\Attendance\App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'team_id', 'device_id', 'date', 'check_in', 'check_out',
        'total_hours', 'status', 'source', 'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function device()
    {
        return $this->belongsTo(AttendanceDevice::class, 'device_id');
    }

    public function computeStatus(): string
    {
        $lateThreshold = config('attendance.late_threshold', '09:30');
        $halfDayCutoff = config('attendance.half_day_cutoff', '13:00');

        if (!$this->check_in) return 'absent';

        $checkIn  = \Carbon\Carbon::parse($this->check_in);
        $checkOut = $this->check_out ? \Carbon\Carbon::parse($this->check_out) : null;

        if ($checkOut && $checkOut->format('H:i') < $halfDayCutoff) return 'half_day';
        if ($checkIn->format('H:i') > $lateThreshold) return 'late';
        return 'present';
    }

    public function computeTotalHours(): ?float
    {
        if (!$this->check_in || !$this->check_out) return null;
        $in  = \Carbon\Carbon::parse($this->check_in);
        $out = \Carbon\Carbon::parse($this->check_out);
        return round($out->diffInMinutes($in) / 60, 2);
    }
}
