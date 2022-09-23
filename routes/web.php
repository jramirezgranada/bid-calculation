<?php

use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('settings/fees', [SettingsController::class, 'saveFees'])->name('save-fees');
    Route::post('settings/association-fees', [SettingsController::class, 'saveAssociationsFee'])->name('save-associations-fee');
});


require __DIR__ . '/auth.php';
