<?php

namespace Modules\Payroll\App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PayrollRecord extends Model
{
    protected $fillable = [
        'team_id', 'year', 'month',
        'base_salary', 'bonus', 'deductions', 'net_salary',
        'status', 'paid_at', 'notes',
    ];

    protected $casts = [
        'year'        => 'integer',
        'month'       => 'integer',
        'paid_at'     => 'datetime',
        'base_salary' => 'decimal:2',
        'bonus'       => 'decimal:2',
        'deductions'  => 'decimal:2',
        'net_salary'  => 'decimal:2',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function scopeForMonth(Builder $query, int $year, int $month): Builder
    {
        return $query->where('year', $year)->where('month', $month);
    }

    public static function computeNet(float $base, float $bonus, float $deductions): float
    {
        return round($base + $bonus - $deductions, 2);
    }
}
