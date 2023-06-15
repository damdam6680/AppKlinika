<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Patient;
use App\Models\Appointment;
use App\Http\Controllers\DentistController;
use App\Http\Controllers\TreatmentController;
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

    Route::get('patients', [PatientController::class, 'index']);
    Route::get('patients/me', [PatientController::class, 'showMe']);
    Route::get('patients/{id}', [PatientController::class, 'show']);

    Route::put('patients/me', [PatientController::class, 'updateMe']);
    Route::patch('patients/me', [PatientController::class, 'updateMe']);

    Route::put('patients/{id}', [PatientController::class, 'update']);
    Route::patch('patients/{id}', [PatientController::class, 'update']);

    Route::put('dentists/{id}', [DentistController::class, 'update']);
    Route::get('dentists/{id}', [DentistController::class, 'show']);
    Route::put('dentists/update', [DentistController::class, 'updateDentist']);
    Route::get('dentists', [DentistController::class, 'index']);


    Route::get('/appointments/calendar', [AppointmentController::class, 'calendar']);
    Route::get('/appointments/doctor', [AppointmentController::class, 'AppotemtsForDoctor']);
    Route::get('/appointments/patient', [AppointmentController::class, 'AppotemtsForPacient']);
    Route::get('/appointments/patient/list', [AppointmentController::class, 'AppotemtsForPacientList']);
    Route::patch('/appointments/{id}', [AppointmentController::class, 'update']);
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::post('/appointments', [AppointmentController::class, 'store']);

    Route::post('/dentists/create', [UserController::class, 'createDentist']);



    Route::apiResource('users',UserController::class);
    Route::apiResource('treatments',TreatmentController::class);
    Route::post('treatments', [TreatmentController::class, 'store']);

});

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

