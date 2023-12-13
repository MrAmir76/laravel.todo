<?php

namespace App\Http\Requests\Api\V1\Todo;

use App\Http\Requests\Api\V1\BaseRequest;

class TodoUpdateRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'todo_id' => 'required|numeric|exists:todo,id',
            'resultSelf' => 'required|string|min:2',
        ];
    }
}
