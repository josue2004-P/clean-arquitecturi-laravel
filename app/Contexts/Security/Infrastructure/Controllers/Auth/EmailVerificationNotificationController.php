<?php

namespace App\Contexts\Security\Infrastructure\Controllers\Auth;

use App\Contexts\Shared\Infrastructure\Controllers\Controller;
use App\Contexts\Security\Application\UseCases\Auth\SendEmailVerificationNotificationUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    public function __invoke(Request $request, SendEmailVerificationNotificationUseCase $useCase): RedirectResponse
    {
        $sent = $useCase->execute($request->user());

        if (!$sent) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        return back()->with('status', 'verification-link-sent');
    }
}