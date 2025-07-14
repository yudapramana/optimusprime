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

    /**
     * Enum type values:
     * - start_date
     * - mid_date
     * - end_date
     */
}
