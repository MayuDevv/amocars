<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $fillable = [
        'car_id',
        'name',
        'phone',
        'message',
        'status',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}