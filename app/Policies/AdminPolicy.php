<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{

    public function isAdmin(User $user): bool
    {
        return $user->admin;
    }


}
