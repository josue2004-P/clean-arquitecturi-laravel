<?php

namespace App\Contexts\Clientes\Infrastructure\LaravelModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClienteTelefonoEloquentModel extends Model
{
    protected $table = 'cliente_telefonos';

    protected $fillable = ['cliente_id', 'telefono', 'tipo_telefono'];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(ClienteEloquentModel::class, 'cliente_id');
    }
}