<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiptSignature extends Model
{
    protected $fillable = [
        'name',
        'signature_url',
        'position',
        'is_active',
    ];
}
