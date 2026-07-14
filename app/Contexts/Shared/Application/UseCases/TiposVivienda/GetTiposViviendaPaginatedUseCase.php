<?php
namespace App\Contexts\Shared\Application\UseCases\TiposVivienda;

use App\Contexts\Shared\Domain\Repositories\TipoViviendaRepositoryInterface;

class GetTiposViviendaPaginatedUseCase {
    public function __construct(private TipoViviendaRepositoryInterface $rep) {}
    public function execute(?string $s, int $p) { return $this->rep->paginateWithSearch($s, $p); }
}