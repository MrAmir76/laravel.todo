<?php

namespace App\Http\Requests\Api\V1\Todo;

use App\Http\Requests\Api\V1\BaseRequest;

class TodoAddRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'todo-title' => 'required|string|min:2',
            'todo-body' => 'required|string|min:5',
            'todo-deadline' => 'required|numeric|min:1|max:365',
            'resultSelf' => 'nullable|string|min:2',
            'user_id' => 'nullable|numeric|exists:users,id'
        ];
    }
}
