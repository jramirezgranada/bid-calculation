<?php

namespace Database\Seeders;

use App\Models\AssociationFee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssociationFeeSeeder extends Seeder
{
    public function run()
    {
        $associationFees = [
            [
                'amount_from' => 1,
                'amount_to' => 500,
                'amount_value' => 5,
            ],
            [
                'amount_from' => 501,
                'amount_to' => 1000,
                'amount_value' => 10,
            ],
            [
                'amount_from' => 1001,
                'amount_to' => 3000,
                'amount_value' => 15,
            ],
            [
                'amount_from' => 3001,
                'amount_to' => 100000000000000,
                'amount_value' => 20,
            ],
        ];

        DB::table('association_fees')->truncate();

        foreach ($associationFees as $associationFee) {
            AssociationFee::create($associationFee);
        }
    }
}
