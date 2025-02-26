<?php

namespace Database\Factories;

use App\Models\FlightBooking;
use App\Models\User;
use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightBookingFactory extends Factory
{
    protected $model = FlightBooking::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'flight_id' => Flight::factory(),
            'total_adults' => $this->faker->numberBetween(1, 3),
            'total_children' => $this->faker->numberBetween(0, 2),
            'total_infants' => $this->faker->numberBetween(0, 1),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}
