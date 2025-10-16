<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{
    use SoftDeletes;

    protected $table = 'clientes';
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
        'codigo_int',
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
                'cliente.id',
                'cliente.nombre',
                'cliente.nombre_comercial',
                'cliente.tipo_doc',
                't.descripcion as tipo_doc_des',
                'cliente.nume_doc',
                'cliente.ruc',
                'cliente.telefono',
                'cliente.celular',
                'cliente.email',
                'cliente.direccion',
                'cliente.ubigeo',
                DB::raw("case when coalesce(cliente.ubigeo, '') <> '' then concat(e.nombre, ' - ', trim(p.nombre), ' - ', d.nombre) else null end as ubigeo_des"),
                'cliente.empresa',
                'cliente.activo',
                'cliente.created_by',
                'cliente.created_at'
            ])
            ->leftJoin('tipo_documento as t', 't.id', '=', 'cliente.tipo_doc')
            ->leftJoin('distritos as d', 'd.id', '=', 'cliente.ubigeo')
            ->leftJoin('provincias as p', 'p.id', '=', 'd.provincia_id')
            ->leftJoin('departamentos as e', 'e.id', '=', 'd.departamento_id')
            ->orderByDesc('cliente.created_at');
        // die($query->toRawSql());
        $result = $query->get();
        return $result;
    }
}
