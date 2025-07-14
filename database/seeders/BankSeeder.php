<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    public function run()
    {
        DB::table('banks')->insert([
            [
                'bank_name' => 'Bank BNI',
                'account_name' => 'Universitas Ekasakti',
                'account_number' => '7512885991',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bank_name' => 'Bank BRI',
                'account_name' => 'Universitas Ekasakti',
                'account_number' => '2208.01000179.30.2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bank_name' => 'Bank BSI',
                'account_name' => 'Universitas Ekasakti',
                'account_number' => '1000211927',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bank_name' => 'Bank BTN',
                'account_name' => 'Universitas Ekasakti',
                'account_number' => '0000901300005029',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bank_name' => 'Bank Nagari (Syariah)',
                'account_name' => 'Universitas Ekasakti',
                'account_number' => '7100.0108.00014.0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bank_name' => 'Bank Bukopin',
                'account_name' => 'Universitas Ekasakti',
                'account_number' => '1002217038',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
