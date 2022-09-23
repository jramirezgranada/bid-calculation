<?php

namespace App\Http\Livewire;

use App\Traits\CalculatorTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class VehicleCalculator extends Component
{
    use CalculatorTrait;

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
     * @var array
     */
    protected $rules = [
        'budget' => 'numeric'
    ];

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

        $this->calculationResult = $this->calculateMaxVehicleAmount($this->budget);
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
