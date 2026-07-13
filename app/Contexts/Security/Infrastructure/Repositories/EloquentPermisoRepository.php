<?php
namespace App\Contexts\Security\Infrastructure\Repositories;

use App\Contexts\Security\Domain\Repositories\PermisoRepositoryInterface;
use App\Contexts\Security\Infrastructure\LaravelModels\PermisoEloquentModel;

class EloquentPermisoRepository implements PermisoRepositoryInterface
{
    public function all(): array
    {
        return PermisoEloquentModel::all()->toArray();
    }

    public function paginateWithSearch(string $search, int $perPage)
    {
        return \App\Contexts\Security\Infrastructure\LaravelModels\PermisoEloquentModel::where('nombre', 'like', '%'.$search.'%')
            ->paginate($perPage);
    }

    public function findById(int $id): ?array
    {
        $model = PermisoEloquentModel::find($id);
        return $model ? $model->toArray() : null;
    }

    public function existsWithNombre(string $nombre, ?int $exceptId = null): bool
    {
        $query = PermisoEloquentModel::where('nombre', $nombre);
        if ($exceptId) {
            $query->where('id', '!=', $exceptId);
        }
        return $query->exists();
    }

    public function save(array $data): void
    {
        PermisoEloquentModel::create($data);
    }

    public function update(int $id, array $data): void
    {
        PermisoEloquentModel::where('id', $id)->update($data);
    }

    public function delete(int $id): void
    {
        PermisoEloquentModel::where('id', $id)->delete();
    }
}