<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            'ver usuarios',
            'crear usuario',
            'editar usuario',
            'eliminar usuario'
        ];
        foreach ($permisos as $value) {
            Permission::firstOrCreate([
                'name' => $value,
                'guard_name' => 'api'
            ]);
        }
        $roles = [
            'super-admin',
            'admin'
        ];
        foreach ($roles as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'api'
            ]);
        }
        $superAdminRole = Role::where('name', 'super-admin')->first();
        $superAdminRole->syncPermissions(Permission::all());
        $superAdmin = User::firstOrCreate(
            [
                'usuario' => env('DEFAULT_ADMIN')
            ],
            [
                'nombre' => 'Super Administrador',
                'password' => bcrypt(env('DEFAULT_ADMIN_PASSWORD')),
                'created_at' => now(),
            ]
        );
        $superAdmin->assignRole('super-admin');
    }
}
