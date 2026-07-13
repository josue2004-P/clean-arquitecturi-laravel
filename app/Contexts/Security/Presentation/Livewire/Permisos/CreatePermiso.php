<?php
namespace App\Contexts\Security\Presentation\Livewire\Permisos;

use Livewire\Component;
use App\Contexts\Security\Application\UseCases\Permisos\CreatePermisoUseCase;
use Exception;

class CreatePermiso extends Component
{
    public $nombre = '';
    public $descripcion = '';

    public function mount()
    {
        if (!checkPermiso('permisos.is_create')) {
            abort(403, 'No tienes permisos para realizar esta acción.');
        }
    }

    public function save(CreatePermisoUseCase $useCase)
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
        ]);

        try {
            $useCase->execute([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
            ]);

            session()->flash('success', 'Llave de seguridad creada correctamente.');
            
            return $this->redirectRoute('permisos.index');

        } catch (Exception $e) {
            $this->addError('nombre', $e->getMessage());
        }
    }
    public function render()
    {
        return view('security::permisos.create')->layout('shared::layouts.app', [
            'title' => 'Registrar Nuevo Permiso de Módulo'
        ]);
    }
}