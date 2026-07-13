<?php

namespace App\Contexts\Security\Presentation\Livewire\Perfiles;

use Livewire\Component;
use App\Contexts\Security\Domain\Repositories\PerfilRepositoryInterface;
use App\Contexts\Security\Domain\Repositories\PermisoRepositoryInterface;
use App\Contexts\Security\Application\UseCases\Perfiles\UpdatePerfilUseCase;
use Exception;

class EditPerfil extends Component
{
    public $perfilId;
    public $nombre = '';
    public $descripcion = '';
    
    public $matriz = []; 

    public function mount($id, PerfilRepositoryInterface $perfilRepo, PermisoRepositoryInterface $permisoRepo)
    {
        if (!checkPermiso('perfiles.is_update')) {
            abort(403, 'Acción restringida.');
        }

        $perfil = $perfilRepo->findWithPermisos((int)$id);
        $this->perfilId = $perfil->id;
        $this->nombre = $perfil->nombre;
        $this->descripcion = $perfil->descripcion;

        $allPermisos = $permisoRepo->all();
        foreach ($allPermisos as $permiso) {
            $pivot = $perfil->permisos->firstWhere('id', $permiso['id'])?->pivot;
            
            $this->matriz[$permiso['id']] = [
                'is_read'   => $pivot ? (bool)$pivot->is_read : false,
                'is_create' => $pivot ? (bool)$pivot->is_create : false,
                'is_update' => $pivot ? (bool)$pivot->is_update : false,
                'is_delete' => $pivot ? (bool)$pivot->is_delete : false,
            ];
        }
    }

    public function save(UpdatePerfilUseCase $useCase)
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
        ]);

        try {
            $useCase->execute($this->perfilId, [
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
            ], $this->matriz);

            session()->flash('success', 'Perfil y matriz de seguridad sincronizados correctamente.');
            return $this->redirectRoute('perfiles.index');
        } catch (Exception $e) {
            $this->addError('nombre', $e->getMessage());
        }
    }

    public function render(PermisoRepositoryInterface $permisoRepo)
    {
        return view('security::perfiles.edit', [
            'permisosCatalogo' => $permisoRepo->all()
        ])->layout('shared::layouts.app', [
            'title' => 'Configurar Estructura de Perfil'
        ]);
    }
}