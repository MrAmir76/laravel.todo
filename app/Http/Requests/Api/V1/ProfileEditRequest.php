<?php

namespace App\Http\Requests\Api\V1;

class ProfileEditRequest extends BaseRequest
{

    public function rules()
    {
        return
            [
                'email' => 'required|email|max:255',
                'name' => 'required|string|min:3|max:255'
            ];
    }
}
