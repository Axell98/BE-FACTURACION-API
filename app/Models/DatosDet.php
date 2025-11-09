<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatosDet extends Model
{

    protected $table = 'datos_det';
    protected $primaryKey = null;
    protected $fillable = [
        'cabcod',
        'detcod',
        'descripcion',
        'orden',
        'activo'
    ];
    public $incrementing = false;
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'orden' => 'integer',
            'activo' => 'boolean'
        ];
    }

    public static function createCab(array $data)
    {
        DB::table('datos_cab')->insert([
            'id' => $data['id'],
            'descripcion' => $data['descripcion']
        ]);
    }
}
