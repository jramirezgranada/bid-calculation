<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFeesRequest;
use App\Models\AssociationFee;
use App\Models\Fee;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SettingsController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $fees = Fee::all();
        $associationFees = AssociationFee::all();

        return view('settings.index')->with(compact('fees', 'associationFees'));
    }

    public function saveFees(UpdateFeesRequest $request)
    {
        $fees = $request->all();

        foreach ($fees['fee'] as $fee) {
            Fee::where('slug', $fee['slug'])->update(['value' => (double)$fee['value']]);
        }

        return redirect()->route('settings');
    }
}
