<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tipo_cliente',
        'nombres',
        'apellidos',
        'razon_social',
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

    public static function getData(array $params = [])
    {
        $query = self::select('*');
        $result = $query->get();
        return $result->toArray();
    }

    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
