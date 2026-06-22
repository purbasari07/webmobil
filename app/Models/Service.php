<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'service_name',
        'description',
        'price',
        'estimated_time',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
