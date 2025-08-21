<?php

namespace App\Livewire\Dropdown;

use Livewire\Attributes\Session;
use Livewire\Component;

class LanguageSwitch extends Component
{
    public function render()
    {
        return view('livewire.dropdown.language-switch');
    }

    public function switchLanguage($language)
    {
        session()->put('language', $language);
        return redirect()->back();
    }
}
