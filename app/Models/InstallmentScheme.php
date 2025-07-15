<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallmentScheme extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_name',
    ];

    protected $appends = [
        'scheme_label',
    ];

    /**
     * Relasi ke tabel installments
     * Satu skema bisa digunakan oleh banyak cicilan mahasiswa
     */
    public function installments()
    {
        return $this->hasMany(Installment::class);
    }

    /**
     * Accessor untuk label nama skema agar lebih ramah dibaca
     */
    public function getSchemeLabelAttribute()
    {
        return match ($this->scheme_name) {
            'one_time_payment' => 'Pembayaran Sekali',
            'installment_three_times' => 'Cicilan 3 Kali',
            default => ucfirst(str_replace('_', ' ', $this->scheme_name)),
        };
    }
}
