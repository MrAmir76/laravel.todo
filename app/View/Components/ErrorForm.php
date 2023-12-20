<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ErrorForm extends Component
{

    public $message;

    public function __construct($message)
    {

        $this->message = $message;

    }

    public function render(): View
    {
        return view('components.custom.error-form');
    }
}