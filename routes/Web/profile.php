<?php

use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\UserController;

Route::prefix('account')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/users', [UserController::class, 'index'])->name('profile.user');
    Route::get('/users/detail/{id}', [UserController::class, 'detail'])->name('profile.detail');
    Route::put('/users/updateUserUnVerify', [UserController::class, 'updateUserUnVerify'])->name('profile.updateUserUnVerify');
    Route::put('/users/updateUserVerify', [UserController::class, 'updateUserVerify'])->name('profile.updateUserVerify');

});
