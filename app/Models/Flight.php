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
        'passenger_details',
        'price',
        'status',
        'image',
        'flight_type',
        'travel_class',
    ];

    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
        'price' => 'decimal:2',
        'passenger_details' => 'json',
    ];

    /**
     * Scope a query to filter flights based on search parameters.
     */
    public function scopeFilter(Builder $query, $filters)
    {
        if (!empty($filters['departure_airport'])) {
            $query->where('departure_airport', 'like', "%{$filters['departure_airport']}%");
        }

        if (!empty($filters['arrival_airport'])) {
            $query->where('arrival_airport', 'like', "%{$filters['arrival_airport']}%");
        }

        if (!empty($filters['departure_time'])) {
            $query->whereDate('departure_time', $filters['departure_time']);
        }

        if (!empty($filters['arrival_time'])) {
            $query->whereDate('arrival_time', $filters['arrival_time']);
        }

        if (!empty($filters['flight_type'])) {
            $query->where('flight_type', $filters['flight_type']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['travel_class'])) {
            $query->where('travel_class', $filters['travel_class']);
        }

        if (!empty($filters['available_seats'])) {
            $query->where('available_seats', '>=', $filters['available_seats']);
        }

        if (!empty($filters['passengers'])) {
            $query->whereJsonContains('passenger_details', [
                'adults' => $filters['passengers']['adults'] ?? 0,
                'children' => $filters['passengers']['children'] ?? 0,
                'infants' => $filters['passengers']['infants'] ?? 0,
            ]);
        }
    }

    /**
     * Define relationship with FlightBooking
     */
    public function bookings()
    {
        return $this->hasMany(FlightBooking::class);
    }
}
