<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\DatosSistema;
use App\Models\TipoComprobante;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class DatosSistemaController extends Controller
{

    public function index() {
        $data = [
            'tipos_documentos' => [],
            'tipos_comprobantes' => TipoComprobante::all()
        ];
        return responseSuccess('Data found', $data);
    }

    public function ubigeo(Request $request)
    {
        $params = $request->validate([
            'departamento' => 'sometimes|nullable|integer',
            'provincia'    => 'sometimes|nullable|integer',
            'agrupar'      => 'sometimes|nullable|string|in:true,false'
        ]);
        $params['agrupar'] = isset($params['agrupar']) ? $params['agrupar'] == 'true' : false;
        $data = DatosSistema::getUbigeo($params);
        return responseSuccess('Data found', $data);
    }

    public function paises()
    {
        $data = DatosSistema::getPaises();
        return responseSuccess('Data found', $data);
    }

    public function permisos() {
        $data = Permission::all();
        return responseSuccess('Data found', $data);
    }
}
