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
}
