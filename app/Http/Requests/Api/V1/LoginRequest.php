<?php

namespace App\Http\Requests\Api\V1;

class LoginRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }
}
