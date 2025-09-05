<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
