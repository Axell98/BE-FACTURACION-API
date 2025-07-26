<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::firstOrCreate([
            'name' => 'super-admin', 
            'display_name' => 'Super Administrador', 
            'guard_name' => 'api'
        ]);
        $user = User::firstOrCreate(
            [
                'usuario' => env('DEFAULT_ADMIN')
            ],
            [
                'nombre'     => 'Super Administrador',
                'password'   => bcrypt(env('DEFAULT_ADMIN_PASSWORD')),
                'created_at' => now()
            ]
        );
        $user->assignRole($superAdminRole);
        $this->command->info('Usuario Super Admin creado.');
    }
}
