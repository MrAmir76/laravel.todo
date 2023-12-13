<?php


use App\Http\Controllers\Api\V1\TodoController;

$version = 'v1';

Route::prefix($version)->middleware(['verified', 'auth:sanctum'])->group(function () {
    Route::get('todo/detail/{id}', [TodoController::class, 'detail']);

    Route::get('todo/list/self', [TodoController::class, 'todoListSelf']);
    Route::get('todo/list/all', [TodoController::class, 'todoListAll']);

    Route::post('todo/search/self', [TodoController::class, 'todoSearchSelf']);
    Route::post('todo/search/all', [TodoController::class, 'todoSearchAll']);

    Route::post('todo/add', [TodoController::class, 'todoAdd']);
    Route::post('todo/update', [TodoController::class, 'todoUpdate']);
    Route::post('todo/updateAdmin', [TodoController::class, 'todoUpdateAdmin']);

    Route::post('comment/add', [TodoController::class, 'commentAdd']);
    Route::delete('comment/{id}', [TodoController::class, 'commentRemove']);
    Route::get('comments/todo/{id}', [TodoController::class, 'commentsTodo']);
});
