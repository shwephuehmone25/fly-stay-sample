<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $table = 'flights';

    protected $fillable = [
        'flight_number',
        'airline',
        'departure_airport',
        'arrival_airport',
        'departure_time',
        'arrival_time',
        'total_seats',
        'available_seats',
        'price',
        'status',
    ];

    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
        'price' => 'decimal:2',
    ];

    public function bookings()
    {
        return $this->hasMany(FlightBooking::class);
    }
}
