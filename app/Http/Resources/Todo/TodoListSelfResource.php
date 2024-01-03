<?php

namespace App\Http\Resources\Todo;

use App\helper\Jalali;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;


/**
 *  @OA\Schema(
 *     schema="TodoSelfResource",
 *     required={"id", "title", "deadline", "result", "finally_result", "finally_status", "user", "created_at"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Recusandae ipsum autem quia praesentium."),
 *     @OA\Property(property="deadline", type="integer", example=9),
 *     @OA\Property(property="result", type="string", example="Possimus soluta ut et fugit et placeat et aperiam."),
 *     @OA\Property(property="finally_result", type="string", example="Sunt ad et nostrum est corporis."),
 *     @OA\Property(property="finally_status", type="integer", example=0),
 *     @OA\Property(property="created_at", type="string", example="09:57:04 1402/10/11"),
 * )
 */
class TodoListSelfResource extends JsonResource
{


    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'deadline' => $this->deadline,
            'result' => $this->result,
            'finally_result' => $this->finally_result,
            'finally_status' => $this->finally_status,
            'created_at' => Jalali::convert($this->created_at)
        ];
    }
}
