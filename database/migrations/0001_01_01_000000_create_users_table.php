<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('usuario', 20)->unique();
            $table->string('password', 255)->nullable(false);
            $table->string('nombre', 100)->nullable(false);
            $table->string('tipo_doc', 3)->nullable();
            $table->string('nume_doc', 20)->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('foto_url', 255)->nullable();
            $table->string('empresa_acceso', 100)->nullable();
            $table->integer('empresa_actual')->nullable();
            $table->boolean('activo')->default(true)->nullable();
            $table->timestamps();
            $table->softDeletes();
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
