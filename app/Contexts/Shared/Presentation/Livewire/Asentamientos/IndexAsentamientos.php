<?php

namespace App\Contexts\Shared\Presentation\Livewire\Asentamientos;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetAsentamientosPaginatedUseCase;
use App\Contexts\Shared\Application\UseCases\Asentamientos\DeleteAsentamientoUseCase;

class IndexAsentamientos extends Component
{
    use WithPagination;

    #[Url(history: true, keep: true)]
    public $search = '';

    #[Url(keep: true)]
    public $perPage = 10;

    public function mount()
    {
        if (!checkPermiso('asentamientos.is_read')) {
            abort(403, 'Acceso denegado.');
        }
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function confirmDelete($id)
    {
        $this->dispatch('swal-confirm', [
            'title' => '¿Eliminar asentamiento?',
            'text'  => 'Esta acción removerá definitivamente la ubicación del catálogo.',
            'icon'  => 'warning',
            'id'    => $id,
            'function' => 'delete-asentamiento',
        ]);
    }

    #[On('delete-asentamiento')]
    public function deleteAsentamiento($id, DeleteAsentamientoUseCase $useCase)
    {
        if (!checkPermiso('asentamientos.is_update')) {
            $this->dispatch('swal-init', [
                'icon' => 'error', 
                'title' => 'Acceso Denegado', 
                'text' => 'No tienes permisos para modificar asentamientos.'
            ]);
            return;
        }

        $useCase->execute((int)$id);
        
        $this->dispatch('swal-init', [
            'icon' => 'success', 
            'title' => 'Eliminado', 
            'text' => 'El asentamiento ha sido eliminado correctamente.'
        ]);
    }

    public function render(GetAsentamientosPaginatedUseCase $getUseCase)
    {
        return view('shared::asentamientos.index', [
            'asentamientos' => $getUseCase->execute($this->search, (int)$this->perPage)
        ])
        ->layout('shared::layouts.app') 
        ->title('Gestión de Asentamientos');
    }
}