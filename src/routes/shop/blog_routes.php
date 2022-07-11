<?php


use App\Http\Controllers\API\Shop\BlogsController;
use \Illuminate\Support\Facades\Route;


Route::apiResource('blogs' , BlogsController::class , [
    'names' => [
        'index' => 'shop.blogs.index',
        'store' => 'shop.blogs.store',
        'show' => 'shop.blogs.show',
        'update' => 'shop.blogs.update',
        'destroy' => 'shop.blogs.destroy',
    ]
    ])->scoped([
        'blog' => 'slug',
    ]);

