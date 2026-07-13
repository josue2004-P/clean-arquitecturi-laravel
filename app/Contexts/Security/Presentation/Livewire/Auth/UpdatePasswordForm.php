<?php

namespace App\Contexts\Security\Presentation\Livewire\Auth;

use Livewire\Component;
use App\Contexts\Security\Application\UseCases\Auth\UpdateAuthenticatedPasswordUseCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordForm extends Component
{
    public $current_password = '';
    public $password = '';
    public $password_confirmation = '';

    public function updatePassword(UpdateAuthenticatedPasswordUseCase $useCase)
    {
        $this->validate([
            'current_password' => ['required', 'string'],
            'password'         => ['required', 'string', Password::defaults(), 'confirmed'],
        ]);

        try {
            $useCase->execute(Auth::user(), [
                'current_password' => $this->current_password,
                'password'         => $this->password,
            ]);

            $this->reset(['current_password', 'password', 'password_confirmation']);

            $this->dispatch('swal-init', [
                'icon'  => 'success',
                'title' => 'Sistema Seguro',
                'text'  => 'Tu credencial de acceso ha sido actualizada correctamente.'
            ]);

        } catch (ValidationException $e) {
            foreach ($e->errors() as $key => $messages) {
                $this->addError($key, $messages[0]);
            }
        }
    }

    public function render()
    {
        return view('security::auth.update-password-form');
    }
}