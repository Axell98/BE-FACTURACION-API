<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UnidadMedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sourceSql = database_path('sql/unidad_medida.sql');
        if (File::exists($sourceSql)) {
            $sql = File::get($sourceSql);
            DB::unprepared($sql);
            $this->command->info('Archivo [unidad_medida.sql] ejecutado.');
        } else {
            $this->command->warn('Archivo [unidad_medida.sql] no encontrado.');
        }
    }
}
