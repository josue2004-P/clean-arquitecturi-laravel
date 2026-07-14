<?php

namespace App\Contexts\Shared\Domain\Entities;

class TipoCredito
{
    public function __construct(
        private ?int $id,
        private string $nombre,
        private ?string $descripcion,
        private bool $aplicaVivienda,
        private bool $aplicaCliente,
        private ?string $createdAt = null,
        private ?string $updatedAt = null
    ) {}

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getNombre(): string { return $this->nombre; }
    public function getDescripcion(): ?string { return $this->descripcion; }
    public function aplicaVivienda(): bool { return $this->aplicaVivienda; }
    public function aplicaCliente(): bool { return $this->aplicaCliente; }

    public function toArray(): array
    {
        return [
            'id'              => $this->id,
            'nombre'          => $this->nombre,
            'descripcion'     => $this->descripcion,
            'aplica_vivienda' => $this->aplicaVivienda,
            'aplica_cliente'  => $this->aplicaCliente,
        ];
    }
}