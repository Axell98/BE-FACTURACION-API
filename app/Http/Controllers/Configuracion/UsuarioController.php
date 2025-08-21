<?php

namespace App\Http\Controllers\Configuracion;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->validate([
            'rol' => 'sometimes|nullable|string',
            'estado' => 'sometimes|nullable|string|in:true,false'
        ]);
        $data = User::listUsers($params);
        $message = !empty($data) ? 'Data found' : 'Data not found';
        return responseSuccess($message, $data);
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

    public function update(UserRequest $request, $id)
    {
        User::where('id', $id)->update([
            'nombre'    => $request->nombre,
            'tipo_doc'  => $request->input('tipo_doc'),
            'nume_doc'  => $request->input('nume_doc'),
            'celular'   => $request->input('celular'),
            'direccion' => $request->input('direccion')
        ]);
        return responseSuccess('Updated data', null, 200);
    }

    public function remove($id)
    {
        User::where('id', $id)->delete();
        return responseSuccess('Deleted data', null, 200);
    }
}
