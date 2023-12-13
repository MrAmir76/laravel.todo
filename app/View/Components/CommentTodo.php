<?php

namespace App\View\Components;

use App\Models\TodoComments;
use Illuminate\View\Component;

class CommentTodo extends Component
{

    public $id;
    public $comments;

    public function __construct($id)
    {
        $this->id = $id;
        $this->comments = TodoComments::query()
            ->where('todo_id', $id)->orderByDesc('id')
            ->paginate(5)->fragment('comment');
    }


    public function render()
    {
        return view('components.custom.comment-todo');
    }
}
