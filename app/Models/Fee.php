<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = [
        'label',
        'slug',
        'type',
        'value',
    ];

    /**
     * @param string $slug
     * @return float|null
     */
    public static function getFeeAmountBySlug(string $slug): ?float
    {
        $fee = self::where('slug', $slug)->first();

        return $fee?->value;
    }
}
