<?php

namespace App\Contexts\Security\Presentation\Livewire\Auth;

use Livewire\Component;
use App\Contexts\Security\Application\UseCases\Auth\AuthenticateUserUseCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    public function mount()
    {
        if (Auth::check()) {
            return $this->redirectRoute('dashboard', navigate: true);
        }
    }

    public function login(AuthenticateUserUseCase $useCase)
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        try {
            $throttleKey = Str::transliterate(Str::lower($this->email).'|'.request()->ip());

            $useCase->execute([
                'email' => $this->email,
                'password' => $this->password,
            ], $this->remember, $throttleKey);

            session()->regenerate();

            return $this->redirectIntended(route('dashboard', absolute: false));

        } catch (ValidationException $e) {
            foreach ($e->errors() as $key => $messages) {
                $this->addError($key, $messages[0]);
            }
        }
    }

    public function render()
    {
        return view('security::auth.login')
            ->layout('security::layouts.fullscreen-layout')
            ->title('Iniciar Sesión'); 
    }
}