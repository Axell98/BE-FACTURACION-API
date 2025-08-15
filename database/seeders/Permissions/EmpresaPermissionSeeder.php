<?php

namespace Database\Seeders\Permissions;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class EmpresaPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'empresa.view',
            'empresa.create',
            'empresa.edit',
            'empresa.delete'
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'api'
            ]);
        }
    }
}
