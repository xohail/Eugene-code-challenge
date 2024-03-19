<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Duplicates\ClinicsMergeController;
use App\Http\Controllers\Duplicates\DoctorsMergeController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

//
// Merge routes
//
Route::resource('duplicates/clinics', ClinicsMergeController::class);
Route::resource('duplicates/doctors', DoctorsMergeController::class);
Route::post('duplicates/clinics/merge', [ClinicsMergeController::class, 'clinicsMerge'])->name('duplicates.clinics_merge');
Route::post('duplicates/doctors/merge', [DoctorsMergeController::class, 'doctorsMerge'])->name('duplicates.doctors_merge');

//
// Main doctor & test routes
//
Route::resource('doctors', DoctorController::class);
Route::resource('tests', TestController::class);

// Landing page
Route::get('/', 'App\Http\Controllers\DoctorController@index');
