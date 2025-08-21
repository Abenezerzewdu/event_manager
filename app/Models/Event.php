<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'date',
        'location',
        'budget',
        'user_id',
        'event_type_id'
    ];

    protected $casts = [
        'date' => 'datetime',
        'budget' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function eventServices()
    {
        return $this->hasMany(EventService::class);
    }
}
