<?php

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('doctors.index');
});

Route::post('/clinics/merge', [ClinicController::class, 'clinics_merge'])->name('clinics.clinics_merge');

Route::resource('doctors', DoctorController::class);
Route::resource('tests', TestController::class);
Route::resource('clinics', ClinicController::class);
