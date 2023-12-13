<?php

namespace App\Livewire;

use App\Models\Todo;
use App\Models\TodoComments;
use Livewire\Component;
use Session;

class DeleteTodo extends Component
{

    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function remove()
    {
        TodoComments::query()->where('todo_id', $this->id)->delete();
        Todo::query()->findOrFail($this->id)->delete();
        Session::flash('alert', 'وظیفه انتخابی به همراه نظرات مرتبط حذف شد.');
        $this->redirect(route('index'), 1);
    }

    public function render()
    {
        return view('livewire.delete-todo');
    }
}
