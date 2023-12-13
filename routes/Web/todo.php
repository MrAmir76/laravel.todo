<?php

use App\Http\Controllers\Front\DetailTodo;
use App\Http\Controllers\Front\Search;
use App\Livewire\AddTodo;
use App\View\Components\CommentForm;

Route::pattern('searchInput', '\w+');

Route::middleware(['auth:web', 'verified'])->group(function () {
    Route::post('addTodo', [AddTodo::class, 'save'])->name('addTodo');
    Route::put('updateTodoAdmin/{id}', [DetailTodo::class, 'updateTodoAdmin'])->name('updateTodoAdmin');
    Route::put('updateTodo/{id}', [DetailTodo::class, 'updateTodo'])->name('updateTodo');
    Route::get('detailTodo/{id}', [DetailTodo::class, 'index'])->name('detailTodo');
    Route::post('commentSave/{id}', [CommentForm::class, 'saveComment'])->name('saveComment');
    Route::get('search/{id}/{searchInput}', [Search::class, 'index'])->name('search');
});
