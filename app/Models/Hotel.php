<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
        'price',
    ];

    protected $casts = [
        'rating' => 'decimal:2',
        'price' => 'decimal:2',
    ];

    public function bookings()
    {
        return $this->hasMany(HotelBooking::class);
    }

    public function scopeFilter(Builder $query, $search)
    {
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }
    }
}
