<?php

use App\Http\Controllers\API\Auth\LoginControllerSanctum;
use App\Http\Controllers\API\Auth\RegisterControllerSanctum;
use Illuminate\Support\Facades\Route;


Route::prefix('auth' )->group(function () {

    Route::post('register' , [RegisterControllerSanctum::class , 'register'])->name('register');

    Route::post('login' , [LoginControllerSanctum::class , 'login'])->name('login');
});

