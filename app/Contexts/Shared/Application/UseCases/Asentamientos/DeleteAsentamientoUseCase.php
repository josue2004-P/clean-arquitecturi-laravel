<?php

namespace App\Contexts\Shared\Application\UseCases\Asentamientos;

use App\Contexts\Shared\Infrastructure\LaravelModels\AsentamientoEloquentModel;

class DeleteAsentamientoUseCase
{
    public function execute(int $id): void
    {
        $model = AsentamientoEloquentModel::findOrFail($id);
        $model->delete();
    }
}