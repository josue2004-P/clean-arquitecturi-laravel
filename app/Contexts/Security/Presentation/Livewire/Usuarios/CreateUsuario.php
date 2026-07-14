<?php

namespace App\Contexts\Security\Presentation\Livewire\Usuarios;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Contexts\Security\Application\UseCases\Usuarios\CreateUserUseCase;
use Exception;

class CreateUsuario extends Component
{
    public $usuario = '';
    public $name = '';
    public $apellido_paterno = '';
    public $apellido_materno = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $is_activo = true;

    public $foto = null;
    public $firma = null;

    public function mount()
    {
        if (!checkPermiso('usuarios.is_create')) {
            abort(403, 'No autorizado.');
        }
    }

    #[On('fotoUploaded')]
    public function setFoto($path)
    {
        $this->foto =$path;
    }

    #[On('firmaUploaded')]
    public function setFirma($path)
    {
        $this->firma =$path;
    }

    public function save(CreateUserUseCase $useCase)
    {
        $this->validate([
            'usuario'          => 'required|string|max:100|unique:users,usuario',
            'name'             => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'email'            => 'required|string|email|max:255|unique:users,email',
            'password'         => 'required|string|min:8|confirmed',
            'is_activo'        => 'nullable|boolean',
        ]);

        try {
            $useCase->execute([
                'usuario'          => $this->usuario,
                'name'             => $this->name,
                'apellido_paterno' => $this->apellido_paterno,
                'apellido_materno' => $this->apellido_materno,
                'email'            => $this->email,
                'password'         => $this->password,
                'is_activo'        => $this->is_activo,
                'foto'             => $this->foto,
                'firma'            => $this->firma,
            ]);

            session()->flash('success', 'Usuario registrado con éxito.');
            return $this->redirectRoute('usuarios.index');
        } catch (Exception $e) {
            $this->addError('usuario', 'Error al procesar el alta: ' .$e->getMessage());
        }
    }

    public function render()
    {
        return view('security::usuarios.create')
            ->layout('shared::layouts.app')
            ->title('Nuevo Usuario');
    }
}