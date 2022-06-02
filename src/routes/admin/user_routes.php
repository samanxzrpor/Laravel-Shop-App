<?php

use App\Http\Controllers\API\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['role:Super Admin|Admin'])->apiResource('users' , UserController::class );

Route::prefix('users')->middleware(['role:Super Admin|Admin'])->group(function (){

    Route::post('block/{user}' , [UserController::class , 'blockUser'])->name('users.block');

    Route::post('chane_role/{user}' , [UserController::class , 'changeUserRole'])->name('users.changeRole');
});
