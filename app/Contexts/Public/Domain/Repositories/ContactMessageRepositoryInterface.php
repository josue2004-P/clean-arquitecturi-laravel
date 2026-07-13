<?php

namespace App\Contexts\Public\Domain\Repositories;

interface ContactMessageRepositoryInterface
{
    public function save(array $data): void;
}