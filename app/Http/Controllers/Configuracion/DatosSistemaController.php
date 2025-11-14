<?php

namespace App\Http\Controllers\Configuracion;

use App\Enums\DatosEnum;
use App\Http\Controllers\Controller;
use App\Models\DatosDet;
use App\Models\DatosUbigeo;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class DatosSistemaController extends Controller
{

    public function index()
    {
        $data = DatosDet::select('id_det as id', 'id_cab', 'descripcion')
            ->where('activo', true)
            ->orderBy('orden')
            ->get()->groupBy('id_cab');
        $response = [];
        foreach (DatosEnum::cases() as $categorias) {
            $response[$categorias->label()] = $data[$categorias->value] ?? [];
        };
        return responseSuccess('Data found', $response);
    }

    public function ubigeo(Request $request)
    {
        $params = $request->validate([
            'departamento' => 'sometimes|nullable|integer',
            'provincia'    => 'sometimes|nullable|integer',
            'agrupar'      => 'sometimes|nullable|string|in:true,false'
        ]);
        $params['agrupar'] = isset($params['agrupar']) ? $params['agrupar'] == 'true' : false;
        $data = DatosUbigeo::getUbigeo($params);
        return responseSuccess('Data found', $data);
    }

    public function paises()
    {
        $data = DatosUbigeo::getPaises();
        return responseSuccess('Data found', $data);
    }

    public function permisos()
    {
        $data = Permission::all();
        return responseSuccess('Data found', $data);
    }
}
