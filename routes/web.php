<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ContractController;




Route::group(['middleware' => ['jwt.auth']], function () {
    Route::resource('properties', PropertyController::class);
    Route::resource('tenants', TenantController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('contracts', ContractController::class);

});