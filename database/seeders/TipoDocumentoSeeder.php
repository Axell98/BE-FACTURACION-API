<?php

namespace Database\Seeders;

use App\Models\TipoDocumento;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiposComprobantes = [
            '0' => 'Sin documento',
            '1' => 'DNI',
            '4' => 'Carnet de extranjería',
            '6' => 'RUC',
            '7' => 'Pasaporte',
            'A' => 'Cédula diplomática de identidad',
            'B' => 'Documento identidad país residencia-no.d',
            'C' => 'Tax Identificación Number - TIN – Doc Trib PP.NN',
            'D' => 'Identification Number - IN – Doc Trib PP. JJ',
            'E' => 'TAM - Tarjeta Andina de Migración',
            'F' => 'PTP - Permiso Temporal de Permanencia'
        ];
        foreach ($tiposComprobantes as $key => $value) {
            TipoDocumento::firstOrCreate([
                'id' => $key,
            ], [
                'descripcion' => $value
            ]);
        }
    }
}
