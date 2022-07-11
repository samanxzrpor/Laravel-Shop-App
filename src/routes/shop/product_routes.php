<?php


use App\Http\Controllers\API\Shop\ProductsController;
use \Illuminate\Support\Facades\Route;


Route::apiResource('products' , ProductsController::class , [
    'names' => [
        'index' => 'shop.products.index',
        'store' => 'shop.products.store',
        'show' => 'shop.products.show',
        'update' => 'shop.products.update',
        'destroy' => 'shop.products.destroy',
    ]
    ])->scoped([
        'product' => 'slug',
    ]);

