<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicSemester;

class AcademicSemesterSeeder extends Seeder
{
    public function run()
    {
        $semesters = [
            [
                'year' => 2025,
                'semester' => 'ganjil',
                'start_date' => '2025-08-01',
                'mid_date' => '2025-10-15',
                'end_date' => '2026-01-31',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'year' => 2025,
                'semester' => 'genap',
                'start_date' => '2026-02-01',
                'mid_date' => '2026-04-15',
                'end_date' => '2026-07-31',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        AcademicSemester::insert($semesters);
    }
}
