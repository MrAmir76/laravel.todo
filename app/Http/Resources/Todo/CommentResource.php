<?php

namespace App\Http\Resources\Todo;

use App\helper\Jalali;
use App\Http\Resources\userResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**  @OA\Schema(
 *     schema="CommentTodoResource",required={"comment_id","user", "content","created_at"},
 *       @OA\Property(property="comment_id", type="integer", example=1),
 *       @OA\Property(property="user", type="object", ref="#/components/schemas/UserResource"),
 *       @OA\Property(property="content", type="string", example= "This is test content"),
 *       @OA\Property(property="created_at", type="string", example="1400-01-01 12:34:56"),
 *   )
 **/
class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'comment_id' => $this->id,
            'user' => new userResource(User::query()->findOrFail($this->user_id)),
            'content' => $this->content,
            'created_at' => Jalali::convert($this->created_at),
        ];
    }
}
