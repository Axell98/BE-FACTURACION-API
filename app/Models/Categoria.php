<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{   
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nombre',
        'activo'
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
}
