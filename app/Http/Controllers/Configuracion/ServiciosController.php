<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ServiciosController extends Controller
{
    protected $apiUrl = 'https://api.apifacturacion.com';
    protected $apiToken = 'd1bcba49df6b30e5a7bc0f202aae0fec';

    public function searchDni(string $dni)
    {
        try {
            $response = Http::asForm()->post($this->apiUrl . "/dni/$dni", [
                'token' => $this->apiToken
            ]);
            $responseBody = $response->body();
            $jsonData = json_decode($responseBody, true);
            if (empty($jsonData['dni'])) {
                return responseError('Sin resultados', 404);
            }
            return responseSuccess('Successful query', $jsonData);
        } catch (\Exception $ex) {
            return responseError('Sin resultados', 404);
        }
    }

    public function searchRuc(string $ruc)
    {
        try {
            $response = Http::asForm()->post($this->apiUrl . "/ruc/$ruc", [
                'token' => $this->apiToken
            ]);
            $responseBody = $response->body();
            $jsonData = json_decode($responseBody, true);
            if (empty($jsonData['ruc'])) {
                return responseError('Sin resultados', 404);
            }
            if (isset($jsonData['token'])) {
                unset($jsonData['token']);
            }
            return responseSuccess('Successful query', $jsonData);
        } catch (\Exception $ex) {
            return responseError('Sin resultados', 404);
        }
    }
}
