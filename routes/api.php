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
    Route::get('dentists/me/', [DentistController::class, 'showMe']);

    Route::get('patients', [PatientController::class, 'index']);
    Route::get('patients/me', [PatientController::class, 'showMe']);
    Route::get('patients/{id}', [PatientController::class, 'show']);
    Route::put('patients/me', [PatientController::class, 'updateMe']);
    Route::patch('patients/me', [PatientController::class, 'updateMe']);
    Route::put('patients/{id}', [PatientController::class, 'update']);
    Route::patch('patients/{id}', [PatientController::class, 'update']);
    Route::delete('patients/{id}', [PatientController::class, 'destroy']);



    Route::put('dentists/me', [DentistController::class, 'updateMe']);
    Route::patch('dentists/me', [DentistController::class, 'updateMe']);

    Route::put('dentists/{id}', [DentistController::class, 'update']);
    Route::patch('dentists/{id}', [DentistController::class, 'update']);
    Route::get('dentists/{id}', [DentistController::class, 'show']);
    Route::put('dentists/update', [DentistController::class, 'updateDentist']);
    Route::get('dentists', [DentistController::class, 'index']);


    Route::get('/appointments/calendar', [AppointmentController::class, 'calendar']);
    Route::get('/appointments/doctor', [AppointmentController::class, 'appointmentForDoctor']);
    Route::get('/appointments/patient', [AppointmentController::class, 'AppotemtsForPacient']);
    Route::get('/appointments/patient/list', [AppointmentController::class, 'AppotemtsForPacientList']);
    Route::patch('/appointments/{id}', [AppointmentController::class, 'update']);
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::post('/appointments', [AppointmentController::class, 'store']);
    Route::delete('appointments/{id}', [AppointmentController::class, 'destroy']);
    Route::get('appointments/chart', [AppointmentController::class, 'chart']);

    Route::post('/dentists/create', [UserController::class, 'createDentist']);
    Route::delete('dentists/{id}', [DentistController::class, 'destroy']);

    Route::get('users/me', [UserController::class, 'getUserInfo']);
    Route::get('users', [UserController::class, 'index']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);

    Route::put('users/{id}', [UserController::class, 'update']);
    Route::patch('users/{id}', [UserController::class, 'update']);
    Route::get('users/{id}', [UserController::class, 'show']);


    Route::post('treatments', [TreatmentController::class, 'store']);
    Route::get('treatments/{id}', [TreatmentController::class, 'show']);
    Route::delete('treatments/{id}', [TreatmentController::class, 'destroy']);
    Route::patch('/treatments/{id}', [TreatmentController::class, 'update']);
    Route::put('/treatments/{id}', [TreatmentController::class, 'update']);



});

Route::get('treatments', [TreatmentController::class, 'index']);



Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
