<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientProjectInstallment extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'installment_number',
        'base_amount',
        'gst_amount',
        'total_amount',
        'due_date',
        'status',
        'payment_method',
        'transaction_id',
        'invoice_number',
        'paid_at',
    ];

    protected $casts = [
        'due_date' => 'date',
        'paid_at'  => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(ClientProject::class, 'project_id');
    }
}
