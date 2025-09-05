<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\MenuRole;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $data = Role::where('name', '!=', 'super-admin')->get()->toArray();
        $message = !empty($data) ? 'Data found' : 'Data not found';
        $formatted = array_map(function ($item) {
            $item['created_at'] = (new \DateTime($item['created_at']))->format('Y-m-d H:i:s');
            $item['updated_at'] = (new \DateTime($item['updated_at']))->format('Y-m-d H:i:s');
            return $item;
        }, $data);
        return responseSuccess($message, $formatted);
    }

    public function search($id)
    {
        $role = Role::with('permissions')->find($id);
        if (!$role) {
            return responseError('Rol no encontrado.', 404);
        }
        return responseSuccess('Datos encontrados.', [
            'id' => $role->id,
            'name' => $role->name,
            'display_name' => $role->display_name,
            'permissions' => $role->permissions->pluck('name')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string',
            'accesos' => 'required|array',
            'accesos.*.menu' => 'required|integer',
            'accesos.*.permisos' => 'required|array',
            'accesos.*.permisos.*' => 'string|exists:permissions,name'
        ]);
        DB::transaction(function () use ($request) {
            $menuRole = [];
            $permisos = [];
            $newRole = Role::create([
                'name' => Str::slug($request->nombre),
                'display_name' => $request->nombre,
                'guard_name' => 'api'
            ]);
            foreach ($request->accesos as $value) {
                $permisos = array_merge($permisos, !empty($value['permisos']) ? $value['permisos'] : []);
                $menuRole[] = ['id_menu' => $value['menu'], 'id_role' => $newRole->id];
            }
            MenuRole::insert($menuRole);
            if (!empty($permisos)) {
                $newRole->syncPermissions($permisos);
            }
        });
        return responseSuccess('Created data', null, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'   => 'required|string|unique:roles,name,' . $id,
            'permisos' => 'array|exists:permissions,name'
        ]);
        $role = Role::findOrFail($id);
        $role->display_name = $request->nombre;
        $role->save();

        if ($request->has('permisos')) {
            $role->syncPermissions($request->permisos);
        }
        return responseSuccess('Updated data', null, 200);
    }

    public function remove($id)
    {
        Role::find($id)->delete();
        return responseSuccess('Deleted data', null, 200);
    }
}
