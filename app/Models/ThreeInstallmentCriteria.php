<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreeInstallmentCriteria extends Model
{
    use HasFactory;

    public const TYPES = ['start_date', 'mid_date', 'end_date'];

    protected $fillable = [
        'type',
        'percentage',
    ];

    protected $appends = [
        'type_alias'
    ];

    /**
     * Enum type values:
     * - start_date
     * - mid_date
     * - end_date
     */

    /**
     * Get alias name for type.
     */
    public function getTypeAliasAttribute()
    {
        return match ($this->type) {
            'start_date' => 'awal_semester',
            'mid_date'   => 'tengah_semester',
            'end_date'   => 'akhir_semester',
            default      => $this->type,
        };
    }
}
