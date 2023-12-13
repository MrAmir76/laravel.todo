<?php

namespace App\Http\Requests\Api\V1\Todo;

use App\Http\Requests\Api\V1\BaseRequest;

class TodoAdminUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'todo_id' => 'required|numeric|exists:todo,id',
            'todo-title' => 'required|string|min:2',
            'todo-body' => 'required|string|min:5',
            'todo-deadline' => 'required|numeric|min:1|max:365',
            'resultSelf' => 'nullable|string|min:2',
            'finally-result' => "required|string|min:5",
            'status-finally' => "nullable|numeric|in:0,1,null",
        ];
    }
}
