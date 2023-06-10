<?php

namespace Database\Factories;
use App\Models\Patients;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
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
        $availableUserIds = User::where('role', 'is_User')->pluck('id')->toArray();



        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'pesel' => $this->faker->unique()->numerify('###########'),
            'address' => $this->faker->address,
            'phone' => $this->faker->numerify('####-###-###'),
            'user_id' => $this->faker->unique()->numberBetween(1, 50),
            'gender' => $this->faker->randomElement(['Female', 'Male']),
            'birthday' => $this->faker->date(),
        ];
    }


}
