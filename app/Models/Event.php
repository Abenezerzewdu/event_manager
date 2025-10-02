<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'status',
        'location',
        'budget',
        'user_id',
        'event_type_id',
    ];

    protected $casts = [
        'event_date' => 'date',
        'budget' => 'decimal:2',
        'is_planned' => 'boolean',
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
    
    public function orders()
{
    return $this->hasMany(Order::class);
}

    public function eventServices()
    {
        return $this->hasMany(EventService::class);
    }
}
