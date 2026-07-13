<?php

namespace App\Contexts\Security\Presentation\Livewire\Auth;

use Livewire\Component;
use App\Contexts\Security\Application\UseCases\Auth\CheckEmailVerificationStatusUseCase;
use Illuminate\Support\Facades\Auth;

class VerifyEmailPrompt extends Component
{
    public function mount(CheckEmailVerificationStatusUseCase $useCase)
    {
        if (!Auth::check()) {
            return $this->redirectRoute('login');
        }

        if ($useCase->execute(Auth::user())) {
            return $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
        }
    }

    public function render()
    {
        return view('security::auth.verify-email-prompt')
            ->layout('security::layouts.fullscreen-layout')
            ->title('Verificar Correo');
    }
}