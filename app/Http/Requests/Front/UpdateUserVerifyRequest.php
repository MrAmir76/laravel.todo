<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserVerifyRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|string',
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'isAdmin' => 'nullable|in:null,1',
        ];
    }
}
