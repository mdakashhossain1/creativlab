<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class GoogleBusinessToken extends Model
{
    protected $fillable = [
        'access_token', 'refresh_token', 'token_type',
        'token_expires_at', 'google_email', 'google_name', 'google_avatar',
    ];

    protected $casts = [
        'token_expires_at' => 'datetime',
    ];

    public function isExpired(): bool
    {
        return $this->token_expires_at && $this->token_expires_at->isPast();
    }
}
