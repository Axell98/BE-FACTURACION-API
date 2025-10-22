<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadesMedida extends Model
{
    protected $table = 'unidades_medida';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'codigo_sunat',
        'descripcion',
        'simbolo',
        'activo',
    ];
    public $incrementing = true;
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'activo' => 'boolean'
        ];
    }
}
