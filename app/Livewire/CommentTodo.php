<?php

namespace App\Livewire;

use App\Models\TodoComments;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class CommentTodo extends Component
{

    public $id;
    use WithPagination;

    protected $listeners = ['refreshComment'];

    public function mount($id): void
    {
        $this->id = $id;
    }


    public function refreshComment(): void
    {
        Session::flash('alert', 'نظرانتخاب شده حذف شد');
        $this->render();
    }

    public function render(): View
    {
        $comments = TodoComments::query()
            ->where('todo_id', $this->id)->orderByDesc('id')
            ->paginate(5)->fragment('comment');

        return view('livewire.comment-todo', compact('comments'));
    }
}