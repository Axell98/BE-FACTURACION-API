<?php

namespace App\Http\Controllers\Registros;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProveedorRequest;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ProveedoresController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->validate([]);
        $data = Proveedor::all();
        $message = !empty($data) ? 'Data found' : 'Data not found';
        return responseSuccess($message, $data);
    }

    public function store(ProveedorRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = JWTAuth::user()->usuario;
        Proveedor::create($data);
        return responseSuccess('Successfully created data', [], 201);
    }

    public function update(ProveedorRequest $request, $id)
    {
        $data = $request->validated();
        $proveedor = Proveedor::find($id);
        if ($proveedor) {
            $data['updated_by'] = JWTAuth::user()->usuario;
            Proveedor::where('id', $id)->update($data);
            return responseSuccess('Successfully updated data');
        }
        return responseError("No existe un cliente con el id [$id]", 404);
    }

    public function remove($id)
    {
        $proveedor = Proveedor::find($id);
        if ($proveedor) {
            $proveedor->delete();
            return responseSuccess('Successfully deleted data');
        }
        return responseError("No existe un cliente con el id [$id]", 404);
    }
}
