<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'event_id',
        'is_attending'
    ];

    protected $casts = [
        'is_attending' => 'boolean'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
