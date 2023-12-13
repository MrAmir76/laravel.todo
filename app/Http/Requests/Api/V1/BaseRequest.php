<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        $response = [
            'status' => 'fail',
            'message' => 'اطلاعات وارد شده نامعتبر است',
            'errors' => $validator->errors()
        ];
        throw new HttpResponseException(response()->json($response, 400));
    }
}
