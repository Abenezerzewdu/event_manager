<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
         'user_id',
        'company_name',
        'contact_email',
        'phone',
        'address',
        'description'
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
