<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'status'
    ];
      protected $casts = [
        'status' => 'string',
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
