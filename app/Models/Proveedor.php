<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use SoftDeletes;

    protected $table = 'proveedores';
    protected $primaryKey = 'id';


    protected $hidden = [
        'deleted_at',
        'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'activo' => 'boolean'
        ];
    }
}
