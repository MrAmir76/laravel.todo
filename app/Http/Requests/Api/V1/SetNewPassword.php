<?php

namespace App\Http\Requests\Api\V1;


class SetNewPassword extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'otp_code' => 'required|numeric',
            'password' => ['required', 'min:10', 'max:255', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'password.confirmed' => 'تکرار رمزعبور صحیح نمی باشد'
        ];
    }


}
