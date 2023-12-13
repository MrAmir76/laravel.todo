<?php

namespace App\Http\Requests\Api\V1;


use Auth;

class ChangePasswordRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'current_password' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!password_verify($value, Auth::user()->password)) {
                        $fail('رمزعبور فعلی صحیح نمی‌باشد.');
                    }
                },
            ],
            'password' => ['required', 'min:8', 'max:255', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'password.confirmed' => 'تکرار رمزعبور صحیح نمی باشد'
        ];
    }
}
