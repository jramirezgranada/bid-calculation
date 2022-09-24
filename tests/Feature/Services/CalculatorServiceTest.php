<?php

namespace Tests\Feature\Services;

use App\Services\CalculatorService;
use Tests\TestCase;

class CalculatorServiceTest extends TestCase
{
    /** @test */
    public function it_returns_array_result()
    {
        $calculatorService = new CalculatorService();
        $budget = 1000;
        $results = $calculatorService->calculateMaxVehicleAmount($budget);

        self::assertIsArray($results);
        self::arrayHasKey('basic_fee');
    }
}
