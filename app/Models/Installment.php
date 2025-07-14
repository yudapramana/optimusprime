<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'academic_semester_id',
        'installment_scheme_id',
        'tuition_fee',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Academic Semester
    public function academicSemester()
    {
        return $this->belongsTo(AcademicSemester::class);
    }

    // Relasi ke Installment Scheme
    public function scheme()
    {
        return $this->belongsTo(InstallmentScheme::class, 'installment_scheme_id');
    }

    // Relasi ke Pembayaran
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
