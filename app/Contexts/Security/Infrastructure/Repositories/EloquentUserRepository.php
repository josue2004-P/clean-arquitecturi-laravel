<?php

namespace App\Contexts\Security\Infrastructure\Repositories;

use App\Contexts\Security\Domain\Repositories\UserRepositoryInterface;
use App\Contexts\Security\Infrastructure\LaravelModels\UserEloquentModel;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function paginateWithSearch(string $search, int $perPage)
    {
        return UserEloquentModel::where('name', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%')
            ->with('perfiles')
            ->paginate($perPage);
    }

    public function findById(int $id): ?array
    {
        $model = UserEloquentModel::find($id);
        return $model ? $model->toArray() : null;
    }

    public function findWithPerfiles(int $id)
    {
        return UserEloquentModel::with('perfiles')->findOrFail($id);
    }

    public function save(array $data): void
    {
        UserEloquentModel::create($data);
    }

    public function update(int $id, array $data, array $perfiles = []): void
    {
        $user = UserEloquentModel::findOrFail($id);
        
        $user->update($data);
        
        if (!empty($perfiles)) {
            $user->perfiles()->sync($perfiles);
        } elseif (isset($data['perfiles'])) {
            $user->perfiles()->sync($data['data']['perfiles']);
        } else {
        }
    }

    public function delete(int $id): void
    {
        UserEloquentModel::where('id', $id)->delete();
    }
}