<?php

namespace App\Http\Resources\Todo;

use App\helper\Jalali;
use App\Http\Resources\userResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateTodoResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'deadline' => $this->deadline,
            'result' => $this->result,
            'user' => new userResource($this->user_id),
            'created_at' => Jalali::convert($this->created_at),
        ];
    }
}
