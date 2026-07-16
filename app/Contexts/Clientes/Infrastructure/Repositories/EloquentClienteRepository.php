<?php

namespace App\Contexts\Clientes\Infrastructure\Repositories;

use App\Contexts\Clientes\Domain\Entities\Cliente;
use App\Contexts\Clientes\Domain\Entities\ClienteTelefono;
use App\Contexts\Clientes\Domain\Repositories\ClienteRepositoryInterface;
use App\Contexts\Clientes\Infrastructure\LaravelModels\ClienteEloquentModel;
use DateTime;

class EloquentClienteRepository implements ClienteRepositoryInterface
{
    public function getAll(): array
    {
        $modelos = ClienteEloquentModel::all();
        $clientes = [];

        foreach ($modelos as $modelo) {
            $clientes[] = $this->toEntity($modelo);
        }

        return $clientes;
    }

    public function findById(int $id): ?Cliente
    {
        $modelo = ClienteEloquentModel::with(['zonasInteres', 'telefonos'])->find($id);
        
        if (!$modelo) {
            return null;
        }

        return $this->toEntity($modelo);
    }

public function save(Cliente $cliente): Cliente
    {
        return \Illuminate\Support\Facades\DB::transaction(function () use ($cliente) {
            $modelo = new ClienteEloquentModel();
            $modelo = $this->fillModel($modelo, $cliente);
            $modelo->save();

            // Altas iniciales de teléfonos
            foreach ($cliente->getTelefonos() as $tel) {
                $modelo->telefonos()->create([
                    'telefono'      => $tel->getTelefono(),
                    'tipo_telefono' => $tel->getTipoTelefono() ?? 'Celular',
                ]);
            }

            $modelo->zonasInteres()->sync($cliente->getZonasInteres());

            return $this->toEntity($modelo->load(['telefonos', 'zonasInteres']));
        });
    }

    public function update(int $id, Cliente $cliente): Cliente
    {
        return \Illuminate\Support\Facades\DB::transaction(function () use ($id, $cliente) {
            $modelo = ClienteEloquentModel::findOrFail($id);
            $modelo = $this->fillModel($modelo, $cliente);
            $modelo->save();

            $telefonosDominio = $cliente->getTelefonos();
            
            $telefonosArray = array_map(fn($t) => $t->toArray(), $telefonosDominio);

            $telefonosValidos = array_filter($telefonosArray, function ($t) {
                return !empty($t['telefono']);
            });

            $idsEnviados = array_filter(array_column($telefonosValidos, 'id'));

            $modelo->telefonos()->whereNotIn('id', $idsEnviados)->delete();

            foreach ($telefonosValidos as $datos) {
                $payload = [
                    'telefono'      => $datos['telefono'],
                    'tipo_telefono' => $datos['tipo_telefono'] ?? 'Celular',
                ];

                if (!empty($datos['id'])) {
                    $modelo->telefonos()->where('id', $datos['id'])->update($payload);
                } else {
                    $modelo->telefonos()->create($payload);
                }
            }

            $modelo->zonasInteres()->sync($cliente->getZonasInteres());

            return $this->toEntity($modelo->load(['telefonos', 'zonasInteres']));
        });
    }

    public function delete(int $id): bool
    {
        $modelo = ClienteEloquentModel::find($id);
        
        if (!$modelo) {
            return false;
        }

        return (bool) $modelo->delete();
    }
    
    /**
     * Mapea un modelo Eloquent a una Entidad de Dominio limpia.
     */
    private function toEntity(ClienteEloquentModel $modelo): Cliente
    {

        $telefonosDominio = $modelo->telefonos->map(function ($tel) {
            return new ClienteTelefono(
                id: $tel->id,
                clienteId: $tel->cliente_id,
                telefono: $tel->telefono,
                tipoTelefono: $tel->tipo_telefono
            );
        })->toArray();

        return new Cliente(
            id: $modelo->id,
            nombre: $modelo->nombre,
            apellidoPaterno: $modelo->apellido_paterno,
            apellidoMaterno: $modelo->apellido_materno,
            fechaNacimiento: $modelo->fecha_nacimiento ? new DateTime($modelo->fecha_nacimiento) : null,
            rfc: $modelo->rfc,
            curp: $modelo->curp,
            asentamientoId: $modelo->asentamiento_id,
            calleNumero: $modelo->calle_numero,
            nss: $modelo->nss,
            correoInfonavit: $modelo->correo_infonavit,
            contrasenaInfonavit: $modelo->contrasena_infonavit,
            tipoCreditoId: $modelo->tipo_redito_id,
            precalificacion: (float) $modelo->precalificacion,
            avaluoSolicitado: $modelo->avaluo_solicitado,
            estadoCivil: $modelo->estado_civil,
            regimenCasamiento: $modelo->regimen_casamiento,
            telefonos: $telefonosDominio,
            referencias: [],
            documentos: [],
            zonasInteres: $modelo->zonasInteres->pluck('id')->toArray()
        );
    }

    /**
     * Pasa los datos de la Entidad al modelo Eloquent para persistencia.
     */
    private function fillModel(ClienteEloquentModel $modelo, Cliente $entidad): ClienteEloquentModel
    {
        $modelo->nombre = $entidad->getNombre();
        $modelo->apellido_paterno = $entidad->getApellidoPaterno();
        $modelo->apellido_materno = $entidad->getApellidoMaterno();
        $modelo->fecha_nacimiento = $entidad->getFechaNacimiento()?->format('Y-m-d');
        $modelo->rfc = $entidad->getRfc();
        $modelo->curp = $entidad->getCurp();
        $modelo->asentamiento_id = $entidad->getAsentamientoId();
        $modelo->calle_numero = $entidad->getCalleNumero();
        $modelo->nss = $entidad->getNss();
        $modelo->correo_infonavit = $entidad->getCorreoInfonavit();
        $modelo->contrasena_infonavit = $entidad->getContrasenaInfonavit();
        $modelo->tipo_redito_id = $entidad->getTipoCreditoId();
        $modelo->precalificacion = $entidad->getPrecalificacion();
        $modelo->avaluo_solicitado = $entidad->getAvalaoSolicitado();
        $modelo->estado_civil = $entidad->getEstadoCivil();
        $modelo->regimen_casamiento = $entidad->getRegimenCasamiento();

        return $modelo;
    }
}