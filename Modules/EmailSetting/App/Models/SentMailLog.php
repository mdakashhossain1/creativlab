<?php

namespace Modules\EmailSetting\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SentMailLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id', 'from_email', 'to_email', 'cc',
        'subject', 'body', 'status', 'error_message', 'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function account()
    {
        return $this->belongsTo(BusinessEmailAccount::class, 'account_id');
    }

    public function scopeSent($query)
    {
        return $query->where('status', 'sent');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }
}
