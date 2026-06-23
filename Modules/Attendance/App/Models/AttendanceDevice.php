<?php

namespace Modules\Attendance\App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;

class AttendanceDevice extends Model
{
    protected $table = 'attendance_devices';

    protected $fillable = [
        'team_id', 'device_name', 'device_type',
        'device_fingerprint', 'is_active', 'last_seen_at',
    ];

    protected $casts = [
        'is_active'    => 'boolean',
        'last_seen_at' => 'datetime',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'device_id');
    }
}
