<?php

namespace App\Http\Resources;

use App\Models\EmpresaUsuario;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'usuario'     => $this->usuario,
            'nombre'      => $this->nombre,
            'tipo_doc'    => $this->tipo_doc,
            'nume_doc'    => $this->nume_doc,
            'celular'     => $this->celular,
            'email'       => $this->email,
            'direccion'   => $this->direccion,
            'foto_url'    => !empty($this->foto_url) ? env('APP_URL') . $this->foto_url : null,
            'activo'      => $this->activo,
            'roles'       => $this->roles->isNotEmpty() ? $this->roles->first()->only(['id', 'name', 'display_name']) : null,
            'empresas'    => EmpresaUsuario::getEmpresas($this->id),
            'permissions' => $this->getAllPermissions()->pluck('name'),
            'created_at'  => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at'  => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
