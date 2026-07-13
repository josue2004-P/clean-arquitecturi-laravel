<?php

namespace App\Contexts\Security\Presentation\Livewire\Profile;

use Livewire\Component;

class EditProfilePage extends Component
{
    public function render()
    {
        return view('security::profile.edit-profile-page')
            ->layout('shared::layouts.app')
            ->title('Configuración de Perfil');
    }
}