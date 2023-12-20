<?php

namespace App\Livewire;

use App\Models\Todo;
use App\Models\TodoComments;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class DeleteTodo extends Component
{
    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function remove(): void
    {
        TodoComments::query()->where('todo_id', $this->id)->delete();
        Todo::query()->findOrFail($this->id)->delete();
        Session::flash('alert', 'وظیفه انتخابی به همراه نظرات مرتبط حذف شد.');
        $this->redirect(route('index'), 1);
    }

    public function render(): View
    {
        return view('livewire.delete-todo');
    }
}
