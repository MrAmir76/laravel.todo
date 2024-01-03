<?php

namespace App\Http\Resources\Todo;

use App\helper\Jalali;
use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Resources\userResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="DetailTodoResource",
 *     required={"todo_id", "title", "content", "deadline", "user", "result", "finally_result", "finally_status", "created_at"},
 *     @OA\Property(property="todo_id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Todo title"),
 *     @OA\Property(property="content", type="string", example="Todo content"),
 *     @OA\Property(property="deadline", type="string", example="2022-01-01"),
 *     @OA\Property(property="user", ref="#/components/schemas/UserResource"),
 *     @OA\Property(property="result", type="string", example="Todo result"),
 *     @OA\Property(property="finally_result", type="string", example="Finally result"),
 *     @OA\Property(property="finally_status", type="string", enum={"شکست خورده", "موفقیت آمیر", "نامشخص"}, example="نامشخص"),
 *     @OA\Property(property="created_at", type="string", example="1400-01-01 12:34:56")
 * )
 */
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
