<?php

namespace App\Exports;

use App\Models\Proveedor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ProveedorExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Proveedor::select([
            'codigo_int',
            'razon_social',
            'nombre_comercial',
            'tipo_doc',
            'nume_doc',
            'telefono',
            'celular',
            'email',
            'direccion'
        ])->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // 2. Definir las cabeceras: Esto se usará como la primera fila del archivo
        return [
            'Codigo Interno',
            'Nombre/Razon social',
            'Nombre comercial',
            'Tipo documento',
            'Número documento',
            'Telefono',
            'Celular',
            'Email',
            'Dirección'
        ];
    }

    public function getCsvSettings(): array
    {
        // Define el delimitador que quieres usar en el archivo CSV
        return [
            'delimiter' => ','
        ];
    }
}
