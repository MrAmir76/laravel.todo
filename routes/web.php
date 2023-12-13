<?php

use App\Http\Controllers\Front\HomeController;
use App\View\Components\CreateTodo;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '^[0-9]{1,}$');
Route::get('/', [HomeController::class, 'index'])->name('index');

require __DIR__ . '/Web/todo.php';
require __DIR__ . '/Web/auth.php';
require __DIR__ . '/Web/email_verification.php';
require __DIR__ . '/Web/profile.php';
