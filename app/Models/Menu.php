<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
        ];
    }

    public static function userMenu($role)
    {
        $query = self::select(['m.*'])
            ->from('menu as m')
            ->whereRaw('m.activo = true')
            ->orderBy('m.orden');
        if (!is_super_admin()) {
            $query->join('menu_role as mr', function ($join) use ($role) {
                $join->on('mr.id_menu', '=', 'm.id')
                    ->on('mr.id_role', '=', DB::raw($role));
            });
        }
        $result = self::reformatMenu($query->get());
        return $result;
    }

    private static function reformatMenu($dataset, $menuPad = null)
    {
        $dataAux = $dataset->filter(function ($menu) use ($menuPad) {
            return $menu['id_pad'] == $menuPad;
        });
        foreach ($dataAux as $menu) {
            $menu['submenus'] = self::reformatMenu($dataset, $menu['id']);
        }
        return $dataAux->values()->toArray();
    }
}
