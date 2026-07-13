<?php

namespace App\Contexts\Security\Application\UseCases\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UpdateAuthenticatedPasswordUseCase
{
    public function execute(mixed $user, array $data): void
    {
        if (! Hash::check($data['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['La contraseña actual es incorrecta.'],
            ]);
        }

        $user->update([
            'password' => Hash::make($data['password']),
        ]);
    }
}