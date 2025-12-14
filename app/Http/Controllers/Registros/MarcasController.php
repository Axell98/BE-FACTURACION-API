<?php

namespace App\Http\Controllers\Registros;

use App\Models\Marca;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class MarcasController extends Controller
{
    public function index(Request $request)
    {
        $data = Marca::select('id', 'nombre', 'activo', 'created_by', 'created_at')->orderBy('nombre')->get()->toArray();
        $message = !empty($data) ? 'Data found' : 'Data not found';
        return responseSuccess($message, $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'activo' => 'sometimes|nullable|boolean',
        ]);
        $data['created_by'] = JWTAuth::user()->usuario;
        Marca::create($data);
        return responseSuccess('Successfully created data', [], 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'activo' => 'sometimes|nullable|boolean'
        ]);
        Marca::where('id', $id)->update($data);
        return responseSuccess('Successfully created data');
    }

    public function remove($id)
    {
        Marca::where('id', $id)->delete();
        return responseSuccess('Successfully deleted data');
    }
}
