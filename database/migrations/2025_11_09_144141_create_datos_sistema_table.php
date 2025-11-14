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
        Schema::create('datos_cab', function (Blueprint $table) {
            $table->string('id', '3')->primary();
            $table->string('descripcion', 250)->nullable();
        });

        Schema::create('datos_det', function (Blueprint $table) {
            $table->string('id_cab', '3')->nullable(false);
            $table->string('id_det', '5')->nullable(false);
            $table->string('descripcion', 250)->nullable(false);
            $table->integer('orden')->nullable();
            $table->boolean('activo')->default(true);
            $table->primary(['id_cab', 'id_det']);
            $table->engine('InnoDB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_det');
        Schema::dropIfExists('datos_cab');
    }
};
