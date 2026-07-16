<?php

namespace App\Contexts\Clientes\Infrastructure\LaravelModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClienteReferenciaEloquentModel extends Model
{
    protected $table = 'cliente_referencias';

    protected $fillable = ['cliente_id', 'nombre', 'celular', 'parentesco', 'asentamiento_id', 'calle_numero'];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(ClienteEloquentModel::class, 'cliente_id');
    }
}