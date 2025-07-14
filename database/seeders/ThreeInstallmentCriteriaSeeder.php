<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThreeInstallmentCriteriaSeeder extends Seeder
{
    public function run()
    {
        DB::table('three_installment_criterias')->insert([
            [
                'type' => 'start_date',
                'percentage' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'mid_date',
                'percentage' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'end_date',
                'percentage' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
