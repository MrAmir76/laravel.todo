<?php

namespace App\Http\Requests\Api\V1;

use App\Models\User;

class RegisterRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'min:6']
        ];
    }
}
