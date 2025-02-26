<?php

namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition()
    {
        return [
            'flight_number' => $this->faker->unique()->numerify('FL-####'),
            'airline' => $this->faker->company(),
            'departure_airport' => $this->faker->city(),
            'arrival_airport' => $this->faker->city(),
            'departure_time' => $this->faker->dateTime(),
            'arrival_time' => $this->faker->dateTime(),
            'total_seats' => $this->faker->numberBetween(100, 300),
            'available_seats' => $this->faker->numberBetween(50, 200),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'status' => $this->faker->randomElement(['scheduled', 'delayed', 'cancelled']),
        ];
    }
}
