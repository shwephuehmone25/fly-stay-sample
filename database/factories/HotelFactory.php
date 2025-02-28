<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    protected $model = Hotel::class;

    public function definition()
    {
        $imageUrls = [
            'https://images.unsplash.com/photo-1584897356466-858d9b6c53d1?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3',
            'https://images.unsplash.com/photo-1508009603885-50cf7c579365?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3',
            'https://images.unsplash.com/photo-1576788369575-4ab045b9287e?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3',
            'https://images.unsplash.com/photo-1522093007474-d86e9bf7ba6f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3',
            'https://plus.unsplash.com/premium_photo-1661963646506-e822afdd50cb?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3',
            'https://plus.unsplash.com/premium_photo-1697730111898-17d08693dca8?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3',
            'https://plus.unsplash.com/premium_photo-1669927131902-a64115445f0f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3',
            'https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3',
            'https://images.unsplash.com/photo-1612257999781-1a997105f94b?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3',
            'https://images.unsplash.com/photo-1584412370502-1dd6d55d1060?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3',
        ];

        return [
            'name' => $this->faker->company(),
            'location' => $this->faker->address(),
            'total_rooms' => $this->faker->numberBetween(50, 200),
            'remaining_rooms' => $this->faker->numberBetween(0, 100),
            'price' => $this->faker->randomFloat(2, 100, 3000),
            'rating' => $this->faker->randomFloat(2, 1, 5),
            'image' => $this->faker->randomElement($imageUrls),
        ];
    }
}
