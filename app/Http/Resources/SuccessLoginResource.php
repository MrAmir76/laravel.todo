<?php

namespace App\Http\Resources;

use App\Http\Controllers\Api\V1\BaseApiController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SuccessLoginResource extends JsonResource
{

    public function toArray(Request $request)
    {
        $token = explode('|', $this->createToken($this->email)->plainTextToken)[1];
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'token' => $token
        ];
        $message = 'ورود به حساب کاربری با موفقیت انجام شد';

        return BaseApiController::successResource($message, $data);
    }
}
