<?php

namespace App\View\Components;

use App\Models\Todo;
use Illuminate\View\Component;

class DetailTodo extends Component
{
    public $id;
    public $task;

    public function __construct($id)
    {
        $this->id = $id;
        $this->task = Todo::query()->findOrFail($id);
    }

    public function render()
    {
        return view('components.custom.detail-todo');
    }
}
