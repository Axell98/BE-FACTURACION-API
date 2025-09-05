<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoComprobante extends Model
{
    protected $table = 'tipos_comprobantes';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    
    protected function casts(): array
    {
        return [
            'activo' => 'boolean'
        ];
    }
}
