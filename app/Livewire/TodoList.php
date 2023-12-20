<?php

namespace App\Livewire;

use App\Models\Todo;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;


class TodoList extends Component
{
    use WithPagination;

    protected $listeners = ['updateTodoList'];

    public function updateTodoList(): void
    {
        $this->render();
    }

    public function render(): View
    {

        $todo = Todo::query()
            ->where('user_id', auth()->user()->id)
            ->orderByDesc('id')->paginate(5);

        return view('livewire.todo-list', compact('todo'));

    }
}
