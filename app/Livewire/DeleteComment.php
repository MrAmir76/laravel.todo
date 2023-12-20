<?php

namespace App\Livewire;

use App\Models\TodoComments;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class DeleteComment extends Component
{
    public $commentId;
    public $todoID;

    public function mount($commentId, $todoID): void
    {
        $this->commentId = $commentId;
        $this->todoID = $todoID;
    }

    public function removeComment(): void
    {
        if (Gate::allows('isAdmin', auth()->user())) {
            TodoComments::query()->findOrFail($this->commentId)->delete();
            $this->dispatch('refreshComment');
        } else {
            abort(403);
        }
    }

    public function render(): View
    {
        return view('livewire.delete-comment');
    }
}