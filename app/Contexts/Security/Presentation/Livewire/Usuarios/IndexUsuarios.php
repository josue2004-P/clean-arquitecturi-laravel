<?php

namespace App\Contexts\Security\Presentation\Livewire\Usuarios;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use App\Contexts\Security\Domain\Repositories\UserRepositoryInterface;

use App\Contexts\Security\Application\UseCases\Usuarios\DeactivateUserUseCase;

class IndexUsuarios extends Component
{
    use WithPagination;

    #[Url(history: true, keep: true)]
    public $search = '';

    #[Url(keep: true)]
    public $perPage = 10;

    public function mount()
    {
        if (!checkPermiso('usuarios.is_read')) {
            abort(403, 'Acceso denegado.');
        }
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function confirmDelete($id)
    {
        $this->dispatch('swal-confirm', [
            'title' => '¿Eliminar usuario?',
            'text'  => 'Esta acción removerá el acceso del usuario.',
            'icon'  => 'warning',
            'id'    => $id,
            'function' => 'deactivate-user',
        ]);
    }

    #[On('deactivate-user')]
    public function deactivateUser($id, DeactivateUserUseCase $useCase)
    {
        if (!checkPermiso('usuarios.is_update')) {
            $this->dispatch('swal-init', ['icon' => 'error', 'title' => 'Acceso Denegado', 'text' => 'No tienes permisos para modificar usuarios.']);
            return;
        }

        $useCase->execute((int)$id);
        $this->dispatch('swal-init', ['icon' => 'success', 'title' => 'Desactivado', 'text' => 'El usuario ha sido dado de baja correctamente.']);
    }

    public function render(UserRepositoryInterface $repository)
    {
        return view('security::usuarios.index', [
            'usuarios' => $repository->paginateWithSearch($this->search, (int)$this->perPage),
        ])
        ->layout('shared::layouts.app')
        ->title('Gestión de Usuarios');
    }
}