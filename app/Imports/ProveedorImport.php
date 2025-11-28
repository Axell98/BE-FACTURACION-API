<?php

namespace App\Imports;

use App\Models\Proveedor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ProveedorImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        $dataToInsert = $rows->map(function ($row) {
            return [
                'codigo_int' => $row['codigo_int'] ?? null,
                'razon_social' => $row['razon_social'],
                'nombre_comercial' => $row['nombre_comercial'] ?? null,
                'tipo_doc' => $row['tipo_doc'],
                'nume_doc' => $row['nume_doc'],
                'empresa' => $row['empresa'],
                'created_by' => JWTAuth::user()->usuario,
                'created_at' => now()
            ];
        })->toArray();
        Proveedor::insert($dataToInsert);
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function chunkSize(): int
    {
        return 500; // Puedes ajustar este valor
    }
}
