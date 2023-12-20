<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminNavLink extends Component
{
    public $name;
    public $font;
    public $link;

    public function __construct($name, $font, $link)
    {
        $this->name = $name;
        $this->font = $font;
        $this->link = $link;
    }

    public function render(): View
    {
        return view('components.custom.admin.admin-nav-link');
    }
}