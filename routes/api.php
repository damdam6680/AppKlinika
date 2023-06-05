<?php

use App\Http\Controllers\PatientsController;
use App\Http\Controllers\AppointmentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Patients;
use App\Models\Appointments;
use App\Http\Controllers\DentistsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware' => ['user'],], function () {
//     // Trasy dla zalogowanych użytkowników
// });

// // Trasy wymagające roli administratora
// Route::group(['namespace' => 'App\Http\Controllers'], function () {
//     Route::apiResource('patients', PatientsController::class);
//     Route::apiResource('dentists', DentistsController::class);
//     Route::apiResource('user',UserController::class);
// });

// Route::any('admin/access/denied', function () {
//     return response()->json(['error' => 'Access denied for admin'], 403);
// })->name('admin.access.denied');


Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('patients', PatientsController::class);
    Route::apiResource('dentists', DentistsController::class);
    Route::apiResource('appointments', AppointmentsController::class);
    Route::apiResource('user',UserController::class);
    Route::delete('patients/{id}', [PatientsController::class, 'destroy']);
    Route::delete('patients/{user_id}', [PatientsController::class, 'destroy']);

});

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
