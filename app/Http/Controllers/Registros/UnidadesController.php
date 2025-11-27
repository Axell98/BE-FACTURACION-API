<?php

namespace App\Http\Controllers\Registros;

use App\Http\Controllers\Controller;
use App\Models\UnidadesMedida;
use Illuminate\Http\Request;

class UnidadesController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->validate([
            'activos' => 'sometimes|nullable|string|in:true'
        ]);
        $filter = [true, false];
        if (!empty($params)) unset($filter[1]);
        $data = UnidadesMedida::whereIn('activo', $filter)->orderBy('descripcion')->get()->toArray();
        $message = !empty($data) ? 'Data found' : 'Data not found';
        return responseSuccess($message, $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo'      => 'required|string',
            'descripcion' => 'required|string',
            'activo'      => 'sometimes|nullable|boolean'
        ]);
        if (UnidadesMedida::where('codigo', $data['codigo'])->exists()) {
            return responseError("Ya existe un registro con el mismo código", 409);
        }
        UnidadesMedida::create($data);
        return responseSuccess('Created data');
    }

    public function update(Request $request, $id)
    {
        $params = $request->validate([
            'codigo'      => 'required|string',
            'descripcion' => 'required|string',
            'simbolo'     => 'sometimes|nullable|string',
            'activo'      => 'sometimes|nullable|boolean'
        ]);
        UnidadesMedida::where(['id' => $id])->update([
            'descripcion' => $params['descripcion'],
            'activo' => $params['activo']
        ]);
        return responseSuccess('Updated data');
    }

    public function remove($id)
    {
        UnidadesMedida::where('id', $id)->remove();
        return responseSuccess('Deleted data');
    }
}
