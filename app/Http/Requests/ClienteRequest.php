<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'tipo_cliente' => 'required|integer',
            'nombres' => 'sometimes|nullable|string',
            'apellidos' => 'sometimes|nullable|string',
            'razon_social' => 'sometimes|nullable|string',
            'tipo_doc' => 'sometimes|nullable|string',
            'nume_doc' => 'sometimes|nullable|string',
            'ruc' => 'sometimes|nullable|string',
            'telefono' => 'sometimes|nullable|string',
            'celular' => 'sometimes|nullable|string',
            'email' => 'sometimes|nullable|string',
            'direccion' => 'sometimes|nullable|string',
            'ubigeo' => 'sometimes|nullable|string',
            'empresa' => 'sometimes|nullable|integer',
            'activo' => 'sometimes|nullable|boolean',
        ];
    }
}
