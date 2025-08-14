<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])->group(function () {



Route::post('/Owner/Register',[AuthController::class,'Register'])->name('OwnerRegister');

Route::post('/Owner/Login',[AuthController::class,'Login'])->name('OwnerLogin');

});

Route::post('/addRole/{name}',[RoleController::class,'createRole'])->name('addRole');
Route::get('/allRoles',[RoleController::class,'getAllRoles'])->name('getAllRoles');