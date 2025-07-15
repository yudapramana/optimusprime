<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['L', 'P']);


         // Buat user terlebih dahulu
        $user = User::factory()->create([
            'name' => $this->faker->name($gender === 'L' ? 'male' : 'female'),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);


        return [
            'user_id' => $user->id,
            'nim' => $this->faker->unique()->numerify('2501####'),
            'name' => $user->name,
            'gender' => $gender,
            'birth_place' => $this->faker->city,
            'birth_date' => $this->faker->date('Y-m-d', '2005-01-01'),
            'email' => $user->email,
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
