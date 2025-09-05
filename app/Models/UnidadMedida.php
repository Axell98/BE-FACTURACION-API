<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    protected $table = 'medidas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nombre',
        'abreviatura',
    ];
}
