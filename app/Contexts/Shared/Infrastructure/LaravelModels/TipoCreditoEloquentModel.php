<?php

namespace App\Contexts\Shared\Infrastructure\LaravelModels;

use Illuminate\Database\Eloquent\Model;

class TipoCreditoEloquentModel extends Model
{
    protected $table = 'tipos_credito';

    protected $fillable = [
        'nombre',
        'descripcion',
        'aplica_vivienda',
        'aplica_cliente',
    ];

    protected $casts = [
        'aplica_vivienda' => 'boolean',
        'aplica_cliente'  => 'boolean',
    ];
}