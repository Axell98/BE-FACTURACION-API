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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_int', 50)->nullable();
            $table->string('razon_social', 250)->nullable(false);
            $table->string('nombre_comercial', 250)->nullable();
            $table->string('tipo_doc', 3)->nullable();
            $table->string('nume_doc', 25)->nullable();
            $table->string('ruc', 25)->nullable();
            $table->string('telefono', 150)->nullable();
            $table->string('celular', 150)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('direccion', 250)->nullable();
            $table->string('ubigeo', 6)->nullable();
            $table->string('contacto', 250)->nullable();
            $table->string('web', 250)->nullable();
            $table->string('cuenta_detraccion', 250)->nullable();
            $table->integer('empresa')->default(1);
            $table->boolean('activo')->default(true);
            $table->string('created_by', 15)->nullable();
            $table->timestamp('created_at', 0);
            $table->string('updated_by', 15)->nullable(); 
            $table->timestamp('updated_at', 0);
            $table->string('deleted_by', 15)->nullable();
            $table->softDeletes();
            $table->engine('InnoDB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
