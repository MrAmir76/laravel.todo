<?php

namespace App\Http\Resources;

use App\Http\Controllers\Api\V1\BaseApiController;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class SuccessRegisterResource extends JsonResource
{
    public function toArray(Request $request): array|JsonSerializable|Arrayable
    {
        $resource_data = [
            'name' => $this->name,
            'email' => $this->email,
            'is_verify' => boolval(intval($this->email_verified_at)),
            'created_at' => $this->created_at
        ];
        return BaseApiController::successResource('حساب کاربری ایجاد شد', $resource_data);
    }
}
