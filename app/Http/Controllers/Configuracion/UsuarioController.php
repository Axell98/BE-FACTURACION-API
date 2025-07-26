<?php

namespace App\Http\Controllers\Configuracion;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $data = User::all();
        return responseSuccess('Data found', $data);
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'usuario'   => $request->usuario,
            'password'  => bcrypt($request->password),
            'nombre'    => $request->nombre,
            'tipo_doc'  => $request->input('tipo_doc'),
            'nume_doc'  => $request->input('nume_doc'),
            'celular'   => $request->input('celular'),
            'direccion' => $request->input('direccion')
        ]);
        $user->assignRole($request->role);
        return responseSuccess('Created data', null, 201);
    }
}
