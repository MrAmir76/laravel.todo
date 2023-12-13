<?php

namespace App\Http\Requests\Api\V1;

class loginRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }
}
