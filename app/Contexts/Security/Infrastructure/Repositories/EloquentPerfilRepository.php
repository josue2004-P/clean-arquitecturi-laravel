<?php

namespace App\Contexts\Security\Infrastructure\Repositories;

use App\Contexts\Security\Domain\Repositories\PerfilRepositoryInterface;
use App\Contexts\Security\Infrastructure\LaravelModels\PerfilEloquentModel;

class EloquentPerfilRepository implements PerfilRepositoryInterface
{
    public function paginateWithSearch(string $search, int $perPage)
    {
        return PerfilEloquentModel::where('nombre', 'like', '%' . $search . '%')
            ->withCount('usuarios')
            ->paginate($perPage);
    }

    public function findById(int $id): ?array
    {
        $model = PerfilEloquentModel::find($id);
        return $model ? $model->toArray() : null;
    }

    public function findWithPermisos(int $id)
    {
        return PerfilEloquentModel::with('permisos')->findOrFail($id);
    }

    public function existsWithNombre(string $nombre, ?int $exceptId = null): bool
    {
        $query = PerfilEloquentModel::where('nombre', $nombre);
        if ($exceptId) {
            $query->where('id', '!=', $exceptId);
        }
        return $query->exists();
    }

    public function save(array $data): void
    {
        PerfilEloquentModel::create($data);
    }

    public function update(int $id, array $data, array $permisosMatrix = []): void
    {
        $perfil = PerfilEloquentModel::findOrFail($id);
        $perfil->update($data);

        // Procesar y sincronizar la matriz de pivotes
        $syncData = [];
        foreach ($permisosMatrix as $permisoId => $acciones) {
            $syncData[$permisoId] = [
                'is_read'   => (bool)($acciones['is_read'] ?? false),
                'is_create' => (bool)($acciones['is_create'] ?? false),
                'is_update' => (bool)($acciones['is_update'] ?? false),
                'is_delete' => (bool)($acciones['is_delete'] ?? false),
            ];
        }
        $perfil->permisos()->sync($syncData);
    }

    public function delete(int $id): void
    {
        PerfilEloquentModel::where('id', $id)->delete();
    }
}