<?php

namespace App\Contexts\Public\Presentation\Livewire;

use Livewire\Component;

class WelcomePage extends Component
{
    public function render()
    {
        return view('public::welcome-page')
            ->layout('shared::layouts.main')
            ->title('Inicio');
    }
}