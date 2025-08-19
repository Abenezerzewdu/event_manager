<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventService extends Model
{
    protected $fillable = [
        'event_id',
        'service_id',
        'quantity',
        'notes'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
