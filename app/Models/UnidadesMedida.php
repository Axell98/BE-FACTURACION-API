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
        'created_by',
        'updated_by'
    ];
    public $incrementing = true;

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
}
