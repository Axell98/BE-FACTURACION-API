<?php

namespace App\Models;

use App\Enums\DatosEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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

    public static function listProveedores(array $params = [])
    {
        $query = self::select([
            'proveedores.*',
            'dd.descripcion as tipo_doc_des',
            DB::raw("fun_get_ubigeo_descripcion(proveedores.ubigeo) as ubigeo_des")
        ])
            ->leftJoin('datos_det as dd', function ($join) {
                $join->on('dd.id_det', '=', 'proveedores.tipo_doc')
                    ->where('dd.id_cab', DatosEnum::TIPOS_DOCUMENTOS_IDENTIDAD->value);
            })
            ->orderByDesc('proveedores.created_at');
        $result = $query->get();
        return $result;
    }
}
