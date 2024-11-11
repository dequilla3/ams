<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientInfoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// LOGIN
Route::get('/', function () {
    return view('auth.login');
});

//DASHBOARD
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//PATIENT
Route::get('/patient-info',
    [PatientInfoController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('patient-info');

//APPOINTMENTS
Route::get('/appointments',
    [AppointmentController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('appointments');
Route::get('/appointments/filtered',
    [AppointmentController::class, 'filteredAppointments'])
    ->middleware(['auth', 'verified'])->name('appointments.filtered');
Route::get('/new-appointment', function () {
    return view('pages.appointment.new-appointment');
})->middleware(['auth', 'verified'])->name('new-appointment');
Route::post('/store-appointment', [AppointmentController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('store-appointment');

// AUTH
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
