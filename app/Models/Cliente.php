<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $table = 'cliente';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'nombre_comercial',
        'tipo_doc',
        'nume_doc',
        'ruc',
        'telefono',
        'celular',
        'email',
        'direccion',
        'ubigeo',
        'empresa',
        'activo'
    ];

    protected $hidden = [
        'deleted_at',
        'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'activo' => 'boolean'
        ];
    }

    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
