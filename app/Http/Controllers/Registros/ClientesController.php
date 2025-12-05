<?php

namespace App\Http\Controllers\Registros;

use App\Models\Cliente;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use App\Http\Resources\ClienteResource;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ClientesController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->validate([
            'empresa' => 'sometimes|nullable|integer'
        ]);
        $data = Cliente::listClientes($params);
        $message = $data->isEmpty() ? 'Data not found' : 'Data found';
        return responseSuccess($message, ClienteResource::collection($data));
    }

    public function store(ClienteRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = JWTAuth::user()->usuario;
        Cliente::create($data);
        return responseSuccess('Successfully created data', [], 201);
    }

    public function update(ClienteRequest $request, $id)
    {
        $data = $request->validated();
        $data['updated_by'] = JWTAuth::user()->usuario;
        Cliente::where('id', $id)->update($data);
        return responseSuccess('Successfully updated data');
    }

    public function remove($id)
    {
        $cliente = Cliente::find($id);
        if ($cliente) {
            $cliente->delete();
            return responseSuccess('Successfully deleted data');
        }
        return responseError("No existe un cliente con el id [$id]", 404);
    }
}
