<?php

use App\Http\Controllers\PatientsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Patients;
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

Route::group(['middleware' => ['user']], function () {
    // Trasy dla zalogowanych użytkowników
});

// Trasy wymagające roli administratora
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::apiResource('patients', PatientsController::class);
    Route::apiResource('dentists', DentistsController::class);
});

Route::any('admin/access/denied', function () {
    return response()->json(['error' => 'Access denied for admin'], 403);
})->name('admin.access.denied');