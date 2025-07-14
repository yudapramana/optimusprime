<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nim',
        'name',
        'gender',
        'birth_place',
        'birth_date',
        'email',
        'phone_number',
        'address',
        'enrollment_year',
        'entry_semester',
        'status',
        'photo_url',
        'faculty_id',
    ];

    // Default value for photo_url
    protected $attributes = [
        'photo_url' => 'https://ui-avatars.com/api/?name=Mahasiswa+Baru&background=0069d9&color=ffffff',
    ];

    // Accessor: if photo_url is null, return default photo
    public function getPhotoUrlAttribute($value)
    {
        return $value ?: 'https://ui-avatars.com/api/?name=Mahasiswa+Baru&background=0069d9&color=ffffff';
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Fakultas
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    // Accessor: menghitung semester saat ini
    public function getCurrentSemesterAttribute()
    {
        $now = Carbon::now();
        $currentYear = $now->year;
        $currentMonth = $now->month;

        // Tentukan semester sekarang
        $currentSemester = $currentMonth >= 1 && $currentMonth <= 6 ? 'genap' : 'ganjil';


        // Hitung jumlah semester yang telah berlalu
        $yearDiff = $currentYear - $this->enrollment_year;
        
        $semesterCount = $yearDiff * 2;


        if ($this->entry_semester === 'ganjil' && $currentSemester === 'genap') {
            $semesterCount += 1;
        } elseif ($this->entry_semester === 'genap' && $currentSemester === 'ganjil') {
            $semesterCount += 1;
        }

        // Mahasiswa semester pertama = semester 1
        return $semesterCount + 1;
    }
}
