<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
            'permisos' => 'array',
            'permisos.*' => 'string|exists:permissions,name'
        ]);
        $newRole = Role::create([
            'name' => Str::slug($request->nombre),
            'display_name' => $request->nombre,
            'guard_name' => 'api'
        ]);
        if ($request->has('permisos')) {
            $newRole->syncPermissions($request->permisos);
        }
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
