<?php

namespace App\Http\Controllers\Configuracion;

use App\Models\Empresa;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmpresaRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class EmpresaController extends Controller
{
    public function index(Request $request)
    {
        $data = Empresa::all();
        $message = !empty($data) ? 'Data found' : 'Data not found';
        $newArray = array_map(function ($row) {
            $row['logo_url'] = !empty($row['logo_url']) ? env('APP_URL') . $row['logo_url'] : null;
            return $row;
        }, $data->toArray());
        return responseSuccess($message, $newArray);
    }

    public function store(EmpresaRequest $request)
    {
        $data = [
            'ruc'              => $request->input('ruc'),
            'razon_social'     => $request->input('razon_social'),
            'nombre_comercial' => $request->input('nombre_comercial'),
            'direccion'        => $request->input('direccion'),
            'telefono'         => $request->input('telefono'),
            'celular'          => $request->input('celular'),
            'ubigeo'           => $request->input('ubigeo'),
            'created_by'       => JWTAuth::user()->usuario,
        ];
        $data['logo_url'] = null;
        $data['cert_prod_url'] = null;
        $randomCod = Str::random(10);
        if ($request->hasFile('logo')) {
            $data['logo_url'] = $this->uploadLogo($request->file('logo'), $randomCod);
        }
        if ($request->hasFile('certificado')) {
            $data['cert_prod_url'] = $this->uploadCertificate($request->file('certificado'), $randomCod);
        }
        Empresa::create($data);
        return responseSuccess('Created data', null, 201);
    }

    private function uploadLogo($logoFile, string $randomCod)
    {
        $folderName = 'empresa/logo';
        if (!Storage::disk('public')->exists($folderName)) {
            Storage::disk('public')->makeDirectory($folderName);
        }
        $fileName = $randomCod . '.' . $logoFile->extension();
        $logoFile->storeAs($folderName, $fileName, 'public');
        $fileURL = Storage::url($folderName . '/' . $fileName);
        return $fileURL;
    }

    private function uploadCertificate($certFile, string $randomCod)
    {
        $folderName = 'certificado';
        if (!Storage::disk('local')->exists($folderName)) {
            Storage::disk('local')->makeDirectory($folderName);
        }
        $fileName = $randomCod . '.' . $certFile->extension();
        $certFile->storeAs($folderName, $fileName, 'local');
        return $folderName . '/' . $fileName;
    }
}
