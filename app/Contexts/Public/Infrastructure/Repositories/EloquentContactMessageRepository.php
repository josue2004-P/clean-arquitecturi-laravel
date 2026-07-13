<?php

namespace App\Contexts\Public\Infrastructure\Repositories;

use App\Contexts\Public\Domain\Repositories\ContactMessageRepositoryInterface;
use App\Contexts\Public\Infrastructure\LaravelModels\ContactMessageEloquentModel;

class EloquentContactMessageRepository implements ContactMessageRepositoryInterface
{
    public function save(array $data): void
    {
        ContactMessageEloquentModel::create($data);
    }
}