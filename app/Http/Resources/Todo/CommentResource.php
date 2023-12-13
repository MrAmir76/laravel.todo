<?php

namespace App\Http\Resources\Todo;

use App\helper\Jalali;
use App\Http\Resources\userResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
