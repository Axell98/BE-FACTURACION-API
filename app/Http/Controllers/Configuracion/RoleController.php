<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $data = Role::all();
        return responseSuccess('Data found', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);
        $role = Role::create(['name' => $request->nombre]);
        return responseSuccess('Rol creado', null, 201);
    }
}
