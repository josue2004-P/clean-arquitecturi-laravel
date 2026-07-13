<?php
namespace App\Contexts\Security\Presentation\Livewire\Permisos;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use App\Contexts\Security\Application\UseCases\Permisos\GetPaginatedPermisosUseCase;
use App\Contexts\Security\Domain\Repositories\PermisoRepositoryInterface;

class IndexPermisos extends Component
{
    use WithPagination;

    #[Url(history: true, keep: true)]
    public $search = '';

    #[Url(keep: true)]
    public $perPage = 10;

    public function mount()
    {
        if (!checkPermiso('permisos.is_read')) {
            abort(403, 'No tienes permisos para visualizar este módulo.');
        }
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function confirmDelete($id)
    {
        $this->dispatch('swal-confirm', [
            'title' => '¿Eliminar permiso?',
            'text'  => 'Esta acción no se puede deshacer',
            'icon'  => 'warning',
            'id'    => $id,
            'function' => 'delete-permiso',
        ]);
    }

    #[On('delete-permiso')]
    public function deletePermiso($id, PermisoRepositoryInterface $repository)
    {
        if (!checkPermiso('permisos.is_delete')) {
            $this->dispatch('swal-init', [
                'icon'  => 'error',
                'title' => 'Acceso Denegado',
                'text'  => 'No tienes permisos para eliminar este permiso'
            ]);
            return;
        }

        try {
            $repository->delete((int)$id);

            $this->dispatch('swal-init', [
                'icon'  => 'success',
                'title' => 'Eliminado',
                'text'  => 'El permiso fue eliminado correctamente'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('swal-init', [
                'icon'  => 'error',
                'title' => 'Error',
                'text'  => 'No se pudo eliminar el registro.'
            ]);
        }
    }

    public function render(GetPaginatedPermisosUseCase $useCase)
    {
        return view('security::permisos.index', [
            'permisos' => $useCase->execute($this->search, (int)$this->perPage),
        ])->layout('shared::layouts.app', [
            'title' => 'Matriz de Permisos del Sistema'
        ]);
    }
}