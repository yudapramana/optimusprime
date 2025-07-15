<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['L', 'P']);

        return [
            'user_id' => User::factory(),
            'nim' => $this->faker->unique()->numerify('2501####'),
            'name' => $this->faker->name($gender === 'L' ? 'male' : 'female'),
            'gender' => $gender,
            'birth_place' => $this->faker->city,
            'birth_date' => $this->faker->date('Y-m-d', '2005-01-01'),
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'enrollment_year' => $this->faker->randomElement([2023, 2024, 2025]),
            'entry_semester' => 'ganjil',
            'status' => 'aktif',
            'photo_url' => null,
            'faculty_id' => rand(1, 7),
        ];
    }
}
