<?php

namespace App\Contexts\Security\Presentation\Livewire\Usuarios;

use Livewire\Component;
use App\Contexts\Security\Domain\Repositories\UserRepositoryInterface;
use App\Contexts\Security\Domain\Repositories\PerfilRepositoryInterface;
use App\Contexts\Security\Application\UseCases\Usuarios\UpdateUserUseCase;
use App\Contexts\Security\Application\UseCases\Usuarios\DeleteUserUseCase;
use Livewire\Attributes\On;
use Exception;

class EditUsuario extends Component
{
    public $userId;
    public $usuario = '';
    public $name = '';
    public $apellido_paterno = '';
    public $apellido_materno = '';
    public $email = '';
    public $is_activo = false;
    public $selectedPerfiles = [];

    public $foto = null;
    public $firma = null;
    
    public $currentFoto = null;
    public $currentFirma = null;

    public function mount($id, UserRepositoryInterface $userRepo)
    {
        if (!checkPermiso('usuarios.is_update')) {
            abort(403, 'No autorizado.');
        }

        $user = $userRepo->findWithPerfiles((int)$id);
        $this->userId           = $user->id;
        $this->usuario          = $user->usuario;
        $this->name             = $user->name;
        $this->apellido_paterno = $user->apellido_paterno;
        $this->apellido_materno = $user->apellido_materno;
        $this->email            = $user->email;
        $this->is_activo        = (bool)$user->is_activo;
        
        $this->currentFoto      = $user->foto;
        $this->currentFirma     = $user->firma;
        
        $this->selectedPerfiles = $user->perfiles->pluck('id')->map(fn($id) => (string)$id)->toArray();
    }

    #[On('fotoUploaded')]
    public function setFoto($path)
    {
        $this->foto = $path;
    }

    #[On('firmaUploaded')]
    public function setFirma($path)
    {
        $this->firma = $path;
    }

    public function confirmPermanentDelete()
    {
        $this->dispatch('swal-confirm', [
            'title' => '¿Eliminar Permanentemente?',
            'text'  => 'Esta acción borrará el registro completo. No se puede deshacer.',
            'icon'  => 'error',
            'id'    => $this->userId,
            'function' => 'force-delete-user',
        ]);
    }

    #[On('force-delete-user')]
    public function forceDeleteUser($id, DeleteUserUseCase $useCase)
    {
        if (!checkPermiso('administrador.is_delete')) {
            $this->dispatch('swal-init', ['icon' => 'error', 'title' => 'Acceso Denegado', 'text' => 'No posees el rango para eliminar registros de raíz.']);
            return;
        }

        $useCase->execute((int)$id);
        
        session()->flash('success', 'El registro de usuario ha sido destruido con éxito.');
        return $this->redirectRoute('usuarios.index');
    }

    public function save(UpdateUserUseCase $useCase)
    {
        $this->validate([
            'name'               => 'required|string|max:255',
            'apellido_paterno'   => 'required|string|max:255',
            'apellido_materno'   => 'required|string|max:255',
            'email'              => 'required|string|email|max:255|unique:users,email,' . $this->userId,
            'is_activo'          => 'nullable|boolean',
            'selectedPerfiles'   => 'nullable|array',
            'selectedPerfiles.*' => 'exists:perfiles,id'
        ]);

        try {
            $useCase->execute($this->userId, [
                'name'             => $this->name,
                'apellido_paterno' => $this->apellido_paterno,
                'apellido_materno' => $this->apellido_materno,
                'email'            => $this->email,
                'is_activo'        => $this->is_activo,
                'foto'             => $this->foto ?? $this->currentFoto,
                'firma'            => $this->firma ?? $this->currentFirma,
            ], $this->selectedPerfiles);

            session()->flash('success', "El usuario {$this->name} ha sido actualizado.");
            return $this->redirectRoute('usuarios.index');
        } catch (Exception $e) {
            session()->flash('error', 'Ocurrió un error al intentar guardar los cambios.');
        }
    }

    public function render(PerfilRepositoryInterface $perfilRepo)
    {
        return view('security::usuarios.edit', [
            'perfilesCatalogo' => $perfilRepo->paginateWithSearch('', 100)
        ])
        ->layout('shared::layouts.app')
        ->title('Editar Usuario');
    }
}