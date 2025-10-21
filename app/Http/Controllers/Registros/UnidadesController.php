<?php

namespace App\Http\Controllers\Registros;

use App\Http\Controllers\Controller;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UnidadesController extends Controller
{
    public function index(Request $request)
    {
        $data = UnidadMedida::all();
        $message = count($data) > 0 ? 'Data found' : 'Data not found';
        return responseSuccess($message, $data);
    }

    public function store(Request $request)
    {
        $body = $request->validate([
            'id' => 'required|string',
            'nombre' => 'required|string',
            'activo' => 'sometimes|nullable|boolean'
        ]);
        $body['created_by'] = JWTAuth::user()->usuario;
        UnidadMedida::create($body);
        return responseSuccess('Created data');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'activo' => 'sometimes|nullable|boolean'
        ]);
        UnidadMedida::whereId($id)->update([
            'nombre' => $request->input('nombre'),
            'activo' => $request->input('activo', true),
            'updated_by' => JWTAuth::user()->usuario,
        ]);
        return responseSuccess('Updated data');
    }

    public function remove($id)
    {
        UnidadMedida::where('id', $id)->remove();
        return responseSuccess('Deleted data');
    }
}
