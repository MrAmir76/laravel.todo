<?php

namespace App\Http\Requests\Api\V1\Todo;

use App\Http\Requests\Api\V1\BaseRequest;

class TodoSearchAllRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'scopeSearch' => 'required|string|in:
                                        "user_email",
                                         "user_name",
                                         "todo_title",
                                         "todo_content",
                                         "todo_finally_result",
                                         "todo_finally_status",',
            'inputSearch' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'scopeSearch.in' => 'حوزه جستوجوی ارسالی صحیح نمی باشد',
        ];
    }
}
