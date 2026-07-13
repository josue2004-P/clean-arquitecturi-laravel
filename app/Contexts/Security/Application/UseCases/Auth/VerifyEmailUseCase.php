<?php

namespace App\Contexts\Security\Application\UseCases\Auth;

use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class VerifyEmailUseCase
{
    public function execute(mixed $user): bool
    {
        if ($user instanceof MustVerifyEmail && $user->hasVerifiedEmail()) {
            return false;
        }

        // 2. Marcar el correo como verificado
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            return true;
        }

        return false;
    }
}