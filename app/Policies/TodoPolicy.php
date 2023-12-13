<?php


namespace App\Policies;


use App\Models\Todo;
use App\Models\User;

class TodoPolicy
{


    public function adminOrOwner(User $user, Todo $todo)
    {
        return $user->admin or $todo->user_id === $user->id;
    }

    public function createComment(User $user, Todo $todo)
        // برای هر وظیفه تنها مدیر و انجام دهنده وظیفه می توانند برای آن نظر بنویسند.
    {
        return $user->admin or $todo->user_id === $user->id;
    }

    public function AdminEditTodo(User $user, Todo $todo)
    {
        //اگر وظیفه بسته نشده باشد و ادمین باشد.
        return $todo->finally_status === null and $user->admin === 1;
    }

    public function EditTodo(User $user, Todo $todo)
    {
        //اگر وظیفه بسته نشده باشد.
        return $todo->finally_status === null;
    }
}

