<?php

namespace Modules\Project\App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioCategory extends Model
{
    protected $table    = 'portfolio_categories';
    protected $fillable = ['name', 'slug', 'description'];

    public function projects()
    {
        return $this->hasMany(Project::class, 'portfolio_category_id');
    }

    public function portfolioItems()
    {
        return $this->hasMany(PortfolioItem::class, 'portfolio_category_id');
    }
}
