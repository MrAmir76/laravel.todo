<?php

namespace App\Http\Requests\Api\V1;

class EmailRequiredRequest extends BaseRequest
{

    public function rules()
    {
        return ['email' => 'required|email'];
    }
}
