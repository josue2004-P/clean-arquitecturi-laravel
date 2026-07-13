<?php

namespace App\Contexts\Security\Infrastructure\Controllers\Auth;

use App\Contexts\Security\Infrastructure\Controllers\Controller;
use App\Contexts\Security\Application\UseCases\Auth\VerifyEmailUseCase;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request, VerifyEmailUseCase $useCase): RedirectResponse
    {
        $useCase->execute($request->user());

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}