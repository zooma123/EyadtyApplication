<?php

use Illuminate\Support\Facades\Route;
use Modules\Doctor\Http\Controllers\AuthDController;
use Modules\Doctor\Http\Controllers\DoctorController;
use Modules\Doctor\Services\AuthDoctorService;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('doctors', DoctorController::class)->names('doctor');
});

Route::post('/Doctor/Register',[AuthDController::class,'register'])->name('DoctorRegister');

Route::post('/Doctor/Login',[AuthDController::class,'login'])->name('DoctorLogin');
