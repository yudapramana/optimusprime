<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'code',
        'tuition_fee',
        'status',
    ];

    // Relasi ke Mahasiswa
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    // Relasi ke Admin
    public function admins()
    {
        return $this->hasMany(Admin::class);
    }
}
