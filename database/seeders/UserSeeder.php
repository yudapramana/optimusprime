<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;
use App\Models\Student;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Admin
        $adminUser = User::create([
            'name' => 'Admin Ekasakti',
            'email' => 'admin@ekasakti.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        Admin::create([
            'user_id' => $adminUser->id,
            'nidn' => '1234567890',
            'faculty_id' => 1, // Pastikan ID fakultas ini sudah ada
        ]);

        // Data Mahasiswa
        $students = [
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'fauzi@student.ac.id',
                'nim' => '23010001',
                'gender' => 'L',
                'birth_place' => 'Bandung',
                'birth_date' => '2004-03-15',
                'phone_number' => '081234567890',
                'address' => 'Jl. Merdeka No. 1, Bandung',
                'enrollment_year' => 2023,
                'entry_semester' => 'ganjil',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@student.ac.id',
                'nim' => '23010002',
                'gender' => 'P',
                'birth_place' => 'Surabaya',
                'birth_date' => '2004-05-10',
                'phone_number' => '081298765432',
                'address' => 'Jl. Mawar No. 5, Surabaya',
                'enrollment_year' => 2023,
                'entry_semester' => 'ganjil',
            ],
            [
                'name' => 'Rizky Ramadhan',
                'email' => 'rizky@student.ac.id',
                'nim' => '23010003',
                'gender' => 'L',
                'birth_place' => 'Yogyakarta',
                'birth_date' => '2003-12-01',
                'phone_number' => '081212345678',
                'address' => 'Jl. Kaliurang KM 7, Yogyakarta',
                'enrollment_year' => 2023,
                'entry_semester' => 'ganjil',
            ],
        ];

        foreach ($students as $student) {
            $user = User::create([
                'name' => $student['name'],
                'email' => $student['email'],
                'password' => Hash::make('password'),
                'role' => 'student',
            ]);

            Student::create([
                'user_id' => $user->id,
                'nim' => $student['nim'],
                'name' => $student['name'],
                'gender' => $student['gender'],
                'birth_place' => $student['birth_place'],
                'birth_date' => $student['birth_date'],
                'email' => $student['email'],
                'phone_number' => $student['phone_number'],
                'address' => $student['address'],
                'enrollment_year' => $student['enrollment_year'],
                'entry_semester' => $student['entry_semester'],
                'status' => 'aktif',
                'photo_url' => null, // atau isi dengan default path jika ada
                'faculty_id' => rand(1, 7), // Sesuaikan dengan ID fakultas yang tersedia
            ]);
        }

        Student::factory()->count(1000)->create();
    }
}
