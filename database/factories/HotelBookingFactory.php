<?php

namespace Database\Factories;

use App\Models\HotelBooking;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelBookingFactory extends Factory
{
    protected $model = HotelBooking::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'hotel_id' => Hotel::factory(),
            'total_guests' => $this->faker->numberBetween(1, 5),
            'rooms_booked' => $this->faker->numberBetween(1, 5),
            'check_in' => $this->faker->date(),
            'check_out' => $this->faker->date(),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}
