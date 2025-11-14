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
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id();
            $table->string('empresa', '3')->nullable(false);
            $table->string('cod_sunat', 20)->nullable(false);
            $table->string('nombre', 150)->nullable(false);
            $table->string('telefono', 50)->nullable();
            $table->string('celular', 50)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('direccion', 250)->nullable();
            $table->string('ubigeo', 6)->nullable();
            $table->boolean('principal')->nullable();
            $table->string('logo_menu', 255)->nullable();
            $table->string('logo_impresion', 255)->nullable();
            $table->string('created_by', 15)->nullable();
            $table->timestamp('created_at', 0);
            $table->string('updated_by', 15)->nullable();
            $table->timestamp('updated_at', 0);
            $table->foreign('empresa')
                ->references('id')
                ->on('empresas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->engine('InnoDB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursal');
    }
};
