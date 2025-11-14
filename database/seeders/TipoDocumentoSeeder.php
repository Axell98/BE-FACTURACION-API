<?php

namespace Database\Seeders;

use App\Models\DatosDet;
use App\Models\TipoDocumento;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $cabId = '002';

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
        DatosDet::createCab([
            'id' => $this->cabId,
            'descripcion' => 'Tipos de documento ident.',
        ]);
        $orden = 1;
        foreach ($tiposComprobantes as $key => $value) {
            DatosDet::create([
                'id_cab' => $this->cabId,
                'id_det' => $key,
                'descripcion' => $value,
                'orden' => $orden
            ]);
            $orden++;
        }
    }
}
