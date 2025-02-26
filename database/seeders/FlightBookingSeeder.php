<?php

namespace Database\Seeders;

use App\Models\FlightBooking;
use Illuminate\Database\Seeder;

class FlightBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        FlightBooking::factory(20)->create();
    }
}
