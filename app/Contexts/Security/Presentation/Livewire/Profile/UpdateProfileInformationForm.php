<?php

namespace App\Contexts\Security\Presentation\Livewire\Profile;

use Livewire\Component;
use App\Contexts\Security\Application\UseCases\Profile\UpdateProfileUseCase;
use App\Contexts\Security\Infrastructure\Requests\ProfileUpdateRequest;

class UpdateProfileInformationForm extends Component
{
    public string $name = '';
    public string $email = '';

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    public function updateProfile(UpdateProfileUseCase $useCase)
    {
        $rules = (new ProfileUpdateRequest())->rules();
        $validated = $this->validate($rules);

        $user = auth()->user()->load('perfiles');

        $useCase->execute(auth()->id(), $user->toArray(), $validated);

        session()->flash('success', 'Perfil actualizado con éxito.');
    }

    public function render()
    {
        return view('security::profile.update-profile-information-form');
    }
}