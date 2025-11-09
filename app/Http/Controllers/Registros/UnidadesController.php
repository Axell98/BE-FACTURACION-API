<?php

namespace App\Http\Controllers\Registros;

use App\Http\Controllers\Controller;
use App\Models\UnidadesMedida;
use Illuminate\Http\Request;

class UnidadesController extends Controller
{
    public function index()
    {
        $data = UnidadesMedida::where('activo', true)->orderBy('descripcion')->get()->toArray();
        $message = !empty($data) ? 'Data found' : 'Data not found';
        return responseSuccess($message, $data);
    }

    public function store(Request $request)
    {
        $body = $request->validate([
            'codigo_sunat' => 'required|string',
            'descripcion'  => 'required|string',
            'activo'       => 'sometimes|nullable|boolean'
        ]);
        UnidadesMedida::create($body);
        return responseSuccess('Created data');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo_sunat' => 'required|string',
            'descripcion'  => 'required|string',
            'simbolo'      => 'sometimes|nullable|string',
            'activo'       => 'sometimes|nullable|boolean'
        ]);
        UnidadesMedida::where('id', $id)->update([
            'descripcion' => $request->input('descripcion'),
            'simbolo' => $request->input('simbolo'),
            'activo' => $request->input('activo', true)
        ]);
        return responseSuccess('Updated data');
    }

    public function remove($id)
    {
        UnidadesMedida::where('id', $id)->remove();
        return responseSuccess('Deleted data');
    }
}
