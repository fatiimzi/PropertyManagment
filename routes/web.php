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
use App\Http\Controllers\AuthController;

use App\Models\Tenant;



// Redirect the root URL to the login page
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Public routes for registration and login
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


// Protected routes for authenticated users
 //Route::group(['middleware' => ['jwt.auth']], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', function () {
        return redirect()->route('properties.proprerties_list');
    })->name('dashboard');

    // CRUD routes for properties, tenants, and payments
    Route::resource('properties', PropertyController::class);
    Route::resource('tenants', TenantController::class);

   Route::get('/tenants/{tenant}/property-rent', function (Tenant $tenant) {
    if (!$tenant->property) {
        return response()->json(['error' => 'No property associated with this tenant'], 404);
    }

    return response()->json(['rental_cost' => $tenant->property->rental_cost]);
});
            // });


    Route::resource('payments', PaymentController::class);
