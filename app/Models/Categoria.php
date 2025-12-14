<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;
    
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'activo',
        'created_by',
        'updated_by',
        'deleted_by'
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
