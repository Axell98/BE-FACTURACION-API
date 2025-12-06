<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
        ];
    }

    public static function menuPermisos($role)
    {
        $query = self::select([
            'm.id',
            'm.id_pad',
            'm.nombre',
            'm.orden',
            'm.permission_name',
            DB::raw("(select 1 from menus_role mr where mr.id_menu as m.id and mr.id_role = $role) as activado")
        ])
            ->from('menus as m')
            ->whereRaw('m.activo = true')
            ->orderBy('m.orden');
        die($query->toRawSql());
        $result = $query->get();
        foreach ($result as $value) {
        }
        // $result = self::reformatMenu($query->get());
        $result = $query->get();
        return $result;
    }

    public static function userMenu(array $permissions)
    {
        $query = self::select([
            'm.id',
            'm.id_pad',
            'm.nombre',
            'm.url',
            'm.icono',
            'm.orden',
            DB::raw("false as activo")
        ])
            ->from('menus as m')
            ->whereRaw('m.activo = true');
        if (!isSuperAdmin()) {
            $query->where(function ($q) use ($permissions) {
                $q->whereIn('m.permission_name', $permissions)
                    ->orWhereIn('m.id', function ($subQuery) use ($permissions) {
                        $subQuery->select('id_pad')
                            ->from('menus')
                            ->whereIn('permission_name', $permissions)
                            ->whereNotNull('id_pad');
                    });
            });
        }
        $query->orderBy('m.orden');
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
