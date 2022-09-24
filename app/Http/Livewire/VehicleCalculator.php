<?php

namespace App\Http\Livewire;

use App\Services\CalculatorService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class VehicleCalculator extends Component
{
    /**
     * @var bool
     */
    public $showResults = false;

    /**
     * @var float
     */
    public $budget;

    /**
     * @var array
     */
    public $calculationResult;

    /**
     * @var CalculatorService
     */
    private CalculatorService $calculatorService;

    /**
     * @var array
     */
    protected $rules = [
        'budget' => 'required|numeric'
    ];

    /**
     * @param $id
     */
    public function __construct($id = null)
    {
        $this->calculatorService = new CalculatorService();
        parent::__construct($id);
    }

    /**
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('livewire.vehicle-calculator');
    }

    /**
     * @return void
     */
    public function submit(): void
    {
        $this->showResults = false;
        $this->validate();

        $this->calculationResult = $this->calculatorService->calculateMaxVehicleAmount($this->budget);
        $this->showResults = true;
    }

    /**
     * @return void
     */
    public function resetForm(): void
    {
        $this->showResults = false;
        $this->calculationResult = null;
        $this->budget = null;
    }
}
