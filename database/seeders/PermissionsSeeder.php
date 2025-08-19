<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            'role' => ['view', 'create', 'edit', 'delete'],
            'usuario' => ['view', 'create', 'edit', 'delete'],
            'empresa' => ['view', 'create', 'edit', 'delete'],
            'sucursal' => ['view', 'create', 'edit', 'delete'],
        ];
        foreach ($modules as $module => $actions) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "$module.$action",
                    'guard_name' => 'api',
                ]);
            }
        }
    }
}
