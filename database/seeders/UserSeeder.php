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


        // Tworzenie administratora
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'is_admin',
        ]);


        User::create([
            'name' => 'user1',
            'email' => 'user1@example.com',
            'password' => bcrypt('password'),
            'role' => 'is_User',
        ]);

        User::create([
            'name' => 'user4',
            'email' => 'user4@example.com',
            'password' => bcrypt('password'),
            'role' => 'is_User',
        ]);

        User::create([
            'name' => 'user6',
            'email' => 'user6@example.com',
            'password' => bcrypt('password'),
            'role' => 'is_User',
        ]);

        User::create([
            'name' => 'user5',
            'email' => 'user2@example.com',
            'password' => bcrypt('password'),
            'role' => 'is_Dentists',
        ]);

        User::create([
            'name' => 'user3',
            'email' => 'user3@example.com',
            'password' => bcrypt('password'),
            'role' => 'is_User',
        ]);
    }
}
