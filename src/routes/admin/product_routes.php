<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\Admin\Products\ProductController;

Route::middleware(['role:Super Admin|Admin'])->apiResource('products' , ProductController::class );

