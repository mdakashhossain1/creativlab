<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'review_id', 'author_name', 'author_url', 'profile_photo_url',
        'rating', 'text', 'review_time', 'relative_time_description',
        'language', 'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function getStarsAttribute(): int
    {
        return (int) $this->rating;
    }
}
