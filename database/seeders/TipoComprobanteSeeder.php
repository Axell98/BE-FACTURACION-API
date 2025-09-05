<?php

namespace Database\Seeders;

use App\Models\TipoComprobante;
use Illuminate\Database\Seeder;

class TipoComprobanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
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
        foreach ($tiposComprobantes as $key => $value) {
            TipoComprobante::firstOrCreate([
                'id' => $key,
            ], [
                'descripcion' => $value
            ]);
        }
    }
}
