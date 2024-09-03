<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PaymentController;
use App\Models\Tenant;

// Public routes for registration and login
Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Public routes for registration and login
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');

// Protected routes for authenticated users
// Route::middleware(['auth:api'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
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
    Route::resource('payments', PaymentController::class);
// });
