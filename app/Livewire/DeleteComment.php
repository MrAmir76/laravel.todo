<?php

namespace App\Livewire;

use App\Models\TodoComments;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Session;

class DeleteComment extends Component
{
    public $commentId;
    public $todoID;

    public function mount($commentId, $todoID)
    {
        $this->commentId = $commentId;
        $this->todoID = $todoID;
    }

    public function removeComment()
    {
        if (Gate::allows('isAdmin', auth()->user())) {
            TodoComments::query()->findOrFail($this->commentId)->delete();
            Session::flash('alert', 'نظر نوشته شده با موفقیت حذف شد');
            $redirectUrl = route('detailTodo', ['id' => $this->todoID]) . "#comment";
            $this->redirect($redirectUrl, 1);
        } else {
            return abort(403);
        }
    }

    public function render()
    {
        return view('livewire.delete-comment');
    }
}
