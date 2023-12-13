<?php

namespace App\Livewire;

use App\Models\Todo;
use App\Models\User;
use Livewire\Component;
use Session;

class AddTodo extends Component
{

    public $taskTitle;
    public $taskBody;
    public $taskDeadline;
    public $operator_;
    public $resultSelf;

    public function save()
    {
        $this->validate([
            'taskTitle' => 'required|min:5|string|max:255',
            'taskBody' => 'required|min:15|string',
            'taskDeadline' => 'required|numeric|min:1|max:365',
            'operator_' => 'required|numeric|exists:users,id',
            'resultSelf' => 'nullable|string|min:15'
        ]);

        if (auth()->user()->admin != 1) {
            $this->operator_ = auth()->user()->id;
        }
        Todo::query()->create([
            'title' => $this->taskTitle,
            'content' => $this->taskBody,
            'deadline' => $this->taskDeadline,
            'user_id' => $this->operator_,
            'result' => $this->resultSelf,
        ]);
        $this->reset(['taskTitle', 'taskBody', 'taskDeadline', 'operator_', 'resultSelf']);
        Session::flash('alert', 'وظیفه جدید اضافه شد.');
        $this->redirect(route('index'), 1);
    }

    public function render()
    {
        $userList = User::all()->pluck('name', 'id');
        return view('livewire.add-todo', compact('userList'));
    }
}
