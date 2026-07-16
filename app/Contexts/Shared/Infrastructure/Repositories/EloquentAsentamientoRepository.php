<?php

namespace App\Contexts\Shared\Infrastructure\Repositories;

use App\Contexts\Shared\Domain\Entities\Asentamiento;
use App\Contexts\Shared\Domain\Repositories\AsentamientoRepositoryInterface;
use App\Contexts\Shared\Infrastructure\LaravelModels\AsentamientoEloquentModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentAsentamientoRepository implements AsentamientoRepositoryInterface
{

    public function all(): array
    {
        $models = AsentamientoEloquentModel::orderBy('nombre_asentamiento', 'asc')->get();

        return $models->map(function ($model) {
            return new Asentamiento(
                $model->id,
                $model->codigo_postal,
                $model->estado,
                $model->municipio,
                $model->tipo_asentamiento,
                $model->nombre_asentamiento,
                $model->ciudad
            );
        })->toArray();
    }
    
    public function findByCodigoPostal(string $codigoPostal): array
    {
        $models = AsentamientoEloquentModel::where('codigo_postal', $codigoPostal)->get();

        return $models->map(function ($model) {
            return new Asentamiento(
                $model->id,
                $model->codigo_postal,
                $model->estado,
                $model->municipio,
                $model->tipo_asentamiento,
                $model->nombre_asentamiento,
                $model->ciudad
            );
        })->toArray();
    }

    public function create(Asentamiento $asentamiento): void
    {
        AsentamientoEloquentModel::create($asentamiento->toArray());
    }

    public function bulkInsert(array $asentamientos): void
    {
        AsentamientoEloquentModel::insert($asentamientos);
    }

    public function paginateWithSearch(?string $search, int $perPage): LengthAwarePaginator
    {
        return AsentamientoEloquentModel::query()
            ->when($search, function ($query) use ($search) {
                $query->where('codigo_postal', 'like', '%' . $search . '%')
                    ->orWhere('nombre_asentamiento', 'like', '%' . $search . '%')
                    ->orWhere('municipio', 'like', '%' . $search . '%')
                    ->orWhere('estado', 'like', '%' . $search . '%');
            })
            ->paginate($perPage);
    }
}