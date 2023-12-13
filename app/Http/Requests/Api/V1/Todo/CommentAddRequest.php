<?php

namespace App\Http\Requests\Api\V1\Todo;

use App\Http\Requests\Api\V1\BaseRequest;

class CommentAddRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'todo_id' => 'required|numeric|exists:todo,id',
            'content_comment' => 'required|string|min:5',
        ];
    }
}
