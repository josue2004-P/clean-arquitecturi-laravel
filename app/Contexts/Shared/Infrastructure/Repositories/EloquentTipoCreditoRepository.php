<?php

namespace App\Contexts\Shared\Infrastructure\Repositories;

use App\Contexts\Shared\Domain\Entities\TipoCredito;
use App\Contexts\Shared\Domain\Repositories\TipoCreditoRepositoryInterface;
use App\Contexts\Shared\Infrastructure\LaravelModels\TipoCreditoEloquentModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentTipoCreditoRepository implements TipoCreditoRepositoryInterface
{
    public function create(TipoCredito $tipoCredito): void
    {
        TipoCreditoEloquentModel::create($tipoCredito->toArray());
    }

    public function update(int $id, array $data): void
    {
        $model = TipoCreditoEloquentModel::findOrFail($id);
        $model->update($data);
    }

    public function delete(int $id): void
    {
        $model = TipoCreditoEloquentModel::findOrFail($id);
        $model->delete();
    }

    public function paginateWithSearch(?string $search, int $perPage): LengthAwarePaginator
    {
        return TipoCreditoEloquentModel::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nombre', 'like', '%' . $search . '%')
                    ->orWhere('descripcion', 'like', '%' . $search . '%');
            })
            ->paginate($perPage);
    }
}