<?php

namespace App\Models;

use App\Enums\DatosEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{
    use SoftDeletes;

    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'codigo_int',
        'razon_social',
        'nombre_comercial',
        'tipo_doc',
        'nume_doc',
        'ruc',
        'telefono',
        'celular',
        'email',
        'direccion',
        'ubigeo',
        'contacto',
        'web',
        'cuenta_detraccion',
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

    public static function listarClientes(array $params)
    {
        $query = self::query()
            ->select([
                'clientes.id',
                'clientes.codigo_int',
                'clientes.razon_social',
                'clientes.nombre_comercial',
                'clientes.tipo_doc',
                'dd.descripcion as tipo_doc_des',
                'clientes.nume_doc',
                'clientes.ruc',
                'clientes.telefono',
                'clientes.celular',
                'clientes.email',
                'clientes.direccion',
                'clientes.ubigeo',
                DB::raw("case when coalesce(clientes.ubigeo, '') <> '' then concat(e.nombre, ' - ', trim(p.nombre), ' - ', d.nombre) else null end as ubigeo_des"),
                'clientes.empresa',
                'clientes.activo',
                'clientes.created_by',
                'clientes.created_at'
            ])
            ->leftJoin('distritos as d', 'd.id', '=', 'clientes.ubigeo')
            ->leftJoin('provincias as p', 'p.id', '=', 'd.provincia_id')
            ->leftJoin('departamentos as e', 'e.id', '=', 'd.departamento_id')
            ->leftJoin('datos_det as dd', function ($join) {
                $join->on('dd.id_det', '=', 'clientes.tipo_doc')
                    ->where('dd.id_cab', DatosEnum::TIPOS_DOCUMENTOS_IDENTIDAD->value);
            })
            ->orderByDesc('clientes.created_at');
        $result = $query->get();
        return $result->toArray();
    }
}
