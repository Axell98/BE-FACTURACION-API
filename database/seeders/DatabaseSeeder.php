<?php

namespace Database\Seeders;

use Database\Seeders\Permissions;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            Permissions\UserPermissionSeeder::class,
            Permissions\RolePermissionSeeder::class,
            Permissions\EmpresaPermissionSeeder::class,
            SuperAdminSeeder::class,
            UbigeoSeeder::class,
            PaisesSeeder::class
        ]);
    }
}
