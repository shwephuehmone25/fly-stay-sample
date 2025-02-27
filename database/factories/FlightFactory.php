<?php

namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition()
    {
        $imageUrls = [
            'https://images.unsplash.com/photo-1584897356466-858d9b6c53d1?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bXlhbm1hcnxlbnwwfHwwfHx8MA%3D%3D',
            'https://images.unsplash.com/photo-1508009603885-50cf7c579365?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8dGhhaWxhbmR8ZW58MHx8MHx8fDA%3D',
            'https://images.unsplash.com/photo-1576788369575-4ab045b9287e?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8aG9uZyUyMGtvbmd8ZW58MHx8MHx8fDA%3D',
            'https://images.unsplash.com/photo-1522093007474-d86e9bf7ba6f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8cGFyaXN8ZW58MHx8MHx8fDA%3D',
            'https://plus.unsplash.com/premium_photo-1661963646506-e822afdd50cb?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8YmFuZ2tva3xlbnwwfHwwfHx8MA%3D%3D',
            'https://plus.unsplash.com/premium_photo-1697730111898-17d08693dca8?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fHNoYW5naGl8ZW58MHx8MHx8fDA%3D',
            'https://plus.unsplash.com/premium_photo-1669927131902-a64115445f0f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8Y2l0eXxlbnwwfHwwfHx8MA%3D%3D',
            'https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8Y2l0eXxlbnwwfHwwfHx8MA%3D%3D',
            'https://images.unsplash.com/photo-1612257999781-1a997105f94b?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8eWFuZ29ufGVufDB8fDB8fHww',
            'https://images.unsplash.com/photo-1584412370502-1dd6d55d1060?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8bWFuZGFsYXl8ZW58MHx8MHx8fDA%3D',
        ];

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
            'flight_type' => $this->faker->randomElement(['oneway', 'rounded']),
            'image' => $this->faker->randomElement($imageUrls),
        ];
    }
}
