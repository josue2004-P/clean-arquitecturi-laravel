<?php
namespace App\Contexts\Security\Presentation\Livewire\Permisos;

use Livewire\Component;
use App\Contexts\Security\Domain\Repositories\PermisoRepositoryInterface;
use App\Contexts\Security\Application\UseCases\Permisos\UpdatePermisoUseCase;
use Exception;

class EditPermiso extends Component
{
    // Propiedades vinculadas al formulario (wire:model)
    public $permisoId;
    public $nombre = '';
    public $descripcion = '';

    /**
     * El parámetro {id} de la ruta de Laravel se inyecta automáticamente aquí.
     */
    public function mount($id, PermisoRepositoryInterface $repository)
    {
        if (!checkPermiso('permisos.is_update')) {
            abort(403, 'No tienes permisos para realizar esta acción.');
        }

        $permiso = $repository->findById((int)$id);

        if (!$permiso) {
            abort(404, 'Permiso no encontrado.');
        }

        $this->permisoId = $permiso['id'];
        $this->nombre = $permiso['nombre'];
        $this->descripcion = $permiso['descripcion'];
    }

    /**
     * Procesa el envío del formulario invocando al Caso de Uso.
     */
    public function save(UpdatePermisoUseCase $useCase)
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
        ]);

        try {
            $useCase->execute($this->permisoId, [
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
            ]);

            session()->flash('success', 'Permiso actualizado con éxito.');
            
            return $this->redirectRoute('permisos.index');

        } catch (Exception $e) {
            $this->addError('nombre', $e->getMessage());
        }
    }

    public function render()
    {
        return view('security::permisos.edit')->layout('shared::layouts.app', [
            'title' => 'Modificar Parámetros de Permiso'
        ]);
    }
}