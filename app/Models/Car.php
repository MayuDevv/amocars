<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'plate',
        'version',
        'year',
        'km',
        'fuel',
        'engine',
        'price',
        'description',
        'status',
        'featured',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'year' => 'integer',
        'km' => 'integer',
        'featured' => 'boolean',
    ];

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function contactRequests()
    {
        return $this->hasMany(ContactRequest::class);
    }
}