<?php

namespace App\Livewire;

use Livewire\Component;

class Search extends Component
{

    public $inputSearch = '';
    public $scopeSearch = 1;

    public function searchValidate()
    {
        $this->validate([
            'inputSearch' => 'required|string|min:2',
            'scopeSearch' => 'required|numeric|in:1,2,3',
        ]);
        $redirectParams = ['id' => $this->scopeSearch, 'searchInput' => $this->inputSearch];
        $this->redirect(route('search', $redirectParams), 1);
    }

    public function render()
    {
        return view('livewire.search');
    }
}
