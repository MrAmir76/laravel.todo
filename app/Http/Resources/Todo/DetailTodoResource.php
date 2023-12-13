<?php

namespace App\Http\Resources\Todo;

use App\helper\Jalali;
use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Resources\userResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailTodoResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $message = "اطلاعات ارسال شد";
        $data = [
            'todo_id' => $this->id,
            "title" => $this->title,
            "content" => $this->content,
            "deadline" => $this->deadline,
            "user" => new userResource(User::query()->findOrFail($this->user_id)),
            "result" => $this->result,
            "finally_result" => $this->finally_result,
            "finally_status" => ($this->finally_status === 0) ? "شکست خورده" : (($this->finally_status === 1) ? "موفقیت آمیر" : "نامشخص"),
            "created_at" => Jalali::convert($this->created_at)
        ];
        return BaseApiController::successResource($message, $data);
    }
}
