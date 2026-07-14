<?php

namespace App\Contexts\Security\Application\UseCases\Auth;

use App\Contexts\Security\Infrastructure\Requests\LoginRequest;
use App\Contexts\Security\Infrastructure\LaravelModels\UserEloquentModel;
use Illuminate\Validation\ValidationException;

class AuthenticateUserUseCase
{
    public function execute(array $credentials, bool $remember = false, string $throttleKey = ''): void
    {
        $user = UserEloquentModel::where('usuario', $credentials['usuario'])->first();
        if ($user && !$user->is_activo) {
            throw ValidationException::withMessages([
                'usuario' => 'Esta cuenta se encuentra suspendida temporalmente. Contacta al administrador.',
            ]);
        }

        request()->merge(array_merge($credentials, ['remember' => $remember]));

        $authRequest = app(LoginRequest::class);
        
        $authRequest->authenticate();
    }
}