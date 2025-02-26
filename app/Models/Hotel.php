<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotels';

    protected $fillable = [
        'name',
        'location',
        'total_rooms',
        'remaining_rooms',
        'rating',
    ];

    protected $casts = [
        'rating' => 'decimal:2',
    ];

    public function bookings()
    {
        return $this->hasMany(HotelBooking::class);
    }
}
