<?php

namespace App\Contexts\Security\Application\UseCases\Auth;

use App\Contexts\Security\Infrastructure\LaravelModels\UserEloquentModel as User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class RegisterNewUserUseCase
{
    public function execute(array $data): User
    {
        $user = User::create([
            'name'      => $data['name'],
            'email'     => strtolower(trim($data['email'])),
            'password'  => Hash::make($data['password']),
            'is_activo' => true, 
        ]);

        event(new Registered($user));

        return $user;
    }
}