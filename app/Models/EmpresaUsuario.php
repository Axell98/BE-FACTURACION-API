<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmpresaUsuario extends Model
{
    protected $table = 'empresas_usuario';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_empresa',
        'id_usuario',
        'default'
    ];
    public $incrementing = false;
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'default' => 'boolean',
        ];
    }

    public static function getEmpresas(int $userId)
    {
        $query = self::select([
            'e.id',
            'e.ruc',
            'e.razon_social',
            DB::raw("case when coalesce(e.logo_url, '') <> '' then concat('" . env('APP_URL') . "', e.logo_url) else null end as logo_url"),
        ])
            ->from('empresas as e');
        if (!is_super_admin()) {
            $query->join('empresa_usuario as eu', 'eu.id_empresa', '=', 'e.id')
                ->where('eu.id_usuario', $userId)
                ->orderByDesc('eu.default');
        }
        $result = $query->get();
        return $result->toArray();
    }
}
