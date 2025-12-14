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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigoInterno', 60);
            $table->string('codigoBarras', 60);
            $table->string('nombre', 250);
            $table->string('descripcion', 250)->nullable();
            $table->text('especificaciones')->nullable();
            $table->date('fechaVenc')->nullable();
            $table->unsignedBigInteger('categoria')->nullable();
            $table->unsignedBigInteger('marca')->nullable();
            $table->unsignedBigInteger('unidadMedida')->nullable();
            $table->decimal('stockIni')->nullable();
            $table->decimal('stockMin')->nullable();
            $table->decimal('stockAct')->nullable();
            $table->decimal('precioVenta')->nullable();
            $table->decimal('precioCompra')->nullable();
            $table->boolean('incluyeIgv')->nullable();
            $table->string('tipoAfecVenta', 5)->nullable();
            $table->string('tipoAfecCompra', 25)->nullable();
            $table->string('imagenUrl', 250)->nullable();
            $table->string('enlaceUrl', 250)->nullable();
            $table->string('sucursal', 50);
            $table->string('empresa', 3);
            $table->string('createdBy', 12)->nullable();
            $table->timestamp('createdAT', 0)->nullable();
            $table->string('updatedBy', 12)->nullable();
            $table->timestamp('updatedAt', 0)->nullable();
            $table->string('deletedBy', 12)->nullable();
            $table->timestamp('deletedAt', 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
