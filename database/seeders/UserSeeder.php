<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(50)->state(function (array $attributes) {
            return [
                'role' => 'user',
            ];
        })->create();

    // Tworzenie użytkowników z rolą is_dentis (51-100)
        User::factory()
        ->count(50)
        ->state(function (array $attributes) {
            return [
                'role' => 'dentist',
            ];
        })
        ->create();



        // Tworzenie administratora
        User::create([
            'name' => 'Admin',
            'email' => 'admin123@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);



    }
}
