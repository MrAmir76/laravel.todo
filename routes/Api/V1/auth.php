<?php

use App\Http\Controllers\Api\v1\AuthController;

$prefix = '/account';
$version = 'v1';

Route::prefix($version . $prefix)->middleware('guest:sanctum')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/restPassword', [AuthController::class, 'restPassword']);
    Route::post('/setNewPassword', [AuthController::class, 'setNewPassword']);

});

Route::prefix($version . $prefix)->middleware(['unverified', 'auth:sanctum'])->group(function () {
    Route::post('/sendVerifyEmail', [AuthController::class, 'sendVerifyEmail']);
    Route::post('/verifyEmail', [AuthController::class, 'VerifyEmail']);
});


Route::prefix($version . $prefix)->middleware(['verified', 'auth:sanctum'])->group(function () {
    Route::post('/editProfile', [AuthController::class, 'editProfile']);
    Route::post('/changePassword', [AuthController::class, 'changePassword']);
});
