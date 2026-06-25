<?php

namespace Modules\EmailSetting\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessEmailAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'smtp_host', 'smtp_port',
        'smtp_username', 'smtp_password', 'encryption',
        'is_default', 'status',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function logs()
    {
        return $this->hasMany(SentMailLog::class, 'account_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /** Dynamically build a Laravel mailer config array for this account. */
    public function mailerConfig(): array
    {
        return [
            'transport'  => 'smtp',
            'host'       => $this->smtp_host,
            'port'       => (int) $this->smtp_port,
            'encryption' => $this->encryption === 'none' ? null : $this->encryption,
            'username'   => $this->smtp_username,
            'password'   => $this->smtp_password,
        ];
    }
}
