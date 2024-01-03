<?php

namespace App\Http\Resources;

use App\Http\Controllers\Api\V1\BaseApiController;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class SuccessLoginResource extends JsonResource
{

    public function toArray(Request $request): array|\JsonSerializable|Arrayable
    {
        // delete old token
        DB::table('personal_access_tokens')->where('name',$this->email)->delete();

        $newToken = $this->createToken($this->email);
        $token = explode('|', $newToken->plainTextToken)[1];
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'token' => $token
        ];
        $message = 'ورود به حساب کاربری با موفقیت انجام شد';

        return BaseApiController::successResource($message, $data);
    }
}
