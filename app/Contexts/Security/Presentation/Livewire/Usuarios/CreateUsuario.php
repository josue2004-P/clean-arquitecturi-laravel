<?php

namespace App\Contexts\Security\Presentation\Livewire\Usuarios;

use Livewire\Component;
use App\Contexts\Security\Application\UseCases\Usuarios\CreateUserUseCase;
use Exception;

class CreateUsuario extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $is_activo = true;

    public function mount()
    {
        if (!checkPermiso('usuarios.is_create')) {
            abort(403, 'No autorizado.');
        }
    }

    public function save(CreateUserUseCase $useCase)
    {
        $this->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'is_activo' => 'nullable|boolean',
        ]);

        try {
            $useCase->execute([
                'name'      => $this->name,
                'email'     => $this->email,
                'password'  => $this->password,
                'is_activo' => $this->is_activo,
            ]);

            session()->flash('success', 'Usuario registrado con éxito.');
            return $this->redirectRoute('usuarios.index');
        } catch (Exception $e) {
            $this->addError('email', 'Error al procesar el alta del usuario.');
        }
    }

    public function render()
    {
        return view('security::usuarios.create')
            ->layout('shared::layouts.app')
            ->title('Nuevo Usuario');
    }
}