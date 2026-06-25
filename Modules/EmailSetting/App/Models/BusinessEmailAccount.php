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
        'imap_host', 'imap_port', 'imap_encryption',
        'is_default', 'status',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function logs()
    {
        return $this->hasMany(SentMailLog::class, 'account_id');
    }

    public function receivedMails()
    {
        return $this->hasMany(ReceivedMailLog::class, 'account_id');
    }

    public function hasImap(): bool
    {
        return !empty($this->imap_host);
    }

    public function imapConnectionString(): string
    {
        $enc = match ($this->imap_encryption) {
            'tls'  => '/imap/tls/novalidate-cert',
            'none' => '/imap/novalidate-cert',
            default => '/imap/ssl/novalidate-cert',
        };
        return '{' . $this->imap_host . ':' . $this->imap_port . $enc . '}INBOX';
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
