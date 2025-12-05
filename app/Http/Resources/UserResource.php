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
            'id'         => $this->id,
            'usuario'    => $this->usuario,
            'nombres'    => $this->nombres,
            'apellidos'  => $this->apellidos,
            'fullNombre'   => trim($this->nombres . ' ' . $this->apellidos),
            'tipoDoc'    => $this->tipo_doc,
            'numeDoc'    => $this->nume_doc,
            'fechaNac'   => $this->fecha_nac,
            'celular'    => $this->celular,
            'email'      => $this->email,
            'direccion'  => $this->direccion,
            'fotoUrl'    => !empty($this->foto_url) ? config('app.url') . $this->foto_url : null,
            'activo'     => (bool) $this->activo,
            'roles'      => $this->roles->isNotEmpty() ? $this->roles->first()->only(['name', 'display_name']) : null,
            'empresas'   => EmpresaUsuario::getEmpresaUsuario($this->id),
            // 'permissions' => $this->getAllPermissions()->pluck('name'),
            'createdAt'  => $this->created_at->format('Y-m-d H:i:s'),
            'updatedAt'  => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
