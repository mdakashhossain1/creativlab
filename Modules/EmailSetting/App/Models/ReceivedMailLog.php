<?php

namespace Modules\EmailSetting\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReceivedMailLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id', 'message_uid', 'from_email', 'from_name',
        'to_email', 'subject', 'body_preview', 'body', 'is_read', 'received_at',
    ];

    protected $casts = [
        'is_read'     => 'boolean',
        'received_at' => 'datetime',
    ];

    public function account()
    {
        return $this->belongsTo(BusinessEmailAccount::class, 'account_id');
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}
