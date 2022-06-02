<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\ResidentController;
use App\Models\Official;
use App\Models\Resident;

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
    $officials = Official::all();
    
    $residents = Resident::all();

    return view('parking', compact('officials', 'residents'));
});

Route::resource('vehicle', VehicleController::class);
Route::resource('official', OfficialController::class);
Route::resource('resident', ResidentController::class);

Route::post('/identify_plate', [App\Http\Controllers\VehicleController::class, 'identify_plate'])->name('identify_plate');
Route::post('/checkout', [App\Http\Controllers\VehicleController::class, 'checkout'])->name('checkout');
Route::get('/residents/print', [App\Http\Controllers\ResidentController::class, 'print'])->name('residents.print');
Route::post('/reset_month', [App\Http\Controllers\VehicleController::class, 'reset_month'])->name('reset_month');
