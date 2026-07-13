<?php

namespace App\Contexts\Dashboard\Presentation\Livewire;

use Livewire\Component;

class DashboardPage extends Component
{
    public function render()
    {
     return view('dashboard::dashboard.dashboard-page')
            ->layout('shared::layouts.app')
            ->title('Panel Principal');
    }
}