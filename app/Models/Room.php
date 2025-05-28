<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'type',
        'price',
        'description',
        'status',
        'capacity',
        'image',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
