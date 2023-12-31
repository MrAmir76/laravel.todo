<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminBoxUserInfo extends Component
{

    public $name;
    public $email;
    public $created;

    public function __construct($name, $email, $created)
    {
        $this->name = $name;
        $this->email = $email;
        $this->created = $created;
    }

    public function render(): View
    {
        return view('components.custom.admin.admin-box-user-info');
    }
}
