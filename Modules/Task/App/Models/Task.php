<?php

namespace Modules\Task\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'priority', 'tags', 'status',
        'meeting_at', 'notify_before_minutes',
        'reminder_sent_at', 'meeting_notified_at',
    ];

    protected $casts = [
        'tags'                 => 'array',
        'meeting_at'           => 'datetime',
        'reminder_sent_at'     => 'datetime',
        'meeting_notified_at'  => 'datetime',
    ];

    public function scopeInbox($query)       { return $query->where('status', 'inbox'); }
    public function scopeDone($query)        { return $query->where('status', 'done'); }
    public function scopeImportant($query)   { return $query->where('status', 'important'); }
    public function scopeTrash($query)       { return $query->where('status', 'trash'); }

    public function getPriorityColorAttribute(): string
    {
        return match ($this->priority) {
            'high'   => '#ef4444',
            'low'    => '#22c55e',
            default  => '#f59e0b',
        };
    }

    public function getTagsListAttribute(): array
    {
        return $this->tags ?? [];
    }
}
