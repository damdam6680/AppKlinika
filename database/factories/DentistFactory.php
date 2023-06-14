<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dentists>
 */
class DentistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $specializations = ['Chirurgia stomatologiczna', 'Chirurgia szczękowo-twarzowa', 'Ortodoncja', 'Periodontologia'];
        return [
            'first_name' =>fake()->firstName,
            'last_name' =>fake()->lastName,
            'specialization' =>fake()->randomElement($specializations),
            'phone_number' =>fake()->phoneNumber,
            'user_id' => $this->faker->unique()->numberBetween(50, 100),
        ];
    }
}
