<?php

namespace Database\Seeders;

use App\Models\DatosDet;
use Illuminate\Database\Seeder;

class TipoComprobanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $cabId = '001';

    public function run(): void
    {
        $tiposComprobantes = [
            '01' => 'Factura',
            '02' => 'Nota de venta',
            '03' => 'Boleta',
            '07' => 'Nota de crédito',
            '08' => 'Nota de debito',
            '09' => 'Guia de remisión',
            '00' => 'Cotización'
        ];
        DatosDet::createCab([
            'id' => $this->cabId,
            'descripcion' => 'Tipos de comprobante',
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
