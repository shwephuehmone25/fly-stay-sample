<?php

namespace Database\Seeders;

use App\Models\HotelBooking;
use Illuminate\Database\Seeder;

class HotelBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        HotelBooking::factory(20)->create();
    }
}
