<?php

use App\Http\Controllers\API\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:Super Admin|Admin'])
    ->apiResource('products' , ProductController::class )
    ->scoped([
        'product' => 'slug',
    ]);

