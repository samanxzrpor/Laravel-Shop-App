<?php

use App\Http\Controllers\API\Admin\Blogs\BlogController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:Super Admin|Admin'])->apiResource('blogs' , BlogController::class );
