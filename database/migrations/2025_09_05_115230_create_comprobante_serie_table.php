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
        Schema::create('comprobante_serie', function (Blueprint $table) {
            $table->unsignedBigInteger('sucursal');
            $table->string('tipo_comp', 3);
            $table->string('serie', 10);
            $table->integer('correlativo');
            $table->primary(['sucursal', 'tipo_comp']);
            $table->foreign('sucursal')->references('id')->on('sucursales')->onDelete('cascade');
            $table->engine('InnoDB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprobante_serie');
    }
};
