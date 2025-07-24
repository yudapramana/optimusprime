<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReceiptSignature;

class ReceiptSignatureSeeder extends Seeder
{
    public function run()
    {
        ReceiptSignature::create([
            'name' => 'Belum Setting Nama',
            'signature_url' => 'https://st2.depositphotos.com/1054979/7429/v/450/depositphotos_74293633-stock-illustration-digital-signature.jpg',
            'position' => 'Petugas Administrasi',
            'is_active' => true
        ]);
    }
}
