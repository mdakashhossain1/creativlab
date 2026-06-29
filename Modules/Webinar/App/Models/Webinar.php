<?php

namespace Modules\Webinar\App\Models;

use Illuminate\Database\Eloquent\Model;

class Webinar extends Model
{
    protected $fillable = [
        'title', 'slug', 'page_html', 'page_css',
        'webinar_date', 'total_seats', 'payment_enabled',
        'price', 'currency_symbol', 'status',
    ];

    protected $casts = [
        'payment_enabled' => 'boolean',
        'webinar_date'    => 'datetime',
    ];

    public function registrations()
    {
        return $this->hasMany(WebinarRegistration::class);
    }


}
