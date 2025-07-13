<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('usuario', 15)->unique();
            $table->string('password', 255);
            $table->string('nombre', 150);
            $table->string('celular', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('direccion', 20)->nullable();
            $table->string('avatar', 20)->nullable();
            $table->boolean('activo')->default(1)->nullable();
            $table->timestamp('last_login')->nullable();
            $table->timestamps();
            $table->engine('InnoDB');
        });

        DB::table('usuario')->insert([
            'usuario'     => env('DEFAULT_ADMIN'),
            'password'    => bcrypt(env('DEFAULT_ADMIN_PASSWORD')),
            'nombre'      => 'Super Administrador',
            'activo'      => true,
            'created_at'  => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
