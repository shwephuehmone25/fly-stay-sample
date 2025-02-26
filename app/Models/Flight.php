<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function scopeFilter(Builder $query, $search)
    {
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('flight_number', 'like', "%{$search}%")
                  ->orWhere('airline', 'like', "%{$search}%")
                  ->orWhere('departure_airport', 'like', "%{$search}%")
                  ->orWhere('arrival_airport', 'like', "%{$search}%");
            });
        }
    }

    public function bookings()
    {
        return $this->hasMany(FlightBooking::class);
    }
}
