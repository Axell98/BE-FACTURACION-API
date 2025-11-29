<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProveedorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'codigoInterno' => $this->codigo_int,
            'razonSocial' => $this->razon_social,
            'nombreComercial' => $this->nombre_comercial,
            'tipoDoc' => $this->tipo_doc,
            'tipoDocDes' => $this->tipo_doc_des,
            'numeDoc' => $this->nume_doc,
            'telefono' => $this->telefono,
            'celular' => $this->celular,
            'email' => $this->email,
            'direccion' => $this->direccion,
            'ubigeoCod' => $this->ubigeo,
            'ubigeoDes' => $this->ubigeo_des,
            'contacto' => $this->contacto,
            'empresa' => $this->empresa,
            'web' => $this->web,
            'agenteRetencion' => $this->agente_retencion,
            'activo' => $this->activo,
            'createdBy' => $this->created_by,
            'createdAt' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
            'updatedBy' => $this->updated_by,
            'updatedAt' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null
        ];
    }
}
