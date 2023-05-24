<?php

namespace Database\Factories;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patients>
 */
class PatientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {

        return [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'pesel' => fake()->numerify('###########'),
            'address' => fake()->address,
            'phone' => fake()->phoneNumber,
            'user_id' => User::where('role', 'is_User')->inRandomOrder()->value('id'),
        ];
    }


}
