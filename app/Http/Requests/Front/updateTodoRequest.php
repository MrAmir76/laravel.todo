<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class updateTodoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'resultSelf' => 'nullable|string|min:5',
        ];
    }
}
