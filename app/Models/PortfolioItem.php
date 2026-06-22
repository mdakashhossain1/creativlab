<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortfolioItem extends Model
{
    // type: 'image' | 'video' | 'bunny'
    // content_source: direct image/video URL or Bunny Stream embed URL
    // thumbnail: optional thumbnail image URL (used for video/bunny cards)
    protected $fillable = ['portfolio_category_id', 'type', 'content_source', 'thumbnail', 'title', 'description'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(PortfolioCategory::class, 'portfolio_category_id');
    }
}
