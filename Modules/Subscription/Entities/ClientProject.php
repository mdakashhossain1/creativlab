<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class ClientProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'title',
        'description',
        'start_date',
        'end_date',
        'total_price',
        'slots',
        'payment_type',
        'monthly_amount',
        'gst_enabled',
        'gst_percent',
        'status',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function installments()
    {
        return $this->hasMany(ClientProjectInstallment::class, 'project_id');
    }

    public function pendingInstallments()
    {
        return $this->hasMany(ClientProjectInstallment::class, 'project_id')->where('status', 'pending');
    }
}
