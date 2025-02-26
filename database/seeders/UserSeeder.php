<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory(10)->create();

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '0934567890',
            'password' => bcrypt('@dmin123'),
            'role' => 'admin',
        ]);
    }
}
