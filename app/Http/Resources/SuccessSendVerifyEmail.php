<?php

namespace App\Http\Resources;

use App\Http\Controllers\Api\V1\BaseApiController;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class SuccessSendVerifyEmail extends JsonResource
{
    public function toArray(Request $request): array|JsonSerializable|Arrayable
    {
        $message = 'ایمیل تایید حساب کاربری ارسال شد.';
        $data =
            [
                'email' => $this->email,
                'name' => $this->name
            ];
        return BaseApiController::successResource($message, $data);
    }
}
