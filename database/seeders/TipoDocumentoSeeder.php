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
            '0' => 'SIN DOCUMENTO',
            '1' => 'DNI',
            '4' => 'CARNET DE EXTRANJERÍA',
            '7' => 'RUC',
            'A' => 'CÉDULA DIPLOMÁTICA DE IDENTIDAD',
            'B' => 'DOC.IDENT.PAIS.RESIDENCIA-NO.D',
            'C' => 'Tax Identification Number - TIN – Doc Trib PP.NN',
            'D' => 'Identification Number - IN – Doc Trib PP. JJ',
            'E' => 'TAM- Tarjeta Andina de Migración'
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
