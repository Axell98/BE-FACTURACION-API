<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use SoftDeletes;

    protected $table = 'proveedores';
    protected $primaryKey = 'id';
    protected $fillable = [
        'codigo_int',
        'razon_social',
        'nombre_comercial',
        'tipo_doc',
        'nume_doc',
        'telefono',
        'celular',
        'email',
        'direccion',
        'ubigeo',
        'contacto',
        'web',
        'empresa',
        'activo',
        'agente_retencion',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $hidden = [
        'deleted_at',
        'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'agente_retencion' => 'boolean'
        ];
    }

    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function listarProveedores(array $params)
    {
        $query = self::select();
    }
}
