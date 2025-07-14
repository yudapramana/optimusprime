<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InstallmentScheme;

class InstallmentSchemeSeeder extends Seeder
{
    public function run(): void
    {
        $schemes = [
            ['scheme_name' => 'one_time_payment'],
            ['scheme_name' => 'installment_three_times'],
        ];

        foreach ($schemes as $scheme) {
            InstallmentScheme::firstOrCreate($scheme);
        }
    }
}
