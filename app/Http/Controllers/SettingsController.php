<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFeesRequest;
use App\Models\AssociationFee;
use App\Models\Fee;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $fees = Fee::all();
        $associationFees = AssociationFee::all();

        return view('settings.index')->with(compact('fees', 'associationFees'));
    }

    /**
     * @param UpdateFeesRequest $request
     * @return RedirectResponse
     */
    public function saveFees(UpdateFeesRequest $request): RedirectResponse
    {
        $fees = $request->all();

        foreach ($fees['fee'] as $fee) {
            Fee::where('slug', $fee['slug'])->update(['value' => (double)$fee['value']]);
        }

        Session::flash('success', 'Settings were updated, successfully !!');
        return redirect()->route('settings');
    }
}
