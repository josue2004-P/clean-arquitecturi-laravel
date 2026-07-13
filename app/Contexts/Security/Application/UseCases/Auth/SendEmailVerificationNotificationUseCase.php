<?php

namespace App\Contexts\Security\Application\UseCases\Auth;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Exception;

class SendEmailVerificationNotificationUseCase
{
    public function execute(mixed $user): bool
    {
        if ($user instanceof MustVerifyEmail && $user->hasVerifiedEmail()) {
            return false; // Indica que no fue necesario reenviar
        }

        if (method_exists($user, 'sendEmailVerificationNotification')) {
            $user->sendEmailVerificationNotification();
        }

        return true;
    }
}