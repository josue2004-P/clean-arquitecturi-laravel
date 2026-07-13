<?php

namespace App\Contexts\Security\Presentation\Livewire\Auth;

use Livewire\Component;
use App\Contexts\Security\Application\UseCases\Auth\ResetPasswordUseCase;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;

class ResetPassword extends Component
{
    public $token = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    public function mount(Request $request, $token)
    {
        $this->token = $token;
        $this->email = $request->query('email', '');
    }

    public function resetPassword(ResetPasswordUseCase $useCase)
    {
        $this->validate([
            'token'    => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        try {
            $useCase->execute([
                'token'                 => $this->token,
                'email'                 => $this->email,
                'password'              => $this->password,
                'password_confirmation' => $this->password_confirmation,
            ]);

            session()->flash('status', 'Tu contraseña ha sido restablecida correctamente.');
            return $this->redirectRoute('login');

        } catch (ValidationException $e) {
            foreach ($e->errors() as $key => $messages) {
                $this->addError($key, $messages[0]);
            }
        }
    }

    public function render()
    {
        return view('security::auth.reset-password')
            ->layout('security::layouts.fullscreen-layout')
            ->title('Nueva Contraseña');
    }
}