<?php

namespace App\Livewire;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AddTodo extends Component
{
    public $taskTitle;
    public $taskBody;
    public $taskDeadline;
    public $operator_;

    public $resultSelf;
    public $showNewTaskBtn = false;

    public function updatedTaskTitle(): void
    {
        $this->validate([
            'taskTitle' => 'required|min:5|string|max:255',
            'taskBody' => 'nullable|min:15|string',
            'taskDeadline' => 'nullable|numeric|min:1|max:365',
            'operator_' => 'nullable|numeric|exists:users,id',
            'resultSelf' => 'nullable|string|min:15',
        ]);
    }

    public function updatedTaskBody(): void
    {
        $this->validate([
            'taskTitle' => 'nullable|min:5|string|max:255',
            'taskBody' => 'required|min:15|string',
            'taskDeadline' => 'nullable|numeric|min:1|max:365',
            'operator_' => 'nullable|numeric|exists:users,id',
            'resultSelf' => 'nullable|string|min:15',
        ]);
    }


    public function updatedTaskDeadline(): void
    {
        $this->validate([
            'taskTitle' => 'nullable|min:5|string|max:255',
            'taskBody' => 'nullable|min:15|string',
            'taskDeadline' => 'required|numeric|min:1|max:365',
            'operator_' => 'nullable|numeric|exists:users,id',
            'resultSelf' => 'nullable|string|min:15',
        ]);
    }

    public function updatedOperator_(): void
    {
        $this->validate([
            'taskTitle' => 'nullable|min:5|string|max:255',
            'taskBody' => 'nullable|min:15|string',
            'taskDeadline' => 'nullable|numeric|min:1|max:365',
            'operator_' => 'required|numeric|exists:users,id',
            'resultSelf' => 'nullable|string|min:15',
        ]);
    }

    public function updatedResultSelf(): void
    {
        $this->validate([
            'taskTitle' => 'nullable|min:5|string|max:255',
            'taskBody' => 'nullable|min:15|string',
            'taskDeadline' => 'nullable|numeric|min:1|max:365',
            'operator_' => 'nullable|numeric|exists:users,id',
            'resultSelf' => 'required|string|min:15',
        ]);
    }

    public function AllRulesValidation(): array
    {
        return [
            'taskTitle' => 'required|min:5|string|max:255',
            'taskBody' => 'required|min:15|string',
            'taskDeadline' => 'required|numeric|min:1|max:365',
            'operator_' => 'required|numeric|exists:users,id',
            'resultSelf' => 'nullable|string|min:15'
        ];
    }

    public function updated(): void
    {
        $this->showNewTaskBtn = false;
        $validateData = $this->validate($this->AllRulesValidation());
        $isValidateFrom = boolval(count($validateData));
        if ($isValidateFrom) $this->showNewTaskBtn = true;
    }

    public function save(): void
    {
        $this->validate($this->AllRulesValidation());

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
        $this->dispatch('updateTodoList');
    }


    public function render(): View
    {
        $userList = User::all()->pluck('name', 'id');
        return view('livewire.add-todo', compact('userList'));
    }
}