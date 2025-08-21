<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price'
    ];

    public function vendorServices()
    {
        return $this->hasMany(VendorService::class);
    }

    public function eventServices()
    {
        return $this->hasMany(EventService::class);
    }
}
