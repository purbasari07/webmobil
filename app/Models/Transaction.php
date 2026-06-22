<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'booking_id',
        'mekanik_id',
        'kasir_id',
        'total_service',
        'total_sparepart',
        'grand_total',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function mekanik()
    {
        return $this->belongsTo(User::class, 'mekanik_id');
    }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }

    public function spareparts()
    {
        return $this->belongsToMany(Sparepart::class, 'transaction_spareparts')
                    ->withPivot('id', 'quantity', 'price')
                    ->withTimestamps();
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
