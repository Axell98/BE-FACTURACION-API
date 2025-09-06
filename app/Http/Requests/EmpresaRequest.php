<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ruc' => 'required|string|unique:empresas,ruc',
            'razon_social' => 'required|string',
            'nombre_comercial' => 'required|string',
            'direccion' => 'sometimes|nullable|string',
            'ubigeo' => 'required|string',
            'telefono' => 'sometimes|nullable|string',
            'celular' => 'sometimes|nullable|string',
            'ubigeo' => 'sometimes|nullable|string',
            'pais' => 'sometimes|nullable|string',
            'selva_bienes' => 'sometimes|nullable|string',
            'selva_servicios' => 'sometimes|nullable|string',
            'logo' => 'sometimes|nullable|file',
            'usuario_sol' => 'sometimes|nullable|string',
            'password_sol' => 'sometimes|nullable|string',
            'certificado' => 'sometimes|nullable|file|max:10240',
            'certificado_key' => 'sometimes|nullable|string'
        ];
    }
}
