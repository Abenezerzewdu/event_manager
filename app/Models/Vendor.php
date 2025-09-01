<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vendor extends Model
{
    protected $fillable = [
        'company_name',
        'contact_email',
        'phone',
        'user_id',
        'status',
        'description',
        'vendors_file'
    ];
public function user(): BelongsTo
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
     public function getStatusColorAttribute()
    {
        return [
            'pending' => 'yellow',
            'approved' => 'green',
            'rejected' => 'red'
        ][$this->status] ?? 'gray';
    }
}
