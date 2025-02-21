<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'id' => 1,
            'name' => 'Test User 1',
            'email' => 'user1@example.com',
            'password' => 'password1',
        ]);

        User::factory()->create([
            'id' => 2,
            'name' => 'Test User 2',
            'email' => 'user2@example.com',
            'password' => 'password2',
        ]);
    }
}
