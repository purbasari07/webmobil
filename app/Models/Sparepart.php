<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'stock',
        'price',
    ];

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_spareparts')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
}
