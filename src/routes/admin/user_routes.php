<?php

use App\Http\Controllers\API\Admin\Users\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['role:Super Admin|Admin'])->apiResource('users' , UserController::class );

