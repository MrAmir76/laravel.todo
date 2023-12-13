<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class updateTodoAdminRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'todo-title' => 'required|string|min:3',
            'todo-body' => 'required|string|min:5',
            'todo-deadline' => 'required|numeric|min:1|max:365',
            'resultSelf' => 'nullable|string|min:5',
            'finally-result' => 'nullable|string|min:5',
            'status-finally' => 'nullable|in:null,0,1|numeric'
        ];
    }
}
