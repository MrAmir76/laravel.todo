<?php

namespace App\Http\Resources\Todo;

use App\helper\Jalali;
use App\Http\Resources\userResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoListAllResource extends JsonResource
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
            'user' => new userResource(User::query()->findOrFail($this->user_id)),
            'created_at' => Jalali::convert($this->created_at)
        ];
    }
}
