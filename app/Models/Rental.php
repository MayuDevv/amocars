<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'car_id',
        'daily_price',
        'available',
    ];

    protected $casts = [
        'daily_price' => 'decimal:2',
        'available' => 'boolean',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}