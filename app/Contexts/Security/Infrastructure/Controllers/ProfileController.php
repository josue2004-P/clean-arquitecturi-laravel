<?php

namespace App\Contexts\Security\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use App\Contexts\Security\Infrastructure\Requests\ProfileUpdateRequest;
use App\Contexts\Security\Application\UseCases\Profile\UpdateProfileUseCase;
use App\Contexts\Security\Application\UseCases\Profile\DestroyAccountUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    private UpdateProfileUseCase $updateProfileUseCase;
    private DestroyAccountUseCase $destroyAccountUseCase;

    public function __construct(
        UpdateProfileUseCase $updateProfileUseCase,
        DestroyAccountUseCase $destroyAccountUseCase
    ) {
        $this->updateProfileUseCase = $updateProfileUseCase;
        $this->destroyAccountUseCase = $destroyAccountUseCase;
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Pasamos el ID, el array original del usuario autenticado y los datos nuevos validados
        $this->updateProfileUseCase->execute(
            $request->user()->id,
            $request->user()->toArray(),
            $request->validated()
        );

        return Redirect::route('profile.edit')->with('success', 'Perfil actualizado.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        try {
            $userId = $request->user()->id;

            // Ejecutamos la lógica del dominio
            $this->destroyAccountUseCase->execute($userId, $request->input('password'));

            // Si todo sale bien, destruimos la sesión en la infraestructura HTTP
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/');
            
        } catch (\InvalidArgumentException $e) {
            // Mapeamos la excepción de negocio a una excepción de validación de Laravel
            throw ValidationException::withMessages([
                'password' => [$e->getMessage()],
            ])->errorBag('userDeletion');
        }
    }
}