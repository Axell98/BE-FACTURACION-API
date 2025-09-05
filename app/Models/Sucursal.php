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
        'abreviatura',
    ];
    public $incrementing = false;
    public $timestamps = false;
}
