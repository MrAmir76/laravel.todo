<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Search extends Component
{
    public $inputSearch = '';
    public $scopeSearch = 1;
    public $showSearchBtn = false;


    public function updatedInputSearch(): void
    {
        $this->showSearchBtn = false;
        $cleanData = $this->validate(['inputSearch' => 'required|string|min:2']);
        if ((count($cleanData))) $this->showSearchBtn = true;
    }

    public function searchValidate(): void
    {
        $this->validate([
            'inputSearch' => 'required|string|min:2',
            'scopeSearch' => 'required|numeric|in:1,2,3',
        ]);
        $redirectParams = ['id' => $this->scopeSearch, 'searchInput' => $this->inputSearch];
        $this->redirect(route('search', $redirectParams), 1);
    }

    public function render(): View
    {
        return view('livewire.search');
    }
}