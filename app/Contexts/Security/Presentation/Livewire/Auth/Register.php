<?php

namespace App\Contexts\Security\Presentation\Livewire\Auth;

use Livewire\Component;
use App\Contexts\Security\Application\UseCases\Auth\RegisterNewUserUseCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    public function mount()
    {
        if (Auth::check()) {
            return $this->redirectRoute('dashboard', navigate: true);
        }
    }

    public function register(RegisterNewUserUseCase $useCase)
    {
        $this->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = $useCase->execute([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => $this->password,
        ]);

        Auth::login($user);

        return $this->redirect(route('dashboard', absolute: false));
    }

    public function render()
    {
        return view('security::auth.register')
            ->layout('security::layouts.fullscreen-layout')
            ->title('Crear Cuenta');
    }
}