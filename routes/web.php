<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\TestController;

Route::get('/', function () {
    return redirect()->route('doctors.index');
});

Route::resource('doctors', DoctorController::class);
Route::resource('tests', TestController::class);
