<?php

namespace App\Contexts\Security\Presentation\Livewire\Perfiles;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use App\Contexts\Security\Domain\Repositories\PerfilRepositoryInterface;

class IndexPerfiles extends Component
{
    use WithPagination;

    #[Url(history: true, keep: true)]
    public $search = '';

    #[Url(keep: true)]
    public $perPage = 10;

    public function mount()
    {
        if (!checkPermiso('perfiles.is_read')) {
            abort(403, 'No tienes credenciales para ver este módulo.');
        }
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function confirmDelete($id)
    {
        $this->dispatch('swal-confirm', [
            'title' => '¿Eliminar perfil?',
            'text'  => 'Esta acción no se puede deshacer',
            'icon'  => 'warning',
            'id'    => $id,
            'function' => 'delete-perfil',
        ]);
    }

    #[On('delete-perfil')]
    public function deletePerfil($id, PerfilRepositoryInterface $repository)
    {
        if (!checkPermiso('perfiles.is_delete')) {
            $this->dispatch('swal-init', ['icon' => 'error', 'title' => 'Acceso Denegado', 'text' => 'No puedes eliminar este perfil.']);
            return;
        }

        $repository->delete((int)$id);
        $this->dispatch('swal-init', ['icon' => 'success', 'title' => 'Eliminado', 'text' => 'El perfil fue removido con éxito.']);
    }

    public function render(PerfilRepositoryInterface $repository)
    {
        return view('security::perfiles.index', [
            'perfiles' => $repository->paginateWithSearch($this->search, (int)$this->perPage),
        ])->layout('shared::layouts.app', [
            'title' => 'Control de Perfiles y Roles'
        ]);
    }
}