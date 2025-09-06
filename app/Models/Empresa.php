<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Empresa extends Model
{
    protected $table = 'empresas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ruc',
        'razon_social',
        'nombre_comercial',
        'direccion',
        'telefono',
        'celular',
        'ubigeo',
        'pais',
        'selva_bienes',
        'selva_servicios',
        'igv',
        'icbper',
        'logo_url',
        'sunat_client_id',
        'sunat_secret_id',
        'key_publica',
        'key_privada',
        'cert_test_url',
        'cert_prod_url',
        'modo_prueba',
        'created_by',
        'updated_at'
    ];

    protected $hidden = [
        'key_publica',
        'key_privada',
        'sunat_client_id',
        'cert_prod_url',
        'cert_test_url',
        'sunat_secret_id'
    ];

    protected function casts(): array
    {
        return [
            'modo_prueba' => 'boolean',
        ];
    }

    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public static function list()
    {
        $query = self::select([
            'e.id',
            'e.ruc',
            'e.razon_social',
            'e.nombre_comercial',
            'e.direccion',
            'e.telefono',
            'e.celular',
            'e.ubigeo',
            'd.id as departamento_id',
            'd.nombre as departamento_des',
            'p.id as provincia_id',
            'p.nombre as provincia_des',
            'd1.id as distrito_id',
            'd1.nombre as distrito_des',
            'e.pais',
            'e.selva_bienes',
            'e.selva_servicios',
            'e.igv',
            'e.icbper',
            DB::raw("case when coalesce(e.logo_url, '') <> '' then concat('" . env('APP_URL') . "', e.logo_url) else null end as logo_url"),
            'e.modo_prueba',
            'e.created_by',
            'e.created_at',
            'e.updated_by',
            'e.updated_at'
        ])
            ->from('empresas as e')
            ->leftJoin('departamentos as d', 'd.id', '=', DB::raw("SUBSTRING(e.ubigeo, 1, 2)"))
            ->leftJoin('provincias as p', 'p.id', '=', DB::raw("SUBSTRING(e.ubigeo, 1, 4)"))
            ->leftJoin('distritos as d1', 'd1.id', '=', 'e.ubigeo');
        $result = $query->get();
        return $result;
    }

    public static function getEmpresasAsig(array $empresas = [])
    {
        $query = self::select('id', 'ruc', 'razon_social', DB::raw("case when coalesce(logo_url, '') <> '' then concat('" . env('APP_URL') . "', logo_url) else null end as logo_url"),);
        if (!is_super_admin()) {
            $query->whereIn($empresas);
        }
        $result = $query->get();
        return $result->toArray();
    }
}
