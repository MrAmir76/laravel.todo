<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class userTable extends Component
{

    public function render()
    {
        $users = User::query()->paginate(5);
        return view('components.custom.user-table', compact('users'));
    }
}
