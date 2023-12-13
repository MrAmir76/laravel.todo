<?php

use App\Http\Controllers\Front\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Front\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Front\Auth\NewPasswordController;
use App\Http\Controllers\Front\Auth\PasswordController;
use App\Http\Controllers\Front\Auth\PasswordResetLinkController;
use App\Http\Controllers\Front\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;


Route::prefix('account')->middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgotPassword', [PasswordResetLinkController::class, 'create'])->name('password.request');

    Route::post('forgotPassword', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('resetPassword/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('resetPassword', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::prefix('account')->middleware('auth')->group(function () {

    Route::get('confirmPassword', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirmPassword', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PasswordController::class, 'update'])->name('password.update')
        ->middleware('verified');
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

