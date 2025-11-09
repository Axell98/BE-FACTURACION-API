<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\SucursalRequest;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->validate([
            'empresa' => 'required|integer'
        ]);
        $data = Sucursal::all();
        $message = !empty($data) ? 'Data found' : 'Data not found';
        return responseSuccess($message, $data);
    }

    public function register(SucursalRequest $request) {}

    public function update(SucursalRequest $request, int $id) {}

    public function remove(int $id) {}
}
