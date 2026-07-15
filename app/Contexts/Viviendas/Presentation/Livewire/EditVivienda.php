<?php

namespace App\Contexts\Viviendas\Presentation\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Contexts\Viviendas\Application\UseCases\SaveViviendaUseCase;
use App\Contexts\Viviendas\Application\UseCases\SaveViviendaContactosUseCase;
use App\Contexts\Viviendas\Application\UseCases\SaveViviendaDocumentosUseCase;
use App\Contexts\Viviendas\Application\UseCases\SaveViviendaFotosUseCase;

use App\Contexts\Viviendas\Infrastructure\LaravelModels\ViviendaEloquentModel;
use App\Contexts\Shared\Infrastructure\LaravelModels\AsentamientoEloquentModel;
use App\Contexts\Shared\Infrastructure\LaravelModels\TipoViviendaEloquentModel;
use App\Contexts\Shared\Infrastructure\LaravelModels\TipoCreditoEloquentModel;
use App\Contexts\Shared\Infrastructure\LaravelModels\AmenidadEloquentModel;

class EditVivienda extends Component
{
    use WithFileUploads;

    public $asentamientos = [];
    public $tiposVivienda = [];
    public $creditosDisponibles = [];
    public $amenidadesDisponibles = [];

    public $viviendaId;
    public $fraccionamiento = '';
    public $asentamiento_id = '';
    public $tipo_vivienda_id = '';
    public $precio_lista = '';
    public $recamaras = 0;
    public $direccion = '';
    public $llaves = false;
    public $estatus_vivienda = 'Disponible';
    public $creditos_ids = [];
    public $amenidades_ids = [];

    public array $contactos = [];
    public array $documentos = [];

    public $temporalFile;
    public $temporalTipo = '';

    public array $fotos = [];
    public $temporalFotoFile; 

    public array $tiposDisponibles = [
        'Escrituras' => 'Escrituras Públicas',
        'Predial' => 'Boleta de Impuesto Predial',
        'Identificacion' => 'Identificación Oficial Propietario',
        'Plano' => 'Plano Arquitectónico / Poligonal',
        'Contrato' => 'Contrato de Exclusividad',
    ];

    protected array $rules = [
        'fraccionamiento'  => 'nullable|string|max:255',
        'asentamiento_id'  => 'required|exists:asentamientos,id',
        'tipo_vivienda_id' => 'required|exists:tipos_vivienda,id',
        'precio_lista'     => 'required|numeric|min:0',
        'recamaras'        => 'required|integer|min:0',
        'direccion'        => 'required|string',
        'llaves'           => 'required|boolean',
        'estatus_vivienda' => 'required|in:Disponible,Apartada,Vendida,Rentada,Mantenimiento,Suspendida',
        'creditos_ids'     => 'nullable|array',
        'amenidades_ids'   => 'nullable|array',
    ];

    public function mount($id)
    {
        if (!checkPermiso('viviendas.is_update')) abort(403);

        $this->asentamientos = AsentamientoEloquentModel::select('id', 'codigo_postal', 'nombre_asentamiento')->get();
        $this->tiposVivienda = TipoViviendaEloquentModel::select('id', 'nombre')->get();
        $this->creditosDisponibles = TipoCreditoEloquentModel::where('aplica_vivienda', true)->select('id', 'nombre')->get();
        $this->amenidadesDisponibles = AmenidadEloquentModel::select('id', 'nombre')->get();

        $model = ViviendaEloquentModel::with(['creditos', 'amenidades','contactos', 'documentos', 'fotos'])->findOrFail($id);
        $this->viviendaId = $model->id;
        $this->fraccionamiento = $model->fraccionamiento;
        $this->asentamiento_id = $model->asentamiento_id;
        $this->tipo_vivienda_id = $model->tipo_vivienda_id;
        $this->precio_lista = $model->precio_lista;
        $this->recamaras = $model->recamaras;
        $this->direccion = $model->direccion;
        $this->llaves = (bool)$model->llaves;
        $this->estatus_vivienda = $model->estatus_vivienda;
        
        $this->creditos_ids = $model->creditos->pluck('id')->map(fn($id) => (string)$id)->toArray();
        $this->amenidades_ids = $model->amenidades->pluck('id')->map(fn($id) => (string)$id)->toArray();

        $this->contactos = $model->contactos->map(function($c) {
            return [
                'id'       => $c->id, 
                'nombre'   => $c->nombre,
                'relacion' => $c->relacion,
                'telefono' => $c->telefono,
                'correo'   => $c->correo,
                'notes'    => $c->notes,
            ];
        })->toArray();

        $this->documentos = $model->documentos->map(function($d) {
            return [
                'id'              => $d->id, 
                'url'             => $d->url,
                'nombre_original' => $d->nombre_original,
                'tipo_documento'  => $d->tipo_documento,
                'peso_bytes'      => $d->peso_bytes,
                'verificado'      => (bool)$d->verificado,
            ];
        })->toArray();

        $this->fotos = $model->fotos->sortBy('orden')->map(function($f) {
            return [
                'id'              => $f->id,
                'url'             => $f->url,
                'nombre_original' => $f->nombre_original,
                'orden'           => $f->orden,
                'es_principal'    => (bool)$f->es_principal,
                'preview'         => null
            ];
        })->toArray();

        if (empty($this->contactos)) {
            $this->addContacto();
        }
        
    }

    public function addContacto()
    {
        $this->contactos[] = [
            'id'       => null, 
            'nombre'   => '', 
            'relacion' => '', 
            'telefono' => '', 
            'correo'   => '', 
            'notes'    => ''
        ];
    }

    public function removeContacto($index)
    {
        unset($this->contactos[$index]);
        $this->contactos = array_values($this->contactos);
    }

    public function addDocumento()
    {
        $this->validate([
            'temporalFile' => 'required|file|max:10240',
            'temporalTipo' => 'required|string',
        ]);

        $path = $this->temporalFile->store('viviendas/documentos', 'local');

        $this->documentos[] = [
            'id'              => null,
            'url'             => $path,
            'nombre_original' => $this->temporalFile->getClientOriginalName(),
            'tipo_documento'  => $this->temporalTipo,
            'peso_bytes'      => $this->temporalFile->getSize(),
            'verificado'      => false,
        ];

        $this->reset(['temporalFile', 'temporalTipo']);
    }

    public function removeDocumento($index)
    {
        if (isset($this->documentos[$index]['url'])) {
            Storage::disk('local')->delete($this->documentos[$index]['url']);
        }

        unset($this->documentos[$index]);
        $this->documentos = array_values($this->documentos);
    }

        public function addFoto()
    {
        $this->validate([
            'temporalFotoFile' => 'required|image|max:5120',
        ]);

        $path = $this->temporalFotoFile->store('viviendas/fotos', 'local');

        $esPrincipal = count($this->fotos) === 0;

        $this->fotos[] = [
            'id'              => null,
            'url'             => $path,
            'nombre_original' => $this->temporalFotoFile->getClientOriginalName(),
            'orden'           => count($this->fotos),
            'es_principal'    => $esPrincipal,
            'preview'         => $this->temporalFotoFile->temporaryUrl()
        ];

        $this->reset('temporalFotoFile');
    }

    public function setFotoPrincipal($index)
    {
        foreach ($this->fotos as $key => $foto) {
            $this->fotos[$key]['es_principal'] = ($key === $index);
        }
    }

    public function removeFoto($index)
    {
        if (isset($this->fotos[$index]['url'])) {
            \Illuminate\Support\Facades\Storage::disk('local')->delete($this->fotos[$index]['url']);
        }

        $fuePrincipal = $this->fotos[$index]['es_principal'];
        unset($this->fotos[$index]);
        $this->fotos = array_values($this->fotos);

        if ($fuePrincipal && count($this->fotos) > 0) {
            $this->fotos[0]['es_principal'] = true;
        }
    }

    public function save(
        SaveViviendaUseCase $useCase, 
        SaveViviendaContactosUseCase $contactosUseCase,
        SaveViviendaDocumentosUseCase $documentosUseCase,
        SaveViviendaFotosUseCase $fotosUseCase
    ) {
        $this->validate();

        $useCase->execute([
            'id'               => $this->viviendaId,
            'fraccionamiento'  => $this->fraccionamiento,
            'asentamiento_id'  => $this->asentamiento_id,
            'tipo_vivienda_id' => $this->tipo_vivienda_id,
            'precio_lista'     => $this->precio_lista,
            'recamaras'        => $this->recamaras,
            'direccion'        => $this->direccion,
            'llaves'           => (bool)$this->llaves,
            'estatus_vivienda' => $this->estatus_vivienda,
            'creditos_ids'     => $this->creditos_ids,
            'amenidades_ids'   => $this->amenidades_ids,
        ]);

        $contactosUseCase->execute($this->viviendaId, $this->contactos);
        $documentosUseCase->execute($this->viviendaId, $this->documentos);
        $fotosUseCase->execute($this->viviendaId, $this->fotos);

        session()->flash('success', 'Ficha de la propiedad actualizada correctamente.');
        return redirect()->route('viviendas.index');
    }

    public function render()
    {
        return view('viviendas::edit')
            ->layout('shared::layouts.app')
            ->title('Modificar Inmueble');
    }
}