<?php
namespace App\Contexts\Shared\Application\UseCases\TiposVivienda;

use App\Contexts\Shared\Domain\Repositories\TipoViviendaRepositoryInterface;

class DeleteTipoViviendaUseCase {
    public function __construct(private TipoViviendaRepositoryInterface $rep) {}
    public function execute(int $id) { $this->rep->delete($id); }
}