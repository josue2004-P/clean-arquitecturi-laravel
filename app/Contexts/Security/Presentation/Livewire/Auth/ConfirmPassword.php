<?php

namespace App\Contexts\Security\Presentation\Livewire\Auth;

use Livewire\Component;
use App\Contexts\Security\Application\UseCases\Auth\ValidateConfirmPasswordUseCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ConfirmPassword extends Component
{
    public $password = '';

    public function mount()
    {
        if (!Auth::check()) {
            return $this->redirectRoute('login');
        }
    }

    public function confirm(ValidateConfirmPasswordUseCase $useCase)
    {
        $this->validate([
            'password' => 'required|string',
        ]);

        try {
            $userEmail = Auth::user()->email;

            $useCase->execute($this->password, $userEmail);

            return $this->redirectIntended(route('dashboard', absolute: false));

        } catch (ValidationException $e) {
            $this->addError('password', $e->errors()['password'][0]);
        }
    }

    public function render()
    {
        return view('security::auth.confirm-password')
            ->layout('security::layouts.fullscreen-layout')
            ->title('Confirmar Contraseña');
    }
}