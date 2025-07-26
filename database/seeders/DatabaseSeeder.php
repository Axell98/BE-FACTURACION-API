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
            SuperAdminSeeder::class,
        ]);
    }
}
