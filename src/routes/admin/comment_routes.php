<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\Admin\Comments\CommentController;

Route::prefix('comments')->middleware(['role:Super Admin|Admin'])->group(function () {

    Route::get('/' , [CommentController::class , 'index'])->name('comments.list');
    Route::get('/{comment}' , [CommentController::class , 'show'])->name('comments.show');
    Route::delete('delete/{comment}' , [CommentController::class , 'destroy'])->name('comments.destroy');

    Route::post('block/{comment}' , [CommentController::class , 'block'])->name('comments.block');
});

