<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'usuario'  => 'required|string',
            'nombre'   => 'required|string',
            'password' => 'required|string|min:8',
            'role'     => 'required|string|exists:roles,name',
            'tipo_doc' => 'present|nullable|string',
            'nume_doc' => 'present|nullable|string',
            'celular'  => 'present|nullable|string',
            'direccion' => 'present|nullable|string',
            'empresas' => 'required|array',
            'empresas.*' => 'required|integer|min:1'
        ];
        if ($this->isMethod('PUT')) {
            unset($rules['password']);
        }
        return $rules;
    }
}
