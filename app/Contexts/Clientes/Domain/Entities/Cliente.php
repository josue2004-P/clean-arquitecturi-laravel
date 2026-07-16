<?php

namespace App\Contexts\Clientes\Domain\Entities;

use DateTime;

class Cliente
{
    public function __construct(
        private ?int $id,
        private string $nombre,
        private string $apellidoPaterno,
        private string $apellidoMaterno,
        private ?DateTime $fechaNacimiento,
        private ?string $rfc,
        private ?string $curp,
        private ?int $asentamientoId,
        private ?string $calleNumero,
        private ?string $nss,
        private ?string $correoInfonavit,
        private ?string $contrasenaInfonavit,
        private ?int $tipoCreditoId,
        private float $precalificacion,
        private string $avaluoSolicitado,
        private ?string $estadoCivil,
        private ?string $regimenCasamiento,
        private array $telefonos = [],   
        private array $referencias = [],  
        private array $documentos = [],   
        private array $zonasInteres = []  
    ) {}

    public function getId(): ?int 
    { 
        return $this->id; 
    }

    public function getNombreCompleto(): string 
    {
        return "{$this->nombre} {$this->apellidoPaterno} {$this->apellidoMaterno}";
    }

    public function getNombre(): string 
    { 
        return $this->nombre; 
    }

    public function getApellidoPaterno(): string 
    { 
        return $this->apellidoPaterno; 
    }

    public function getApellidoMaterno(): string 
    { 
        return $this->apellidoMaterno; 
    }

    public function getFechaNacimiento(): ?DateTime 
    { 
        return $this->fechaNacimiento; 
    }

    public function getRfc(): ?string 
    { 
        return $this->rfc; 
    }

    public function getCurp(): ?string 
    { 
        return $this->curp; 
    }

    public function getAsentamientoId(): ?int 
    { 
        return $this->asentamientoId; 
    }

    public function getCalleNumero(): ?string 
    { 
        return $this->calleNumero; 
    }

    public function getNss(): ?string 
    { 
        return $this->nss; 
    }

    public function getCorreoInfonavit(): ?string 
    { 
        return $this->correoInfonavit; 
    }

    public function getContrasenaInfonavit(): ?string 
    { 
        return $this->contrasenaInfonavit; 
    }

    public function getTipoCreditoId(): ?int 
    { 
        return $this->tipoCreditoId; 
    }

    public function getPrecalificacion(): float 
    { 
        return $this->precalificacion; 
    }

    public function getAvalaoSolicitado(): string 
    { 
        return $this->avaluoSolicitado; 
    }

    public function getEstadoCivil(): ?string 
    { 
        return $this->estadoCivil; 
    }

    public function getRegimenCasamiento(): ?string 
    { 
        return $this->regimenCasamiento; 
    }
    
    public function getTelefonos(): array 
    { 
        return $this->telefonos; 
    }

    public function getReferencias(): array 
    { 
        return $this->referencias; 
    }

    public function getDocumentos(): array 
    { 
        return $this->documentos; 
    }

    public function getZonasInteres(): array 
    { 
        return $this->zonasInteres; 
    }
}