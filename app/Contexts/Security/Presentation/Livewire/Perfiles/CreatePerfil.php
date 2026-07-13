<?php

namespace App\Contexts\Security\Presentation\Livewire\Perfiles;

use Livewire\Component;
use App\Contexts\Security\Application\UseCases\Perfiles\CreatePerfilUseCase;
use Exception;

class CreatePerfil extends Component
{
    public $nombre = '';
    public $descripcion = '';

    public function mount()
    {
        if (!checkPermiso('perfiles.is_create')) {
            abort(403, 'Acción restringida.');
        }
    }

    public function save(CreatePerfilUseCase $useCase)
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

            session()->flash('success', 'Perfil creado correctamente.');
            return $this->redirectRoute('perfiles.index');
        } catch (Exception $e) {
            $this->addError('nombre', $e->getMessage());
        }
    }

    public function render()
    {
        return view('security::perfiles.create')->layout('shared::layouts.app', [
            'title' => 'Registrar Nuevo Perfil de Acceso'
        ]);
    }
}