<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssociationFee extends Model
{
    protected $fillable = [
        'amount_from',
        'amount_to',
        'amount_value',
    ];

    protected $casts = [
        'amount_to' => 'float',
        'amount_from' => 'float',
        'amount_value' => 'float',
    ];
}
