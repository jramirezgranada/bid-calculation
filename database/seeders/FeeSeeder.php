<?php

namespace Database\Seeders;

use App\Models\Fee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeeSeeder extends Seeder
{
    public function run()
    {
        DB::table('fees')->truncate();

        $fees = [
            [
                'label' => 'Basic Fee',
                'slug' => 'basic_fee',
                'type' => 'variable',
                'value' => 0.1,
            ],
            [
                'label' => 'Special Fee',
                'slug' => 'special_fee',
                'type' => 'variable',
                'value' => 0.02,
            ],
            [
                'label' => 'Storage Fee',
                'slug' => 'storage_fee',
                'type' => 'fixed',
                'value' => 100,
            ],
            [
                'label' => 'Basic Fee Min',
                'slug' => 'basic_fee_min',
                'type' => 'fixed',
                'value' => 10,
            ],
            [
                'label' => 'Basic Fee Max',
                'slug' => 'basic_fee_max',
                'type' => 'fixed',
                'value' => 50,
            ],
        ];

        foreach ($fees as $fee) {
            Fee::create($fee);
        }
    }
}
