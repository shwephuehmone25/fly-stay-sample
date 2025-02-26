<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    use HasFactory;

    protected $table = 'flight_bookings';

    protected $fillable = [
        'user_id',
        'flight_id',
        'total_adults',
        'total_children',
        'total_infants',
        'total_passengers',
        'status',
    ];

    protected $casts = [
        'total_passengers' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}
