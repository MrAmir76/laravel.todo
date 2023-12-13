<?php

use Illuminate\Support\Facades\Route;

Route::pattern('id', '^[0-9]{1,}$');


require __DIR__ . '/Api/V1/auth.php';
require __DIR__ . '/Api/V1/todo.php';
