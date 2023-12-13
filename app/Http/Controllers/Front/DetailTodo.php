<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\updateTodoAdminRequest;
use App\Http\Requests\Front\updateTodoRequest;
use App\Models\Todo;

class DetailTodo extends Controller
{
    public function updateTodoAdmin(updateTodoAdminRequest $request, int $id)
    {
        $todo = Todo::query()->findOrFail($id);
        $todo->update([
            'title' => $request->get('todo-title'),
            'content' => $request->get('todo-body'),
            'deadline' => $request->get('todo-deadline'),
            'result' => $request->get('resultSelf'),
            'finally_result' => $request->get('finally-result'),
            'finally_status' => $request->get('status-finally'),
        ]);
        return redirect()->back()->with('alert', 'بروزرسانی انجام شد');
    }

    public function updateTodo(updateTodoRequest $request, int $id)
    {
        $todo = Todo::query()->findOrFail($id);
        $todo->update(['result' => $request->get('resultSelf')]);
        return redirect()->back()->with('alert', 'بروزرسانی انجام شد');
    }

    public function index(int $id)
    {
        return view('pages.detail-todo', compact('id'));
    }
}
