<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sourceSql = database_path('sql/menu.sql');
        if (File::exists($sourceSql)) {
            $sql = File::get($sourceSql);
            DB::unprepared($sql);
            $this->command->info('Archivo [menu.sql] ejecutado.');
        } else {
            $this->command->warn('Archivo [menu.sql] no encontrado.');
        }
    }
}
