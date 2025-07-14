<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faculty;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        $faculties = [
            ['name' => 'Ekonomi', 'code' => 'FE', 'tuition_fee' => 3200000, 'status' => true],
            ['name' => 'Hukum', 'code' => 'FH', 'tuition_fee' => 3200000, 'status' => true],
            ['name' => 'FISIPOL', 'code' => 'FISIPOL', 'tuition_fee' => 2500000, 'status' => true],
            ['name' => 'Teknik', 'code' => 'FT', 'tuition_fee' => 2500000, 'status' => true],
            ['name' => 'Pertanian', 'code' => 'FPERT', 'tuition_fee' => 2500000, 'status' => true],
            ['name' => 'FKIP', 'code' => 'FKIP', 'tuition_fee' => 2000000, 'status' => true],
            ['name' => 'Sastra Inggris', 'code' => 'FS', 'tuition_fee' => 2000000, 'status' => true],
            ['name' => 'D III MIK', 'code' => 'DMIK', 'tuition_fee' => 2000000, 'status' => true],
            ['name' => 'Pascasarjana', 'code' => 'PASCA', 'tuition_fee' => 6000000, 'status' => true],
        ];

        foreach ($faculties as $faculty) {
            Faculty::create($faculty);
        }
    }
}
