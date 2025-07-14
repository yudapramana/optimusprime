<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AcademicSemester extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'semester',
        'start_date',
        'mid_date',
        'end_date',
    ];

    // Auto append custom attributes when serialized (e.g. JSON)
    protected $appends = [
        'start_date_formatted',
        'mid_date_formatted',
        'end_date_formatted',
        'semester_name',
        'periode',
        'tahun_ajaran'
    ];

    /**
     * Scope untuk tahun terbaru duluan.
     */
    public function scopeLatestFirst($query)
    {
        return $query->orderByDesc('year')->orderBy('semester');
    }

    /**
     * Format nama semester
     */
    public function getSemesterNameAttribute()
    {
        return ucfirst($this->semester) . ' ' . $this->year;
    }

    /**
     * Format tanggal mulai secara human readable
     */
    public function getStartDateFormattedAttribute()
    {
        return Carbon::parse($this->start_date)->translatedFormat('d F Y');
    }

    /**
     * Format tanggal tengah (nullable)
     */
    public function getMidDateFormattedAttribute()
    {
        return $this->mid_date ? Carbon::parse($this->mid_date)->translatedFormat('d F Y') : '-';
    }

    /**
     * Format tanggal akhir
     */
    public function getEndDateFormattedAttribute()
    {
        return Carbon::parse($this->end_date)->translatedFormat('d F Y');
    }

    /**
     * Relasi ke tabel Installments
     * Satu semester akademik bisa memiliki banyak cicilan
     */
    public function installments()
    {
        return $this->hasMany(Installment::class);
    }

    /**
     * Scope untuk semester ganjil
     */
    public function scopeGanjil($query)
    {
        return $query->where('semester', 'ganjil');
    }

    /**
     * Scope untuk semester genap
     */
    public function scopeGenap($query)
    {
        return $query->where('semester', 'genap');
    }

    /**
     * Akses format periode (contoh: 2025/2026 Ganjil)
     */
    public function getPeriodeAttribute()
    {
        $nextYear = $this->year + 1;
        return "{$this->year}/{$nextYear} " . ucfirst($this->semester);
    }

    /**
     * Akses format Tahun Ajaran (contoh: Tahun Ajaran 2025/2026 Ganjil)
     */
    public function getTahunAjaranAttribute()
    {
        $nextYear = $this->year + 1;
        return "Tahun Ajaran {$this->year}/{$nextYear} " . ucfirst($this->semester);
    }
}
