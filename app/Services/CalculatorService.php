<?php

namespace App\Services;

use App\Models\AssociationFee;
use App\Models\Fee;

class CalculatorService
{
    /**
     * @param int $precision
     */
    public function __construct(private int $precision = 2)
    {
    }

    /**
     * @param float $budget
     * @return array
     */
    public function calculateMaxVehicleAmount(float $budget): array
    {
        $storageFee = Fee::getFeeAmountBySlug('storage_fee');
        $basicFeePercent = Fee::getFeeAmountBySlug('basic_fee');
        $basicFeeMaxVal = Fee::getFeeAmountBySlug('basic_fee_max');
        $basicFeeMinVal = Fee::getFeeAmountBySlug('basic_fee_min');
        $specialFee = Fee::getFeeAmountBySlug('special_fee');

        $maxAmount = $budget - $storageFee;

        // 102 is the 102% because we know that max amount is 100% + 2% of special fee
        $maxTaxedAmount = ($maxAmount - $basicFeeMaxVal) / 102 * 100;
        $minTaxedAmount = ($maxAmount - $basicFeeMinVal) / 102 * 100;

        $maxTaxedAssociated = $this->getMaxTaxedAmount($maxTaxedAmount);
        $minTaxedAssociated = $this->getMaxTaxedAmount($minTaxedAmount);

        if (empty($maxTaxedAssociated) && empty($minTaxedAssociated)) {
            return [
                'special_fee' => 0,
                'basic_fee' => 0,
                'association_fee' => 0,
                'storage_fee' => 0,
                'vehicle_cost' => 0,
                'budget' => $budget,
            ];
        } else if (!is_null($maxTaxedAssociated) && !is_null($minTaxedAssociated) &&
            $maxTaxedAssociated->getAttributes() === $minTaxedAssociated->getAttributes()
        ) {
            $associationFee = $maxTaxedAssociated->amount_value;
        } else if (empty($maxTaxedAssociatedArray)) {
            $associationFee = $minTaxedAssociated->amount_value;
        } else {
            $associationFee = $maxTaxedAssociated->amount_value;
        }

        if ($maxTaxedAmount * $basicFeePercent > $basicFeeMaxVal && $minTaxedAmount * $basicFeePercent > $basicFeeMaxVal) {
            $basicFee = $basicFeeMaxVal;
        } else if ($maxTaxedAmount * $basicFeePercent < $basicFeeMinVal && $minTaxedAmount * $basicFeePercent < $basicFeeMinVal) {
            $basicFee = $basicFeeMinVal;
        } else {
            $basicFee = round(($maxAmount - $associationFee) / 112 * 10, $this->precision, PHP_ROUND_HALF_UP);
        }

        if ($basicFee != 0) {
            $maxAmount = round(($maxAmount - $associationFee - $basicFee) / 102 * 100, $this->precision, PHP_ROUND_HALF_UP);
            $specialFee = round($maxAmount * $specialFee, $this->precision, PHP_ROUND_HALF_UP);

        }

        return [
            'special_fee' => $specialFee,
            'basic_fee' => $basicFee,
            'association_fee' => $associationFee,
            'storage_fee' => $storageFee,
            'vehicle_cost' => $maxAmount,
            'budget' => $budget,
        ];
    }

    /**
     * @param float $taxedAmount
     * @return AssociationFee|null
     */
    private function getMaxTaxedAmount(float $taxedAmount): ?AssociationFee
    {
        return AssociationFee::where('amount_from', '<=', $taxedAmount)
            ->where('amount_to', '>=', $taxedAmount)
            ->first();
    }
}
