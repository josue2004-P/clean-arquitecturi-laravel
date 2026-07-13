<?php

namespace App\Contexts\Security\Application\UseCases\Auth;

use Illuminate\Contracts\Auth\MustVerifyEmail;

class CheckEmailVerificationStatusUseCase
{
    public function execute(mixed $user): bool
    {
        if ($user instanceof MustVerifyEmail && $user->hasVerifiedEmail()) {
            return true;
        }

        return false;
    }
}