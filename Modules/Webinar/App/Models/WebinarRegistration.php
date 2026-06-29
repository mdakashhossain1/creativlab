<?php

namespace Modules\Webinar\App\Models;

use Illuminate\Database\Eloquent\Model;

class WebinarRegistration extends Model
{
    protected $fillable = [
        'webinar_id', 'name', 'email', 'phone',
        'payment_method', 'payment_status', 'transaction_id', 'amount',
    ];

    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }
}
