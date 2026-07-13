<?php


use App\Contexts\Security\Infrastructure\Controllers\Auth\LogoutController;
use App\Contexts\Security\Infrastructure\Controllers\Auth\EmailVerificationNotificationController;
use App\Contexts\Security\Infrastructure\Controllers\Auth\VerifyEmailController;

use App\Contexts\Security\Presentation\Livewire\Auth\Login;
use App\Contexts\Security\Presentation\Livewire\Auth\ConfirmPassword;
use App\Contexts\Security\Presentation\Livewire\Auth\VerifyEmailPrompt;
use App\Contexts\Security\Presentation\Livewire\Auth\ResetPassword;
use App\Contexts\Security\Presentation\Livewire\Auth\ForgotPassword;
use App\Contexts\Security\Presentation\Livewire\Auth\Register;

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // REGISTER
    Route::get('register', Register::class)->name('register');

    // LOGIN
    Route::get('login', Login::class)->name('login');

    // CONFIRM PASSWORD
    Route::get('confirm-password', ConfirmPassword::class)->name('password.confirm');

    // ENVIAR CORREO DE VERIFICACION
    Route::post('email/verification-notification', EmailVerificationNotificationController::class)
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // RESET PASSWORD
    Route::get('reset-password/{token}', ResetPassword::class)->name('password.reset');

    // RECUPERACION DE CONTRASE;A
    Route::get('forgot-password', ForgotPassword::class)->name('password.request');
  
});

Route::middleware('auth')->group(function () {

    // VERIFICACION
    Route::get('verify-email', VerifyEmailPrompt::class)
        ->name('verification.notice');

    // VERIFICACION DE EMAIL
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
 
    // LOGOUT
    Route::post('logout', LogoutController::class)->name('logout');
});
