<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nombre',
        'direccion',
        'ubigeo'
    ];
    public $incrementing = false;
    public $timestamps = false;

    public function listarSucursales(array $params = [])
    {
        $query = self::select();
        $result = $query->get();
        return $result;
    }
}
