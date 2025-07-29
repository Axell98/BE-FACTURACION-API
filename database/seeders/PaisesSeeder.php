<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PaisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sourceSql = database_path('sql/paises.sql');
        if (File::exists($sourceSql)) {
            $sql = File::get($sourceSql);
            DB::unprepared($sql);
            $this->command->info('Archivo [paises.sql] ejecutado.');
        } else {
            $this->command->warn('Archivo [paises.sql] no encontrado.');
        }
    }
}
