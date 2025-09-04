<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'description',
        'vendors_file',
    ];

    public function vendorServices()
    {
        return $this->hasMany(VendorService::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
