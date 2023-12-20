<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class userTable extends Component
{
    public function render(): View
    {
        $users = User::query()->paginate(5);
        return view('components.custom.user-table', compact('users'));
    }
}