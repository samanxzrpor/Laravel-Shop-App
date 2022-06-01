<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


# Authentication Routes
include __DIR__ . '/auth/auth.php';


Route::prefix('admin')
    ->middleware(['auth:sanctum'])
    ->group(function (){

        # Admin User Dashboard Processing
        include __DIR__ . '/admin/user_routes.php';

        # Admin Product Dashboard Processing
        include __DIR__ . '/admin/product_routes.php';

        # Admin Blogs Dashboard Processing
        include __DIR__ . '/admin/blogs_routes.php';

        # Admin Category Dashboard Processing
        include __DIR__ . '/admin/category_routes.php';

        # Admin Comments Dashboard Processing
        include __DIR__ . '/admin/comment_routes.php';
    });
