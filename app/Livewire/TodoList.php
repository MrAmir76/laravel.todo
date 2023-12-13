<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Livewire\WithPagination;


class TodoList extends Component
{
    use WithPagination;

    public function render($data = null)
    {
        $todo = Todo::query()->where('user_id', auth()->user()->id)
            ->orderByDesc('id')->paginate(5);

        return view('livewire.todo-list', compact('todo'));

    }
}
