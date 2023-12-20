<?php

namespace App\Http\Requests\Api\V1;

class VerifyEmailRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'otp_code' => 'required|numeric'
        ];
    }
}
