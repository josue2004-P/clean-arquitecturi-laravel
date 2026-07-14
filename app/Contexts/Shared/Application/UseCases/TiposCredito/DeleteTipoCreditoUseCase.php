<?php
namespace App\Contexts\Shared\Application\UseCases\TiposCredito;

use App\Contexts\Shared\Domain\Repositories\TipoCreditoRepositoryInterface;

class DeleteTipoCreditoUseCase
{
    public function __construct(private TipoCreditoRepositoryInterface $repository) {}

    public function execute(int $id): void
    {
        $this->repository->delete($id);
    }
}