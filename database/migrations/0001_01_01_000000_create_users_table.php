<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->string('nombre', 100);
            $table->string('tipo_doc', 10)->nullable();
            $table->string('nume_doc', 50)->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('email', 120)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('foto_url', 255)->nullable();
            $table->boolean('activo')->default(1)->nullable();
            $table->timestamp('last_login')->nullable();
            $table->timestamps();
            $table->engine('InnoDB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
