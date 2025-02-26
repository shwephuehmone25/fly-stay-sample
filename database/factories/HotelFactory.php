<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    protected $model = Hotel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'location' => $this->faker->address(),
            'total_rooms' => $this->faker->numberBetween(50, 200),
            'remaining_rooms' => $this->faker->numberBetween(0, 100),
            'rating' => $this->faker->randomFloat(2, 1, 5),
        ];
    }
}
