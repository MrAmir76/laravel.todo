<?php

namespace App\View\Components;

use App\Http\Requests\Front\CreateCommentTodoRequest;
use App\Models\Todo;
use App\Models\TodoComments;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\Component;

class CommentForm extends Component
{
    public $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function saveComment(CreateCommentTodoRequest $request, $id)
    {
        $this->id = $id;
        $todo = Todo::query()->findOrFail($id);
        if (Gate::allows('createComment', $todo)) {
            TodoComments::query()->create([
                'content' => $request['contentComment'],
                'todo_id' => $id, 'user_id' => auth()->user()->id
            ]);
            return redirect()->route('detailTodo', ['id' => $this->id . '#comment'])
                ->with('alert', 'نظر شما ارسال شد');
        } else {
            abort(403);
        }
    }

    public function render(): View
    {
        return view('components.custom.comment-form');
    }
}
