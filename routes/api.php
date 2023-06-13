<?php

use App\Http\Controllers\PatientsController;
use App\Http\Controllers\AppointmentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Patients;
use App\Models\Appointments;
use App\Http\Controllers\DentistsController;
use App\Http\Controllers\TreatmentsController;
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



Route::middleware('auth:sanctum')->group(function(){

    Route::apiResource('patients', PatientsController::class);


    Route::patch('dentists/updateDentist', [DentistsController::class, 'updateDentist']);
    Route::get('dentists', [DentistsController::class, 'index']);

    //Route::apiResource('appointments', AppointmentsController::class);
    Route::get('/appointments/calendar', [AppointmentsController::class, 'calendar']);
    Route::get('/appointments/AppotemtsForDoctor', [AppointmentsController::class, 'AppotemtsForDoctor']);


    Route::patch('/appointments/{id}', [AppointmentsController::class, 'update']);
    Route::get('/appointments', [AppointmentsController::class, 'index']);

    Route::post('/appointments/createDentist', [UserController::class, 'createDentist']);


    Route::get('patients/me', [PatientsController::class, 'show']);
    Route::apiResource('user',UserController::class);
    Route::apiResource('treatments',TreatmentsController::class);
    Route::delete('patients/{id}', [PatientsController::class, 'destroy']);
    Route::delete('patients/{user_id}', [PatientsController::class, 'destroy']);

});

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

