<?php

namespace App\Http\Controllers\Registros;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->validate([
            'empresa' => 'sometimes|nullable|integer'
        ]);
        $data = Cliente::getData($params);
        $message = !empty($data) ? 'Data found' : 'Data not found';
        return responseSuccess($message, $data);
    }

    public function store(ClienteRequest $request)
    {
        $bodyReq = $request->validated();
        Cliente::create($bodyReq);
        return responseSuccess('Successfully created data', [], 201);
    }

    public function update(ClienteRequest $request, $id)
    {
        $bodyReq = $request->validated();
        Cliente::where('id', $id)->update($bodyReq);
        return responseSuccess('Successfully updated data', [], 201);
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
