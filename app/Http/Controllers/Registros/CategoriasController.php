<?php

namespace App\Http\Controllers\Registros;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index(Request $request)
    {
        $data = Categoria::all();
        $message = !empty($data) ? 'Data found' : 'Data not found';
        return responseSuccess($message, $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'activo' => 'required|boolean'
        ]);
        Categoria::create($data);
        return responseSuccess('Successfully created data', [], 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'activo' => 'required|boolean'
        ]);
        Categoria::where('id', $id)->update($data);
        return responseSuccess('Successfully created data');
    }
}
