<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vendor extends Model
{
    protected $fillable = [
         'user_id',
        'company_name',
        'contact_email',
        'phone',
        'address',
        'description',
        'vendors_file',
        'payment_status',
        'plan',
        'status',
    ];

public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function vendorServices()
    {
        return $this->hasMany(VendorService::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orders()
{
    return $this->hasMany(Order::class);
}

     public function getStatusColorAttribute()
    {
        return [
            'pending' => 'yellow',
            'approved' => 'green',
            'rejected' => 'red'
        ][$this->status] ?? 'gray';
    }

    public function services()
{
    return $this->belongsToMany(Service::class, 'vendor_services');
}


    // accessor for average rating
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    // accessor for starting price
    public function getStartingPriceAttribute()
    {
        return $this->services()->min('price') ?? 0;
    }

}
