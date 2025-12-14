<?php

namespace App\Http\Controllers\Registros;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class CategoriasController extends Controller
{
    public function index(Request $request)
    {
        $data = Categoria::select('id', 'nombre', 'descripcion', 'activo', 'created_by', 'created_at')->orderBy('nombre')->get()->toArray();
        $message = !empty($data) ? 'Data found' : 'Data not found';
        return responseSuccess($message, $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'sometimes|nullable|string',
            'activo' => 'sometimes|nullable|boolean',
        ]);
        $data['created_by'] = JWTAuth::user()->usuario;
        Categoria::create($data);
        return responseSuccess('Successfully created data', [], 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'sometimes|nullable|string',
            'activo' => 'sometimes|nullable|boolean'
        ]);
        Categoria::where('id', $id)->update($data);
        return responseSuccess('Successfully created data');
    }

    public function remove($id)
    {
        Categoria::where('id', $id)->remove();
    }
}
