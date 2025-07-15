<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'installment_id',
        'reference_id',
        'academic_semester',
        'installment_number',
        'percentage',
        'amount_paid',
        'bank_id',
        'eviden_url',
        'upload_date',
        'transfer_date',
        'due_date',
        'status',
        'notes',
    ];

    protected $appends = [
        'status_label',
    ];

    /**
     * Relasi ke tabel Installment
     * Satu pembayaran milik satu cicilan
     */
    public function installment()
    {
        return $this->belongsTo(Installment::class);
    }

    /**
     * Accessor untuk format jumlah bayar dalam format rupiah
     */
    public function getFormattedAmountPaidAttribute()
    {
        return $this->amount_paid ? 'Rp ' . number_format($this->amount_paid, 0, ',', '.') : '-';
    }

    /**
     * Accessor untuk label status
     */
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending' => 'Menunggu',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => ucfirst($this->status),
        };
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
