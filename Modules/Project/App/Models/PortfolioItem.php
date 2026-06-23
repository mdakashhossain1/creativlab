<?php

namespace Modules\Project\App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    protected $table    = 'portfolio_items';
    protected $fillable = ['portfolio_category_id', 'project_id', 'type', 'content_source', 'thumbnail', 'title', 'description'];

    public function portfolioCategory()
    {
        return $this->belongsTo(PortfolioCategory::class, 'portfolio_category_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
