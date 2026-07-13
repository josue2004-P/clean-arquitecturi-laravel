<?php
namespace App\Contexts\Security\Infrastructure\LaravelModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PermisoEloquentModel extends Model
{
    use HasFactory;

    protected $table = 'permisos';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function perfiles(): BelongsToMany
    {
        return $this->belongsToMany(PerfilEloquentModel::class, 'perfil_permiso', 'permiso_id', 'perfil_id')
                    ->withPivot(['is_read', 'is_create', 'is_update', 'is_delete'])
                    ->withTimestamps();
    }
}