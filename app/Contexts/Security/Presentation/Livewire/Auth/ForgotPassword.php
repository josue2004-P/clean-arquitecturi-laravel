<?php

namespace App\Contexts\Security\Presentation\Livewire\Auth;

use Livewire\Component;
use App\Contexts\Security\Application\UseCases\Auth\SendPasswordResetLinkUseCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ForgotPassword extends Component
{
    public $email = '';

    public function mount()
    {
        if (Auth::check()) {
            return $this->redirectRoute('dashboard', navigate: true);
        }
    }

    public function sendResetLink(SendPasswordResetLinkUseCase $useCase)
    {
        $this->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            $statusMessage = $useCase->execute($this->email);

            session()->flash('status', $statusMessage);
            
            $this->reset('email');

        } catch (ValidationException $e) {
            $this->addError('email', $e->errors()['email'][0]);
        }
    }

    public function render()
    {
        return view('security::auth.forgot-password')
            ->layout('security::layouts.fullscreen-layout')
            ->title('Restablecer Contraseña');
    }
}