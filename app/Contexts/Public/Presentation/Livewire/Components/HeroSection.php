<?php

namespace App\Contexts\Public\Infrastructure\Livewire\Components;

use Livewire\Component;

class HeroSection extends Component
{
    public function render()
    {
        return view('public::components.hero');
    }
}